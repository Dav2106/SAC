<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>EMD SYS</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/Bootstrap/bootstrap/css/bootstrap.min.css">
	<link href="<?php echo URL;?>Public/Bootstrap/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" media="screen">
	<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/CSS/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/CSS/reportes.css">
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="shortcut icon" href="../favicon.ico" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
	<header>
	<div class="container-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
			<a href="<?php echo URL;?>Usuarios/Index/redirect"><img src="../Imagenes/centro-medico1.png" alt=""></a>
		</div>	
		   <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
	            <nav>
		             <ul class="nav nav-pills">
	      			   <li class="dropdown">
				          <a class="dropdown-toggle" data-toggle="dropdown">Pacientes<b class="caret"></b></a>
				          <ul class="dropdown-menu">
				            <li><a href="<?php echo URL;?>Reportes/Reportes/MenosAtendido">Atendidos por consulta</a></li>
				            <li><a href="<?php echo URL;?>Reportes/Reportes/HistorialClinico">Historial clínico</a></li>
				            <li><a href="<?php echo URL;?>Reportes/Reportes/HistorialFinanciero">Historial financiero</a></li>
				          </ul>
				        </li>
	      				<li class="dropdown">
				          <a class="dropdown-toggle" data-toggle="dropdown">Medicamentos<b class="caret"></b></a>
				          <ul class="dropdown-menu">
				            <li><a href="<?php echo URL;?>Reportes/Reportes/masRecetado">Recetados</a></li>
				          </ul>
				        </li>
	      				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Financieros<b class="caret"></b></a>
							<ul class="dropdown-menu">
					            <li><a href="<?php echo URL;?>Reportes/Reportes/atenyPag">Atendidos y que cancelaron</a></li>
					             <li><a href="<?php echo URL;?>Reportes/Reportes/FechaEspecifica">Atendidos Fecha especifica</a></li>
					              <li><a href="<?php echo URL;?>Reportes/Reportes/rangoFecha">Atendidos Rango fecha</a></li>
					              <li><a href="<?php echo URL;?>Reportes/Reportes/ReporteGeneral">Atendidos por día</a></li>
					              <li><a href="<?php echo URL;?>Reportes/Reportes/controlDia">Control diario</a></li>
				          </ul>
	      				</li>
	      				<li class="dropdown">
				          <a class="dropdown-toggle" data-toggle="dropdown">Otros<b class="caret"></b></a>
				          <ul class="dropdown-menu">
				            <li><a href="<?php echo URL;?>Reportes/Reportes/masComun">Enfermedades mas comunes</a></li>
				          </ul>
				        </li>
				</ul>
				</nav>	
			</div>
			<div class="col-xs-4">
				<div>
				   	<nav>
				        <ul class="nav nav-pills" style="margin-left: 80%;">
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
</header>
<aside class="color2 col-lg-12 col-md-12 col-sm-12 col-xs-12"><br>				
</aside>
	<div  class="color1 col-lg-12 col-md-12 col-sm-12 col-xs-12" ><br>
	</div>
		<div class="container-fluid">	
			<div class="main row" >
				<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3 id="EMD" >
						Sección de Reportes
					</h3><br>
				</div>
			</div>
		</div>
		<div class="ImgIndex">
			<img style="margin-left: 15%;width:90%;" src="<?php echo URL;?>Imagenes/EMDlogoIndex.jpeg" class="rounded" >  
		</div>
    <div class="panel panel-default">
			<div class ="color2 col-lg-12 col-md-12 col-sm-12 col-xs-12"><br>
			</div>
			<div  class ="color1 col-lg-12 col-md-12 col-sm-12 col-xs-12" ><br>
			</div>
	</div><br><br><br><br><br>
	<footer class="color1" style="height: 85px;">
		<div class="container">
			<div class="main row">
				<div class ="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4>@CentroMedicoNosara</h4>
				</div>
				<div class ="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4>Dirección: Ubicado en Nosara contiguo al Gollo</h4>
				</div>
			</div>
		</div>	
	</footer>
	<script src="<?php echo URL;?>Public/JS/jquery-3.1.0.min.js"></script>
	<script src="<?php echo URL;?>Public/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$("li").click(function () {  
	  $('li').removeClass('active');
      $(this).addClass('active');
    });
</script>
</body>
</html>