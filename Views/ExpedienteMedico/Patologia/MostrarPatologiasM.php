<?php session_set_cookie_params(0,"/");
@session_start();
if(!isset($_SESSION['funcionario'])){
	header('location: '.URL.'Usuarios/Login/iniciarSesion');
}
$fecha = getdate();
$fecha = date('Y-m-d');?>
<!DOCTYPE>
<html xmlns="">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EMD SYSTEM</title>
<link rel="shortcut icon" href="../favicon.ico" />
<link href="<?php echo URL;?>Public/Bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo URL;?>Public/Bootstrap/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="<?php echo URL;?>Public/Bootstrap/fonts/css/font-awesome.min.css">
<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo URL;?>Public/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Public/JS/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Public/JS/validacionesPatologia.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/datatables.min.js"></script>
</head>
<body>
	<div class="container-fluid">
       	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
	   		<a href="<?php echo URL;?>ExpedienteMedico/Diagnostico/FinalizarConsulta"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
	   	</div>
	    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
	   		<h2 class="form-signin-heading" style="margin-left: 60%;">Patologías</h2>
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
	   	<hr>
	   </div>
	   <div>
        <h4 style="margin-left: 85%;">Paciente: <?php echo $_SESSION['cedula'];?></h4><h4 style="margin-left: 85%;">Nombre: <?php echo $_SESSION['nombre'];?></h4><h4 style="margin-left: 85%;">Diagnóstico: <?php echo $_SESSION['lastDgn'];?></h4>
    	</div> 
        <button class="btn btn-success" id="btnAgregar" type="button"  data-toggle="modal" data-target="#modal-1"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Agregar Patologias</button>&nbsp;<button class="btn btn-primary" id="btnAgrePatologia" type="button"  data-toggle="modal" data-target="#modal-5"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Seleccionar Patologías</button><br><br>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	      <ul id="lista" class="nav nav-pills nav-justified nav-tabs">
	        <li><a href="<?php echo URL;?>ExpedienteMedico/Diagnostico/mostrarDia/<?php echo $_SESSION['cedula']."-".$_SESSION['nombre']."-".$_SESSION['sexo'];?>">Diagnósticos</a></li>
	        <li class="active"><a href="#">Patologías</a></li>
	        <li><a href="<?php echo URL;?>ExpedienteMedico/Tratamiento/mostrarDia">Tratamientos</a></li>
	        <li><a href="<?php echo URL;?>ExpedienteMedico/Examen/mostrarDia">Exámenes</a></li>
	        <li><a href="<?php echo URL;?>ExpedienteMedico/Hospitalizacion/mostrarObsHospi">Hospitalizaciones</a></li>
	        
	      </ul>
	    </div>
        <hr><br><br>
        <div class="container-fluid">
        <table cellspacing="0" width="100%" id="example" class="table table-bordered table-striped table-hover table-responsive">
        <thead>
        <tr>
        <th style="display: none;">ID</th>
        <th>Descripción</th>
        <th style="display: none;">Id paciente</th>
        <th>Fecha</th>
        <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->patologia as $elementos){ ?>
			<tr>
				<td style="display: none;"><?php echo $elementos['EMD05IDPAT']; ?></td>
				<td><?php echo $elementos['EMD05DESCPAT']; ?></td>
				<td style="display: none;"><?php echo $elementos['EMD01PAC_EMD01IDPAC']; ?></td>
				<td><?php echo $elementos['EMD19FECHPAT']; ?></td>
				<td align="center"> 
				<button class="btn btn-danger" id="btnModi" type="button" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-4"> <span class="glyphicon glyphicon-trash-align-center"></span>Eliminar</button></td>
			</tr>
			<?php } ?>
        </tbody>
        </table>
       </div>
    </div>
   	           
<!-- Bootstrap modal -->
<div class="modal fade" id="modal-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Agregar Patología</h3>
			</div>
			<div class="modal-body">		
				<form class="form-group row" name="Patologias" action="<?php echo URL;?>ExpedienteMedico/Patologia/AgregarPatologia" method="POST" onsubmit="return CamposVaciosA()">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group row">
					 	    <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Descripción:</label> 
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							   <input class="form-control" type="text" value="" id="descripcion" name="descripcion" required maxlength="300">   
							</div>
						</div><br><br>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				            <div class="modal-footer" >
				              <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
				              <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
				              <button id="enviar" name="enviar" type="submit" class="btn btn-success">Agregar</button>
				            </div>
				        </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!--fin modal -->


   
<div class="modal fade" id="modal-2" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Modificar Patología</h3>
			</div>
			<div class="modal-body">		
				<form class="form-group row" name="Patologias" action="<?php echo URL;?>ExpedienteMedico/Patologia/ModificarPatologia" method="POST">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group row">
							<input type="text" name="id1" id="id1" style="display: none;">
					 	    <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Descripción:</label> 
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							   <input class="form-control" type="text" id="descripcion1" name="descripcion1" required maxlength="300">   
							</div>
						</div><br><br>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				            <div class="modal-footer" >
				              <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
				              <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
				              <button id="enviar" name="enviar" type="submit" class="btn btn-warning">Modificar</button>
				            </div>
				        </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!--fin modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal-4" role="dialog">
    <div class="modal-dialog">
	    <div class="modal-content">
            <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h3 class="modal-title">Eliminar Patología</h3>
			</div>
			<div class="modal-body form">
			    <form action="<?php echo URL;?>ExpedienteMedico/Patologia/EliminarPatologia" method="POST" id="form" class="form-horizontal">
			        <div class="form-group row">
						<h3>&nbsp;&nbsp;Seguro que desea eliminarlo?</h3>
						<div class="col-xs-3">
							<input class="form-control" type="text" value="" id="id1" name="id1" style="display: none;">
							<input class="form-control" type="text" value="<?php echo $_SESSION["cedula"];?>" id="idP" name="idP" style="display: none;">
						</div>
					</div><br><br>
				    <div class="modal-footer" >
					    <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
					    <button id="enviar" name="enviar" type="submit" class="btn btn-danger">Eliminar</button>
				    </div>
			    </form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<div class="modal fade" id="modal-5" role="dialog">
	<div class="modal-dialog  modal-lg">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h3 class="modal-title">Patologias</h3>
	    	</div><br><br>
	    	<form action="">
		      	<div class="modal-body col-lg-12 col-md-12 col-sm-12 col-xs-12" id="bodyPatologia">
		      		<table class="table table-bordered table-striped" id="pat">
		      			<thead>
		      				<th>Descripción</th>
		      				<th>Seleccionar</th>
		      			</thead>
		      		</table>
		      	</div>
	      	</form>
			<div class="modal-footer" >
				<div class="col-xs-12">
					<a href="<?php echo URL;?>ExpedienteMedico/Patologia/mostrarDia" class="btn btn-default">Cerrar</a>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<br>
<div class="container-fluid" style="margin-top: 135px;">
	<div class="alert alert-info"></div>
    <button class="btn btn-success" onclick="window.location = '<?php echo URL;?>ExpedienteMedico/Diagnostico/mostrar/<?php echo $_SESSION["cedula"]."-".$_SESSION["nombre"]."-".$_SESSION["sexo"];?>';">Regresar</button>
    <a style="margin-left: 80%;" class="btn btn-danger" href="<?php echo URL;?>ExpedienteMedico/Diagnostico/FinalizarConsulta">Finalizar consulta</a>
</div>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#example').DataTable();
	cargarPatologias();
	function cargarPatologias(){
	$.ajax({
		type: "POST",
		url: "<?php echo URL;?>ExpedienteMedico/Patologia/CargarPatologias",
		dataType: 'json',
		success: function(data){
			console.log(data);
			var tabla = $("#pat tbody").html('');
				$.each(data, function(index, record){
					var row = $("<tr />");
					$("<td />").text(record.Patologia).appendTo(row);
					$("<td />").html('<input type="checkbox" value='+record.ID+' name="checkPat">').appendTo(row);
					row.appendTo('#pat');
				});
		$("#pat").DataTable();		
		},
		error: function(err){
			console.log(err);
		}
	});
	}
});
</script>
<script type="text/javascript">
	function seleccionarTabla() {
	var _trEdit = null;
	$(document).on('click', '#btnModi',function(){
		_trEdit = $(this).closest('tr');
		var _id = $(_trEdit).find('td:eq(0)').text();
		var _descripcion = $(_trEdit).find('td:eq(1)').text();
		var _idPat = $(_trEdit).find('td:eq(2)').text();

		
		$('input[name="id1"]').val(_id);
		$('input[name="descripcion1"]').val(_descripcion);
		$('input[name="idPat"]').val(_idPat);
	}); 
}

		$(document).on('click', 'input[name="checkPat"]',function(){
			if(this.checked){
				var _id = $(this).val();
				var idPac = '<?php echo $_SESSION["cedula"];?>';
    			var datos = {"patologia" : _id, "idPac": idPac};
	  			$.ajax({
	    			data: datos,
	    			type: 'POST',
	    			url: '<?php echo URL;?>ExpedienteMedico/Patologia/AgregarPatologiaList',
	    			dataType: 'json',
	    			success: function(data){
	    				console.log(data);
	    			},
	    			error: function(err){
	    				console.log(err);
	    			}
	    		});
			} 
	  		else{
				var _id = $(this).val();
				var idPac = '<?php echo $_SESSION["cedula"];?>';
    			var datos = {"patologia" : _id, "idPac": idPac};
	  			$.ajax({
	    			data: datos,
	    			type: 'POST',
	    			url: '<?php echo URL;?>ExpedienteMedico/Patologia/EliminarPatologiaList',
	    			dataType: 'json',
	    			success: function(data){
	    				console.log(data);
	    			},
	    			error: function(err){
	    				console.log(err);
	    			}
	    		});
	  		} 
		});	
</script>
</body>
</html>