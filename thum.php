<?php

$project = $_POST[project];
// echo $project;
$cmd =   exec("/usr/autodesk/maya2016/bin/mayapy /home/crystal/MG/asset/python/folder_backup.py $project");
// $cmd =   exec("/usr/autodesk/maya2016/bin/mayapy /home/crystal/MG/asset/python/cmd_test.py $project");
// $cmd =   exec("/usr/autodesk/maya/bin/mayapy /home/crystal/MG/asset/python/change_path.py $project");

echo $cmd;
?>

