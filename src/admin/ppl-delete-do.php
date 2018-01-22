<?php

require_once '-globals.php';
require_once '-session.php';

$sql = "UPDATE users SET users.ustatus = 0 WHERE users.uid = ".$_POST['id_txt'];
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $conn->prepare($sql);
$sth->execute();


$conn = null;
header("Location: ppl.php?m=3");
?>