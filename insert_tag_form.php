<html>
<head>
	<link href="css/button.css" rel="stylesheet">
	<style>
		body{
			border:2px solid #0087C1;
			margin : 25px;
			background : #4C4C4C;
			color : white;
			text-align :center;
			font-family: Verdana,Geneva,sans-serif; ff
		}
        a{
            word-break : nowrap;
            cursor : hand;
        }
        a:hover{
        color : red;
        }
        p{
            word-break : nowrap;
        }
        select{
            word-break : nowrap;
        }
        input {
            background : none;
            color :white;
            border : 1px dotted  #0087C1;
            border-radius : 5px;
            text-align : center;
            height : 25px;

        }
    </style>
</head>
<body>
<?php 
$position= $_GET[position];
$path = $_GET[path];
$team = $_GET[team];

echo $team;

if($dept == "root"){

	echo("
			<form method='post' action='insert_tag.php?position='root'&path=$path'>
			<br>
			<center><h2>Add Tag</h2></center>
			<br>
			<label><b>Tag</b></label>
			<input type='text' name='tag'><br><br>
			<button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok'>등록</button>
			<button type='button' class='btn btn-primary' onclick='javascript:window.close()'><span class='glyphicon glyphicon-remove'></span>취소</button>
			</form>
			");
}else{
	echo("
			<form method='post' action='insert_tag.php?position=$position&path=$path'>
			<br>
			<center><h2>Add Tag</h2></center>
			<br>
			<label><b>Tag</b></label>
			<input type='text' name='tag'><br><br>
			<button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok'>등록</button>
			<button type='button' class='btn btn-primary' onclick='javascript:window.close()'><span class='glyphicon glyphicon-remove'></span>취소</button>
			</form>
			");
}

?>
</body>
</html>
