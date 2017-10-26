<?php
/*
 * 카테고리와 태그 구분 x
 * tag
 * */
$idx = $_POST['idx'];
$path = $_POST['path'];
$tag=$_POST['tag'];	//기존 태그 명
$update_tag = $_POST['update_tag'];	//변경할 태그 명 

include "lib/dbconn.php";

$select_tag_sql = "select * from tag where tag='$update_tag'";
$select_tag_result = mysql_query($select_tag_sql, $connect);
$select_tag_cnt = mysql_num_rows($select_tag_result);

if($select_tag_cnt !=0){
	echo "<script>alert('이미 존재하는 태그입니다');window.reloadDiv('$path');</script>";
}else{
	$update_tag_sql = "update tag set tag='$update_tag' where tag='$tag'";
	mysql_query($update_tag_sql,$connect);
	
	$update_tag_sql2 = "update asset_tag set tag='$update_tag' where tag='$tag'";
	mysql_query($update_tag_sql2,$connect);
	
	$update_tag_sql3 = "update tag_dept set tag='$update_tag' where tag='$tag'";
	mysql_query($update_tag_sql3,$connect);
	
	echo("<script>
			window.reloadDiv('$path');
			</script>
			");
}
?>