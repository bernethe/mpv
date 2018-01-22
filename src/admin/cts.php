<?php
require_once '-globals.php';
require_once '-session.php';

require_once '-head.php';
require_once '-nav.php';

$sth = $conn->prepare("SELECT categories.cid, categories.clabel FROM categories WHERE categories.cstatus = 1 ORDER BY categories.corder ASC");
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
<?php if(isset($_GET['m'])) { ?>
<div class="row">
	<div class="col-sm-4 col-sm-offset-4">
		<?php if( $_GET['m'] == 1 ) { ?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<strong>Listo</strong>: Se ha ingresado en el sistema la categoría.
		</div>
		<?php } else if( $_GET['m'] == 2 ) { ?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<strong>Listo</strong>: Se han editado los datos de la categoría.
		</div>
		<?php } else if( $_GET['m'] == 3 ) { ?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<strong>Listo</strong>: Se ha borrado del sistema a la categoría.
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>
<div class="row">
<div class="col-sm-6 col-sm-offset-3">
	<ul class="list-unstyled" id="sortable">
		<?php for ($i=0; $i < count($sth_rows); $i++) { 
			echo '<li data-cid="'.$sth_rows[$i]->cid.'"><small class="gris"><i class="fa fa-sort" aria-hidden="true"></i></small> '.$sth_rows[$i]->clabel.' <a href="cts-delete.php?id='.$sth_rows[$i]->cid.'" class="sort-delete"><i class="fa fa-trash" aria-hidden="true"></i></a><a href="cts-edit.php?id='.$sth_rows[$i]->cid.'" class="sort-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li> ';
		} ?>
	</ul>
	<div class="text-center">
		<button class="btn btn-default" type="button" id="resort_btn"><i class="fa fa-sort" aria-hidden="true"></i> Guardar Orden</button>
	</div>
</div>
</div>
<hr>
<form action="cts-new.php" method="POST" class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<h2>Nueva Categoría</h2>
		<div class="form-group">
			<label for="label_txt">Categoría</label>
			<input type="text" class="form-control" id="label_txt" name="label_txt" placeholder="Nombre de la categoría">
		</div>
		<div class="form-group">
			<label for="desc_txt">Descripción</label>
			<textarea name="desc_txt" id="desc_txt" class="form-control" placeholder="Descripción de la categoría"></textarea>
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
			<button class="btn btn-default" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar categoría</button>
		</div>
	</div>
</form>
<?php
$sth->closeCursor();
$sthSex->closeCursor();
$sthDepto->closeCursor();
require_once '-foot.php'; ?>