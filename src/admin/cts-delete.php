<?php
require_once '-globals.php';
require_once '-session.php';

require_once '-head.php';
require_once '-nav.php';

$sth = $conn->prepare("SELECT categories.cid, categories.clabel FROM categories WHERE categories.cid = :id");
$sth->bindParam(':id', $_REQUEST['id']);
$sth->execute();
$sth_rows = $sth->fetchAll(PDO::FETCH_CLASS);
?>
<div class="row"><div class="col-sm-12"><h1><i class="fa fa-table" aria-hidden="true"></i> Categorías</h1></div></div>
<div class="row">
	<form action="cts-delete-do.php" method="POST" class="col-sm-6 col-sm-offset-3">
		<div class="panel panel-danger">
			<div class="panel-heading"><h4>CONFIRMACIÓN DE BORRADO</h4></div>
			<div class="panel-body">
				<p>Se dispone a borrar la categoría:</p>
				<h2 class="text-center"><?php echo $sth_rows[0]->clabel; ?></h2>
				<p>¿Está seguro en proceder con este borrado?</p>
			</div>
			<div class="panel-footer text-right">
				<input type="hidden" name="id_txt" id="id_txt" value="<?php echo $sth_rows[0]->cid; ?>">
				<a class="btn btn-default" href="javascript:history.go(-1);" role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar</a>
				<button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</button>
			</div>
		</div>
	</form>
</div>
<?php $sth->closeCursor(); require_once '-foot.php'; ?>