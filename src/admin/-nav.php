<?php

$cur_a = explode('/',$_SERVER["SCRIPT_NAME"]);
$cur_t = count($cur_a)-1;
$cur = str_replace('.php','',$cur_a[$cur_t]);

$cur_i = $cur.'.php';
$cp_p = $cur_a[$cur_t].'?';

$cur_n_a = explode('-',$cur);
$cur_n = $cur_n_a[0];
//var_dump($cur_n);

function evalNavActive($value='') {
	global $cur_n;
	if($cur_n == $value) {
		return ' class="active"';
	} else {
		return '';
	}
}

?>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
			<a class="navbar-brand" href="panel.php">MPV</a>
			</div>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="nav navbar-nav">
				<li<?php echo evalNavActive('panel') ?>><a href="panel.php"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
				<li<?php echo evalNavActive('ppl') ?>><a href="ppl.php"><i class="fa fa-users" aria-hidden="true"></i> Gente</a></li>
				<li<?php echo evalNavActive('cts') ?>><a href="cts.php"><i class="fa fa-table" aria-hidden="true"></i> Categorías</a></li>
				<li<?php echo evalNavActive('rsl') ?>><a href="rsl.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> Resultados</a></li>
			</ul>
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li><a href="-log-off.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>