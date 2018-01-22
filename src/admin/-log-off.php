<?php

$logoutGoTo = "../admin/?m=3";
if (!isset($_SESSION)) {
  session_start();
}

$_SESSION['uid'] = NULL;
$_SESSION['uname'] = NULL;
$_SESSION['ulevel'] = NULL;

unset($_SESSION['uid']);
unset($_SESSION['uname']);
unset($_SESSION['ulevel']);

if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}

?>