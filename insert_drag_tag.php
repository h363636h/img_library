<html> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=euc-kr"> 
</head>
<?php
//tag drag

$get_tag = $_GET['tag'];
$path = $_GET['path'];
$asset_id = $_GET['asset_id'];
$asset_id_arr = $_GET['asset_id_arr'];

echo "asset_id_arr => " .$asset_id_arr."<br>";
echo "path => " .$path."<br>";
echo "get_tag=>". $get_tag."<br>";
echo "asset_id =>".$asset_id."<br>";

$asset_id_arr = explode(",",$asset_id_arr);

include "lib/dbconn.php";

if(isset($asset_id)){
    $select_tag_sql = "select * from asset_tag where asset_id='$asset_id' and tag='$get_tag'";
    $select_tag_result = mysql_query($select_tag_sql, $connect);
    $select_tag_cnt = mysql_num_rows($select_tag_result);
    
    if($select_tag_cnt ==1){
        echo("
 								<script>
 								alert('이미 존재하는 태그입니다');
  								window.reloadDiv('$path');
 								</script>
 								");
    }else{
        $insert_tag_sql = "insert into asset_tag(asset_id,tag)";
        $insert_tag_sql .="values('$asset_id','$get_tag')";
        mysql_query($insert_tag_sql,$connect);
        echo "<script>
    							window.reloadDiv('$path');
    							</script>
    							";
    }
}else{
    	foreach ($asset_id_arr as $asset_id2){
    		$select_tag_sql2 = "select * from asset_tag where asset_id='$asset_id2' and tag='$get_tag'";
    		$select_tag_result2 = mysql_query($select_tag_sql2,$connect);
    		$select_tag_cnt2 = mysql_num_rows($select_tag_result2);
    
    		if($select_tag_cnt2 !=0){
    			echo("
    					<script>
    					alert('이미 존재하는 태그입니다');
    					window.reloadDiv('$path');
    					</script>
    					");
    		}else{
    
        			$insert_tag_sql2 = "insert into asset_tag(asset_id,tag)";
        			$insert_tag_sql2 .="values('$asset_id2','$get_tag')";
        			mysql_query($insert_tag_sql2,$connect);
        		}
        	}
        
        	echo "<script>
        	window.reloadDiv('$path');
        	</script>
        	";
}
?>