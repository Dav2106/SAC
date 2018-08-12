<?php session_set_cookie_params(0,"/");
@session_start();
if(!isset($_SESSION['funcionario'])){
	header('refresh:0;'.URL.'Usuarios/Login/iniciarSesion');
}
if($_SESSION['funcionario'] == @$_SESSION['Recepcionista']){
	header('location: '.URL.'Usuarios/Index/indexRes');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EMD SYS</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Assets/CSS/Bootstrap/bootstrap/css/bootstrap.min.css">
	<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Assets/CSS/style.css">
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="shortcut icon" href="../favicon.ico" />
</head>
<body>
	<div class="container-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
				<a href="<?php echo URL;?>Index/indexAdm"><img src="../Imagenes/centro-medico1.png" alt=""></a>
			</div>
		   <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
	            <nav>
		            <ul class="nav navbar-nav">
						<li><a href="<?php echo URL;?>Usuarios/Funcionario/mostrar">Funcionarios</a></li>
						<li><a href="<?php echo URL;?>Finanzas/Servicio/mostrar">Servicios</a></li>
						<li><a href="<?php echo URL;?>Factura/agregar">Facturar</a></li>
						<li><a href="<?php echo URL;?>Reportes/Reportes/index">Reportes</a></li>
					</ul>
				</nav>	
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div>
				   	<nav>
				        <ul class="nav navbar-nav" style="margin-left: 80%;">
						   <li class="dropdown">
					       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['funcionario'];?><span class="caret"></span></a>
						    <ul class="dropdown-menu">
							    <li><a href="<?php echo URL;?>Usuarios/Login/CerrarSesion">Cerrar Sesion</a></li>
						    </ul>
						    </li>
						</ul>
					</nav>	
				</div>	
		   	</div>
		</div>
	</div>		
	<div class="container-fluid">	
		<div class="panel panel-default">
			<div class="main row">
				<div class ="color1 col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
				<div class ="color2 col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
			</div>
		</div><br>
		<div class="container-fluid">	
			<div class="main row" >
				<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3 id="EMD" >
						Expediente Medico Digital
					</h3><br>
				</div>
			</div>
		</div>
		<div class="ImgIndex">
			<img style="margin-left: 15%;width:90%;" src="<?php echo URL;?>Imagenes/EMDlogoIndex.jpeg" class="rounded" > 
		</div>
		<div class="panel panel-default">
			<div class="main row">
				<div class ="color1 col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
				<div class ="color2 col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
			</div>
		</div><br><br><br><br><br>
	</div>		
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
<script src="<?php echo URL;?>Assets/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>