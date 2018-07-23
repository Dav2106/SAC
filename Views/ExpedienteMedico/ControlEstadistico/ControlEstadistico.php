<?php @session_set_cookie_params(0,"/");
@session_start();
if(!isset($_SESSION['funcionario'])){
	header('location: '.URL.'Usuarios/Login/iniciarSesion');
}
$fecha = getdate();
$fecha = date('Y-m-d');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SAC</title>
	<?php 
	$path = "C:/inetpub/wwwroot/SAC/Assets/Assets.php";
	if(file_exists($path)){
		require $path;  
	}
	?>
	<script type="text/javascript">
		$(function(){
			$("#example").DataTable();
		});
	</script>	
</head>
<body>
<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
	   		<a href="<?php echo URL;?>ExpedienteMedico/Diagnostico/FinalizarConsulta"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
	   	</div>	
	   <div class="col-lg-7 col-md-7col-sm-7 col-xs-7">
	   		<h2 class="form-signin-heading" style="margin-left: 55%;">Control Prenatal</h2>
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
	   	</div><hr>
	</div>	
	<div class="main row">
		<div>
          	<h4 style="margin-left: 85%;">Paciente: <?php echo $_SESSION['cedula'];?></h4><h4 style="margin-left: 85%;">Nombre: <?php echo $_SESSION['nombre'];?></h4><h4 style="margin-left: 85%;">Diagnóstico: <?php echo $_SESSION['lastDgn'];?></h4>
    	</div>
	</div>
</div>
<div class="container-fluid"> 
    <button class="btn btn-success" id="btnAgregar" type="button"  data-toggle="modal" data-target="#modal-1"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Agregar Control Prenatal</button><br><br>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<ul id="lista" class="nav nav-pills nav-justified nav-tabs">
			  <li ><a href="<?php echo URL;?>ExpedienteMedico/Diagnostico/mostrarDia/<?php echo $_SESSION['cedula']."-".$_SESSION['nombre']."-".$_SESSION['sexo'];?>">Diagnósticos</a></li>
			  <li><a href="<?php echo URL;?>ExpedienteMedico/Patologia/mostrarDia">Patologías</a></li>
			  <li><a href="<?php echo URL;?>ExpedienteMedico/Tratamiento/mostrarDia">Tratamientos</a></li>
			  <li><a href="<?php echo URL;?>ExpedienteMedico/Examen/mostrarDia">Exámenes</a></li>
			  <li><a href="<?php echo URL;?>ExpedienteMedico/Hospitalizacion/mostrarObsHospi">Hospitalizaciones</a></li>
			  <li class="active"><a href="#">Control Prenatal</a></li>
			</ul>
		</div>
</div><br><br>
<div class="container-fluid">
   	<table cellspacing="0" width="100%" id="example" class="table table-striped table-hover table-responsive table-bordered">
       	<thead>
        	<tr>
				<th>Fecha</th>
				<th>Edad gestional</th>
				<th>Peso</th>
				<th>P.Arterial</th>
				<th>Altura uterina</th>
				<th>Presentación</th>
				<th>FCF</th>
				<th>Mov. Fetales</th>
				<th>Modificar</th>
				<th>Eliminar</th>
        	</tr>
        </thead>
        <tbody>
        <?php foreach($this->contEsta as $elementos){ ?>
			<tr>
				<td hidden="hidden"><?php echo $elementos['EMD13IDESC']; ?></td>
				<td><?php echo $elementos['EMD13FECHESC']; ?></td>
				<td><?php echo $elementos['EMD13EDADGESESC']; ?></td>
				<td><?php echo $elementos['EMD13PESOESC']; ?></td>
				<td><?php echo $elementos['EMD13PARTEEC']; ?></td>
				<td><?php echo $elementos['EMD13ALTUTESC']; ?></td>
				<td><?php echo $elementos['EMD13PRECENTESC']; ?></td>
				<td><?php echo $elementos['EMD13FCF']; ?></td>
				<td><?php echo $elementos['EMD13MOVFETESC']; ?></td>
				<td hidden="hidden"><?php echo $elementos['EMD07DGN_EMD07IDDGN']; ?></td>
				<td align="center">
					<button class="btn btn-warning" id="btnModi" type="button" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-2">&nbsp;Modificar</button>
				</td>
				<td align="center"> 
					<button class="btn btn-danger" id="btnModi" type="button" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-4"> <span class="glyphicon glyphicon-trash-align-center"></span>Eliminar</button>
				</td>
			</tr>
		<?php } ?>
        </tbody>
    </table>
</div>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			 	<button type="button" class="close" data-dismiss="modal">&times;</button>
			 	<h3 class="modal-title">Agregar Control Prenatal</h3>
			</div>
			<div class="modal-body ">	
				<form class="form-group row" name="ControlEstadistico"  action="<?php echo URL;?>ExpedienteMedico/ControlEstadistico/AgregarControl" method="POST">
					<input style="display: none;" type="date" value="<?php echo $fecha;?>" name="fecha" id="fecha">
					<input type="text" style="display: none;" id="idDiagnostico" name="idDiagnostico" value="<?php echo $_SESSION['idLastDgn'];?>">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Presión arterial: </label>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<input type="text" class="form-control" name="P_Arterial" id="P_Arterial" placeholder="Presión Arterial" required maxlength="50">
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">FCF: </label>
							<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
								<input type="text" class="form-control" name="FCF" id="FCF" placeholder="FCF" required maxlength="45">
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
						<br><div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Edad gestacional: </label>
							<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
								<input type="text" class="form-control" name="edGest" id="edGest" placeholder="Edad Gestional" required maxlength="45">
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Altura uterina: </label>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<input type="text" class="form-control" name="altUt" id="altUt" placeholder="Altura Uterina" required maxlength="45">
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<br><div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Movimientos fetales: </label>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<input type="text" class="form-control" name="movFetal" id="movFetal" placeholder="Movimientos fetales" required maxlength="45">
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Peso: </label>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<input type="text" class="form-control" name="peso" id="peso" placeholder="Peso" required maxlength="45">
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
						<br><div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Presentación: </label>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<input type="text" class="form-control" name="precentacion" id="precentacion" placeholder="Presentación" required maxlength="45">
							</div>
						</div>						
					</div><br><br><br><br>
					<div class="modal-footer" >
						<div class="col-xs-2"></div>
						<a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
						<button id="enviar" name="enviar" type="submit" class="btn btn-success">Agregar</button>
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
			 	<h3 class="modal-title">Modificar Control Prenatal</h3>
			</div>
			<div class="modal-body ">
				<form class="form-group row" name="ControlEstadistico"  action="<?php echo URL;?>ExpedienteMedico/ControlEstadistico/ModificarControlEstadistico" method="POST">
					<input type="text"  name="ID1" id="ID1" placeholder="ID" class="form-control" value="" style="display: none;">
					<input type="date" style="display: none;" name="fecha1" id="fecha1" value="<?php echo $fecha;?>">
					<input type="text" style="display: none;"  name="idDiagnostico1" id="idDiagnostico1" placeholder="ID Diagnostico" class="form-control" value="">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Presión arterial: </label>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<input type="text" class="form-control" name="P_Arterial1" id="P_Arterial1" placeholder="Presión Arterial" required maxlength="50">
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">FCF: </label>
							<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
								<input type="text" class="form-control" name="FCF1" id="FCF1" placeholder="FCF" required maxlength="45">
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
						<br><div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Edad gestacional: </label>
							<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
								<input type="text" class="form-control" name="edGest1" id="edGest1" placeholder="Edad Gestional" required maxlength="45">
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Altura uterina: </label>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<input type="text" class="form-control" name="altUt1" id="altUt1" placeholder="Altura Uterina" required maxlength="45">
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<br><div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Movimientos fetales: </label>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<input type="text" class="form-control" name="movFetal1" id="movFetal1" placeholder="Movimientos fetales" required maxlength="45">
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Peso: </label>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<input type="text" class="form-control" name="peso1" id="peso1" placeholder="Peso" required maxlength="45">
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
						<br><div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Presentación: </label>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<input type="text" class="form-control" name="precentacion1" id="precentacion1" placeholder="Presentación" required maxlength="45">
							</div>
						</div>						
					</div><br><br><br><br>
					<div class="modal-footer" >
						<div class="col-xs-2"></div>
						<a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
						<button id="enviar" name="enviar" type="submit" class="btn btn-warning">Modificar</button>
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
       			<h3 class="modal-title">Eliminar Control Prenatal</h3>
   			</div>
   			<div class="modal-body form">
       			<form action="<?php echo URL;?>ExpedienteMedico/ControlEstadistico/EliminarControlEstadistico" method="POST" id="form" class="form-horizontal">
        			<div class="form-body">
            			<div class="form-group">
            				<h3>&nbsp;&nbsp;Seguro que desea eliminarlo?</h3>
             		 		<div class="col-md-9">
               					<input class="form-control" type="text" value="" id="ID1" name="ID1" style="display: none;">
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
<div class="col-lg12 col-md-12 col-sm-12 col-xs-12 container-fluid" style="margin-top: 140px; position: fixed;">
	<div class="alert alert-info"></div>
	<button class="btn btn-success" onclick="window.location = '<?php echo URL;?>ExpedienteMedico/Diagnostico/mostrarDia/<?php echo $_SESSION['cedula']."-".$_SESSION['nombre']."-".$_SESSION['sexo'];?>'">Regresar</button>
	<a class="btn btn-danger" style="margin-left: 80%;" href="<?php echo URL;?>ExpedienteMedico/Diagnostico/FinalizarConsulta">Finalizar consulta</a>
</div>
<script type="text/javascript">
	$(document).on('click','#btn-cargar', function(){
		var id = $(_trEdit).find('td:eq(0)').text();
		var p=$("#cedula").val(id);
	});
</script>
<script> 
	$(document).ready(function(){
	$("#btn-cargar").trigger("onclick");
})
</script>
<script type="text/javascript">
	function seleccionarTabla() {
		var _trEdit = null;
		$(document).on('click', '#btnModi',function(){
		_trEdit = $(this).closest('tr');
		var _id = $(_trEdit).find('td:eq(0)').text();
		var _fecha = $(_trEdit).find('td:eq(1)').text();
		var _edGest = $(_trEdit).find('td:eq(2)').text();
		var _Peso = $(_trEdit).find('td:eq(3)').text();
		var _P_Arterial = $(_trEdit).find('td:eq(4)').text();
		var _altUt = $(_trEdit).find('td:eq(5)').text();
		var _precentacion = $(_trEdit).find('td:eq(6)').text();
		var _FCF = $(_trEdit).find('td:eq(7)').text();
		var _movFetal = $(_trEdit).find('td:eq(8)').text();
		var _idDiagnostico = $(_trEdit).find('td:eq(9)').text();
		
		$('input[name="ID1"]').val(_id);
		$('input[name="edGest1"]').val(_edGest);
		$('input[name="peso1"]').val(_Peso);
		$('input[name="P_Arterial1"]').val(_P_Arterial);
		$('input[name="altUt1"]').val(_altUt);
		$('input[name="precentacion1"]').val(_precentacion);
		$('input[name="FCF1"]').val(_FCF);
		$('input[name="movFetal1"]').val(_movFetal);
		$('input[name="idDiagnostico1"]').val(_idDiagnostico);
		}); 
	}
</script>	
</body>
</html>