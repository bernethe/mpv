<?php

require_once '-globals.php';
require_once '-session.php';

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $conn->prepare("INSERT INTO users (uname, upass, ufb, usex, udepartment, ustatus) VALUES (:username, :uid, :fb, :sex, :depto, 1)");
$sth->bindParam(':username', $_REQUEST['name_txt']);
$sth->bindParam(':uid', $_REQUEST['docid_txt']);
$sth->bindParam(':fb', $_REQUEST['fbuid_txt']);
$sth->bindParam(':sex', $_REQUEST['sex_txt']);
$sth->bindParam(':depto', $_REQUEST['depto_txt']);
$sth->execute();

$conn = null;
header("Location: ppl.php?m=1");

?>