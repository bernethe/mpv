<?php

$sth1 = $conn->prepare("SELECT * FROM binnacle WHERE binnacle.buser = :uid AND binnacle.bcategory = :cat");
$sth1->bindParam(':uid', $_REQUEST['user']);
$sth1->bindParam(':cat', $_REQUEST['category']);
$sth1->execute();
$sth1_rows = $sth1->fetchAll(PDO::FETCH_CLASS);

if( count($sth1_rows) == 0 ) {
	$sth2 = $conn->prepare("INSERT INTO binnacle ( buser, bcategory, bvote ) VALUES ( :uid, :cat, :vot )");
	$sth2->bindParam(':uid', $_REQUEST['user']);
	$sth2->bindParam(':cat', $_REQUEST['category']);
	$sth2->bindParam(':vot', $_REQUEST['vote']);
	$sth2->execute();

	$sth3 = $conn->prepare("SELECT categories.cid AS id, categories.clabel AS label, categories.cdesc AS descript, categories.csex AS sex, categories.cdepartment AS department, IF((SELECT binnacle.bvote FROM binnacle WHERE binnacle.buser = :uid AND binnacle.bcategory = categories.cid) IS NULL,0,binnacle.bvote) AS vote FROM categories LEFT JOIN binnacle ON binnacle.bcategory = categories.cid WHERE categories.cstatus = 1 GROUP BY 1 ORDER BY categories.corder ASC");
	$sth3->bindParam(':uid', $_REQUEST['user']);
	$sth3->execute();
	$sth3_rows = $sth3->fetchAll(PDO::FETCH_CLASS);

	echo json_encode($sth3_rows);

	$sth3->closeCursor();
}

$sth1->closeCursor();


?>