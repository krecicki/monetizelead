<?php require_once('MySQLi-Wrapper/MysqliDb.php'); 
	$host = "localhost";
	$user = "{USER}";
	$pwd = "{PASS}";
	$database= "{DATAB}";
	$db = new MysqliDb($host, $user, $pwd,$database);
	if (!$db) {
		die("Connection failed: " . mysqli_connect_error());
	}
	define('STRIP_SUBSCRIPTION_ID', '{STRIP_SUBSCRIPTION_ID}');
	define('STRIP_PLAN_ID', '{STRIP_PLAN_ID}');
?>