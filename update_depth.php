<?php
$update_dept =  $_GET[update_depth];
$path =  $_GET[path];
$tag=  $_GET[tag];

include "lib/dbconn.php";

$select_update_id= "select position from tag_dept where tag='$update_dept'";

$select_update_result= mysql_query($select_update_id,$connect);
while($select_update_rs = mysql_fetch_array($select_update_result)){
	$parent_id = $select_update_rs[0];
}

$update_id_sql = "update tag_dept set parent_id='$parent_id' where tag='$tag'";
mysql_query($update_id_sql,$connect);
// echo $parent_id;

		echo("<script>
	window.reloadDiv('$path');
				</script>
				");
?>