<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>utf-8</title> 
</head> 
<?php
header('content-type:text/html;charset=utf-8');
$dir =  $_POST['dir'];
$dir = urldecode($dir);	//특수문자 처리
$dir =  html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($dir)), null, 'UTF-8');		//한글 유니코드 -> utf8 변환
if( file_exists($dir) ) {
	$files = scandir($dir);
	natcasesort($files);
	if( count($files) > 2 ) { // The 2 accounts for . and ..
		echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
		// All dirs
		foreach( $files as $file ) {
			if( file_exists($dir . $file) && $file != '.' && $file != '..' && is_dir($dir . $file) ) {
				echo "<li class=\"directory collapsed\"><a href='' rel='$dir$file'>".htmlentities($file)."</a></li>";
			}
		}
		echo "</ul>";	
	}
}

?>
</html>