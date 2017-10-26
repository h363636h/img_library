<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Asset library</title>
    <link rel="stylesheet" href="css/custom.css" />
    <link rel="stylesheet" href="css/prism.css" />
    <link rel="stylesheet" href="css/flatnav.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
    <link rel="stylesheet" href="css/jqueryFileTree.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />    
    <link rel="stylesheet" type="text/css" href="css/tag.css" />   
    <link rel="stylesheet" type="text/css" href="css/tag_tree.css" /> 
    
    <link rel="stylesheet" type="text/css" href="css/jquery.treeview.css" />   
    <link rel="stylesheet" type="text/css" href="css/screen.css" />   
    
    <script src='js/jquery-11.0.min.js' type='text/javascript'></script>
    <script src="js/jquery-1.10.2.js" type='text/javascript'></script>
    <script src="js/jquery-ui.js" type='text/javascript'></script>
    <script src='js/drag.js' type='text/javascript'></script>
 	<script src="js/modernizr.custom.js"></script>

    <script src="js/jqueryFileTree.js" type='text/javascript'></script>
	<script src="js/jquery.cookie.js" type='text/javascript'></script>
    <script src="js/jquery.treeview.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready (function() {
            $("#sel").on("change", function(){
                $('.filetree').fileTree({
                    root: '//home/crystal/Desktop/project_test/'+$(this).val()+'/',
                    script: 'connectors/jqueryFileTree.php',
                    multiFolder : false
                    
                },  function (file) {
                        var path = file;
						$.ajax({
							url : 'main.php?path='+path+'/',
							dataType : 'html'
						})
						.done(function(data){
							$('#gallery').html(data);
						});
                    });
                })
            });

        function detail(asset,lod,full_path,file_name,mov,texture,modeling,lookdev,rigging){
      	  var popUrl = "detail.php?asset=" + asset +"&lod="+lod+ "&full_path=" + full_path + "&file_name=" + file_name +"&mov="+mov+ "&texture=" + texture + "&modeling="+modeling+"&lookdev="+lookdev+"&rigging="+rigging;
      	  var popOption = "width = 1000, height =750, top=200, left=450, resizable=no, scrollbars = no, status = no";
      	  window.open(popUrl,"",popOption);
        }

        function delete_tag_popup(idx,path,tag){
            var popUrl = "delete_tag_form.php?idx=" + idx + "&path=" + path + "&tag=" +tag;
            var popOption = "width=370,  height=190, top=500, left=700, resizable=no, scrollbars=no, status=no";
            window.open(popUrl,"",popOption);
        }

        function delete_asset_popup(asset_id,tag_id,path){
            var popUrl = "delete_asset_form.php?asset_id=" + asset_id + "&tag_id=" + tag_id + "&path=" + path;
            var popOption = "width=370, height=190,resizable=no, scrollbars=no, status=no;";
            window.open(popUrl,"",popOption);
        }

        function delete_asset_popup2(asset_id,tag_id,path,type){
            var popUrl = "delete_asset_form.php?asset_id=" + asset_id + "&tag_id=" + tag_id + "&path=" + path + "&type=" + type;
            var popOption = "width=370, height=190,resizable=no, scrollbars=no, status=no;";
            window.open(popUrl,"",popOption);
        }   
        
        function tag_search(path,tag){
            var path = path;
            var tag = tag;
			$.ajax({
				url : 'main.php?path='+ path + '&tag_name=' + tag,
				dataType : 'html'
			})
			.done(function(data){
				$('#gallery').html(data);
			});
        }
        
        function tag_search2(path,tag,type){
			$.ajax({
				url : 'main.php?path='+ path + '&tag_name=' + tag + '&type=' + type,
				dataType : 'html'
			})
			.done(function(data){
				$('#gallery').html(data);
			});
        }
                
        function reloadDiv(path) {
            var path = path;
			$.ajax({
				url : 'main.php?path='+ path,
				dataType : 'html'
			})
			.done(function(data){
				$('#gallery').html(data);
			});
        }
        
        function reloadDiv2(path,type) {
            var path = path;
            var team = team;
			$.ajax({
				url : "main.php?path="+ path + "&type=" + type,
				dataType : 'html'
			})
			.done(function(data){
				$('#gallery').html(data);
			});
        }
        
        $(document).ready(function(){
            $(window).scroll(function(){
                if ($(this).scrollTop() > 100) {
                    $('.scrollToTop').fadeIn();
                } else {
                    $('.scrollToTop').fadeOut();
                }
            });

            $('.scrollToTop').click(function(){
                $('html, body').animate({scrollTop : 0},800);
                return false;
            });

        });
            
        function sel(path,type){
	            $.ajax({
	                url : 'main.php?path=' + path + '&type='+type ,
	                dataType : 'html'
	            })
	            .done(function(data){
	                $('#gallery').html(data);
	            });
            }
        
        function sel2(word,task,type){
            $.ajax({
                url : 'main.php?word=' + word +'&task='+task+ '&type='+type,
                dataType : 'html'
            })
            .done(function(data){
                $('#gallery').html(data);
            });
        }

        function tag_drop(ev,target,path,tag) {
            ev.preventDefault();
            var data= ev.dataTransfer.getData("text");
            var path = path;
            var update_depth = target.id;
            ev.target.appendChild(document.getElementById(data));
			$.ajax({
				url : 'update_depth.php?tag='+ data + '&path='+path + '&update_depth=' + update_depth ,
				dataType : 'html'
			})
			.done(function(data){
				$('#gallery').html(data);
			});
        }

        $(document).ready(function(){
        	$('.list > li a').click(function() {
        	    $(this).parent().find('.sub').slideToggle();
        	});
        });

        function divClicked() {
            var divHtml = $(this).html();
            var editableText = $("<input type='text' />");
            editableText.val(divHtml);
            $(this).replaceWith(editableText);
            editableText.focus();
            editableText.blur(editableTextBlurred);
        }

        function editableTextBlurred() {
            var html = $(this).val();
            var viewableText = $("<div>");
            viewableText.html(html);
            $(this).replaceWith(viewableText);
            viewableText.click(divClicked);
        }      

        function add_cate_tag(position,path){
            var popUrl = "insert_tag_form.php?position=" + position +  "&path=" + path;
            var popOption = "width=370, height=280,resizable=no, scrollbars=no, status=no;";
            window.open(popUrl,"",popOption);
        }

        function get_path(path,full_path){
			$.ajax({
				url : 'main.php?path='+ path + '&full_path=' + full_path,
				dataType : 'html'
			})
			.done(function(data){
				$('#gallery').html(data);
			});
        }
        
        function word_get_path(full_path,task,word){
			$.ajax({
				url : 'main.php?full_path=' + full_path + '&task='+task+'&word='+word,
				dataType : 'html'
			})
			.done(function(data){
				$('#gallery').html(data);
			});
        }      
        function form_submit(path){
            var path = path;
            $('#tag_search_form').submit(function(){
                var tag_name = $('#tag_search_text').val();
    			$.ajax({
				url : 'main.php?path='+ path + '&tag_name=' + tag_name ,
				dataType : 'html'
				})
			.done(function(data){
				$('#gallery').html(data);
			});            
                
            });
          }

        function login(){
            var popUrl = "admin_login_form.php";
            var popOption = "width=500, height=500,resizable=no, scrollbars=no, status=no;";
            window.open(popUrl,"",popOption);
            
        }
	</script>
</head>
<body>
<?php 
include "lib/dbconn.php";

mysql_query("set session character_set_client=utf8");
mysql_query("set session character_set_connection=utf8");
mysql_query("set session character_set_results=utf8");

$auto_sql = "select * from tag";
$auto_result = mysql_query($auto_sql);
$json=array();

while($auto_row = mysql_fetch_array($auto_result)){
	array_push($json,$auto_row['tag']);
}
?>
<br/><br/>
    <ul class="nav">
    <div class="logo">
   	 Asset library
    </div>
    <div class="login">
            <a href="javascript:login()" style="color: white; "><b style="font-size: 13px;">Admin</b></a>
    </div>
    
        <li id="search">
            <form name="search" method="get" action="index.php">
			    <select name="task" id="task">
			    	<option value="select_error"  style="background : #4c4c4c; important!">SELECT</option>
			    	<option value="tag" style="background : #4c4c4c; important!">TAG</option>
			    	<option value="filename" style="background : #4c4c4c; important!">ASSET</option>
			    </select>
                <input type="text" name="word" id="search_text"/>
                <input type="submit" id="search_button" value="">
            </form>
        </li>
    </ul>
<div class="line2">
	<div class="col1">
		<?php include "select_box.php"; ?>
        <br/>
	    <div class="menu">
	        <div class="filetree"></div>
	        <br/><br/><br/>
	    </div>
    </div> 
    <div class="col2">
    	<div id="gallery">
    	<?php include "main.php";?>
		</div>
    </div>
 </div>  
</body>
</html>