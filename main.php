<?php
header('content-type:text/html;charset=utf-8');
include "./lib/dbconn.php";

$ip = $_SERVER['REMOTE_ADDR'];
mysql_query("set session character_set_client=utf8");
mysql_query("set session character_set_connection=utf8");
mysql_query("set session character_set_results=utf8");

$path = $_GET['path'];
$word = $_GET['word'];
$tag_name = $_GET['tag_name'];

$task = $_GET['task'];

if($task == 'select_error'){
	echo "<script>alert('카테고리를 선택해 주세요'); history.go(-1);</script>";
}

if(isset($tag_name)){
    $asset_sql = "select *
                            from tag t
                            inner join asset_tag at
                            on t.tag = at.tag
                            inner join asset a 
                            on at.asset_id = a.asset_id
                            where t.tag='$tag_name' and path='$path' group by asset_name order by t.tag   
    ";
}else if(isset($word)){
    $asset_sql = "select *
                            from tag t
                            inner join asset_tag at
                            on t.tag = at.tag
                            inner join asset a
                            on at.asset_id = a.asset_id
                            where t.tag='$word' group by asset_name     order by t.tag";
}
    else{
    $asset_sql = "select * from asset where path='$path' group by asset_name";    
}

if(isset($task) && $task =="filename" && isset($word)){
    $asset_sql = "select * from asset where asset_name like '%$word%' group by asset_name";
}

///// auto complete /////
$auto_sql = "select * from tag";
$auto_result = mysql_query($auto_sql);
$json=array();

while($auto_row = mysql_fetch_array($auto_result)){
	array_push($json,$auto_row['tag']);
}
//////////////////////////

$asset_result = mysql_query($asset_sql);
$asset_rowcnt = mysql_num_rows($asset_result);


if(empty($word)){

	$db_asset_array = array();
	
	while ($asset_row = mysql_fetch_array($asset_result)) {
		array_push($db_asset_array, array_pop(explode('/',$asset_row[asset_name])));
	}
}
////////////////////
?>

<?php if(isset($path) || isset($word)){?>

<div id="img">
<br><br>
	<form id="tag_search_form" action="javascript:form_submit('<?php echo $path?>')">
		<label>
			<font size='2' style='color : #918F90; padding-left:0%'><b>TAG NAME &nbsp; </b></font>
				<input type="text"  id="tag_search_text">
				<input type="submit" value="검색" id="tag_search_form">
		</label>
	</form>
	
	<div class="clear"></div>
	<?php
	       header('content-type:text/html;charset=utf-8');
	        include "os_chk.php";
	        if($user_os== Linux){
	        	echo "<font size='4.2' style='color : #727071; padding-left:0%'><b> Path&nbsp;&nbsp; : &nbsp;&nbsp;</b>". $path ."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	        }else{
	        	$win_path = str_replace('/', '\\', $path);
	        	$win_get_path = str_replace('/','\\',$get_path);
	        	echo "<font size='3' style='color : #012874; padding-left:0%'><b> PATH&nbsp;&nbsp; : &nbsp;&nbsp;</b>". $win_path ."</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
	        }
	 ?>
	        <br> <br>
 	<input type='button'  value='Select All' id='chk' >
 		<b style='padding-left : 82%; color : #8F8D8C; font-size:17px;'> Total : <?php echo $asset_rowcnt; ?></b>
		<ul class="grid effect-2" id="grid">
		<?php
	      if( json_encode($db_asset_array) == "[]"){
	       echo "<font color='#01335b;'> 데이터가 없습니다</font>";
	                    }
	                    else {
	                    	$asset_result2 = mysql_query($asset_sql, $connect);
	                    	for($i=0; $i<$asset_rowcnt; $i++){
	                    		$asset_rs = mysql_fetch_array($asset_result2);
	                    		$asset_path = array_pop(explode('/',$asset_rs[full_path]));
	                    		
	                    		if($user_os== Linux){
	                    			$full_path = $asset_rs[full_path];
	                    		}else{
	                    			$full_path = str_replace('/', '\\', $asset_rs[full_path]);
	                    		}
	                    		$rv=str_replace(" ","%20","rvlink:// '".$asset_rs[rv_path]."'");
	                    		if(isset($word)){
	                    			echo("
											<li style='width:280px' id='img' asset_id='$asset_rs[asset_id]' ondrop=drop(event,'$path','$asset_rs[asset_id]') ondragover='allowDrop(event)'>
                                                <a href=javascript:detail('$asset_rs[thum]','$asset_rs[lod]','$asset_rs[full_path]','$asset_rs[asset_name]','$asset_rs[mov]','$asset_rs[texture]','$asset_rs[model]','$asset_rs[lookdev]','$asset_rs[rigging]')>
                                                    <img src='./thumnail/small_thum/$asset_rs[thum]' >
                                                </a>
                                                <br>
	                    					    <center>
                                                <a href=javascript:detail('$asset_rs[thum]','$asset_rs[lod]','$asset_rs[full_path]','$asset_rs[asset_name]','$asset_rs[mov]','$asset_rs[texture]','$asset_rs[model]','$asset_rs[lookdev]','$asset_rs[rigging]')>
	                    			                    <b style='font-size : 15px'>    
	                    			                        $asset_rs[asset_name]
	                    			                    </b>
	                    			                </a>
                                                </center>
                                                <br>
                                                <hr style='border : 1px double #c1c1c1;'><br>
	                    					");
	                    		}
	                    		else{
	                    		echo("
                                        <li style='width:280px' id='img' asset_id='$asset_rs[asset_id]' ondrop=drop(event,'$path','$asset_rs[asset_id]') ondragover='allowDrop(event)'>
                                                <a href=javascript:detail('$asset_rs[thum]','$asset_rs[lod]','$asset_rs[full_path]','$asset_rs[asset_name]','$asset_rs[mov]','$asset_rs[texture]','$asset_rs[model]','$asset_rs[lookdev]','$asset_rs[rigging]')>
                                                <img src='./thumnail/small_thum/$asset_rs[thum]' >
                                            </a>
                                            <br>
	                    				   <center>
                                                <a href=javascript:detail('$asset_rs[thum]','$asset_rs[lod]','$asset_rs[full_path]','$asset_rs[asset_name]','$asset_rs[mov]','$asset_rs[texture]','$asset_rs[model]','$asset_rs[lookdev]','$asset_rs[rigging]')>
                                                    <b style='font-size : 15px'>    
                                                        $asset_rs[asset_name]
	                    		                     </b>
                                                </a>
                                            </center>
                                            <br>
											<hr style='border : 1px double #c1c1c1;'><br>								
											");
	                    		}
	                    		    $tag_asset_sql = "select a.asset_id as asset_id, t.tag as tag
                                	                    		from tag t
                                	                    		inner join asset_tag at
                                	                    		on t.tag = at.tag
                                	                    		inner join asset a
                                	                    		on at.asset_id = a.asset_id
                                	                    		where full_path = '$asset_rs[full_path]' group by t.tag order by t.tag";
	                    		echo "<div id='tags'  ondrop=drop(event,'$path','$asset_rs[asset_id]') ondragover='allowDrop(event)'>";
	                    		$tag_asset_result = mysql_query($tag_asset_sql,$connect);
	                    		$tag_asset_cnt = mysql_num_rows($tag_asset_result);
	                    		
	                    		for($i2 = 0; $i2 < $tag_asset_cnt; $i2++){
	                    			$tag_asset_rs = mysql_fetch_array($tag_asset_result);
	                    				echo ("<div class='tag2'>
	                    						<a href=javascript:tag_search('$path','$tag_asset_rs[tag]') style='float:left'><b># $tag_asset_rs[tag] </b></a>
	                    						<a href=javascript:delete_asset_popup('$tag_asset_rs[asset_id]','$tag_asset_rs[tag]','$path') style='float:left'>&nbsp; x</a>
	                    						</div>
	                    						");
	                    		}
	                    		echo "</div>"; //tags end
								echo("</li>");
	                    }
	            }
?>
	</ul>
</div>
<div class="wrap-loading display-none">
    <div><img src="./images/loading.gif" /></div>
</div>    

<div id="floatMenu">
<h2><font style="color:#4C4C4C" ><center>TAG LIST</center></font> </h2>
<?php
include "lib/dbconn.php";

$dept_sql = "select * from tag_dept where parent_id like '0%'";
$dept_result = mysql_query($dept_sql);
$dept_cnt = mysql_num_rows($dept_result);
echo("
			<div id='sidetree'>
				<div class='treeheader'>&nbsp;</div>
				<div id='sidetreecontrol' style='font-size:10px;padding-left : 58%;'><a href='?#'><b>CLOSE</a> | <a href='?#'>OPEN</a></b></div>
				<br>
				<ul id='tree'>
				&nbsp;<a onclick=add_cate_tag('root','$path')><b>+</b></a>
");	//root 추가
for($i=0; $i<$dept_cnt; $i++){
		$dept_rs = mysql_fetch_array($dept_result);
		echo "<li class='dept' id='$dept_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=tag_drop(event,this,'$path','$dept_rs[tag]') ondragover='allowDrop(event)' ondragenter='dragEnter(event)' ondragleave='dragLeave(event)'>
					<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=delete_tag_popup('$dept_rs[idx]','$path','$dept_rs[tag]') width=10 height=10>
					<b><span class='tag_edit' idx='$dept_rs[idx]' path='$path' tag='$dept_rs[tag]' >$dept_rs[tag]</span></b>
					<a onclick=add_cate_tag('$dept_rs[position]','$path')>+</a>
				";
		//start
		$dept2_sql = "select * from tag_dept where parent_id='$dept_rs[position]'";	//dept2까지 존재 & tag O
		$dept2_result = mysql_query($dept2_sql);
		$dept2_cnt = mysql_num_rows($dept2_result);
		
		echo("<ul>");
		for($i2=0; $i2<$dept2_cnt; $i2++){
			$dept2_rs = mysql_fetch_array($dept2_result);
			
			echo "<li class='dept'  id='$dept2_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=tag_drop(event,this,'$path','$dept2_rs[tag]') ondragover='allowDrop(event)' ondragenter='dragEnter(event)' ondragleave='dragLeave(event)'>
					<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=delete_tag_popup('$dept2_rs[idx]','$path','$dept2_rs[tag]') width=10 height=10>
					<b><span class='tag_edit' idx='$dept2_rs[idx]' path='$path' tag='$dept2_rs[tag]' >$dept2_rs[tag]</span></b>
					<a onclick=add_cate_tag('$dept2_rs[position]','$path')>+</a>
					";		//dept2 출력
			
			//3start
			$dept3_sql = "select * from tag_dept where parent_id='$dept2_rs[position]'";//dept3까지 존재 & tag O
			$dept3_result = mysql_query($dept3_sql);
			$dept3_cnt = mysql_num_rows($dept3_result);
			
			echo("<ul>");
			
			for($i3=0; $i3<$dept3_cnt; $i3++){
				$dept3_rs = mysql_fetch_array($dept3_result);
				echo "<li class='dept' id='$dept3_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=tag_drop(event,this,'$path','$dept3_rs[tag]') ondragover='allowDrop(event)' ondragenter='dragEnter(event)' ondragleave='dragLeave(event)'>
							<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=delete_tag_popup('$dept3_rs[idx]','$path','$dept3_rs[tag]') width=10 height=10>
							<b><span class='tag_edit' idx='$dept3_rs[idx]' path='$path' tag='$dept3_rs[tag]'>$dept3_rs[tag]</span></b>
							<a onclick=add_cate_tag('$dept3_rs[position]','$path')>+</a>
						";	//dept3 출력
				
				//4start
				$dept4_sql = "select * from tag_dept where parent_id='$dept3_rs[position]'";
				$dept4_result = mysql_query($dept4_sql);
				$dept4_cnt = mysql_num_rows($dept4_result);
				
				echo "<ul>";
				
				for($i5=0; $i5<$dept4_cnt; $i5++){
					$dept4_rs = mysql_fetch_array($dept4_result);
					echo "<li class='dept' id='$dept4_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=tag_drop(event,this,'$path','$dept4_rs[tag]') ondragover='allowDrop(event)' ondragenter='dragEnter(event)' ondragleave='dragLeave(event)'>
								<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=delete_tag_popup('$dept4_rs[idx]','$path','$dept4_rs[tag]') width=10 height=10>
								<b><span class='tag_edit' idx='$dept4_rs[idx]' path='$path' tag='$dept4_rs[tag]'>$dept4_rs[tag]</span></b>
								<a onclick=add_cate_tag('$dept4_rs[position]','$path')>+</a>
							";	//dep4 출력
					
					//5 start
					$dept5_sql = "select * from tag_dept where parent_id='$dept4_rs[position]'";	//dept3까지 존재 & tag O
					$dept5_result = mysql_query($dept5_sql);
					$dept5_cnt = mysql_num_rows($dept5_result);
					
					echo "<ul>";
					
					for($i6=0; $i6<$dept5_cnt; $i6++){
						$dept5_rs = mysql_fetch_array($dept5_result);
						echo "<li class='dept' id='$dept5_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=tag_drop(event,this,'$path','$dept5_rs[tag]') ondragover='allowDrop(event)' ondragenter='dragEnter(event)' ondragleave='dragLeave(event)'>
									<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=delete_tag_popup('$dept5_rs[idx]','$path','$dept5_rs[tag]') width=10 height=10>
									<b><span class='tag_edit' idx='$dept5_rs[idx]' path='$path' tag='$dept5_rs[tag]' >$dept5_rs[tag]</span></b>
									<a onclick=add_cate_tag('$dept5_rs[position]','$path')>+</a>
						";	//dept5 출력
						
						//6 start
						
						$dept6_sql = "select * from tag_dept where parent_id='$dept5_rs[position]'";	
						$dept6_result = mysql_query($dept6_sql);
						$dept6_cnt = mysql_num_rows($dept6_result);
						
						echo "<ul>";
						
						for($i8=0; $i8<$dept6_cnt; $i8++){
							$dept6_rs = mysql_fetch_array($dept6_result);
							echo "<li class='dept' id='$dept6_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=tag_drop(event,this,'$path','$dept6_rs[tag]') ondragover='allowDrop(event)'>
										<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=delete_tag_popup('$dept6_rs[idx]','$path','$dept6_rs[tag]') width=10 height=10>
										<b><span class='tag_edit' idx='$dept6_rs[idx]' path='$path' tag='$dept6_rs[tag]'>$dept6_rs[tag]</span></b>
										<a onclick=add_cate_tag('$dept6_rs[position]','$path')>+</a>
							";	//dept6 출력
							
							//7 start
							
							$dept7_sql = "select * from tag_dept where parent_id='$dept6_rs[position]'";
							$dept7_result = mysql_query($dept7_sql);
							$dept7_cnt = mysql_num_rows($dept7_result);
							
							echo "<ul>";
							for($i10=0; $i10<$dept7_cnt; $i10++){
								$dept7_rs = mysql_fetch_array($dept7_result);
								echo "<li class='dept' id='$dept7_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=tag_drop(event,this,'$path','$dept7_rs[tag]') ondragover='allowDrop(event)'>
								<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=delete_tag_popup('$dept7_rs[idx]','$path','$dept7_rs[tag]') width=10 height=10>
								<b><span class='tag_edit' idx='$dept7_rs[idx]' path='$path' dept='$dept7_rs[tag]'>$dept7_rs[tag]</span></b>
								<a onclick=add_cate_tag('$dept7_rs[position]','$path')>+</a>
								";	//dept7 출력
								
								//8 start
								$dept8_sql = "select * from tag_dept where parent_id='$dept7_rs[position]'";
								$dept8_result = mysql_query($dept8_sql);
								$dept8_cnt = mysql_num_rows($dept8_result);
								
								echo "<ul>";
								for ($i11=0; $i11<$dept8_cnt; $i11++){
									$dept8_rs = mysql_fetch_array($dept8_result);
									echo "<li class='dept' id='$dept8_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=tag_drop(event,this,'$path','$dept8_rs[tag]') ondragover='allowDrop(event)'>
									<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=delete_tag_popup('$dept8_rs[idx]','$path','$dept8_rs[dept8]') width=10 height=10>
									<b><span class='tag_edit' idx='$dept8_rs[idx]' path='$path' dept='$dept8_rs[tag]'>$dept8_rs[tag]</span></b>
									";	//dept8 출력
								}	//8 end
								echo "</ul>";
								echo "</li>";
							}	//7 end
							echo "</ul>";
							echo "</li>";
						}// 6 end
						echo "</ul>";						
						echo "</li>";
					} //5 end
					echo "</ul>";
					echo "</li>";
				} //4 end
				echo "</ul>";
				echo "</li>";
			}//3 end
			echo "</ul>";
			echo "</li>";
		}
		echo"</ul>";
		echo "</li>";
}
echo("</ul></div>");

// function submit_py($path2){
// 	$a =   exec("python /home/crystal/PycharmProjects/image_gallery/test.py $path2");
// 	echo $a;
// }
?>
</div>
<?php }?>
    <br><br><Br>
    <a href="#" class="scrollToTop"><img src="images/up-arrow.png" width=50 height=50></a>   
    <script src="js/masonry.pkgd.min.js"></script>
	<script src="js/imagesloaded.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/AnimOnScroll.js"></script>
		                  
	<script src="js/float_dimensions.js" type="text/javascript" ></script>
	<script src="js/jquery.cookie.js" type='text/javascript'></script>
    <script src="js/jquery.treeview.js" type="text/javascript"></script>
	<style type="text/css">
	#floatMenu {
		position:absolute;
		float : left;
		top:20%;
		width : 12%;
		margin-left : 67%;
		padding : 10px;
		border : 1px solid #BDBDBD;
		}
	</style>
	<script type='text/javascript'>
// 	var masonry = new Masonry('.masonry', {
// 		  itemSelector: 'li',
// 		        columnWidth: '.box',
// 		        itemSelector: '.box',
// 		        isAnimated: true
// 		});

	new AnimOnScroll( document.getElementById( 'grid' ), {
		minDuration : 0.4,
		maxDuration : 0.7,
		viewportFactor : 0.2
	})

	$( function() {
		var availableTags = <?php echo json_encode($json); ?>;
		$( "#tag_search_text" ).autocomplete({
			source: availableTags,
			delay:1000
		});
	});
			
	var name = "#floatMenu";
	var menuYloc = null;
	$(document).ready(function(){
		menuYloc = parseInt($(name).css("top").substring(0,$(name).css("top").indexOf("px")))
		$(window).scroll(function () { 
			offset = menuYloc+$(document).scrollTop()+"px";
			$(name).animate({top:offset},{duration:500,queue:false});
		});
	}); 
	    		
	$(function() {
		$("#tree").treeview({
			collapsed: false,
			animated: "fast",
			control:"#sidetreecontrol",
			persist: "location"
		});
	});

	$('.tag_edit').click(function() {
		 var $text = $(this),
		$input = $('<input type="text"/>')
		$text.hide()
		.after($input);

		$input.val($text.html()).show().focus()
		.keypress(function(e) {
			var key = e.which
			if (key == 13){ //enter key
				var update_name = $input.val();
				$.ajax({
					type : "post",
					data : {
						 update_tag : $input.val(),
						 idx:$text.attr('idx'),
						path:$text.attr('path'),
						tag:$text.attr('tag')
					},
						url : "update_tag.php",
						dataType:'html',
						success : function(data){
							$('#gallery').html(data);
							$input.hide();
							$text.html($input.val())
							.show();
						},error: function (XMLHttpRequest, textStatus, errorThrown) {
							alert('Error: ' + XMLHttpRequest.responseText)
							}
					});
					return false;
				}
			})
			.focusout(function() {
				$input.hide();
				$text.show();
			})
	});
	function submit_py(path){
		var path = path;
		$.ajax({
			type : "post",
			url : "thum.php",
			data : {path : path},
			dataType:'html',
			success: function(data){
				$('#gallery').html(data);
			},beforeSend : function(){
				$('.wrap-loading').removeClass('display-none');
			},complete:function(){
				$('.wrap-loading').addClass('display-none');
			}, error:function (request, status,error){
				console.log("code : "+request.status+"\n"+"message : "+request.responseText+"\n"+"error : "+error);
			}
		});
	}
	
	var id_arr = [];
	var asset_id_arr=[];

	$("li#img").click(function (){
		$(this).toggleClass("selected");
		var asset_id = $(this).attr('asset_id');
		id_arr.push(asset_id);
	
		asset_id_arr=id_arr.filter(function(el,i,arr){	//중복 제거
			return arr.indexOf(el) === i;
		});
		$('.selected').click(function(){
			$(this).removeClass('selected');
			asset_id_arr.length = 0;
			$('.selected').each(function(){
				asset_id_arr.push($(this).attr("asset_id"));
			});
		});
	});

	$("#chk").click(function(){
		$("li#img").toggleClass("selected");
		$("li#img").each(function(){
			asset_id_arr.push($(this).attr("asset_id"));
		});
		$("#chk").click(function () {
			asset_id_arr.length = 0;
		 });
		$('.selected').click(function(){
			$(this).removeClass('selected');
			asset_id_arr.length = 0;
			$('.selected').each(function(){
				asset_id_arr.push($(this).attr("asset_id"));
			 });
		 });
	});
		         	
	function allowDrop(ev) {
		ev.preventDefault();
	}

	function drag(ev) {
		ev.dataTransfer.setData("text", ev.target.id);
	}

	function dragEnter(event) {
		event.target.style.background="#A8D5FF";
	}

	function dragLeave(event) {
		event.target.style.background = "#E3EFFF";
		event.target.style.border="";
	}

	function drop(ev,path,asset_id) {
		ev.preventDefault();
		var data = ev.dataTransfer.getData("text");
		var path = path;
		var asset_id = asset_id;
		ev.target.appendChild(document.getElementById(data));

		console.log(asset_id_arr);
		if(asset_id_arr.length == 0){	//선택한 이미지 없을 경우
			$.ajax({
				url : 'insert_drag_tag.php?tag='+ data + '&path='+path + '&asset_id=' + asset_id ,
				dataType : 'html',
				async : false
    			}).success(function(data){
					$('#gallery').html(data);
					return;
				});
		}
		if(asset_id_arr.length >0){
			$.ajax({
				url : 'insert_drag_tag.php?asset_id_arr='+ asset_id_arr + '&path='+path + '&tag=' + data,
				dataType : 'html',
				async : false
			}).success(function(data){
				$('#gallery').html(data);
				return;
			});
		}
	}
	</script>