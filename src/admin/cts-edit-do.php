<?php

require_once '-globals.php';
require_once '-session.php';

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $conn->prepare("UPDATE categories SET categories.clabel = :label, categories.cdesc = :descr, categories.csex = :sex, categories.cdepartment = :depto WHERE categories.cid = :id");
$sth->bindParam(':label', $_REQUEST['label_txt']);
$sth->bindParam(':descr', $_REQUEST['desc_txt']);
$sth->bindParam(':sex', $_REQUEST['sex_txt']);
$sth->bindParam(':depto', $_REQUEST['depto_txt']);
$sth->bindParam(':id', $_REQUEST['id_txt']);
$sth->execute();

$conn = null;
header("Location: cts.php?m=2");
?>