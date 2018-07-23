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
	   <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
	   		<h2 class="form-signin-heading">Enfermedades</h2>
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
	   	 <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
	   		<a href="<?php echo URL;?>Usuarios/Index/indexDoc"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
	   	</div>	
	   	<hr>
	   </div>
        <button class="btn btn-success" type="button" id="" data-toggle="modal" data-target="#modal-1"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Agregar Enfermedad</button>
        
        <hr />
        <div class="container">
        <table cellspacing="0" width="100%" id="example" class="table table-bordered table-striped table-hover table-responsive">
        <thead>
        <tr>
        <th>Id</th>
        <th>Tipo</th>
        <th>Nombre</th>
        <th>Id patología</th>
        <th>Modificar</th>
        <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->enfermedad as $elementos){ ?>
			<tr>
			<td><?php echo $elementos['EMD06IDENF']; ?></td>
			<td><?php echo $elementos['EMD06TIPOENF']; ?></td>
			<td><?php echo $elementos['EMD06NOMBENF']; ?></td>
           	<td><?php echo $elementos['EMD05PAT_EMD05IDPAT']; ?></td>
            <!-- editar -->
			 <td align="center">
			 <button class="btn btn-warning" id="btnModi" type="button" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-2"> &nbsp;Modificar</button></td>

			<td align="center"> 
			<button class="btn btn-danger" id="btnModi" type="button" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-4"> <span class="glyphicon glyphicon-trash-align-center"></span>Eliminar</button></td>
			</tr>
			<?php } ?>
        </table>
       </div>
    </div>
    <br />
    <div class="container">
        <div class="alert alert-info"></div>
    </div>

      <!-- Bootstrap modal -->
<div class="container">
	<div class="modal fade" id="modal-1" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
	            <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Agregar enfermedad</h3>
				</div>
				 <div class="modal-body ">			
					<form class="form-group row" name="Enfermedad" action="<?php echo URL;?>ExpedienteMedico/Enfermedad/AgregarEnfermedad" method="POST" onsubmit="return CamposVaciosA()">
						<div class="container">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group row">
								  <label for="example-text-input" class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-form-label">Tipo:</label> 
								  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								    <select class="form-control" id="tipoEnfermedad" name="tipoEnfermedad">
								    	<option value=''>Seleccione</option>
								    	<option value="Congenita">Congénita</option>
									  	<option value="Hereditaria">Hereditaria</option>
									  	<option value="Autoinmune">Autoinmune</option>
									  	<option value="Neurodegenerativa">Neurodegenerativa</option>
									  	<option value="Mental">Mental</option>	
									  	<option value="Metabolica">Metabólica</option>		
								    </select>			    
								  </div>
								  <label for="example-text-input" class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-form-label">Nombre:</label> 
								  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								    <input class="form-control" type="text" value="" id="nombre" name="nombre" required maxlength="45">   
								  </div>    
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group row"> 
									<label for="example-text-input" class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-form-label">ID Patología:</label> 
								  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								    <input class="form-control" type="text" value="" id="IDPatologia" name="IDPatologia">			    
								  </div>
								</div>
							</div><br><br>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
					            <div class="modal-footer">
					              <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
					              <button id="enviar" name="enviar" type="submit" class="btn btn-success">Agregar</button>
					            </div>
					        </div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div><!--fin modal -->

      <!-- Bootstrap modal -->
<div class="container">
	<div class="modal fade" id="modal-2" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
	            <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Modificar enfermedad</h3>
				</div>
				 <div class="modal-body ">			
					<form class="form-group row" name="Enfermedad" action="<?php echo URL;?>ExpedienteMedico/Enfermedad/ModificarEnfermedad" method="POST">
						<div class="container">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group row">
									<input type="text" name="id" id="id" style="display: none;">
								  	<label for="example-text-input" class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-form-label">Tipo:</label> 
								  	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
									    <select class="form-control" id="tipoEnfermedad" name="tipoEnfermedad">
									    	<option value=''>Seleccione</option>
									    	<option value="Congenita">Congénita</option>
										  	<option value="Hereditaria">Hereditaria</option>
										  	<option value="Autoinmune">Autoinmune</option>
										  	<option value="Neurodegenerativa">Neurodegenerativa</option>
										  	<option value="Mental">Mental</option>	
										  	<option value="Metabolica">Metabólica</option>		
									    </select>			    
								  	</div>
								  	<label for="example-text-input" class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-form-label">Nombre:</label> 
								  	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								    	<input class="form-control" type="text" value="" id="nombre" name="nombre" required maxlength="45">   
								  	</div>    
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group row"> 
									<label for="example-text-input" class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-form-label">ID Patología:</label> 
								  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								    <input class="form-control" type="text" value="" id="IDPatologia" name="IDPatologia">			    
								  </div>
								</div>
							</div><br><br>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
					            <div class="modal-footer">
					              <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
					              <button id="enviar" name="enviar" type="submit" class="btn btn-warning">Modificar</button>
					            </div>
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
	        	<h3 class="modal-title">Eliminar Enfermedad</h3>
	      	</div>
      		<div class="modal-body form">
        		<form class="form-group row" name="Enfermedad" action="<?php echo URL;?>ExpedienteMedico/Enfermedad/EliminarEnfermedad" method="POST">
          			<div class="form-body">
			            <div class="form-group">
			              <label class="control-label col-md-3">ID Enfermedad</label>
			              <div class="col-md-9">
			                <input class="form-control" type="text" value="" id="id" name="id">
			              </div>
			            </div>
          			</div><br><br>
			        <div class="modal-footer" >
						<div class="col-xs-5"></div>
						<a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
						<button id="enviar" name="enviar" type="submit" class="btn btn-danger">Eliminar </button>
					</div>
        		</form>
        	</div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<div class="container">
	<button class="btn btn-success" onclick="window.location = '<?php echo URL;?>ExpedienteMedico/Paciente/mostrar' ">Regresar</button>
</div>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#example').DataTable();
});
</script>
<script type="text/javascript">
	function seleccionarTabla() {
	var _trEdit = null;
	$(document).on('click', '#btnModi',function(){
		_trEdit = $(this).closest('tr');
		var _id = $(_trEdit).find('td:eq(0)').text();
		var _tipo = $(_trEdit).find('td:eq(1)').text();
		var _nombre = $(_trEdit).find('td:eq(2)').text();
		var _IDPatologia = $(_trEdit).find('td:eq(3)').text();

		$('input[name="id"]').val(_id);
		$('select[name="tipoEnfermedad"]').val(_tipo);
		$('input[name="nombre"]').val(_nombre);
		$('input[name="IDPatologia"]').val(_IDPatologia);
	}); 
}
</script>
</body>
</html>