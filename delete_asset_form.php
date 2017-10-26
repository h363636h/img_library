<?php
$asset_id = $_GET[asset_id];
$tag_id = $_GET[tag_id];
$path = $_GET[path];
$type = $_GET[type];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<link href="css/button.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/glyphicon.css" />
    
    <style>

        body{

            /*background-color : white;*/
            /*color : white;*/
        }
        a{
            color : #0087C1;
            text-decoration:none;
        }
        a:hover{
            color : white;
        }
        input {
            color :#0087C1;
            border : 1px dotted  #0087C1;
            border-radius : 5px;
            text-align : center;
            height : 25px;

        }
        body{
        background : #4C4C4C;
	    font-family: Verdana,Geneva,sans-serif; 
	    color : white;
        height : 140px;
        border:2px solid #0087C1;
        margin : 25px;
        text-align :center;
}
    </style>
</head>
<?php 
if($type){
	echo("
        <form name='add_tag' method='post' action='delete_asset.php?asset_id=$asset_id&tag_id=$tag_id&path=$path&type=$type'>
            <BR><label>삭제하시겠습니까?</label><Br><Br>
            <button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok'></span> 확인</button>
             <button type='button' class='btn btn-primary' onclick='javascript:window.close()'><span class='glyphicon glyphicon-remove'></span>취소</button>
        </form>

");
	
}else{
	echo("
			<form name='add_tag' method='post' action='delete_asset.php?asset_id=$asset_id&tag_id=$tag_id&path=$path'>
			<BR><br><label>삭제하시겠습니까?</label><Br><Br><br>
			<button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok'></span> 확인</button>
			<button type='button' class='btn btn-primary' onclick='javascript:window.close()'><span class='glyphicon glyphicon-remove'></span>취소</button>
			</form>
			
			");
	
}

?>