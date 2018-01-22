<?php
require_once '-globals.php';
require_once '-session.php';

require_once '-head.php';
require_once '-nav.php';

$sth = $conn->prepare("SELECT users.* FROM users WHERE users.uid = :id");
$sth->bindParam(':id', $_REQUEST['id']);
$sth->execute();
$sth_rows = $sth->fetchAll(PDO::FETCH_CLASS);

$sthSex = $conn->prepare("SELECT sid AS _id, slabel AS _label FROM sex");
$sthSex->execute();
$sthSex_rows = $sthSex->fetchAll(PDO::FETCH_CLASS);
array_unshift($sthSex_rows, (object) array('_id' => '0', '_label' => 'Todos') );

$sthDepto = $conn->prepare("SELECT did AS _id, dlabel AS _label FROM department");
$sthDepto->execute();
$sthDepto_rows = $sthDepto->fetchAll(PDO::FETCH_CLASS);
array_unshift($sthDepto_rows, (object) array('_id' => '0', '_label' => 'Todos') );
?>
<div class="row"><div class="col-sm-12"><h1><i class="fa fa-users" aria-hidden="true"></i> Gente</h1></div></div>
<form action="ppl-edit-do.php" method="POST" class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<h2>Editar Persona</h2>
		<div class="form-group">
			<label for="name_txt">Persona</label>
			<input type="text" class="form-control" id="name_txt" name="name_txt" placeholder="Nombre de la persona" value="<?php echo $sth_rows[0]->uname; ?>">
		</div>
		<div class="form-group">
			<label for="docid_txt">Cédula</label>
			<input type="text" class="form-control" id="docid_txt" name="docid_txt" placeholder="Cédula de la persona" value="<?php echo $sth_rows[0]->upass; ?>">
		</div>
		<div class="form-group">
			<label for="fbuid_txt">Facebook ID</label>
			<input type="text" class="form-control" id="fbuid_txt" name="fbuid_txt" placeholder="Facebook ID de la persona" value="<?php echo $sth_rows[0]->ufb; ?>">
		</div>
		<div class="form-group">
			<label for="sex_txt">Sexo</label>
			<select id="sex_txt" name="sex_txt" class="form-control"><?php echo getOption($sthSex_rows, $sth_rows[0]->usex); ?></select>
		</div>
		<div class="form-group">
			<label for="depto_txt">Departamento</label>
			<select id="depto_txt" name="depto_txt" class="form-control"><?php echo getOption($sthDepto_rows, $sth_rows[0]->udepartment); ?></select>
		</div>
		<div class="form-group text-center">
			<input type="hidden" id="id_txt" name="id_txt" value="<?php echo $sth_rows[0]->uid; ?>">
			<button class="btn btn-default" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar persona</button>
		</div>
	</div>
</form>
<?php 
$sth->closeCursor();
$sthSex->closeCursor();
$sthDepto->closeCursor();
require_once '-foot.php'; ?>