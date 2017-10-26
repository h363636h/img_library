<?php
function connect_db() {
	$connect = mysqli_connect("localhost","root","1234");
	mysqli_select_db($connect, "test");
	mysqli_query($connect, "set names utf8");
	mysqli_query($connect, "set sql_mode=''");
	return $connect;
}

?>
