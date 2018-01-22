<?php
require_once '-globals.php';
require_once '-session.php';

require_once '-head.php';
require_once '-nav.php';

$sth = $conn->prepare("SELECT categories.* FROM categories WHERE categories.cid = :id");
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
<div class="row"><div class="col-sm-12"><h1><i class="fa fa-table" aria-hidden="true"></i> Categorías</h1></div></div>
<form action="cts-edit-do.php" method="POST" class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<h2>Editar Categoría</h2>
		<div class="form-group">
			<label for="label_txt">Categoría</label>
			<input type="text" class="form-control" id="label_txt" name="label_txt" placeholder="Nombre de la categoría" value="<?php echo $sth_rows[0]->clabel; ?>">
		</div>
		<div class="form-group">
			<label for="desc_txt">Descripción</label>
			<textarea name="desc_txt" id="desc_txt" class="form-control" placeholder="Descripción de la categoría" value="<?php echo $sth_rows[0]->cdesc; ?>"></textarea>
		</div>
		<div class="form-group">
			<label for="sex_txt">Sexo</label>
			<select id="sex_txt" name="sex_txt" class="form-control"><?php echo getOption($sthSex_rows, $sth_rows[0]->csex); ?></select>
		</div>
		<div class="form-group">
			<label for="depto_txt">Departamento</label>
			<select id="depto_txt" name="depto_txt" class="form-control"><?php echo getOption($sthDepto_rows, $sth_rows[0]->cdepartment); ?></select>
		</div>
		<div class="form-group text-center">
			<input type="hidden" id="id_txt" name="id_txt" value="<?php echo $sth_rows[0]->cid; ?>">
			<button class="btn btn-default" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar categoría</button>
		</div>
	</div>
</form>
<?php 
$sth->closeCursor();
$sthSex->closeCursor();
$sthDepto->closeCursor();
require_once '-foot.php'; ?>