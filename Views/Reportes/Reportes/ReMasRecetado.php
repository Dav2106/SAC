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
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="col-xs-1">
		   		<a href="<?php echo URL;?>Reportes/index"><img src="<?php echo URL;?>Imagenes/centro-medico1.png" alt=""></a>
		   	</div>
			<div class="col-xs-7">
				<h1>Medicamento mas recetado</h1>
			</div>
			<div class="col-xs-4">
		   		<div>
			     	<nav>
				        <ul class="nav navbar-nav" style="margin-left: 80%;">
						   <li class="dropdown">
					       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['funcionario'];?><span class="caret"></span></a>
					          <ul class="dropdown-menu">
						            <li><a href="<?php echo URL;?>Login/CerrarSesion">Cerrar Sesion</a></li>
					          </ul>
					       </li>
						</ul>
					</nav>	
				</div>	
		   	</div>
		</div>
	</div><br><br>
	 
	<div class="col-xs-2">
		<button class="btn btn-warning" id="btnBuscar">Buscar</button>	
	</div>
	
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div>
				<table class="table table-bordered table-stripped table-responsive" id="reporte">
					<thead>
						<th>Cantidad recetada</th>
						<th>Nombre</th>
					</thead>
					<tbody></tbody>
				</table>
			</div>	
		</div>
		
		<a href="" onclick="window.print()">Guardar como PDF</a>
	</div>
	<div>
		
	</div>
	<script src="<?php echo URL;?>Public/JS/jquery-3.1.0.min.js"></script>
	<script src="<?php echo URL;?>Public/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).on('click','#btnBuscar', function(){
		var fecha1 = $("#fecha1").val();
		var fecha2 = $("#fecha2").val();
		$.ajax({
			data: {"fecha1" : fecha1, "fecha2" : fecha2},
			type: "POST",
			url: "<?php echo URL;?>Reportes/mostrarMasRecetado",
			dataType: 'json',
			success: function(response){
				$.each(response, function(index, record){
					var row = $("<tr />");
					$("<td />").text(record.Cantidad).appendTo(row);
					$("<td />").text(record.Nombre).appendTo(row);
					row.appendTo('table');
					})
				},
				error: function(){
					alert("No tiene pendientes");
				}
			});
		});
	</script>
</body>
</html>