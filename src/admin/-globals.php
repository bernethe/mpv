<?
error_reporting(E_ALL);
ini_set('display_errors', '1');

setlocale(LC_ALL,"es_ES","es_ES","esp");
date_default_timezone_set("America/Costa_Rica");

function getOption($objOpt, $objSel = null) {
	$_opt = '';
	for ($i=0; $i < count($objOpt); $i++) {
		$_opt .= '<option value="'.$objOpt[$i]->_id.'"';
		if($objSel == $objOpt[$i]->_id) {
			$_opt .= ' selected="selected"';
		}
		$_opt .= '>'.$objOpt[$i]->_label.'</option>';
	}
	return $_opt;
}

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

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
?>