<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

setlocale(LC_ALL,"es_ES","es_ES","esp");
date_default_timezone_set("America/Costa_Rica");

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}

$whitelist = array( '127.0.0.1', '::1' );

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
	$servername = "127.0.0.1";
	$dbname = "mpvawards";
	$username = "latres";
	$password = "76783282";
} else {
	$servername = "127.0.0.1:8889";
	$dbname = "mpvawards";
	$username = "root";
	$password = "root";
}
header("Content-type:application/json");

if(isset($_REQUEST['show'])) {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	require_once $_REQUEST['show'].'.php';

	$conn = null;
}


?>