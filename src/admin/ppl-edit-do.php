<?php

require_once '-globals.php';
require_once '-session.php';

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $conn->prepare("UPDATE users SET users.uname = :username, users.upass = :uid, users.ufb = :fb, users.usex = :sex, users.udepartment = :depto WHERE users.uid = :id");
$sth->bindParam(':username', $_REQUEST['name_txt']);
$sth->bindParam(':uid', $_REQUEST['docid_txt']);
$sth->bindParam(':fb', $_REQUEST['fbuid_txt']);
$sth->bindParam(':sex', $_REQUEST['sex_txt']);
$sth->bindParam(':depto', $_REQUEST['depto_txt']);
$sth->bindParam(':id', $_REQUEST['id_txt']);
$sth->execute();

$conn = null;
header("Location: ppl.php?m=2");
?>