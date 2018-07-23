<?php @session_set_cookie_params(0,"/");
	@session_start();
	if(!isset($_SESSION['funcionario'])){
		header('location: '.URL.'Usuarios/Login/iniciarSesion');
	}
?>
<!DOCTYPE>
<html xmlns="">
<head>
<title>SAC</title>
<?php 
$path = "C:/inetpub/wwwroot/SAC/Assets/Assets.php";
if(file_exists($path)){
	require $path;  
}
?>
</head>
<body>
	<div class="container-fluid">
	   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	   <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
	   		<a href="<?php echo URL;?>Usuarios/Index/indexDoc"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
	   	</div>
	   <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
	   		<h2 class="form-signin-heading" style="margin-left: 65%;">Pacientes</h2>
	   	</div>
	   	<div class="col-xs-4">
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
	   <div class="container-fluid">
	   		<button class="btn btn-success" id="btnAgregar" type="button"  data-toggle="modal" data-target="#modal-1"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Agregar Persona</button>
	   </div>
        <hr />
	</div>
	<div class="container-fluid col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table cellspacing="0" width="100%" id="example" class="table table-bordered table-striped table-hover table-responsive">
        <thead>
        <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Primer apellido</th>
        <th>Segundo apellido</th>
        <th>Dirección</th>
        <th style="display: none;">FECHA DE NACIMIENTO</th>
        <th style="display: none;">CORREO</th>
        <th>Sexo</th>
        <th style="display: none;">LUGAR DE NACIMIENTO</th>
		<th style="display: none;">TELÉFONO</th>	
        <th>Diagnosticar</th>
        <th>Modificar</th>
        <th>Eliminar</th>
        </tr>
        </thead>
        </table>
        </div>
	</div>   
	<div class="container-fluid col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<br><div class="alert alert-info"></div>
		<button class="btn btn-success" onclick="window.location = '<?php echo URL;?>Usuarios/Index/indexDoc';">Regresar</button>
	</div>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		    <div class="modal-header">
			 	<button type="button" class="close" data-dismiss="modal">&times;</button>
			 	<h3 class="modal-title">Agregar paciente</h3>
			</div>
			<div class="modal-body ">
			 	<form class="form-group row" name="Paciente" action="<?php echo URL;?>ExpedienteMedico/Paciente/AgregarPaciente" method="POST" onsubmit="return CamposVaciosA()">
				 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					 	<div class="form-group row" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						    <label for="example-text-input" class="col-md-2 col-form-label">Cédula:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="id" name="id" required maxlength="45">
							</div>
						  	<label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Sexo:</label>
						    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <label class="form-check-inline">
							  <input class="form-check-input" type="radio" name="gender" id="gender" value="M" required>M</label>
							  <label class="form-check-inline">
							  <input class="form-check-input" type="radio" name="gender" id="gender" value="F" required>F</label>
						  	</div>
					  	</div>
						<div class="form-group row">
						    <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Nombre:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="nombre" name="nombre" required maxlength="45">
							</div>
							 <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Lugar nacimiento:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="lugNa" name="lugNa" required maxlength="45">
							</div>
						</div>
	                    <div class="form-group row">
							 <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Primer apellido:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="apellido1" name="apellido1" required maxlength="45">
							</div>
						   <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Dirección:</label>
						    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						       <input class="form-control" type="text" value="" id="direccion" name="direccion" required maxlength="45">
						    </div>	
						</div>
						<div class="form-group row">
						  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Segundo apellido:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="apellido2" name="apellido2" required maxlength="45">
							</div>
						    <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Email:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="email" name="email" required maxlength="45">
							   <span id="emailOK"></span>
							</div>
						</div>
						<div class="form-group row">
						  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Fecha nacimiento:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="date" value="" id="fechaNac" name="fechaNac" required maxlength="45">
							</div>
							 <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Teléfono:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="telefono" name="telefono" required maxlength="45">
							</div>
	   					</div>
 					    <div class="form-group row"></div>
						<div class="modal-footer" >
						    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
						 	<a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
						 	 <button id="enviarA" name="enviarA" type="submit" class="btn btn-success">Agregar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!--fin modal -->

 <!-- Bootstrap modal -->
<div class="modal fade" id="modal-2" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		    <div class="modal-header">
			 	<button type="button" class="close" data-dismiss="modal">&times;</button>
			 	<h3 class="modal-title">Modificar paciente</h3>
			</div>
			<div class="modal-body ">
			 	<form class="form-group row" name="Paciente" action="<?php echo URL;?>ExpedienteMedico/Paciente/ModificarPaciente" method="POST">
				 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					 	<div class="form-group row" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						    <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Cédula:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="id1" name="id1" required maxlength="45">
							</div>
						  	<label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Sexo:</label>
						    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <label class="form-check-inline">
							  <input class="form-check-input" type="radio" name="gender1" id="gender1" value="M" required>M</label>
							  <label class="form-check-inline">
							  <input class="form-check-input" type="radio" name="gender1" id="gender1" value="F" required>F</label>
						  	</div>
					  	</div>
						<div class="form-group row">
						    <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Nombre:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="nombre1" name="nombre1" required maxlength="45">
							</div>
							 <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Lugar nacimiento:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="lugNa1" name="lugNa1" required maxlength="45">
							</div>
						</div>
	                    <div class="form-group row">
							 <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Primer apellido:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="apellido11" name="apellido11" required maxlength="45">
							</div>
						   <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Dirección:</label>
						    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						       <input class="form-control" type="text" value="" id="direccion1" name="direccion1" required maxlength="45">
						    </div>	
						</div>
						<div class="form-group row">
						  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Segundo apellido:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="apellido21" name="apellido21" required maxlength="45">
							</div>
						    <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Email:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="email1" name="email1" required maxlength="45">
							   <span id="emailOK1"></span>
							</div>
						</div>
						<div class="form-group row">
						  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Fecha nacimiento:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="date" value="" id="fechaNac1" name="fechaNac1" required maxlength="45">
							</div>	
							 <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Teléfono:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							  <input class="form-control" type="text" value="" id="telefono1" name="telefono1" required maxlength="45">
							</div>
	   					</div>
 					    <div class="form-group row"></div>
						<div class="modal-footer" >
						    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
						 	<a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
						 	 <button id="enviarM" name="enviarM" type="submit" class="btn btn-warning">Modificar</button>
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
		        <h3 class="modal-title">Eliminar Paciente</h3>
	        </div>
      		<div class="modal-body form">
		        <form action="<?php echo URL;?>ExpedienteMedico/Paciente/EliminarPaciente" method="POST" id="form" class="form-horizontal">
			        <div class="form-body">
			            <div class="form-group">
			         		<h3>&nbsp;&nbsp;Seguro que desea eliminar?</h3>
			         		<div class="container-fluid">
			         			<h4>Si elimina a este paciente, toda la información relacionada a él será eliminada.</h4>
			         		</div>
			                <div class="col-md-9">
			                   <input class="form-control" type="text" value="" id="id1" name="id1" style="display: none;"><!--Arreglar-->
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
  <!-- End Bootstrap modal -->
<style type="text/css">
	.hideColumns{
		display: none;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		listar();
	});
	function seleccionarTabla() {
		var _trEdit = null;
		$(document).on('click', '#btnModi',function(){
			_trEdit = $(this).closest('tr');
			var _id = $(_trEdit).find('td:eq(0)').text();
			var _nombre = $(_trEdit).find('td:eq(1)').text();
			var _apellido1 = $(_trEdit).find('td:eq(2)').text();
			var _apellido2 = $(_trEdit).find('td:eq(3)').text();
			var _direccion = $(_trEdit).find('td:eq(4)').text();
			var _fechaNac = $(_trEdit).find('td:eq(5)').text();
			var _email = $(_trEdit).find('td:eq(6)').text();
			var _gender = $(_trEdit).find('td:eq(7)').text();
			var _lugNa = $(_trEdit).find('td:eq(8)').text();
			var _telefono = $(_trEdit).find('td:eq(9)').text();

			$('input[name="id1"]').val(_id);
			$('input[name="nombre1"]').val(_nombre);
			$('input[name="apellido11"]').val(_apellido1);
			$('input[name="apellido21"]').val(_apellido2);
			$('input[name="direccion1"]').val(_direccion);
			$('input[name="fechaNac1"]').val(_fechaNac);
			$('input[name="email1"]').val(_email);
			$('input[name="gender1"][value="'+ _gender +'"]').prop('checked', true);
			$('input[name="lugNa1"]').val(_lugNa);
			$('input[name="telefono1"]').val(_telefono);

			console.log(_id,_nombre,_apellido1,_apellido2,_direccion,_fechaNac,_email,
				_gender,_lugNa,_telefono);
		}); 
	}

	var listar = function(){
		var table = $("#example").DataTable({
			"ajax":{
				"method": "POST",
				"url": "<?php echo URL;?>ExpedienteMedico/Paciente/CargarPersonas"
			},
			"columns":[
				{"data": "EMD01IDPAC"},
				{"data": "EMD01NOMBPAC"},
				{"data": "EMD01APE1PAC"},
				{"data": "EMD01APE2PAC"},
				{"data": "EMD01DIREPAC"},
				{"data": "EMD01FENAPAC"},
				{"data": "EMD01CORRPAC"},
				{"data": "EMD01SEXOPAC"},
				{"data": "EMD01LUNAPAC"},
				{"data": "EMD01TELEPAC"},
				{
		               data: null,
		               className: "center",
		               defaultContent: '<a href="javascript:void(0)" id="btnModi" onclick="selec()"><img src="../../Imagenes/edit.png" width="20px" />'
		        },
		        {
		               data: null,
		               className: "center",
		               defaultContent: '<button class="btn btn-warning" id="btnModi" type="button" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-2"> &nbsp;Modificar</button>'
		        },
		        {
		               data: null,
		               className: "center",
		               defaultContent: '<button class="btn btn-danger" id="btnModi" type="button" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-4"> &nbsp;Eliminar</button>'
		        }
			],
			"columnDefs": [
            {
            	className: "hideColumns",
                "targets": [ 5,6,8,9 ]
            }
        ]
		});

		setInterval(function () {
		table.ajax.reload(null, false);
		}, 5000);
	}

	function selec(){
		var _trEdit = null;
		$(document).on('click', '#btnModi',function(){
			_trEdit = $(this).closest('tr');
			var id = $(_trEdit).find('td:eq(0)').text();
			var nombre = $(_trEdit).find('td:eq(1)').text();
			var sexo = $(_trEdit).find('td:eq(7)').text();

				
			window.location = '<?php echo URL;?>ExpedienteMedico/Diagnostico/mostrarDia/'+id+"-"+nombre+"-"+sexo;
		});
	}

	document.getElementById('email').addEventListener('input', function() {
    campo = event.target;
    valido = document.getElementById('emailOK');
     
        
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(campo.value)) {
    	 $('#enviarA').attr("disabled", false);
      valido.innerText = "válido";
      
    } else {
      valido.innerText = "incorrecto";
     
      document.getElementById('enviarA').disabled=true;
    }
});

	document.getElementById('email1').addEventListener('input', function() {
    campo = event.target;
    valido = document.getElementById('emailOK1');
   
        
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(campo.value)) {
      valido.innerText = "válido";
      $('#enviarM').attr("disabled", false);
    } else {
      valido.innerText = "incorrecto";
     document.getElementById('enviarM').disabled=true;

    }
});
</script>
</body>
</html>
