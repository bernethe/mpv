<?php
if (!isset($_SESSION)) {
  session_start();
}
if(!isset($_SESSION['uid']) || !isset($_SESSION['uname']) || !isset($_SESSION['ulevel'])) {
	$conn = null;
	header("Location: ../admin/?m=2");
	exit;
}
?>