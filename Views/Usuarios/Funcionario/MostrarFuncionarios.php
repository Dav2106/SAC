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
<link href="<?php echo URL;?>Assets/Bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo URL;?>Assets/Bootstrap/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="<?php echo URL;?>Assets/Bootstrap/fonts/css/font-awesome.min.css">
<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo URL;?>Assets/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/JS/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/JS/validacionesFuncionario.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/datatables.min.js"></script>
<script src="<?php echo URL;?>Assets/JS/VerificacionPasswords.js"></script>
</head>
<body>
    <div class="container-fluid">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
        <a href="<?php echo URL;?>Index/indexAdm"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
      </div>
      <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
        <h2 class="form-signin-heading" style="margin-left: 55%;">Funcionarios</h2>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
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
      <hr />
     </div>
        <br /> 
        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-1"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Agregar Funcionario</button>
        <hr />    
        <div class="container-fluid">
        <table cellspacing="0" width="100%" id="example" class="table table-bordered table-striped table-hover table-responsive">
        <thead>
        <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Primer apellido</th>
        <th>Segundo apellido</th>
        <th style="display: none;">DIRECCION</th>
        <th style="display: none;">FECHA</th>
        <th style="display: none;">CORREO</th>
        <th>Cargo</th>
        <th>Crear cuenta</th>
        <th>Modificar</th>
        <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->funcionarios as $elementos){ ?>
    			<tr>
      			<td><?php echo $elementos['EMD02IDFUN']; ?></td>
      			<td><?php echo $elementos['EMD02NOMBFUN']; ?></td>
      			<td><?php echo $elementos['EMD02APE1FUN']; ?></td>
      			<td><?php echo $elementos['EMD02APE2FUN']; ?></td>
      			<td style="display: none;"><?php echo $elementos['EMD02DIREFUN']; ?></td>
            <td style="display: none;"><?php echo $elementos['EMD02FENAFUN']; ?></td>
            <td style="display: none;"><?php echo $elementos['EMD02CORRFUN']; ?></td>
            <td><?php echo $elementos['EMD02CARGFUN']; ?></td>
            <td align="center">
            <a id="buscar" onclick="seleccTablaCuenta()" data-toggle="modal" data-target="#modal-5" class="edit-link" title="Edit">
                  <img src="../Imagenes/edit.png" width="20px" />
                  </a></td>
      			<td align="center">
            <button class="btn btn-warning" id="buscar" type="button" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-2">  &nbsp;Modificar</button></td>
      			<td align="center">
            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-4" id="buscar" onclick="seleccionarTabla()"> Eliminar</button></td>
    			</tr>
			  <?php } ?>
      </tbody>
    </table>
  </div>
</div>
    <br />
    <div class="container-fluid">
        <div class="alert alert-info">
        </div>
    </div>
    <div class="container-fluid">
      <button class="btn btn-success" onclick="window.location = '<?php echo URL;?>Index/indexAdm';">Regresar</button>
    </div>
                    <!-- Bootstrap modal -->
<div class="modal fade" id="modal-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Funcionario</h3>
        </div>             
        <div class="modal-body ">
          <form class="form-group row" action="<?php echo URL;?>Funcionario/AgregarFuncionario" method="POST" onsubmit="return CamposVaciosA()">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group row">
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Cédula:</label> 
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="text" value="" id="id" name="id" required maxlength="45">             
                  </div>
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Nombre:</label> 
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="text" value="" id="nombre" name="nombre" required maxlength="45">  
                  </div>
                </div>
                <div class="form-group row">
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Primer Apellido:</label>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="text" value="" id="apellido1" name="apellido1" required maxlength="45">
                  </div>
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Segundo Apellido:</label>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="text" value="" id="apellido2" name="apellido2" required maxlength="45">
                  </div>   
                </div>
                <div class="form-group row">
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Cargo:</label>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <select class="form-control" id="cargo" name="cargo">
                      <option value=0>Seleccione</option>
                      <option value="Doctor">Doctor</option>
                      <option value="Administrador">Administrador</option>
                      <option value="Recepcionista">Recepcionista</option>
                    </select>
                  </div>
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Dirección:</label> 
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="text" value="" id="direccion" name="direccion" required maxlength="45">
                  </div> 
                </div> 
                <div class="form-group row">
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Fecha Nacimiento:</label> 
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="date" value="" id="fena" name="fena" required maxlength="45">          
                  </div>
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Correo:</label> 
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="text" value="" id="correo" name="correo" required maxlength="45">      
                  </div>   
               </div><br><br><br>
               <div class="modal-footer">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
                <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                <button id="enviar" name="enviar" type="submit" class="btn btn-success">Agregar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div><!--fin modal -->

<div class="modal fade" id="modal-2" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Modificar Funcionario</h3>
        </div>             
        <div class="modal-body ">
          <form class="form-group row" action="<?php echo URL;?>Funcionario/ModificarFuncionario" method="POST">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group row">
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Cédula:</label> 
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="text" value="" id="id1" name="id1" required maxlength="45">        
                  </div>
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Nombre:</label> 
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="text" value="" id="nombre1" name="nombre1" required maxlength="45">  
                  </div>
                </div>
                <div class="form-group row">
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Primer Apellido:</label>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="text" value="" id="apellido11" name="apellido11" required maxlength="45">
                  </div>
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Segundo Apellido:</label>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="text" value="" id="apellido21" name="apellido21" required maxlength="45">
                  </div>   
                </div>
                <div class="form-group row">
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Cargo:</label>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <select class="form-control" id="cargo1" name="cargo1">
                      <option value=0>Seleccione</option>
                      <option value="Doctor">Doctor</option>
                      <option value="Administrador">Administrador</option>
                      <option value="Recepcionista">Recepcionista</option>
                    </select>
                  </div>
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Dirección:</label> 
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="text" value="" id="direccion1" name="direccion1" required maxlength="45">
                  </div> 
                </div> 
                <div class="form-group row">
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Fecha Nacimiento:</label> 
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="date" value="" id="fena1" name="fena1" required maxlength="45">
                  </div>
                  <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Correo:</label> 
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" type="text" value="" id="correo1" name="correo1" required maxlength="45">      
                  </div>   
               </div><br><br><br>
               <div class="modal-footer">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
                <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                <button id="enviar" name="enviar" type="submit" class="btn btn-warning">Modificar</button>
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
        <h3 class="modal-title">Eliminar Funcionario</h3>
      </div>
      <div class="modal-body form">
         <form class="form-group row" name="Funcionario" action="<?php echo URL;?>Funcionario/EliminarFuncionario" method="POST">
          <div class="form-body">
            <div class="form-group">
              <h3>&nbsp;&nbsp;Seguro que desea eliminarlo?</h3>
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <input class="form-control" type="text" value="" id="id1" name="id1" style="display: none;">
              </div>
            </div>
          </div>
          </div>
          <div class="modal-footer">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
              <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
              <button id="enviar" name="enviar" type="submit" class="btn btn-danger">Eliminar</button>
          </div>
       </form>       
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  <div class="modal fade" id="modal-5" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Crear Cuenta</h3>
      </div>
      <div class="modal-body form">
         <form class="form-horizontal" role="form" method="POST" action="<?php echo URL;?>Login/AgregarCuenta" id="formCrearCuenta">
 <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Cédula:</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
      <input type="text" class="form-control" value="" name="id" id="id" placeholder="Cédula" required>
    </div>
  </div>
  <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Usuario:</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
      <input type="text" class="form-control" name="Usuario" id="Usuario" placeholder="Usuario" required><span id="verU"></span>
    </div>
  </div>
  <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Contraseña</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
      <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" required><span id="verC"></span>
    </div>
  </div>
  <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Verificar Contraseña</label>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
      <input type="password" class="form-control" id="veriContraseña" name="veriContraseña" placeholder="Confirmar Contraseña" required>
      <span id="veriC"></span>
        <br>
    </div>    
    </div>
    <div class="modal-footer" >
      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
      <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
      <button id="btnCrear" name="btnCrear" type="submit" class="btn btn-success">Crear</button>
    </div>
    </form>       
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  <!-- End Bootstrap modal -->

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#example').DataTable();

  $(document).on("focus", "#veriContraseña", function(){
    $("#veriC").text(" ");
  });

  $(document).on("focus", "#contraseña", function(){
    $("#verC").text(" ");
  });

  $(document).on("focus", "#Usuario", function(){
    $("#verU").text(" ");
  });

  $(document).on("click","#btnCrear",function(e){
    e.preventDefault();
    var pass = $("#contraseña").val();
    var confPass = $("#veriContraseña").val();
    if($("#Usuario").val() == " " || $("#Usuario").val() == null || $("#Usuario").val() == undefined || /^\s+$/.test($("#Usuario").val()) || $("#Usuario").val().length == 0){
      $("#verU").text("Requerido");
      return false;
    }

    if(pass == " " || pass == null || pass == undefined || /^\s+$/.test(pass) || pass.length == 0){
      $("#verC").text("Requerido");
      return false;
    }

    if(confPass == " " || confPass == null || confPass == undefined || /^\s+$/.test(confPass) || confPass.length == 0){
      $("#veriC").text("Requerido");
      return false;
    }

    if(confPass != pass){
      $("#veriC").text("Las contraseñas no coinciden");
    }else{
      $("#formCrearCuenta").submit();
    }
  });
});
</script>
<script type="text/javascript">
  function seleccionarTabla() {
  var _trEdit = null;
  $(document).on('click', '#buscar',function(){
    _trEdit = $(this).closest('tr');
    var _id = $(_trEdit).find('td:eq(0)').text();
    var _nombre = $(_trEdit).find('td:eq(1)').text();
    var _apellido1 = $(_trEdit).find('td:eq(2)').text();
    var _apellido2 = $(_trEdit).find('td:eq(3)').text();
    var _direccion = $(_trEdit).find('td:eq(4)').text();
    var _fena = $(_trEdit).find('td:eq(5)').text();
    var _email = $(_trEdit).find('td:eq(6)').text();
    var _cargo = $(_trEdit).find('td:eq(7)').text();

    
    $('input[name="id1"]').val(_id);
    $('input[name="nombre1"]').val(_nombre);
    $('input[name="apellido11"]').val(_apellido1);
    $('input[name="apellido21"]').val(_apellido2);
    $('input[name="direccion1"]').val(_direccion);
    $('input[name="fena1"]').val(_fena);
    $('input[name="correo1"]').val(_email);
    $('select[name="cargo1"]').val(_cargo);
  }); 
}

function seleccTablaCuenta() {
  var _trEdit = null;
  $(document).on('click', '#buscar',function(){
    _trEdit = $(this).closest('tr');
    var _id = $(_trEdit).find('td:eq(0)').text();

    $('input[name="id"]').val(_id);
  }); 
}
</script>
</body>
</html>