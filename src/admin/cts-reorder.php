<?php
require_once '-globals.php';
require_once '-session.php';

$nwo_a = explode( "|", $_POST['nwo'] );
$nwo_s = '';

for ($i=0; $i < count($nwo_a); $i++) {
	$nwo_t = explode( ",", $nwo_a[$i]);
	$nwo_s .= "UPDATE categories SET categories.corder = $nwo_t[0] WHERE categories.cid = $nwo_t[1]; \r\n";
}
$sth = $conn->prepare($nwo_s);
$sth->execute();
?>