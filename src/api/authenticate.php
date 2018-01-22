<?php

$json = '{';
$sth1 = $conn->prepare("SELECT users.uid AS id, users.uname AS name, users.ufb AS fb, users.usex AS sex, users.udepartment AS department FROM users WHERE users.ustatus = 1 AND users.uid = :uid AND users.upass LIKE CONCAT('%', :pass, '%') LIMIT 0,1");
$sth1->bindParam(':uid', $_REQUEST['user']);
$sth1->bindParam(':pass', $_REQUEST['password']);
$sth1->execute();
$sth1_rows = $sth1->fetchAll(PDO::FETCH_CLASS);

if( count($sth1_rows) == 1 ) {
	$json .= '"me":'.json_encode($sth1_rows[0]);

	$sth2 = $conn->prepare("SELECT users.uid AS id, users.uname AS name, users.ufb AS fb, users.usex AS sex FROM users WHERE users.ustatus = 1 AND users.uid != :uid ORDER BY users.uname ASC");
	$sth2->bindParam(':uid', $_REQUEST['user']);
	$sth2->execute();
	$sth2_rows = $sth2->fetchAll(PDO::FETCH_CLASS);
	$json .= ',"users":'.json_encode($sth2_rows);
	$sth2->closeCursor();
	
	$sth3 = $conn->prepare("SELECT categories.cid AS id, categories.clabel AS label, categories.cdesc AS descript, categories.csex AS sex, categories.cdepartment AS department, IF((SELECT binnacle.bvote FROM binnacle WHERE binnacle.buser = :uid AND binnacle.bcategory = categories.cid) IS NULL,0,binnacle.bvote) AS vote FROM categories LEFT JOIN binnacle ON binnacle.bcategory = categories.cid WHERE categories.cstatus = 1 GROUP BY 1 ORDER BY corder ASC");
	$sth3->bindParam(':uid', $_REQUEST['user']);
	$sth3->execute();
	$sth3_rows = $sth3->fetchAll(PDO::FETCH_CLASS);
	$json .= ',"categories":'.json_encode($sth3_rows);
	$sth3->closeCursor();
} else {
	//$json .= '"error":"Password Incorrecto."';
}

$sth1->closeCursor();
$json .= '}';
echo ($json);

?>