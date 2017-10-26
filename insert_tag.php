<?php
include "lib/dbconn.php";

$position= $_GET[position]; //root 인지 아닌지 확인
$path = $_GET[path]; //refresh 
$tag = $_POST[tag];


//중복 tag 확인
$select_tag_sql = "select * from tag where tag='$tag'";
$select_tag_result = mysql_query($select_tag_sql,$connect);
$select_tag_cnt = mysql_num_rows($select_tag_result);

if($select_tag_cnt !=0){
	echo "<script> alert('이미 존재하는 태그 입니다.');window.close();</script>";
}else{

	//position 최대값 
	$select_max_position = "select max(position)as position from tag_dept";
	$select_max_result = mysql_query($select_max_position,$connect);
	$select_max_row = mysql_fetch_array($select_max_result);
	$max_num =$select_max_row[position]+1;
	
	
	if($position== "root"){
		$select_root_num = "select max(substring(parent_id,3)+0) as parent_id from tag_dept where parent_id like '0%'";
		$select_root_result = mysql_query($select_root_num,$connect);
		$select_root_row = mysql_fetch_array($select_root_result);
		$root_num = $select_root_row[parent_id]+1;
		
		$new_root_id= '0-'.$root_num;
		echo $new_root_id;
		
		$insert_root_sql = "insert into tag_dept (parent_id,tag,position) values('$new_root_id','$tag','$max_num')";
		mysql_query($insert_root_sql,$connect);
		
		$insert_tag_sql = "insert into tag(tag) values('$tag')";
		mysql_query($insert_tag_sql,$connect);
				echo("<script>
						window.close();
						window.opener.reloadDiv('$path');
						</script>
						");
	}else{
		$insert_node_sql = "insert into tag_dept(parent_id,tag,position) values('$position','$tag','$max_num')";
		mysql_query($insert_node_sql,$connect);
		
		$insert_tag_sql = "insert into tag(tag) values('$tag') ";
		mysql_query($insert_tag_sql,$connect);
		
		echo("<script>
				window.close();
				window.opener.reloadDiv('$path');
				</script>
				");
	}
}

// $tag = $_GET[tag];

// $dept = $_GET[dept];	//dep 명
// $column = $_GET[column];
// $path = $_GET[path];

// $tag = $_POST[tag];	//입력 받은 태그
// $num= (int)substr($column,-1);	//다음 카테고리 column 명 계산 위해
// $add_column = "dept".($num+1);	//입력 받은 다음 카테고리 column 명

// 	$select_tag_sql = "select * from tag where tag='$tag'";
// 	$select_tag_result = mysql_query($select_tag_sql,$connect);
// 	$select_tag_cnt = mysql_num_rows($select_tag_result);
	
// 	if($select_tag_cnt != 0){
// 		echo "<script>alert('이미 존재하는 태그 입니다');window.close();</script>";
// 	}else{
// 		$insert_tag_sql = "insert into tag(tag) values('$tag')";
// 		mysql_query($insert_tag_sql,$connect);
		
// 		$select_pre_sql = "select * from tag_dept where $column='$dept' ";
// 		$select_pre_result = mysql_query($select_pre_sql,$connect);
// 		$select_pre_row = mysql_fetch_array($select_pre_result);
		
// 		$dept1 = $select_pre_row['dept1'];
// 		$dept2 = $select_pre_row['dept2'];
// 		$dept3 = $select_pre_row['dept3'];
// 		$dept4 = $select_pre_row['dept4'];
// 		$dept5 = $select_pre_row['dept5'];
// 		$dept6 = $select_pre_row['dept6'];
// 		$dept7 = $select_pre_row['dept7'];
		
// 		if($add_column == "dept1"){
// 			$dept1 = $tag;
// 		}else if($add_column == "dept2"){
// 			$dept2 = $tag;
// 		}else if($add_column == "dept3"){
// 			$dept3 = $tag;
// 		}else if($add_column == "dept4"){
// 			$dept4 = $tag;
// 		}else if($add_column == "dept5"){
// 			$dept5 = $tag;
// 		}else if($add_column == "dept6"){
// 			$dept6 = $tag;
// 		}else{
// 			$dept7 = $tag;
// 		}
		
		
// 		if($dept1 == null){
// 			$dept1 = 'null';
// 		}
// 		if($dept2 == null){
// 			$dept2 = 'null';
// 		}
// 		if($dept3 == null){
// 			$dept3 = 'null';
// 		}
// 		if($dept4 == null){
// 			$dept4 = 'null';
// 		}
// 		if($dept5 == null){
// 			$dept5 = 'null';
// 		}
// 		if($dept6 == null){
// 			$dept6 = 'null';
// 		}
// 		if($dept7 == null){
// 			$dept7 = 'null';
// 		}
		
// 		$insert_td_sql = "insert into tag_dept(dept1,dept2,dept3,dept4,dept5,dept6,dept7) values('$dept1','$dept2','$dept3','$dept4','$dept5','$dept6','$dept7')";
// 		mysql_query($insert_td_sql,$connect);
// 		echo("<script>
// 				window.close();
// 				window.opener.reloadDiv('$path');
// 				</script>
// 				");
// 	}

?>