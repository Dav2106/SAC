<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>EMD SYS</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="<?php echo URL;?>Assets/CSS/Bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Assets/CSS/style.css">
	<script type="text/javascript" src="<?php echo URL;?>Assets/JS/jquery-3.1.0.min.js"></script>
	<script src="<?php echo URL;?>Assets/JS/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo URL;?>Assets/JS/VerificacionPasswords.js"></script>
</head>
<body>
 	<aside class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></aside>
	<div class="color1 col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
<div class="container-fluid">
	<br><h1 style="text-align: center; margin-top: 6%;">Cambio de contraseña</h1>	
	<div class="main row">
		<div  class="col-xs col-sm-8 col-md-9 col-lg-12"><br><hr><br>
			<form class="form-horizontal" role="form" method="POST" action="<?php echo URL;?>Usuarios/Login/cambiarContra" onsubmit="return verificarPasswords()">
				<div class="form-group">
			    	<label for="ejemplo_email_3" class="col-lg-4 control-label">Cédula:</label>
			    	<div class="col-lg-4">
			      		<input type="text" class="form-control" value="" id="id" name="id" placeholder="Cédula">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="ejemplo_email_3" class="col-lg-4 control-label">Usuario:</label>
			    	<div class="col-lg-4">
			      		<input type="text" class="form-control" value="" id="usuario" name="usuario" placeholder="Usuario">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="col-lg-4 control-label">Nueva Contraseña:</label>
			    	<div class="col-lg-4">
			      		<input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña nueva">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="ejemplo_password_3" class="col-lg-4 control-label">Confirmar Contraseña:</label>
			    	<div class="col-lg-4">
			      		<input type="password" class="form-control" id="veriContraseña" name="veriContraseña" placeholder="Confirmar contraseña">
			      		<span id="spanCamb"></span>
			    	</div>
			  	</div>
			  	<div class="form-group">
			  		<button type="submit" style="margin-left: 49%;" class="col-lg-1 col-md-1 col-sm-1 col-xs-1 btn btn-success">Modificar</button>
			  		<button type="button" style="margin-left: 1%;" class="col-lg-1 col-md-1 col-sm-1 col-xs-1 btn btn-danger" onclick="window.location = '<?php echo URL;?>Usuarios/Login/iniciarSesion'">Cancelar</button>
			  	</div>
			</form><hr>
		</div>
	</div>
</div>
<div class="panel panel-default">
		<div class ="color1 col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
		<div class ="color2 col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
</div><br><br><br><br><br>
<footer class="color1">
	<div class="container">
		<div class="main row">
			<div class ="col-xs-12 col-sm-4 col-md-3 col-lg-7 ">
				<h4>@CentroMedicoNosara</h4>
			</div>
			<div class ="col-xs-12 col-sm-4 col-md-3 col-lg-5 ">
				<h4>Dirección: Ubicado en Nosara contiguo al Gollo</h4>
			</div>
		</div>
	</div>	
</footer>
</body>
</html>