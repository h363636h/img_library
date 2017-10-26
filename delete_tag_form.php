<?php 

$idx = $_GET[idx];
$path = $_GET[path];
$tag = $_GET[tag];

?>
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
<body>
<?php 
      echo("
                <center>
                <form name='delete_tag' method='post' action='delete_tag.php?tag=$tag&idx=$idx&path=$path'>
                <BR><br><label>삭제하시겠습니까?</label><Br><Br><br>
                                <button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok'>확인</button>
                                <button type='button' class='btn btn-primary' onclick='javascript:window.close()'><span class='glyphicon glyphicon-remove'></span>취소</button>
                </form>
                </center>
        ");
?>
</body>
</html>