<?php session_set_cookie_params(0,"/");
@session_start();
if(!isset($_SESSION['funcionario'])){
  header('location: '.URL.'Usuarios/Login/iniciarSesion');
}
$fecha = getdate();
$fecha = date('Y-m-d H:i:s');
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
<link rel="stylesheet" href="<?php echo URL;?>Public/Bootstrap/fonts/css/font-awesome.min.css">
<link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo URL;?>Public/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Public/JS/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Assets/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>Public/JS/validacionesExamen.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   $('#example').DataTable();
});
</script>
</head>
<body>
  <div class="container-fluid">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
        <a href="<?php echo URL;?>ExpedienteMedico/Diagnostico/FinalizarConsulta"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
      </div>
      <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
        <h2 class="form-signin-heading" style="margin-left: 60%;">Exámenes</h2>
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
  <div>
  <h4 style="margin-left: 85%;">Paciente: <?php echo $_SESSION['cedula'];?></h4><h4 style="margin-left: 85%;">Nombre: <?php echo $_SESSION['nombre'];?></h4><h4 style="margin-left: 85%;">Diagnóstico: <?php echo $_SESSION['lastDgn'];?></h4>
  </div>
  <button id="agreExa" class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-1"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Agregar Examen</button><br><br>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <ul id="lista" class="nav nav-pills nav-justified nav-tabs">
        <li><a href="<?php echo URL;?>ExpedienteMedico/Diagnostico/mostrarDia/<?php echo $_SESSION['cedula']."-".$_SESSION['nombre']."-".$_SESSION['sexo'];?>">Diagnósticos</a></li>
         <li><a href="<?php echo URL;?>ExpedienteMedico/Patologia/mostrarDia">Patologías</a></li>
        <li><a href="<?php echo URL;?>ExpedienteMedico/Tratamiento/mostrarDia">Tratamientos</a></li>
        <li class="active"><a href="#">Exámenes</a></li>
        <li><a href="<?php echo URL;?>ExpedienteMedico/Hospitalizacion/mostrarObsHospi">Hospitalizaciones</a></li>
        <li><a href="<?php echo URL;?>ExpedienteMedico/ControlEstadistico/mostrar">Control Prenatal</a></li>
      </ul>
    </div>
  <hr /><br><br>    
  <div class="container-fluid">
    <table cellspacing="0" width="100%" id="example" class="table table-bordered table-striped table-hover table-responsive">
      <thead>
        <tr>
          <th style="display: none;">ID</th>
          <th>Descripción</th>
          <th>Resultado</th>
          <th>Fecha</th>
          <th style="display: none;">DIAGNÓSTICO</th>
          <th>Tipo</th>
          <th>Modificar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach($this->examenes as $elementos){ ?>
			  <tr>
          <td style="display: none;"><?php echo $elementos['EMD10IDEXM']; ?></td>
    			<td><?php echo $elementos['EMD10DESCEXM']; ?></td>
    			<td><?php echo $elementos['EMD10RESUEXM']; ?></td>
    			<td><?php echo $elementos['EMD10FECHEXM']; ?></td>
          <td style="display: none;"><?php echo $elementos['EMD07DGN_EMD07IDDGN']; ?></td>
          <td><?php echo $elementos['EMD10TIPOEXM']; ?></td>
    			<td align="center">
          <button class="btn btn-warning" id="buscar" type="button" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-2">  &nbsp;Modificar</button></td>
    			<td align="center"> <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-4" id="buscar" onclick="seleccionarTabla()">Eliminar</button></td>
			 </tr>
			<?php } ?>
      </tbody>
    </table>
  </div>
  </div><br />
  <div class="container-fluid">
    <div class="alert alert-info" style="margin-top: 125px;"></div>
  </div>
                
 <!-- Bootstrap modal -->
<div class="modal fade" id="modal-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Agregar Examen</h3>
      </div>
      <div class="modal-body ">
        <form class="form-group row" action="<?php echo URL;?>ExpedienteMedico/Examen/AgregarExamen" method="POST" onsubmit="return CamposVaciosA()">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group row">
                <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Descripción:</label> 
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <textarea class="form-control" cols="12" rows="2" value="" id="descripcion" name="descripcion" required maxlength="300"></textarea>          
                </div>
                <label for="example-text-input" class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-form-label">Tipo:</label> 
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <select id="tipoex" name="tipoex" class="form-control">
                    <option value=0>Seleccione</option>
                    <option value="Laboratorio">Laboratorio</option>
                    <option value="Fisico">Físico</option>
                  </select>
                </div>
              </div>  
            </div><br>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group row">
                  <input style="display: none;" type="text" value="<?php echo $_SESSION['idLastDgn'];?>" id="idDiag" name="idDiag"> 
                <input style="display: none;" type="datetime" value="<?php echo $fecha?>" id="fecha" name="fecha"> 
              </div>
            </div><br><br><br>
            <div class="modal-footer" >
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

 <!-- Bootstrap modal -->
<div class="modal fade" id="modal-2" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Modificar Examen</h3>
      </div>
      <div class="modal-body ">
        <form class="form-group row" action="<?php echo URL;?>ExpedienteMedico/Examen/ModificarExamen" method="POST">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group row">
                <input type="text" name="idExamen1" id="idExamen1" style="display: none;">
                <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Descripción:</label> 
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <textarea class="form-control" cols="12" rows="2" value="" id="descripcion1" name="descripcion1" required maxlength="300"></textarea>          
                </div>
                <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Resultado:</label> 
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <textarea class="form-control" cols="12" rows="2" value="" id="resultado1" name="resultado1"></textarea>
                </div>
              </div>
            </div><br>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group row">
                <br> 
                <input type="hidden" value="" id="idDiag1" name="idDiag1">
                <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Tipo:</label> 
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <select id="tipoex1" name="tipoex1" class="form-control">
                    <option value=0>Seleccione</option>
                    <option value="Laboratorio">Laboratorio</option>
                    <option value="Fisico">Físico</option>
                  </select>
                </div>
                <input style="display: none;" type="datetime" value="<?php echo $fecha;?>" id="fecha1" name="fecha1">  
              </div>
            </div><br><br><br>
            <div class="modal-footer" >
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
        <h3 class="modal-title">Eliminar Examen</h3>
      </div>
        <div class="modal-body">
          <form name="EliExamen" action="<?php echo URL;?>ExpedienteMedico/Examen/EliminarExamen" method="POST">
            <div class="form-body">
              <div class="form-group">
                <h3>Seguro que desea eliminarlo?</h3>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                  <input class="form-control" type="text" value="" id="idExamen1" name="idExamen1" style="display: none;">
                </div>
              </div>
            </div><br><br>
            <div class="modal-footer" >
              <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
                 <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                <button id="enviar" name="enviar" type="submit" class="btn btn-danger">Eliminar</button>
            </div>
          </form>       
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
 </div>   

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
                  <table id="examenes" class="table table-stripped">
                    <thead>
                      <tr>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Resultado</th>
                        <th>Tipo</th>
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
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
        <button class="btn btn-success" onclick="window.location = '<?php echo URL;?>ExpedienteMedico/Diagnostico/mostrarDia/<?php echo $_SESSION["cedula"]."-".$_SESSION["nombre"]."-".$_SESSION["sexo"];?>';">Regresar</button>
        <button id="verHist" class="btn btn-primary">Ver historial</button>
      </div>
      <a style="margin-left: 4%;" class="btn btn-danger" href="<?php echo URL;?>ExpedienteMedico/Diagnostico/FinalizarConsulta">Finalizar consulta</a>
    </div>
  </div>
</div>
<script type="text/javascript">

  $(function(){
    $.ajax({
        type: 'POST',
        url: '<?php echo URL;?>ExpedienteMedico/Examen/mostrarHistorial',
        dataType: 'json',
        success: function(response){
          var tabla = $("#examenes tbody").html('');
        $.each(response, function(index, record){
          var row = $("<tr />");    
          $("<td />").text(record.Fecha).appendTo(row);
          $("<td />").text(record.Descripcion).appendTo(row);
          $("<td />").text(record.Resultado).appendTo(row);
          $("<td />").text(record.Tipo).appendTo(row);
          row.appendTo('#examenes');
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
  });

  function seleccionarTabla(){
    var _trEdit = null;
    $(document).on('click', '#buscar',function(){
      _trEdit = $(this).closest('tr');
      var _idExamen = $(_trEdit).find('td:eq(0)').text();
      var _descripcion = $(_trEdit).find('td:eq(1)').text();
      var _resultado = $(_trEdit).find('td:eq(2)').text();
      var _fecha = $(_trEdit).find('td:eq(3)').text();
      var _idDiag = $(_trEdit).find('td:eq(4)').text();
      var _tipo = $(_trEdit).find('td:eq(5)').text();

      $('input[name="idExamen1"]').val(_idExamen);
      $('textarea[name="descripcion1"]').val(_descripcion);
      $('textarea[name="resultado1"]').val(_resultado);
      $('input[name="idDiag1"]').val(_idDiag);
      $('select[name="tipoex1"]').val(_tipo);
    }); 
  }

    function filtrar(){
      var $rows = $('#examenes tr');
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