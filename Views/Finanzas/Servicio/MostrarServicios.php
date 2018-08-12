<?php session_set_cookie_params(0,"/"); 
	session_start();
	if(!isset($_SESSION['funcionario'])){
		header('location: '.URL.'Usuarios/Login/iniciarSesion');
	}
?>
<!DOCTYPE>
<html xmlns="">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EMD SYSTEM</title>
<link rel="shortcut icon" href="../favicon.ico" />
<link href="<?php echo URL;?>Assets/CSS/Bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo URL;?>Assets/Bootstrap/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="<?php echo URL;?>Assets/Bootstrap/fonts/css/font-awesome.min.css">
<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo URL;?>Assets/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/JS/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/JS/validacionesServicio.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/datatables.min.js"></script>
</head>
<body>
	<div class="container-fluid">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
	   		<a href="<?php echo URL;?>Usuarios/Index/indexAdm"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
	   	</div>
	   	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
	   		<h2 class="form-signin-heading" style="margin-left: 55%;">Servicios</h2>
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
       <!--<button class="btn btn-success" type="button"  data-toggle="modal" data-target="#modal-1"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Agregar Servicio</button>-->
        <hr /><br><br><br><br><hr>
        <div class="container-fluid">
        <br><br>
        <table cellspacing="0" width="100%" id="example" class="table table-bordered table-striped table-hover table-responsive">
        <thead>
        <tr>
        <th>Descripción</th>
        <th>Costo</th>
        <th>Modificar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->servicios as $elementos){ ?>
			<tr>
				<td hidden="hidden"><?php echo $elementos['EMD15IDSRV']; ?></td>
				<td><?php echo $elementos['EMD15DESCSRV']; ?></td>
				<td><?php echo number_format($elementos['EMD15COSTSRV']); ?></td>
				<td align="center">
				 <button class="btn btn-warning" id="btnModi" type="button" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-2">&nbsp;Modificar</button></td>
			</tr>
		<?php } ?>
        </tbody>
        </table>
        </div>
    </div>
    <br><br><br><br><br><br>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		    <div class="modal-header">
			 	<button type="button" class="close" data-dismiss="modal">&times;</button>
			 	<h3 class="modal-title">Agregar Servicio</h3>
			</div>
			<div class="modal-body ">
				<form class="form-group row" method="Post" action="<?php echo URL;?>Finanzas/Servicio/AgregarServicio" onsubmit="return CamposVaciosA()">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group row" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Descripción:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								<input class="form-control" type="text" value="" id="direccion" name="direccion">
							</div>
						</div>
						<div class="form-group row">
						  	<label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Costo:</label>
						  	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						  		<input class="form-control" type="text" value="" id="Costo" name="Costo">
						 	 </div>
	   					</div>
 					  	<div class="form-group row"></div>
					 	<div class="modal-footer" >
					  		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
					 		<a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
					 	 	<input id="enviar" name="enviar" type="submit" value="Agregar" class="btn btn-success">
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
			 	<h3 class="modal-title">Modificar Servicio</h3>
			</div>
			<div class="modal-body ">
				<form class="form-group row" method="Post" action="<?php echo URL;?>Finanzas/Servicio/ModificarServicio">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group row" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<input type="text" name="id1" id="id1" hidden="hidden">
							<label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Descripción:</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								<input class="form-control" type="text" value="" id="direccion1" name="direccion1" readonly="readonly">
							</div>
						</div>
						<div class="form-group row">
						  	<label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Costo:</label>
						  	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						  		<input class="form-control" type="text" value="" id="Costo1" name="Costo1">
						 	 </div>
	   					</div>
 					  	<div class="form-group row"></div>
					 	<div class="modal-footer" >
					  		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
					 		<a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
					 	 	<input id="enviar" name="enviar" type="submit" value="Modificar" class="btn btn-warning">
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
        		<h3 class="modal-title">Eliminar Servicio</h3>
      		</div>
      		<div class="modal-body form">
       			<form class="form-group row" name="Servicios" action="<?php echo URL;?>Finanzas/Servicio/EliminarServicio" method="POST">
          			<div class="form-body">
			            <div class="form-group">
			              <label class="control-label col-md-3">ID Servicio</label>
			              <div class="col-md-9">
			                <input class="form-control" type="text" value="" id="id1" name="id1">
			              </div>
			            </div>
          			</div><br><br>
           			<div class="modal-footer" >
					  <div class="col-xs-5"></div>
					 	<a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
					 	 <button id="enviar" name="enviar" type="submit" class="btn btn-danger">Eliminar</button>
					</div>
       			 </form>
          	</div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<div class="container-fluid">
	<div class="alert alert-info"></div>
    <button class="btn btn-success" onclick="window.location = '<?php echo URL;?>Usuarios/Index/indexAdm'">Regresar</button>
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
			var _descripcion = $(_trEdit).find('td:eq(1)').text();
			var _serv = $(_trEdit).find('td:eq(2)').text(); 
			_serv = _serv.replace(","," ");
			_serv = _serv.replace(","," ");
			_serv = _serv.replace(/^\s+|\s+|\s+$/,"");
			_serv = _serv.replace(/^\s+|\s+|\s+$/,"");

			$('input[name="id1"]').val(_id);
			$('input[name="direccion1"]').val(_descripcion);
			$('input[name="Costo1"]').val(_serv);
		}); 
	}

	$('#Costo1').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
	});
</script>
</body>
</html>