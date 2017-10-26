<?php
include "lib/dbconn.php";
$tag = $_GET[tag];
$path = $_GET[path];
$idx = $_GET[idx];

	$delete_dept_sql = "delete from tag_dept where idx='$idx'";	//tag_dept 테이블에서 삭제
	mysql_query($delete_dept_sql,$connect);
	
	$delete_dept_sql2 = "delete from tag where tag='$tag' ";
	mysql_query($delete_dept_sql2);
	
	$delete_dept_sql3 = "delete from asset_tag where tag ='$tag'";
	mysql_query($delete_dept_sql3);
	
	echo("<script>
		window.close();
		window.opener.reloadDiv('$path');
		</script>
		");
	
?>

