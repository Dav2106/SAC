<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>EMD SYS</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/Bootstrap/bootstrap/css/bootstrap.min.css">
	<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/CSS/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/CSS/reportes.css">
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="shortcut icon" href="../favicon.ico" />
	<link rel="stylesheet" href="<?php echo URL;?>Public/Bootstrap/fonts/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
	<div class="container-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
		   		<a href="<?php echo URL;?>Reportes/Reportes/index"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
		   	</div>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
				<h1 style="margin-left: 50%;">Historial Financiero</h1>
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
	</div><br><br>
	<div id="datos" class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<label for="fecha">Buscar por Cédula: </label>
			</div>
			<div class="form-group row">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<input class="form-control" type="text" id="id" name="id" placeholder="Cédula">
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<button class="btn btn-warning" id="btnBuscar">Buscar</button>	
				</div>
			</div>
		</div>
	</div><br><br>
	<div class="container-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div>
				<table class="table table-bordered table-stripped table-responsive" id="reporte">
					<thead>
						<th>Factura</th>
						<th>Descripción</th>
						<th>Fecha</th>
						<th>Total</th>	
					</thead>
					<tbody></tbody>
				</table>
			</div>	
		</div>
		<a id="PDF" href="" style="display:none;" onclick="window.print()"> Guardar como PDF</a>
		<a id="nueRe" href="" style="display:none;" ">Nuevo reporte</a>
	</div>
	<script src="<?php echo URL;?>Public/JS/jquery-3.1.0.min.js"></script>
	<script src="<?php echo URL;?>Public/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).on('click','#btnBuscar', function(){
		var id = $("#id").val();
	
		$.ajax({
			data: "id="+id,
			type: "POST",
			url: "<?php echo URL;?>Reportes/Reportes/histFinan",
			dataType: 'json',
			success: function(response){
				console.log(response);
				$.each(response, function(index, record){
					var row = $("<tr />");
					$("<td />").text(record.ID).appendTo(row);
					$("<td />").text(record.Desc).appendTo(row);
					$("<td />").text(record.Fecha).appendTo(row);
					$("<td />").text(record.Total).appendTo(row);
					row.appendTo('table');
					})
				},
				error: function(err){
					alert("No se encontro resultados");
					console.log(err);
				}
			});
		});
	</script>
	<script>
	$("#btnBuscar").on( "click", function() {
			$('#datos').hide(); //oculto mediante id
			$('#PDF').show();
			$("#nueRe").show();
			
		});
	$(document).ready(function() {
        $('#nueRe').click(function() {
            location.reload();
        });
    });
	</script>
</body>
</html>