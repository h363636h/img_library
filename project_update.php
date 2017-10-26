<?php
$project = $_POST[project];
// echo $project;
$cmd =   exec("/usr/autodesk/maya/bin/mayapy /home/crystal/MG/asset_library/python/project.py");
echo $cmd;

?>

