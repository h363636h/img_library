<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <link href="css/manage_project.css" rel="stylesheet">
    <link href="css/glyphicon.css" rel="stylesheet">
    <link href="css/button.css" rel="stylesheet">
    <script src='js/jquery-11.0.min.js' type='text/javascript'></script>
    <script src="js/jquery-1.10.2.js" type='text/javascript'></script>
    <script src="js/jquery-ui.js" type='text/javascript'></script>
<head>
<body>
<br><br>
  <nav class="shift">
    <ul>
      <li><a href="index.php"><span class='glyphicon glyphicon-home' aria-hidden='true'></span>&nbsp;&nbsp;Home</a></li>
      <li><a href="manage_project.php?cate=ing"><span class='	glyphicon glyphicon-facetime-video' aria-hidden='true'></span>&nbsp;Active Projects</a></li>
      <li><a href="manage_project.php?cate=end"><span class='	glyphicon glyphicon-ok' aria-hidden='true'></span>&nbsp;Completed Projects</a></li>
    </ul>
  </nav>
  <br>
      	<div id="gallery">
		</div>
<?php
session_start();

$cate=$_GET['cate'];

include "lib/dbconn.php";

mysql_query("set session character_set_client=utf8");
mysql_query("set session character_set_connection=utf8");
mysql_query("set session character_set_results=utf8");

if($cate == "end"){
    $project_sql = "select * from project where stat='com' order by project_name";
}else{
    $project_sql = "select * from project where stat='ing' order by project_name";
}

$project_result = mysql_query($project_sql);
$project_cnt = mysql_num_rows($project_result);

$scale = 5;

if($project_cnt % $scale == 0){
    $total_page = floor($project_cnt / $scale);
}else{
    $total_page = floor($project_cnt / $scale)+1;
}
$page = $_GET[page];
if (!$page){
    $page = 1;
}
$start = ($page-1)*$scale;

?>
<br>
<div class="update_button">
	<button type='button' class='btn btn-default' onclick=project_update()><span class='glyphicon glyphicon-refresh' aria-hidden='true'></span>UPDATE</button>
</div>
<center>
<br><br><br>
<table>
	<thead>
		<tr>
			<th colspan=7><center><?php if($cate=="end"){ echo "종료된 프로젝트( $project_cnt 개 )";}else{ echo"진행중인 프로젝트( $project_cnt 개 )";}?></center></th>
		</tr>
	</thead>
	<tbody>
	<?php 
    for($i=$start; $i<$start+$scale && $i < $project_cnt; $i++){
        mysql_data_seek($project_result,$i);
        $rs = mysql_fetch_array($project_result);
        $num = $i+1;
        
        $select_sql = "select update_date,mod_path from asset where project='$rs[project_name]' group by project";
        $select_result = mysql_query($select_sql,$connect);
        $select_rs = mysql_fetch_array($select_result);
    echo ("
                                <tr>
                                    <td rowspan='3' id='num'><b>$num</b></td>
                                    <td rowspan='3' id='img'><center><img src='thumnail/small_thum/$rs[img]'></center></td>
                                    <td id='sub'><b>Project Name</b></td>
                                    <td colspan='3'>$rs[project_name]</td>
                                    <td rowspan='3'><button type='button' class='btn btn-primary' onclick=submit_py('$rs[project_name]')><span class='glyphicon glyphicon-menu-hamburger' aria-hidden='true'></span>정렬</button></td>
                                </tr>
                                <tr>
                                    <td id='sub'><b>Start date</b></td>
                                    <td>$rs[start_date]</td>
                                    <td id='sub'><b>End date</b></td>
                                    <td>$rs[end_date]</td>
                                </tr>
                                <tr>
                                	<td id='sub'><b>Update date</b></td>
                                	<td>$select_rs[update_date]</td>
                                	<td id='sub'><b>mod</b></td>
                                	<td>$select_rs[mod_path]</td>
                                </tr>
                ");
}
?>
	</tbody>
</table>
<br><br><br>
<?php 
    for($i=1; $i <= $total_page; $i++){
        if($page == $i){
            echo "<font color='white' class='select'><b>$i</b></font>";
        }else{
            echo"<a href='manage_project.php?page=$i&cate=$cate'><font color='white' class='paging'><b> $i</b></font></a>";
        }
    }
?>
          </center>
</body>
<div class="wrap-loading display-none">
    <div><img src="./images/loading.gif" /></div>
</div>    
    <script type='text/javascript'>
function submit_py(project){
    var project = project;
    $.ajax({
        type : "post",
        url : "thum.php",
        data : {project : project},
        dataType:'html',
        success: function(data){
            console.log(data);
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

function project_update(){
	$.ajax({
		type : "post",
		url : "project_update.php",
		dataType:"html",
		success: function(data){
			location.reload();
        },beforeSend : function(){
	          $('.wrap-loading').removeClass('display-none');
        },complete:function(){
	          $('.wrap-loading').addClass('display-none');
        }, error:function (request, status,error){
	          console.log("code : "+request.status+"\n"+"message : "+request.responseText+"\n"+"error : "+error);
        }
    });
	
}
</script>
<br><br><br><br><br><br><br><br>
</html>