<?php
$dbconfig = parse_ini_file(".env");

$host = $dbconfig["DB_HOST"];
$username = $dbconfig["DB_USERNAME"];
$password = $dbconfig["DB_PASSWORD"];
$dbname = $dbconfig["DB_DATABASE"];

// create connection
$connect = new mysqli($host, $username, $password, $dbname);

// check connection
if($connect->connect_error) {
	die("connection failed : " . $connect->connect_error);
} 
