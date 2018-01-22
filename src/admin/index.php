<?php require_once('-head.php'); ?>
		<?php if(isset($_GET['m'])) {
			echo '<div class="row" style="padding-top: 15px;"><div class="col-sm-5 col-md-offset-4">';
			if($_GET['m'] == 1) {
				echo '<div class="alert alert-warning" role="alert"><h4 style="margin-top:0px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Advertencia</h4> <hr> <p>Error en el usuario y/o contraseña.</p></div>';
			} else if($_GET['m'] == 2) {
				echo '<div class="alert alert-danger" role="alert"><h4 style="margin-top:0px;"><i class="fa fa-ban" aria-hidden="true"></i> Error</h4> <hr> <p>Está tratando de ingresar al sistema sin haber logueado.</p></div>';
			} else if($_GET['m'] == 3) {
				echo '<div class="alert alert-success" role="alert"><h4 style="margin-top:0px;"><i class="fa fa-check" aria-hidden="true"></i> Listo</h4> <hr> <p>Ha salido del sistema de forma satisfactoria.</p></div>';
			}
			echo '</div></div>';
		} ?>
		<form class="form-horizontal" method="POST" action="-log-on.php" id="log_form">
			<h3 class="text-center"><i class="fa fa-lock" aria-hidden="true"></i></h3>
			<div class="row">
				<div class="alert alert-warning hidden col-sm-5 col-md-offset-4">
					<h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Atención</h4>
					<hr>
					<ul></ul>
				</div>
			</div>
			<div class="form-group" id="user_fg">
				<label for="user_txt" class="col-sm-2 col-md-offset-3 control-label">Usuario</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="user_txt" name="user_txt" placeholder="Usuario" autofocus>
				</div>
			</div>
			<div class="form-group" id="pass_fg">
				<label for="pass_txt" class="col-sm-2 col-md-offset-3 control-label">Contraseña</label>
				<div class="col-sm-4">
					<input type="password" class="form-control" id="pass_txt" name="pass_txt" placeholder="Contraseña">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-5 col-sm-4">
					<button type="submit" class="btn btn-default"><i class="fa fa-key" aria-hidden="true"></i> Ingresar</button>
				</div>
			</div>
		</form>
	</div>
<?php require_once('-foot.php'); ?>