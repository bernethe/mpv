<?php

$sth = $conn->prepare("SELECT users.uid AS id, users.uname AS name FROM users WHERE users.ustatus = 1 ORDER BY 2,1 ASC");
$sth->execute();
$sth_rows = $sth->fetchAll(PDO::FETCH_CLASS);
echo json_encode($sth_rows);
$sth->closeCursor();

?>