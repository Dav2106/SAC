<link rel="shortcut icon" href="favicon.ico" />
<link rel="shortcut icon" href="../favicon.ico" />
<link rel="stylesheet" type="text/css" href="Public\Bootstrap\bootstrap\css\bootstrap.min.css">
<link href="..\Assets\datatables.min.css" rel="stylesheet" type="text\css">
<link rel="stylesheet" type="text/css" href="Public\CSS\style.css">
<link rel="stylesheet" type="text/css" href="..\Public\CSS\style.css">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="shortcut icon" href="../favicon.ico" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

<div style="margin-left: 20%"><h3 ><a href="<?php echo URL;?>Index/indexAdm"><img src="<?php echo URL;?>imagenes\centro-medico1.png" alt=""></a>
REPORTE GENERAL DE LAS FACTURAS REALIZADAS</h3> </div>
<div class="container" style="height: 100px">	
<table class="table" id="tableDetalleMain">
	<thead>
	    <tr>
		    <th>ID PACIENTE</th>
		    <th>ID FUNCIONARIO</th>
		    <th>OBSERVACIONES</th>
		    <th>FECHA</th>
		    <th>TOTAL</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($this->facturas as $elementos) {?>
		<tr>
			<td><?php echo $elementos['EMD01PAC_EMD01IDPAC'];?></td>
			<td><?php echo $elementos['EMD02FUN_EMD02IDFUN'];?></td>
			<td><?php echo $elementos['EMD17DESCCMP'];?></td>
			<td><?php echo $elementos['EMD17FECHCMP'];?></td>
			<td><?php echo $elementos['EMD17TOTACMP'];?></td>
		</tr>	
	<?php } ?>	
	</tbody>
</table>
<br><br><br>
<a href="" onclick="window.print()"> Guardar como PDF</a>
</div>	
