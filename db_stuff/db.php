<?php
$db_host = "fyp-rds-01.czhevipvicns.us-east-1.rds.amazonaws.com:3306";
$db_user = "adminSQL";
$db_pass = "adminPost";
$db_name = "FYP_RDS_01";
$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
