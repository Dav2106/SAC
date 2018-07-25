<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EMD SYS</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Assets/CSS/Bootstrap/bootstrap/css/bootstrap.min.css">
	<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Assets/CSS/style.css">
	<link rel="shortcut icon" href="../favicon.ico" />
	<script type="text/javascript" src="<?php echo URL;?>Assets/JS/validacionesLogin.js"></script>
</head>
<body>
	<div class="panel panel-default" id="titulo">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="form-group">
				<h1>Inicia Sesión</h1> 	   
			</div>
		</div>
	</div>
 	<aside class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></aside>
	<div  class="color1 col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div>	
 	<hr class="linea1">
<div class="container-fluid">
    <div class="container">
	<div class="main row">
		<div  class="col-xs col-sm-8 col-md-9 col-lg-12"><br><br>
			<form class="form-horizontal" role="form" method="POST" action="<?php echo URL;?>Usuarios/Login/SesionIniciar" id="login" onsubmit="return CamposVacios()">
			  <div class="form-group">
			    <label for="ejemplo_email_3" class="col-lg-4 control-label">Usuario:</label>
			    <div class="col-lg-4">
			      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="ejemplo_password_3" class="col-lg-4 control-label">Contraseña</label>
			    <div class="col-lg-4">
			      <input type="password" class="form-control" id="contra" name="contra" placeholder="Contraseña">
			    </div>
			  </div>
			  <div class="form-group">
			   <div class="col-sm-offset-3 col-sm-3">
			    </div>
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br>
			        <div class="form-group row">
			        	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
			        	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					        <a class="btn btn-danger" href="<?php echo URL;?>Usuarios/Login/cambioContra">Olvidé mi contraseña</a>
					        <button type="submit" class="btn btn-success" id="btnIngresar" style="width: 180px; margin-left: 3%;">Ingresar</button>
					    </div>
					</div>
			    </div>
			  </div>
			</form>
		</div>
	</div>
</div><br><br>
<div class="panel panel-default">
	<br><br><br><br>
	<div class="main row">
		<div class ="color1 col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
		<div class ="color2 col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
	</div>
</div>
</div><br><br><br><br>	
<footer class="container-fluid color1">
	<div class="main row">
		<div class ="col-lg-8 col-md-8 col-sm-8 col-xs-8">
			<h4>@CentroMedicoNosara</h4>
		</div>
		<div class ="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<h4>Dirección: Ubicado en Nosara contiguo al Gollo</h4>
		</div>
	</div>
</footer>
<script src="<?php echo URL;?>Assets/JS/jquery-3.1.0.min.js"></script>
<script src="<?php echo URL;?>Assets/JS/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>