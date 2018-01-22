<?php
require_once '-globals.php';
require_once '-session.php';

require_once '-head.php';
require_once '-nav.php';
//var_dump($_SESSION);
?>
<div class="row">
	<a href="ppl.php" class="col-sm-2 col-sm-offset-1 jumbotron text-center item-panel">
		<span><i class="fa fa-users fa-3x" aria-hidden="true"></i></span>
		<span>Usuarios</span>
	</a>
	<a href="cts.php" class="col-sm-2 col-sm-offset-2 jumbotron text-center item-panel">
		<span><i class="fa fa-table fa-3x" aria-hidden="true"></i></span>
		<span>Categorías</span>
	</a>
	</a>
	<a href="rsl.php" class="col-sm-2 col-sm-offset-2 jumbotron text-center item-panel">
		<span><i class="fa fa-bar-chart fa-3x" aria-hidden="true"></i></span>
		<span>Resultados</span>
	</a>
</div>
<?php require_once '-foot.php'; ?>