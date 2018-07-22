<?php session_set_cookie_params(0,"/");
@session_start();
if(!isset($_SESSION['funcionario'])){
	header('location: '.URL.'Usuarios/Login/iniciarSesion');
}
$fecha = getdate();
$fecha = date('Y-m-d H:i:s');?>
<!DOCTYPE html>
<!DOCTYPE>
<html xmlns="">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EMD SYSTEM</title>
<link rel="shortcut icon" href="../../favicon.ico" />
<link href="<?php echo URL;?>Public/Bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="<?php echo URL;?>Public/Bootstrap/fonts/css/font-awesome.min.css">
<link href="<?php echo URL;?>Public/Bootstrap/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link href="<?php echo URL;?>Public/CSS/footer.css" rel="stylesheet" media="screen">
<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo URL;?>Public/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Public/JS/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Public/JS/validacionesDiagnostico.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/datatables.min.js"></script>
</head>
<body>
	<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
	   		<a href="<?php echo URL;?>ExpedienteMedico/Diagnostico/FinalizarConsulta"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
	   	</div>	
	   <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
	   		<h2 class="form-signin-heading" style="margin-left: 40%;">Diagnósticos</h2>
	   	</div>
	   	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
	   		<div>
		     	<nav>
			        <ul class="nav navbar-nav">
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
        <h4 style="margin-left: 85%;">Paciente: <?php echo $_SESSION['cedula'];?></h4><h4 style="margin-left: 85%;">Nombre: <?php echo $_SESSION['nombre'];?></h4>
    </div>    
         <button class="btn btn-success" id="btnAgregar" type="button"  data-toggle="modal" data-target="#modal-1"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Agregar Diagnóstico</button><br><br>
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<ul id="lista" class="nav nav-pills nav-justified nav-tabs">
			  <li class="active"><a href="#">Diagnósticos</a></li>
			  <li><a href="<?php echo URL;?>ExpedienteMedico/Patologia/mostrarDia">Patologías</a></li>
			  <li><a href="<?php echo URL;?>ExpedienteMedico/Tratamiento/mostrarDia">Tratamientos</a></li>
			  <li><a href="<?php echo URL;?>ExpedienteMedico/Examen/mostrarDia">Exámenes</a></li>
			  <li><a href="<?php echo URL;?>ExpedienteMedico/Hospitalizacion/mostrarObsHospi">Hospitalizaciones</a></li>
			  
			</ul>
		</div>
        <hr><br><br>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table cellspacing="0" width="100%" id="example" class="table table-bordered table-striped table-hover table-responsive">
        <thead>
        <tr>
		<th style="display: none;">ID DIAGNOSTICO</th>
        <th>Fecha</th>
        <th>Diagnóstico</th>
        <th>Tratamiento</th>
        <th style="display: none;">ID FUNCIONARIO</th>
        <th>Observaciones</th>
        <th>Examen</th>
        <th>Hospitalización</th>
        <th>Modificar</th>
        <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->diagnostico as $elementos) { ?>
			<tr>
			<td style="display: none;"><?php echo $elementos['EMD07IDDGN']; ?></td>
			<td><?php echo $elementos['EMD07FECHDGN']; ?></td>
			<td><?php echo $elementos['EMD07DESCDGN']; ?></td>
			<td><?php echo $elementos['Tratamiento']; ?></td>
			<td><?php echo $elementos['Indicaciones']; ?></td>
			<td><?php echo $elementos['Examen']; ?></td>
			<td><?php echo $elementos['Hospitalizacion']; ?></td>
			<td style="display: none;"><?php echo $elementos['EMD02FUN_EMD02IDFUN']; ?></td>
			 <td align="center">
			 <button class="btn btn-warning" id="btnModi" type="button" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-2"> &nbsp;Modificar</button></td>
			<td align="center"> 
			<button class="btn btn-danger" id="btnModi" type="button" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-4"> <span class="glyphicon glyphicon-trash-align-center"></span>Eliminar</button></td>
			</tr>
			<?php } ?>
        </tbody>
        </table>
       </div>
    </div>
    <br>
    <!-- Bootstrap modal Agregar 1-->
<div class="container">
	<div class="modal fade" id="modal-1" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
				  	<button type 1="button" class="close" data-dismiss="modal">&times;</button>
				 	<h3 class="modal-title">Agregar diagnóstico</h3>
				</div>
				<div class="modal-body">
					<form name="Diagnostico" method="POST" action="<?php echo URL;?>ExpedienteMedico/Diagnostico/AgregarDiagnostico" onsubmit="return CamposVaciosA()">
						<div class="container">
						    <div class="form-group row">
							    <input style="display: none;" type="datetime" id="fecha" name="fecha" value="<?php echo $fecha;?>">
							  	<label for="example-text-input" class="col-xs-1 col-form-label">Diagnóstico:</label>
							  	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
							  		<textarea class="form-control" rows="8" id="Descripcion" name="Descripcion" required maxlength="250" value=""></textarea>
							  	</div>
							</div>
							<input style="display: none;" type="text" id="idFun" name="idFun" value="<?php echo $_SESSION['funcionario'];?>">
							<input style="display: none;" type="text" id="idPac" name="idPac" value="<?php echo $_SESSION['cedula'];?>">
							<div class="form-group row"><br></div>
							<div class="form-group row" style="margin-left: 60%;">
								<a href="" data-dismiss="modal" class="btn btn-default">Cerrar</a>
								<button type="submit" class="btn btn-success" id="btnA">Agregar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div><!--fin modal -->
<div class="container">
	<div class="modal fade" id="modal-2" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
				  	<button type 1="button" class="close" data-dismiss="modal">&times;</button>
				 	<h3 class="modal-title">Modificar diagnóstico</h3>
				</div>
				<div class="modal-body ">
					<form name="Diagnostico" method="POST" action="<?php echo URL;?>ExpedienteMedico/Diagnostico/ModificarDiagnostico">
						<div class="container">
							<input type="text" name="id" id="id" style="display: none;">
							<input value="<?php echo $fecha;?>" style="display: none;"  value="<?php echo $fecha;?>" class="form-control" required="required" type="datetime" id="fecha" name="fecha">
						    <div class="form-group row">
							  	<label for="example-text-input" class="col-xs-1 col-form-label">Diagnóstico:</label>
							  	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
							  		<textarea class="form-control" rows="8" id="Descripcion" name="Descripcion" required maxlength="250" value=""></textarea>
							  	</div>
							</div>
							<input style="display: none;" type="text" id="idFun" name="idFun" value="<?php echo $_SESSION['funcionario'];?>">
							<input style="display: none;" type="text" id="idPac" name="idPac" value="<?php echo $_SESSION['cedula'];?>">
							<div class="form-group row"><br></div>
							<div class="form-group row" style="margin-left: 60%;">
								<a class="btn btn-default" data-dismiss="modal">Cerrar</a>
								<button type="submit" class="btn btn-warning">Modificar</button>   
							</div>
						</div>
					</form>
				</div>
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
	        	<h3 class="modal-title">Eliminar diagnóstico</h3>
	    	</div>
	      	<div class="modal-body form">
	        	<form action="<?php echo URL;?>ExpedienteMedico/Diagnostico/EliminarDiagnostico" method="POST" id="form" class="form-horizontal">
	          		<div class="form-body">
			            <div class="form-group">
			              	<h3>&nbsp;&nbsp;Seguro que desea eliminar?</h3>
			              	<div class="col-md-9">
			                	<input class="form-control" type="text" value="" id="id" name="id" style="display: none;">
			              	</div>
			            </div>
			        </div>
	           		<div class="modal-footer" >
						<div class="col-xs-5"></div>
						<a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
						<button id="enviar" name="enviar" type="submit" class="btn btn-danger">Eliminar</button>
					</div>
				</form>
			</div>
			<div class="modal-footer" >
				<div class="col-xs-5"></div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-5" role="dialog">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        		<h3 class="modal-title col-xs-3 col-sm-3 col-md-3 col-lg-3">Historial: </h3>
	        		<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
	        			<input type="text" class="form-control" id="buscar" name="buscar">
	        		</div>
	        	</div>
	      	</div><br>
      		<div class="modal-body form">
        		<form>
          			<div class="form-body">
			            <table id="diagnosticos" class="table table-stripped">
			            	<thead>
			            		<tr>
			            			<th>Fecha</th>
			            			<th>Diagnóstico</th>
			            			<th>Tratamiento</th>
			            			<th>Examen</th>
			            			<th>Hospitalizacion</th>
			            		</tr>
			            	</thead>
			            </table>
          			</div><br><br>
			        <div class="modal-footer" >
						<div class="col-xs-5"></div>
						<a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
					</div>
        		</form>
        	</div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-6" role="dialog">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        		<h3 class="modal-title col-xs-3 col-sm-3 col-md-3 col-lg-3" id="titulo"></h3>
	        	</div>
	      	</div><br>
      		<div class="modal-body form">
          		<div class="form-body">
          			<div id="respuesta"></div><br /><br />
          			<div id="respuesta1"></div>
          		</div><br><br>
			    <div class="modal-footer" >
					<div class="col-xs-5"></div>
					<a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
				</div>
        	</div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<input hidden="hidden" id="iL" value="<?php echo $_SESSION['idLastDgn'];?>">	
<div class="container-fluid" style="margin-top: 155px;">
   <div class="alert alert-info"></div>
   <div class="row">
   		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	   		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
	   			<button class="btn btn-success" onclick="window.location = '<?php echo URL;?>ExpedienteMedico/Paciente/mostrar';">Regresar</button>
			   <button id="verHist" class="btn btn-primary">Ver historial</button>
			   <button id="hos" class="btn btn-warning">Pendientes</button>
	   		</div>
		   <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
		   <a class="btn btn-danger" href="<?php echo URL;?>ExpedienteMedico/Diagnostico/FinalizarConsulta">Finalizar consulta</a>
   		</div>
   </div>
</div>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	deshabilitar();
	$('#example').DataTable();
	$.ajax({
		type: 'POST',
		url: '<?php echo URL;?>ExpedienteMedico/Diagnostico/mostrarHistorial',
		dataType: 'json',
		success: function(response){
			var tabla = $("#diagnosticos tbody").html('');
			$.each(response, function(index, record){
				var row = $("<tr />");
				$("<td />").text(record.Fecha).appendTo(row);
				$("<td />").text(record.Descripcion).appendTo(row);
				$("<td />").text(record.Tratamiento).appendTo(row);
				$("<td />").text(record.Examen).appendTo(row);
				$("<td />").text(record.Hospitalizacion).appendTo(row);
				row.appendTo('#diagnosticos');
				filtrar();
			})	
		},
		error: function(){
			console.log("error");
		}
	});
	
	$(document).on('click','#verHist', function(){
		$("#modal-5").modal('show');
		return false; 
	});

	$(document).on('click','#hos', function(){
	        $.ajax({
				type: 'POST',
				url: '<?php echo URL;?>ExpedienteMedico/Examen/BuscarExam',
				success: function(response){
					$("#respuesta1").html('');
					console.log(response);
					if(response != 0){
						$("#respuesta1").html("<h3>Paciente tiene examen pendiente</h3><br /><br /><a href='<?php echo URL;?>ExpedienteMedico/Examen/cargarPendiente'>Ir a Examenes</a>");
					}else if(response == 0){
						$("#respuesta1").html("<h3>Paciente no tiene examenes pendientes</h3>");
					}
				},
				error: function(err){
					console.log(err);
				}
			});
	        $.ajax({
				type: 'POST',
				url: '<?php echo URL;?>ExpedienteMedico/Hospitalizacion/BuscarHosp',
				success: function(response){
					$("#respuesta").html('');
					console.log(response);
					if(response != 0){
						$("#respuesta").html("<h3>Paciente tiene hospitalización vigente</h3><br /><br /><a href='<?php echo URL;?>ExpedienteMedico/Hospitalizacion/mostrarObsHospi'>Ir a hospitalización</a>");
					}else if(response == 0){
						$("#respuesta").html("<h3>Paciente no tiene hospitalización vigente</h3>");
					}
				},
				error: function(err){
					console.log(err);
				}
			});
		$("#modal-6").modal('show');
		return false; 
	});


	$("#btnAgregar").click(function(){
		$('textarea[name="Descripcion"]').val(" ");
	});

	
});
</script>
<script type="text/javascript">
	function cargaUltimoDiagnostico(){
		$.ajax({
			type: 'POST',
			url: '<?php echo URL;?>ExpedienteMedico/Diagnostico/cargarUltimoDiagnostico',
			dataType: 'json',
			success: function(data){
				console.log(data);
			},
			error: function(){
				console.log('error');
			}
		});
	}

	function deshabilitar(){
		cargaUltimoDiagnostico();
		var dgn = $("#iL").val();
		console.log(dgn);
		if(dgn > 0){
			$("#lista li").removeClass('disabled');
		}else {
			$("#lista li").addClass('disabled');
			$("#lista li a").attr('href', '#');
		}
	}
	
	function seleccionarTabla() {
		var _trEdit = null;
		$(document).on('click', '#btnModi',function(){
			_trEdit = $(this).closest('tr');
			var _id = $(_trEdit).find('td:eq(0)').text();
			var _fecha = $(_trEdit).find('td:eq(1)').text();
			var _diagnostico = $(_trEdit).find('td:eq(2)').text();
					
			$('input[name="id"]').val(_id);
			$('input[name="fecha"]').val(_fecha);
			$('textarea[name="Descripcion"]').val(_diagnostico);
		});
	}

	function filtrar(){
		var $rows = $('#diagnosticos tr');
		$('#buscar').keyup(function() {
		    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
	    
		    $rows.show().filter(function() {
		        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
		        return !~text.indexOf(val);
		    }).hide();
		});
	}
</script>
</body>
</html>