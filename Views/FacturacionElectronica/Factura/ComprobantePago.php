<?php session_set_cookie_params(0,"/");
@session_start();
$fecha = getdate();
$fecha = date('Y-m-d');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EMD SYS</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/Bootstrap/bootstrap/css/bootstrap.min.css">
	<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/CSS/style.css">
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="shortcut icon" href="../favicon.ico" />
	<link rel="stylesheet" href="<?php echo URL;?>Public/Bootstrap/fonts/css/font-awesome.min.css">
	<script type="text/javascript" src="<?php echo URL;?>Assets/jquery-1.11.3-jquery.min.js"></script>
</head>
<body >
<br><br><br>
	<div class="Fondo" >
	<div class="container">
			<a href="<?php echo URL;?>Index/redireccion"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
		</div>
		<div id="DetaFactura" >
			<div class="container">
				<h4>Cedula: <?php echo $_SESSION['idPacRep'];?></h4><h4 style="margin-left: 65%;">Fecha: <?php echo $fecha;?></h4>
				<h4>Nombre Completo: <?php echo $_SESSION['idNomRep'];?></h4><h4 style="margin-left: 65%;">Factura: <?php echo $_SESSION['numFact'];?></h4>
			</div><br><br>	
		</div>
		<div class="container">
			<table class="table table-responsive table-stripered" id="reporte">
					<thead>
						<th><h3><b>Descripcion</b></h3></th>
						<th><h3><b>Estado</b></h3></th>
						<th><h3><b>Costo</b></h3></th>
					</thead>
					<tbody>
					<?php foreach($this->detalle as $elementos){ ?>
					<tr>
						<td><h4><?php echo $elementos['EMD08DESCDET']; ?></h4></td>
						<td><h4><?php echo $elementos['EMD08ESTADET']; ?></h4></td>
						<td><h4><?php echo number_format($elementos['EMD08COSTDET']); ?></h4></td>
					</tr>
					</tbody>
					<?php } ?>
			</table>
			<div><h3><b>Total: <?php echo $elementos['EMD17TOTACMP']; ?></b></h3></div>
		</div>
	</div>
</body>
</html>