<?php
include "lib/dbconn.php";
echo $_POST[id];
echo $_POST[pwd];

$id = $_POST[id];
$pwd = $_POST[pwd];

// header("location:admin.php");

$sql = "select * from user where id='$id' and pwd='$pwd'";
$result = mysql_query($sql);
$cnt = mysql_num_rows($result);

if($cnt == 0){
    
    echo "<script>alert('일치하는 정보가 없습니다.');window.close();</script>";
}else{
    echo "<script>window.close();window.opener.location.href='manage_project.php';</script>";
}

session_start();
$_SESSION['id'] = $id;
$_SESSION['pwd'] = $pwd;

?>
