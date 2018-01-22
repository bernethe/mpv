<?php
require_once '-globals.php';
require_once '-session.php';

require_once '-head.php';
require_once '-nav.php';

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $conn->prepare("SELECT categories.cid, categories.clabel, IF((SELECT COUNT(binnacle.bid) FROM binnacle WHERE binnacle.bcategory = categories.cid) IS NULL,0,(SELECT COUNT(binnacle.bid) FROM binnacle WHERE binnacle.bcategory = categories.cid)) AS cvotos FROM categories LEFT JOIN binnacle ON binnacle.bcategory = categories.cid WHERE categories.cstatus = 1 GROUP BY categories.cid ORDER BY categories.corder ASC");
$sth->execute();
$sth_rows = $sth->fetchAll(PDO::FETCH_CLASS);
?>
<div class="row"><div class="col-sm-12"><h1><i class="fa fa-bar-chart" aria-hidden="true"></i> Resultados</h1></div></div>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Categoría</th>
					<th><small>Votos</small></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php for ($i=0; $i < count($sth_rows); $i++) { ?>
				<tr>
					<td><?php echo $sth_rows[$i]->clabel; ?></td>
					<td><?php echo $sth_rows[$i]->cvotos; ?></td>
					<td><a href="rsl-detail.php?id=<?php echo $sth_rows[$i]->cid; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php
$sth->closeCursor();
require_once '-foot.php'; ?>