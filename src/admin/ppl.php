<?php
require_once '-globals.php';
require_once '-session.php';

require_once '-head.php';
require_once '-nav.php';

$sth = $conn->prepare("SELECT users.uid, users.uname, IF((SELECT COUNT(binnacle.bid) FROM binnacle WHERE binnacle.buser = users.uid) IS NULL,0,COUNT(binnacle.bid)) AS uvotos FROM users LEFT JOIN binnacle ON binnacle.buser = users.uid WHERE users.ustatus = 1 GROUP BY users.uid ORDER BY 3 ASC, 2 ASC");
$sth->execute();
$sth_rows = $sth->fetchAll(PDO::FETCH_CLASS);

$sthSex = $conn->prepare("SELECT sid AS _id, slabel AS _label FROM sex");
$sthSex->execute();
$sthSex_rows = $sthSex->fetchAll(PDO::FETCH_CLASS);
//array_unshift($sthSex_rows, (object) array('_id' => '0', '_label' => 'Todos') );

$sthDepto = $conn->prepare("SELECT did AS _id, dlabel AS _label FROM department");
$sthDepto->execute();
$sthDepto_rows = $sthDepto->fetchAll(PDO::FETCH_CLASS);
//array_unshift($sthDepto_rows, (object) array('_id' => '0', '_label' => 'Todos') );
?>
<div class="row"><div class="col-sm-12"><h1><i class="fa fa-users" aria-hidden="true"></i> Gente</h1></div></div>
<?php if(isset($_GET['m'])) { ?>
<div class="row">
	<div class="col-sm-4 col-sm-offset-4">
		<?php if( $_GET['m'] == 1 ) { ?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<strong>Listo</strong>: Se ha ingresado en el sistema a la persona.
		</div>
		<?php } else if( $_GET['m'] == 2 ) { ?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<strong>Listo</strong>: Se han editado los datos de la persona.
		</div>
		<?php } else if( $_GET['m'] == 3 ) { ?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<strong>Listo</strong>: Se ha borrado del sistema a la persona.
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<table class="table table-striped">
			<thead>
				<tr>
					<th><small>Votos</small></th>
					<th>Nombre</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php for ($i=0; $i < count($sth_rows); $i++) { ?>
				<tr>
					<td><?php echo $sth_rows[$i]->uvotos; ?></td>
					<td><?php echo $sth_rows[$i]->uname; ?></td>
					<td><a href="ppl-delete.php?id=<?php echo $sth_rows[$i]->uid; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
					<td><a href="ppl-edit.php?id=<?php echo $sth_rows[$i]->uid; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<hr>
<form action="ppl-new-do.php" method="POST" class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<h2>Nueva Persona</h2>
		<div class="form-group">
			<label for="name_txt">Persona</label>
			<input type="text" class="form-control" id="name_txt" name="name_txt" placeholder="Nombre de la persona">
		</div>
		<div class="form-group">
			<label for="docid_txt">Cédula</label>
			<input type="text" class="form-control" id="docid_txt" name="docid_txt" placeholder="Cédula de la persona">
		</div>
		<div class="form-group">
			<label for="fbuid_txt">Facebook ID</label>
			<input type="text" class="form-control" id="fbuid_txt" name="fbuid_txt" placeholder="Facebook ID de la persona">
		</div>
		<div class="form-group">
			<label for="sex_txt">Sexo</label>
			<select id="sex_txt" name="sex_txt" class="form-control"><?php echo getOption($sthSex_rows); ?></select>
		</div>
		<div class="form-group">
			<label for="depto_txt">Departamento</label>
			<select id="depto_txt" name="depto_txt" class="form-control"><?php echo getOption($sthDepto_rows); ?></select>
		</div>
		<div class="form-group text-center">
			<button class="btn btn-default" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar persona</button>
		</div>
	</div>
	</div>
</form>
<?php 
$sth->closeCursor();
$sthSex->closeCursor();
$sthDepto->closeCursor();
require_once '-foot.php'; ?>