<?php @session_set_cookie_params(0,"/");
@session_start();
if(!isset($_SESSION['funcionario'])){
  header('location: '.URL.'Usuarios/Login/iniciarSesion');
}
if(!isset($_SESSION['idHosP'])){
  $_SESSION['idHosP'] = 0;
}
$fecha = getdate();
$fecha = date('Y-m-d H:i:s');
?>
<!DOCTYPE>
<html xmlns="">
<head>
<title>SAC</title>
<?php 
require $_SERVER['DOCUMENT_ROOT'] . "/SAC/Assets/Assets.php";
?>
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
        <h2 class="form-signin-heading" style="margin-left: 60%;">Hospitalización</h2>
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
      <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <form class="form-group row" action="<?php echo URL;?>ExpedienteMedico/Hospitalizacion/AgregarHospitalizacion" method="POST">
              <input class="form-control" style="display: none;"  type="text" value="<?php echo $_SESSION['cedula'];?>" id="idPac" name="idPac">
              <input class="form-control" style="display: none;" type="text" value="<?php echo $_SESSION['idLastDgn'];?>" id="idDiag" name="idDiag">
              <button id="btnAgreHos"   class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Iniciar Hospitalización</button>
            </form>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="margin-left: 5%;">
            <form action="<?php echo URL;?>ExpedienteMedico/Hospitalizacion/finalizarHos" method="POST">
              <input class="form-control" style="display: none;" type="text" value="<?php echo $_SESSION['idHosP'];?>" id="idhos" name="idhos">   
              <button type="button" id="btnAgreOB" data-toggle="modal" data-target="#modal-12" class="btn btn-warning">Agregar Observación</button>
              <button class="btn btn-danger"  id="btnFinHos" type="submit"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Finalizar Hospitalización</button>
            </form>
          </div>
        </div> 
      </div>
     <br><br>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <ul id="lista" class="nav nav-pills nav-justified nav-tabs">
        <li><a href="<?php echo URL;?>ExpedienteMedico/Diagnostico/mostrarDia/<?php echo $_SESSION['cedula']."-".$_SESSION['nombre']."-".$_SESSION['sexo'];?>">Diagnósticos</a></li>
        <li><a href="<?php echo URL;?>ExpedienteMedico/Patologia/mostrarDia">Patologías</a></li>
        <li><a href="<?php echo URL;?>ExpedienteMedico/Tratamiento/mostrarDia">Tratamientos</a></li>
        <li><a href="<?php echo URL;?>ExpedienteMedico/Examen/mostrarDia">Exámenes</a></li>
        <li class="active"><a href="#">Hospitalizaciones</a></li>
        <li><a href="<?php echo URL;?>ExpedienteMedico/ControlEstadistico/mostrar">Control Prenatal</a></li> 
      </ul>
    </div>
<br><br><br>
    <div >
    
      <div class="container">
       <form action="<?php echo URL;?>ExpedienteMedico/Hospitalizacion/AgregarObsHospit" method="POST">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">         
              <div>
              <input style="display: none;" class="form-control" type="datetime" value="" id="fechaIn" name="fechaIn">
              </div>
          </div> 
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
              <div>
              <input style="display: none;" class="form-control" type="datetime" value="" id="fechaFi" name="fechaFi">
              </div>
              <input type="text" style="display: none;" id="idOB" name="idOB">
               <input class="form-control" style="display: none;" type="text" value="<?php echo $_SESSION['idHosP'];?>" id="idHosP" name="idHosP">
                <input class="form-control" style="display: none;" type="text" value="<?php echo $_SESSION['idLastDgn'];?>" id="idDiagMo" name="idDiagMo">
          </div>
         <div id="" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
            <div>
              <input class="form-control" type="text" value="" style="display: none;" id="descob" name="descob">
            </div>
          </div> 
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
          <br>
            <!-- <button type="button" id="btnAgreOB" data-toggle="modal" data-target="#modal-12" class="btn btn-warning">Agregar Observación</button> -->
             <form action=""></form>
             <button type="button" id="btnModiOB" style="display: none;"  class="btn btn-warning">Modificar Observación</button>
          </div>
         </form> 
      </div>     
    
    </div>

    <br><br> 
      <div class="container-fluid">
        <table cellspacing="0" width="100%" id="example" class="table table-bordered table-striped table-hover table-responsive">
          <thead>
              <tr> 
                  <th style="display: none;">Id</th>
                  <th>Observación</th>
                  <th >Fecha</th>
                  <th style="display: none;">Id Diagnostico</th>
                  <th style="display: none;">Id Hospitalizacion</th>
                  <th>Modificar</th>
                  <th>Eliminar</th>
              </tr>
          </thead>
          <tbody>   
          <?php
          foreach($this->Hospitalizacion as $elementos){
           ?>
            <tr>
              <td style="display: none;"><?php echo $elementos['EMD20IDOBHOS']; ?></td>
              <td><?php echo $elementos['EMD20NOOBHOS']; ?></td>
              <td ><?php echo $elementos['EMD20FECHOB']; ?></td>
              <td style="display: none;"><?php echo $elementos['EMD20IDDGN_IDDGN01']; ?></td>
              <td style="display: none;"><?php echo $elementos['EMDIDHOS_HOS11']; ?></td>
              <td>
              <button class="btn btn-warning" type="button"  id="btnModi"  data-toggle="modal" data-target="#modal-10" onclick="seleccionarTabla()"> &nbsp;Modificar</button></td>
              <td align="center">
              <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-8" id="btnModi" onclick="seleccionarTabla()"> Eliminar</button></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

 <!-- Bootstrap modal Observación -->
<div class="modal fade" id="modal-10" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Modificar Observación</h3>
      
      <div class="modal-body">
        <form action="<?php echo URL;?>ExpedienteMedico/Hospitalizacion/ModificarObsHospit" method="POST">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
          </div> 
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
              <input type="text" hidden="hidden" id="idOB" name="idOB">
          </div>
          <div id="" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
            <label >Observación </label>
            <div>
               <input class="form-control" type="text" value="" id="descob" name="descob" >
            </div>
            <div id="" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
              
            </div>

          </div> 
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
          <br>
            <!-- <button type="submit" id="btnAgreOB" class="btn btn-warning">Agregar Observación</button>-->
           
             <button type="submit" id="btnModiOB"   class="btn btn-warning">Modificar Observación</button>
          </div>
         </form>
         <a href="" style="margin-left: 40%" data-dismiss="modal" class="btn btn-default">Cerrar</a>
         </div>
        </div>
      </div>
    </div>
  </div>
</div><!--fin modal -->

<!-- Bootstrap modal Agregar Observación -->
<div class="modal fade" id="modal-12" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Agregar observación</h3>
      
      <div class="modal-body">
        <form action="<?php echo URL;?>ExpedienteMedico/Hospitalizacion/AgregarObsHospit" method="POST">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 "></div> 
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <input type="text" style="display: none;" id="idOB" name="idOB">
              <input class="form-control" type="text" style="display: none;" value="<?php echo $_SESSION['idHosP'];?>" id="idHosP" name="idHosP">
              <input class="form-control"  type="text" style="display: none;" value="<?php echo $_SESSION['idLastDgn'];?>" id="idDiagMo" name="idDiagMo">
          </div>
          <div id="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <label>Observación </label>
            <div >
               <textarea class="form-control" type="text" value="" id="descob" name="descob" cols="40" rows="10" required maxlength="300"></textarea>
               <br><br>
            </div>  
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <button style="margin-left: 70%" type="submit" id="btnAgreOB" class="btn btn-warning">Agregar Observación</button> 
               <a href="" style="margin-left: 1%;" data-dismiss="modal" class="btn btn-default">Cerrar</a> 
          </div>
         </form>
         </div>
        </div>
      </div>
    </div>
  </div>
<!--fin modal -->

<div class="modal fade" id="modal-8" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Eliminar Observación</h3>
        </div>
          <div class="modal-body form">
            <form action="<?php echo URL;?>ExpedienteMedico/Hospitalizacion/eliminarOBHospitalizacion" method="POST" id="form" class="form-horizontal">
                <div class="form-body">
                  <div class="form-group">
                      <h3>&nbsp;&nbsp;Seguro que desea eliminarlo?</h3>
                      <div class="col-md-9">
                        <input class="form-control" type="text" value="" id="idOB" name="idOB" style="display: none;">
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

<div class="modal fade" id="modal-6" role="dialog">
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
                  <table id="hospitalizacion" class="table table-stripped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Paciente</th>
                        <th>Diagnosico</th>
                        <th>Tratamiento</th>
                        <th>Nombre</th>
                        <th>Fecha de entrada</th>
                        <th>Fecha de salida</th>
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
<input type="hidden" name="idH" id="idH" value="<?php echo $_SESSION['idHosP'];?>">
<div class="container-fluid">
  <div class="alert alert-info"></div>
</div>
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
function seleccionarTabla() {
  var _trEdit = null;
  $(document).on('click', '#btnModi',function(){
    _trEdit = $(this).closest('tr');
    var _idob = $(_trEdit).find('td:eq(0)').text();
    var _idHos = $(_trEdit).find('td:eq(3)').text();
    var _descob = $(_trEdit).find('td:eq(1)').text();
    var _fechaSa = $(_trEdit).find('td:eq(2)').text();
    var _idDiag = $(_trEdit).find('td:eq(4)').text();
    
    $('input[name="idOB"]').val(_idob);
    $('input[name="descob"]').val(_descob);
    $('input[name="fechaSa"]').val(_fechaSa);
    $('input[name="idDiag"]').val(idDiagMo);
     //$('input[name="fechaFi"]').val(idDiagMo);
  }); 
}
$(document).ready(function() {
      veriHos();

      function veriHos(){
        var id = $("#idH").val();
        if(id == 0){
          $("#btnAgreOB").css("display", "none");
        }else if(id != 0){
          $("#btnAgreOB").fadeIn("slow");
          $("#btnAgreHos").css("display", "none");
        }
      }

      $.ajax({
        type: 'POST',
        url: '<?php echo URL;?>ExpedienteMedico/Hospitalizacion/HistorialHospi',
        dataType: 'json',
        success: function(response){
          var tabla = $("#hospitalizacion tbody").html('');
        $.each(response, function(index, record){
          var row = $("<tr />");    
          $("<td />").text(record.Id).appendTo(row);
          $("<td />").text(record.nombre).appendTo(row);
          $("<td />").text(record.descdgn).appendTo(row);
          $("<td />").text(record.desctrt).appendTo(row);
          $("<td />").text(record.nombretrt).appendTo(row);
          $("<td />").text(record.fechaen).appendTo(row);
          $("<td />").text(record.fechasa).appendTo(row);
          row.appendTo('#hospitalizacion');
          filtrar();
        }) 
        },
        error: function(err){
          console.log(err);
        }
      });
    function mostrar(){
    $.ajax({
        type: 'POST',
        url: '<?php echo URL;?>ExpedienteMedico/Hospitalizacion/mos',
        success: function(data){
          console.log(data);
        },
        error: function(){
          console.log('error');
        }
      }); 
  }
  

 $(document).on('click', '#btnModiOB',function(){
//  $('#btnModiOB').click(function(e){
    var idOb = $('input[name="idOB"]').val(); 
    var descob = $('input[name="descob"]').val(); //precio desc observacion fecha
    var idDiagMo = $('input[name="idDiagMo"]').val();
    var idHosP = $('input[name="idHosP"]').val();
 $.ajax({
      data:{"idOB":idOb, "descob": descob, "idDiagMo": idDiagMo, "idHosP": idHosP},
      type: 'POST',
      url: '<?php echo URL;?>ExpedienteMedico/Hospitalizacion/ModificarObsHospit',
        success: function(){
        var tabla = $("#example tbody").html('');
        window.location.reload();
         
      },
      error: function(err){
        console.log(err);
      }
    });
});



$(document).on('click', '#btnAgreHos',function(){
       $.ajax({
          url: '<?php echo URL;?>ExpedienteMedico/Hospitalizacion/mostrarObsHospi',
          success: function(){
          console.log("hola");
          mostrar();
          },
          error: function(err){
          console.log(err);
      }
    });
});

$(document).on('click', '#btnFinHos',function(){
       $.ajax({
          url: '<?php echo URL;?>ExpedienteMedico/Hospitalizacion/mostrarObsHospi',
          success: function(){
          console.log("hola");
          mostrar();
          },
          error: function(err){
          console.log(err);
      }
    });
});

  $(document).on('click','#verHist', function(){
     $("#modal-6").modal('show');
    return false; 
  });

  function filtrar(){
    var $rows = $('#hospitalizacion tr');
    $('#buscar').keyup(function() {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
      
        $rows.show().filter(function() {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });
  }
}); 
</script>
</body>
</html>