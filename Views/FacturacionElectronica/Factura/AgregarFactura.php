<?php session_set_cookie_params(0,"/");
@session_start();
if(!isset($_SESSION['funcionario'])){
	header('location: '.URL.'Login/iniciarSesion');
}
$fecha = getdate();
$fecha = date('Y-m-d H:i:s');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EMD SYS</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/Bootstrap/bootstrap/css/bootstrap.min.css">
	<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/css/style.css">
	<link rel="shortcut icon" href="../favicon.ico" />
	<link rel="stylesheet" href="<?php echo URL;?>Public/Bootstrap/fonts/css/font-awesome.min.css">
	<script src="<?php echo URL;?>Public/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo URL;?>Public/JS/jquery-3.1.0.min.js"></script>
	<script src="<?php echo URL;?>Assets/datatables.min.js"></script>	
		
</head>
<body>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
				<a href="<?php echo URL;?>Index/indexAdm"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
			</div>
		   	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
		   		<h1 style="margin-left: 55%;">Facturación</h1>	
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div>
				   	<nav>
				        <ul class="nav navbar-nav" style="margin-left: 70%">
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
		</div>
<aside class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></aside>
<div  class="color1 col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br></div><hr>
<div class="container">
	<div class="main row">
		<div  class="col-xs col-sm-8 col-md-9 col-lg-12"><br><br><br>
		    <form id="fac" name="factura" method="post" action="<?php echo URL;?>Factura/AgregarFactura">
				<div>
					<div  class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><button   id="btn-Buscar"  type="button"  class="btn btn-primary">Buscar</button></div>
					<div  class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<input type="text"  name="idPac" id="idPac" placeholder="Paciente" 
							 class="form-control" value="<?php echo @$_SESSION['idPacFac'];?>"><br>
                        <input type="text" style="display: none;" name="id" id="id">
						<input type="text"  name="desc" id="desc" placeholder="Descripcion" class="form-control" ><br>		
					</div>
					<div  class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<input type="text"  name="nomPac" id="nomPac" placeholder="Buscar por nombre" class="form-control"><br>
						<input type="text" style="margin-left: 2%;" name="precio" id="precio" placeholder="Precio" onkeyup="ht()" class="form-control"><br>
						<input type="text" style="display: none;" name="idFun" id="idFun" 
						value="<?php echo $_SESSION['funcionario'];?>"><br><br>		
					</div>
					<div  class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<select class="form-control" name="observacion" id="observacion">
							<option value=''>Seleccione Tipo de pago</option>
							<option value='Contado'>Contado</option>
							<option value='Cortesía'>Cortesía</option>
							<option value='Tarjeta'>Tarjeta</option>
						</select><br>
						<input type="datetime" style="display: none;" name="fecha" id="fecha" value="<?php echo $fecha;?>"><br>
						 <button style="display:none;"   id="btn-cargar"  type="button">cargar</button>
					</div>
					<button  style="margin-left: 4%;" class="btn btn-warning" id="btn-update">Actualizar</button>
				</div>
				<div><br><br>
					<label style="font-size: 20px; margin-left: 2%;"><strong>Total:</strong></label>
					<label id="totals" style="font-size: 20px;"><strong>0</strong></label>
					<input  style="margin-left: 40%;" hidden  type="text" name="txttotal" id="txttotal" readonly="readonly">
					<input type="submit" style="margin-left: 30%;"  class="btn btn-success" id="guardar" value="Pagar" >
				</div>
				<span id="espaBla"></span>
				<br><br>
				<table class="table" id="factura">
					<thead>
						<tr>
							<th>Descripcion</th>
							<th>Estado</th>
							<th>Precio</th>
							<th>Fecha</th>
							<th>Accion</th>
							<th>Accion</th>
						</tr>
					</thead>
				</table>
				<div>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						 	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div><br><br><br>				
<div class ="color1 col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>						
<div class ="color2 col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div><br><br><br><br><br>
<footer class="color1">
	<div class="container-fluid">
		<div class="main row">
			<div class ="col-xs-12 col-sm-4 col-md-3 col-lg-7 ">
				<h4>@CentroMedicoNosara</h4>
			</div>
			<div class ="col-xs-12 col-sm-4 col-md-3 col-lg-5 ">
				<h4>Dirección: Ubicado en Nosara contiguo al Gollo</h4>
			</div>
		</div>
	</div>	
</footer>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal-5" role="dialog">
	<div class="modal-dialog">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        		<h3 class="modal-title col-xs-3 col-sm-3 col-md-3 col-lg-3">Pacientes: </h3>
	        		<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
	        			<input type="text" class="form-control" id="buscar" name="buscar">
	        		</div>
	        	</div>
	      	</div><br>
      		<div class="modal-body form">
        		<form>
          			<div class="form-body">
			            <table id="pacientes" class="table table-stripped">
			            	<thead>
			            		<tr>
			            			<th>Cédula</th>
			            			<th>Nombre</th>
			            			<th>Apellido 1</th>
			            			<th>Apellido 2</th>
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
<!-- End Bootstrap modal -->
<script>
$(function(){
	$(document).on("click","#guardar",function(e){
		e.preventDefault();
		var id = $("#idPac").val();   
		var nombre = $("#nomPac").val();
		var tipoPago = $("#observacion").val();
		if((id == null || id.length == 0 || /^\s+$/.test(id) || id == ' ') || 
          (nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) || nombre == ' ') || 
          (tipoPago == null || tipoPago.length == 0 || /^\s+$/.test(tipoPago) || tipoPago == ' ')){
          	alert("Debe completar todos los campos");
        }else{
        	$("#fac").submit();
        }
	});

	$(document).on('click','#btn-Buscar', function(){
		var id = $("#idPac").val();
		$.ajax({
			data: "id="+id,
			type: "POST",
			url: "<?php echo URL;?>Factura/Detalles",
			dataType: 'json',
			success: function(response){
				var tabla = $("#factura tbody").html('');
				$.each(response, function(index, record){
					$("#espaBla").hide();
					var row = $("<tr />");
					$("<td hidden='hidden' />").text(record.ID).appendTo(row);
					$("<td />").text(record.Desc).appendTo(row);
					$("<td />").text(record.Esta).appendTo(row);
					$("<td hidden='hidden' />").text(record.IdPat).appendTo(row);
					$("<td />").text(record.Costo).appendTo(row);
					$("<td />").text(record.Fecha).appendTo(row);
					$("<td><button type='button' class='btn btn-success btn-edit'>Editar </button></td>").appendTo(row);
					$("<td><input type='checkbox' class='chec' id='chec' name='chec' value='"+record.Costo+"'/></td>").appendTo(row);
					row.appendTo('table');
					$("#nomPac").val(record.Nombre);
				})	
			},
			error: function(err){
				alert("No tiene pendientes");
				console.log(err);
			}
		});
	});

	var _trEdit = null;
	$(document).on('click', '.btn-edit',function(){
		_trEdit = $(this).closest('tr');
		var _id = $(_trEdit).find('td:eq(0)').text();
		var _idPac = $(_trEdit).find('td:eq(1)').text();
		var _desc = $(_trEdit).find('td:eq(2)').text();
		var _deta = $(_trEdit).find('td:eq(3)').text();
		var precio = $(_trEdit).find('td:eq(4)').text();
		var _fecha = $(_trEdit).find('td:eq(5)').text();
		precio = precio.replace(","," ");
		precio = precio.replace(","," ");
		precio = precio.replace(/^\s+|\s+|\s+$/,"");
		precio = precio.replace(/^\s+|\s+|\s+$/,"");
		
		$('input[name="id"]').val(_id);	
		$('input[name="idPac"]').val(_deta); //precio desc observacion fecha
		$('input[name="desc"]').val(_idPac);
		$('input[name="precio"]').val(precio);
		$('input[name="fecha"]').val(_fecha);
	}); 
	
	$('#btn-update').click(function(e){
		e.preventDefault();
		var id = $('input[name="id"]').val();	
		var idPac = $('input[name="idPac"]').val(); //precio desc observacion fecha
		var desc = $('input[name="desc"]').val();
		var precio = $('input[name="precio"]').val();
		var fecha = $('input[name="fecha"]').val();

		$.ajax({
			data: {"id":id, "desc": desc, "idPac": idPac, "precio": precio, "fecha": fecha},
			type: "POST",
			url: "<?php echo URL;?>Factura/modificarDeta",
			dataType: 'json',

			success: function(response){
				var tabla = $("#factura tbody").html('');
				$.each(response, function(index, record){
					var row = $("<tr />");
					$("<td hidden='hidden' />").text(record.ID).appendTo(row);
					$("<td />").text(record.Desc).appendTo(row);
					$("<td />").text(record.Esta).appendTo(row);
					$("<td hidden='hidden' />").text(record.IdPat).appendTo(row);
					$("<td />").text(record.Costo).appendTo(row);
					$("<td />").text(record.Fecha).appendTo(row);
					$("<td><button type='button' class='btn btn-success btn-edit'>Editar </button></td>").appendTo(row);
					$("<td><input type='checkbox' id='chec' class='chec' name='chec' value="+record.Costo+"/></td>").appendTo(row);
					row.appendTo('table');
				})
				$('#desc').val(" ");
				$('#precio').val(" ");
				alert("Dato actualizado!");
				recorrerListacompras();
			},
			error: function(err){
				console.log(err);
				alert("No se pudo actulizar");
			}
		});
	});	

	$(document).on('click','.btn-delete', function(){
		if(confirm("Quiere eliminarlo?")){
			var id = $(_trEdit).find('td:eq(0)').text();
			$(this).closest('tr').remove();	
		}
		});				
	});
</script>	

<script type="text/javascript">
	 function recorrerCheckBox(){
    	var sum = 0;
    	$("input[name=chec]").each(function (index) {  
       		if($(this).is(':checked')){
          		sum += parseFloat($(this).val());
       		}
    	});
    	document.getElementById("txttotal").value = sum.toFixed(3);
		document.getElementById("totals").innerHTML = document.getElementById("txttotal").value;
    }

  	$(document).on('click','.chec', function(){
		recorrerCheckBox();	
	});	

	$(document).on('click','#factura tbody tr',function(){
		var idDet = $(this).find("td").eq(0).html();
		var idPac = $(this).find("td").eq(3).html();
		var fechaDet = $(this).find("td").eq(5).html(); 
		var fechaFact = $("#fecha").val();
		var datos = {'idDet': idDet,'idPac' : id, 'fechaDet' : fechaDet, 'fechaFact' : fechaFact};
	});

	$(document).on('change','.chec',function(){
		_trEdit = $(this).closest('tr');
		var id = $(_trEdit).find('td:eq(0)').text();
		CambiarEstado(id);
	});

	$(document).on('click','#nomPac',function(){
		$('#modal-5').modal('show');
		CargaPacientes();
	})

	function CambiarEstado(id){
		$.ajax({
				data: "idDet="+id,
				type: 'POST',
				url: '<?php echo URL;?>Factura/cambiarEstado',
				dataType: 'json',
				success: function(){
					console.log("exito");
				},
				error: function(){
					console.log("error");
				}
			});
	}

	function CargaPacientes(){
		$.ajax({
				type: 'POST',
				url: '<?php echo URL;?>Paciente/CargarPacientesFactura',
				dataType: 'json',
				success: function(response){
					var tabla = $("#pacientes tbody").html('');
				$.each(response, function(index, record){
					var row = $("<tr />");
					$("<td />").text(record.ID).appendTo(row);
					$("<td />").text(record.Nombre).appendTo(row);
					$("<td />").text(record.Ape1).appendTo(row);
					$("<td />").text(record.Ape2).appendTo(row);
					$("<td><input type='checkbox' class='che' name='che'/></td>").appendTo(row);
					row.appendTo('#pacientes');
					filtrar();
				})	
				},
				error: function(){
					console.log("error");
				}
			});
	}

	function filtrar(){
		var $rows = $('#pacientes tr');
		$('#buscar').keyup(function() {
		    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
		    
		    $rows.show().filter(function() {
		        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
		        return !~text.indexOf(val);
		    }).hide();
		});
	}

	$(document).on('click','.che',function(){
		_trEdit = $(this).closest('tr');
		var id = $(_trEdit).find('td:eq(0)').text();
		var nombre = $(_trEdit).find('td:eq(1)').text();
		var apel1 = $(_trEdit).find('td:eq(2)').text();
		var apel2 = $(_trEdit).find('td:eq(3)').text();
		$("#idPac").val(id);
		$("#nomPac").val(nombre+" "+apel1+" "+apel2);
		$.ajax({
		data: "id="+id,
		type: "POST",
		url: "<?php echo URL;?>Factura/Detalles",
		dataType: 'json',
		success: function(response){
			$('#modal-5').modal('hide');
			var tabla = $("#factura tbody").html('');
			$.each(response, function(index, record){
				var row = $("<tr />");
				$("<td hidden='hidden' />").text(record.ID).appendTo(row);
				$("<td />").text(record.Desc).appendTo(row);
				$("<td />").text(record.Esta).appendTo(row);
				$("<td hidden='hidden' />").text(record.IdPat).appendTo(row);
				$("<td />").text(record.Costo).appendTo(row);
				$("<td />").text(record.Fecha).appendTo(row);
				$("<td><button type='button' class='btn btn-success btn-edit'>Editar </button></td>").appendTo(row);
				$("<td><input type='checkbox' class='chec' id='chec' name='chec' value='"+record.Costo+"'/></td>").appendTo(row);
				row.appendTo('table');
			})	
		},
		error: function(){
			alert("No tiene pendientes");
		}
	});
	});
	$('#precio').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
	});
</script>
</body>
</html>