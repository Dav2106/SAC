<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/Bootstrap/bootstrap/css/bootstrap.min.css">
	<link href="<?php echo URL;?>Public/Bootstrap/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" media="screen">
	<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/CSS/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/CSS/reportes.css">
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="shortcut icon" href="../favicon.ico" />
	<link rel="stylesheet" href="<?php echo URL;?>Public/Bootstrap/fonts/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body >
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="col-xs-1">
		   		<a href="<?php echo URL;?>Reportes/Reportes/index"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
		   	</div>
			<div class="col-xs-7">
				<h1 id="ec">Historial de Hospitalizacion</h1>
			</div>
			<div class="col-xs-4">
		   		<div>
			     	<nav>
				        <ul class="nav navbar-nav" style="margin-left: 80%;">
						   <li class="dropdown">
					       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['funcionario'];?><span class="caret"></span></a>
					          <ul class="dropdown-menu">
						            <li><a href="<?php echo URL;?>Usuarios/Login/CerrarSesion">Cerrar sesión</a></li>
					          </ul>
					       </li>
						</ul>
					</nav>	
				</div>	
		   	</div>
		</div>
	</div><br><br>

	<div class="container-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div>
				<table class="table table-bordered" id="reporte">
					<thead>
						<th>Cédula </th>
						<th>Nombre completo</th>
						<th>Causa</th>
						<th>tipo</th>
						<th>Nombre tratamiento</th>
						<th>Fecha entrada</th>
						<th>Fecha salida</th>
					</thead>
					<tbody></tbody>
				</table>
			</div>	
		</div>
		<a id="PDF" href=""  onclick="window.print()">Guardar como PDF</a>
	</div>
	<script src="<?php echo URL;?>Public/JS/jquery-3.1.0.min.js"></script>
	<script src="<?php echo URL;?>Public/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(function(){
			cargarTabla();
		});
		function cargarTabla(){
			$.ajax({
			url: "<?php echo URL;?>Reportes/Reportes/Hospitalizacion",
			dataType: 'json',
			success: function(response){
				$.each(response, function(index, record){
					var row = $("<tr />");
					$("<td />").text(record.Id).appendTo(row);
					$("<td />").text(record.Nombre).appendTo(row);
					$("<td />").text(record.Causa).appendTo(row);
					$("<td />").text(record.Tipo).appendTo(row);
					$("<td />").text(record.NombreTra).appendTo(row);
					$("<td />").text(record.Fecha1).appendTo(row);
					$("<td />").text(record.fecha2).appendTo(row);
					row.appendTo('table');
					})
				},
				error: function(){
					alert("No tiene pendientes");
				}
				
			});
		}	
	</script>
</body>
</html>