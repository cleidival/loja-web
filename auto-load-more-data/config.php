<?php

$con = mysql_connect("186.202.165.58","perolaclass","pcl0914");
$db_username = 'perolaclass';
$db_password = 'pcl0914';
$db_name = 'perolaclass';
$db_host = '186.202.165.58';
$items_per_group = 5;

$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);
//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>