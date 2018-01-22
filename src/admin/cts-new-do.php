<?php

require_once '-globals.php';
require_once '-session.php';

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $conn->prepare("INSERT INTO categories (clabel, cdesc, corder, csex, cdepartment, cstatus) VALUES (:label, :descr, 0, :sex, :depto, 1)");
$sth->bindParam(':label', $_REQUEST['label_txt']);
$sth->bindParam(':descr', $_REQUEST['desc_txt']);
$sth->bindParam(':sex', $_REQUEST['sex_txt']);
$sth->bindParam(':depto', $_REQUEST['depto_txt']);
$sth->execute();

$conn = null;
header("Location: cts.php?m=1");
?>