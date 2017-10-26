<script src='js/jquery-11.0.min.js' type='text/javascript'></script>
<script src="js/jquery-1.10.2.js" type='text/javascript'></script>
<script src="js/jquery-ui.js" type='text/javascript'></script>
<script src="js/tag.js"></script>		

<?php
include "./lib/dbconn.php";

$asset_id = $_GET[asset_id];
$tag_id = $_GET[tag_id];
$path = $_GET[path];
$type = $_GET[type];

$sql = "delete from asset_tag where asset_id='$asset_id' and tag='$tag_id'";

mysql_query($sql,$connect);


mysql_close();

if (isset($type)){
	echo ("<script>
			window.opener.reloadDiv2('$path','$type')
			window.close()
			</script>");
}else{
echo ("<script>
		window.opener.reloadDiv('$path')
		window.close()
		</script>");
}
?>

