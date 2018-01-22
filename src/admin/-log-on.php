<?php 

require_once '-globals.php';

$query_rsG = "SELECT aid, aname, astatus FROM admin WHERE astatus >= 1 AND aname = '".$_POST['user_txt']."' AND apass = '".$_POST['pass_txt']."' LIMIT 0,1";
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $conn->prepare($query_rsG);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_CLASS);
//var_dump($result[0]->aname);

if(count($result) != 0) {
		session_start();
		if (PHP_VERSION >= 5.1) {
			session_regenerate_id(true);
		} else {
			session_regenerate_id();
		}
		$_SESSION['uid'] = intval($result[0]->aid);
		$_SESSION['uname'] = $result[0]->aname;
		$_SESSION['ulevel'] = intval($result[0]->astatus);
		$goto = 'panel.php';
} else {
	$goto = '../admin/?m=1';
}
$sth->closeCursor();
$conn = null;

header('Location: '.$goto);

 ?>