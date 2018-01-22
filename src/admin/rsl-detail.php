<?php
require_once '-globals.php';
require_once '-session.php';

require_once '-head.php';
require_once '-nav.php';

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $conn->prepare("SELECT categories.cid, categories.clabel FROM categories WHERE categories.cid = :id");
$sth->bindParam(':id', $_REQUEST['id']);
$sth->execute();
$sth_rows = $sth->fetchAll(PDO::FETCH_CLASS);

$sthV = $conn->prepare("SELECT users.uid, users.uname, COUNT(binnacle.bid) AS uvotos FROM users JOIN binnacle ON binnacle.bvote = users.uid WHERE binnacle.bcategory = :cat GROUP BY users.uid ORDER BY 3 DESC");
$sthV->bindParam(':cat', $_REQUEST['id']);
$sthV->execute();
$sthV_rows = $sthV->fetchAll(PDO::FETCH_CLASS);

?>
<div class="row"><div class="col-sm-12"><h1><i class="fa fa-bar-chart" aria-hidden="true"></i> Resultados</h1></div></div>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<h2><?php echo $sth_rows[0]->clabel; ?></h2>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nombre</th>
					<th><small>Votos</small></th>
				</tr>
			</thead>
			<tbody>
				<?php for ($i=0; $i < count($sthV_rows); $i++) { ?>
				<tr>
					<td><?php echo $sthV_rows[$i]->uname; ?></td>
					<td><?php echo $sthV_rows[$i]->uvotos; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php
$sth->closeCursor();
$sthV->closeCursor();
require_once '-foot.php'; ?>