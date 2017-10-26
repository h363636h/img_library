<?php
$asset = $_GET[asset];
$file_name = $_GET[file_name];
$thum = $_GET[thum];
$mov = $_GET[mov];
$full_path = $_GET[full_path];
$texture = $_GET[texture];
$modeling = $_GET[modeling];
$lookdev = $_GET[lookdev];
$rigging = $_GET[rigging];

$mov_file = array_pop( explode('/',$mov));
// echo $mov_file;

$ext_chk = substr($mov,-3);
$ext_chk = strtolower($ext_chk);
include "lib/dbconn.php";

$select_sql = "select * from asset where asset_name='$file_name' ";
$select_result = mysql_query($select_sql);
$select_cnt = mysql_num_rows($select_result);
$num = $select_cnt*3 + 2;
$lod_num = $select_cnt*2 +1;

?>
<html>
<head>
<title>Asset Detail</title>
<link rel="stylesheet" type="text/css" href="css/detail.css" />
<link rel="stylesheet" type="text/css" href="css/glyphicon.css" />
<link rel="stylesheet" type="text/css" href="css/button.css" />
<script src='js/jquery-11.0.min.js' type='text/javascript'></script>
<script src="js/jquery-1.10.2.js" type='text/javascript'></script>
<script src="js/jquery-ui.js" type='text/javascript'></script>
<script type="text/javascript">

function down(path){
	$.ajax({
		url : 'download.php?path='+ path,
		dataType : 'html'
	}).done(function(data){
		location.href='download.php?path='+ path;
	});
}

</script>
</head>
<body>
<br>
<center><h2 style="color:white">Asset Detail</h2></center>
<table>
	<tr>
		<td rowspan=<?php echo $num?>>
		<?php if($ext_chk == "png" || $ext_chk == "jpg" || $mov == "None" ){?>
			<img src="thumnail/small_thum/<?php echo $asset;?>" width="300px">
			<?php }else{?>
			
    <video width=300  controls autoplay loop>
        <source src="thumnail/mov/<?php echo $mov_file; ?>">
    </video>
			
			<?php }?>
		</td>
		<td align='center' id='subject'>
			<b>
			Asset <br>name
			</b>
		</td>
			<td colspan="5" align="center">
				<b><?php echo $file_name?></b>
			</td>
	</tr>
	<tr>
		<td align='center' id='subject'>
						<b>
			Asset <br>path
			</b>
		</td>
		<td colspan="5" align="center">
			<?php echo $full_path?>
		</td>
	</tr>
	<tr>
	
    <td rowspan='<?php echo $lod_num?>' align='center' id='subject'><b>LOD</b></td>
		
	<?php 
	for($i=0; $i<$select_cnt; $i++ ){
    $select_rs = mysql_fetch_array($select_result);
    $select_sql2 = "select * from asset where asset_name='$file_name' and lod='$select_rs[lod]'";
    $select_result2 = mysql_query($select_sql2);
    $select_rs2 = mysql_fetch_array($select_result2);
    echo ("
	<tr>
		<td rowspan='2'  align='center' id='subject'><b>$select_rs2[lod]</b></td>
		<td align='center' style='background : #464646;'><b>Model</b></td>
		<td align='center'>$select_rs2[model]</td>
		<td align='center' style='background : #464646;'><b>Texture</b></td>
		<td align='center'>$select_rs2[texture]</td>

	</tr>
	<tr>
		<td align='center' style='background : #464646;'><b>Rigging</b></td>
		<td align='center'>$select_rs2[rigging]</td>
		<td align='center' style='background : #464646;'><b>Look dev</b></td>
		<td align='center'>$select_rs2[lookdev]</td>
	</tr>
    ");
}
?>
	
</table>
<br><br><br>
<center>
	<!--  <button onclick="javascript:down('<?php// echo $full_path;?>')" class="btn btn-primary"><span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span>EXPORT</button> -->
	<button onclick='javascript:window.close()' class="btn btn-detail"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>CLOSE</button>
</center>

</body>
</html>