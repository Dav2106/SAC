<?php session_set_cookie_params(0,"/");
	session_start();
	if(!isset($_SESSION['funcionario'])){
		header('location: '.URL.'Login/iniciarSesion');
	}
?>
<!DOCTYPE>
<html xmlns="">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EMD SYSTEM</title>
<link rel="shortcut icon" href="../favicon.ico" />
<link href="<?php echo URL;?>Public/Bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo URL;?>Public/Bootstrap/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link href="<?php echo URL;?>Public/CSS/footer.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="<?php echo URL;?>Public/Bootstrap/fonts/css/font-awesome.min.css">
<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo URL;?>Public/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Public/JS/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Public/JS/validacionesPaciente.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/datatables.min.js"></script>
</head>
<body>
	<div class="container-fluid">
	   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	   <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
	   		<a href="<?php echo URL;?>Index/indexDoc"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
	   	</div>	
	   <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
	   		<h2 class="form-signin-heading" style="margin-left: 55%;">Lista de espera</h2>
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
	   	<hr>
	   </div>
     <hr />
	</div><hr><br><br><br>
	<div class="container-fluid col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table cellspacing="0" width="100%" id="example" class="table table-bordered table-striped table-hover table-responsive">
        <thead>
        <tr>
        <th>Cédula</th>
        <th>Nombre</th>
        <th>Primer apellido</th>
        <th>Segundo apellido</th>
        <th>Sexo</th>
        <th>Fecha</th>
        <th>Triage</th>
        <th>Observaciones</th>
        <th>Diagnosticar</th>
        </tr>
        </thead>
        </table>
        </div>
	</div>   
	<div class="container-fluid col-lg-12 col-md-12 col-sm-12 col-xs-12" id="footer">
		<br><div class="alert alert-info"></div>
		<button class="btn btn-success" onclick="window.location = '<?php echo URL;?>Index/indexDoc';">Regresar</button>
	</div>
	<script type="text/javascript">
		$(function(){
			listar();
		});
		var listar = function(){
			var table = $("#example").DataTable({
				"ajax":{
					"method": "POST",
					"url": "<?php echo URL;?>Agenda/mostrarListaEspera",
					"error": function(err){
						console.log(err);
					}
				},
				"columns":[
					{"data": "emd01pac_EMD01IDPAC"},
					{"data": "EMD01NOMBPAC"},
					{"data": "EMD01APE1PAC"},
					{"data": "EMD01APE2PAC"},
					{"data": "EMD01SEXOPAC"},
					{"data": "EMD03FECHCIT"},
					{"data": "EMD03TRIACIT"},
					{"data": "EMD03OBSECIT"},
					{
		               data: null,
		               className: "center",
		               defaultContent: '<a href="javascript:void(0)" id="btnModi" onclick="selec()"><img src="../Imagenes/edit.png" width="20px" />'
		            }
				]
			});

			setInterval(function () {
		    table.ajax.reload(null, false);
			}, 10000);
		}

		function selec(){
			var _trEdit = null;
			$(document).on('click', '#btnModi',function(){
				_trEdit = $(this).closest('tr');
				var id = $(_trEdit).find('td:eq(0)').text();
				var nombre = $(_trEdit).find('td:eq(1)').text();
				var sexo = $(_trEdit).find('td:eq(4)').text();
				
				window.location = '<?php echo URL;?>Diagnostico/mostrarDia/'+id+"-"+nombre+"-"+sexo;
			});
		}
	</script>
</body>
</html>
