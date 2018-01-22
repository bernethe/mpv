<?php

require_once '-globals.php';
require_once '-session.php';

$sql = "UPDATE categories SET categories.cstatus = 0 WHERE categories.cid = ".$_POST['id_txt'];
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $conn->prepare($sql);
$sth->execute();


$conn = null;
header("Location: cts.php?m=3");
?>