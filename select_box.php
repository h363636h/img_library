<?php 
include "lib/dbconn.php";

$sql = "select distinct(project) from asset where mod_path='O'";
$result = mysql_query($sql,$connect);
$rowcnt = mysql_num_rows($result);

echo "<select name='sel' id='sel'><option value=''>Select Project</option>";

for($i=0; $i<$rowcnt; $i++){
    $rs = mysql_fetch_array($result);
    echo "<option value='$rs[project]'>$rs[project]</option>";
    echo "<br/>";
    
}

echo "</select>";
?>

