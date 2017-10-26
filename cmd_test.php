<?php
$cmd =   escapeshellcmd("python /library/project/TD/asset_lib/changePathUI.py");
$output = shell_exec($cmd);
echo $output;
?>
