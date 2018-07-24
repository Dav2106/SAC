<?php @session_set_cookie_params(0,"/");
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
        <h2 class="form-signin-heading" style="margin-left: 60%;">Tratamientos</h2>
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
     </div>    
    <div>
        <h4 style="margin-left: 85%;">Paciente: <?php echo $_SESSION['cedula'];?></h4><h4 style="margin-left: 85%;">Nombre: <?php echo $_SESSION['nombre'];?></h4><h4 style="margin-left: 85%;">Diagnóstico: <?php echo $_SESSION['lastDgn'];?></h4>
    </div>
    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-1"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Agregar Tratamiento</button><br><br>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <ul id="lista" class="nav nav-pills nav-justified nav-tabs">
        <li><a href="<?php echo URL;?>ExpedienteMedico/Diagnostico/mostrarDia/<?php echo $_SESSION['cedula']."-".$_SESSION['nombre']."-".$_SESSION['sexo'];?>">Diagnósticos</a></li>
        <li><a href="<?php echo URL;?>ExpedienteMedico/Patologia/mostrarDia">Patologías</a></li>
        <li class="active"><a href="#">Tratamientos</a></li>
        <li><a href="<?php echo URL;?>ExpedienteMedico/Examen/mostrarDia">Exámenes</a></li>
        <li><a href="<?php echo URL;?>ExpedienteMedico/Hospitalizacion/mostrarObsHospi">Hospitalizaciones</a></li>
      </ul>
    </div>
    <hr><br><br>
    <div class="container-fluid">
      <table cellspacing="0" width="100%" id="example" class="table table-bordered table-striped table-hover table-responsive">
        <thead>
        <tr>
        <th>Id</th>
        <th>Fecha</th>
        <th>Observaciones</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Receta</th>
        <th>Modificar</th>
        <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->Tratamiento as $elementos){ ?>
          <tr>
            <td><?php echo $elementos['EMD09IDTRT']; ?></td>
            <td><?php echo $elementos['EMD09FECHTRT']; ?></td>
            <td><?php echo $elementos['EMD09OBSETRT']; ?></td>
            <td><?php echo $elementos['EMD09NOMBTRT']; ?></td>
            <td><?php echo $elementos['EMD09DESCTRT']; ?></td>
            <td><button class="btn btn-primary" id="btnReceta" data-toggle="modal" data-target="#modal-5" onclick="seleccionarTablaReceta()">Receta</button></td>
            <td align="center">
             <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal-2" id="btnModi" onclick="seleccionarTabla()">&nbsp;Modificar</button></td>
            <td align="center">
             <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-4" id="btnModi" onclick="seleccionarTabla()">Eliminar</button></td>
          </tr>
      <?php } ?>
        </tbody>
      </table>
    </div>
</div>
    <!-- Bootstrap modal -->
<div class="modal fade" id="modal-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Agregar Tratamiento</h3>
      </div>
      <div class="modal-body">
        <form class="form-group row" action="<?php echo URL;?>ExpedienteMedico/Tratamiento/AgregarTratamiento" method="POST" onsubmit="return CamposVaciosA()">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <input hidden="hidden" type="text" value="<?php echo $_SESSION['cedula'];?>" id="idPac" name="idPac">
              <input hidden="hidden" type="text" value="<?php echo $_SESSION['idLastDgn'];?>" id="idDia" name="idDia">
              <input hidden="hidden" type="text" value="<?php echo $_SESSION['funcionario'];?>" id="idFun" name="idFun">
              <input hidden="hidden" type="datetime" value="<?php echo $fecha;?>" id="fecha" name="fecha" required maxlength="45">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Nombre:</label>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <input class="form-control" type="text" value="" id="nomTra" name="nomTra" required maxlength="45">
                </div>
                <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Descripción:</label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <textarea class="form-control" type="text" value="" id="descripcion" name="descripcion" required maxlength="45"></textarea>
                </div>  
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Observaciones</label>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-form-label">
                <textarea class="form-control" name="observaciones" id="observaciones" maxlength="300"></textarea>
              </div><br><br><br><br><br>              
            </div>   
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="modal-footer" >
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
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
<!--fin modal -->

    <!-- Bootstrap modal -->
<div class="modal fade" id="modal-2" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Modificar Tratamiento</h3>
      </div>
      <div class="modal-body">
        <form class="form-group row" action="<?php echo URL;?>ExpedienteMedico/Tratamiento/ModificarTratamiento" method="POST">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <input type="text" name="idTrat1" id="idTrat1" hidden="hidden">
                <input hidden="hidden" type="text" value="<?php echo $_SESSION['cedula'];?>" id="idPac1" name="idPac1">
                <input hidden="hidden" type="text" value="" id="idDia1" name="idDia1">
                <input hidden="hidden" type="text" value="<?php echo $_SESSION['funcionario'];?>" id="idFun1" name="idFun1">
                <input hidden="hidden" type="datetime" value="<?php echo $fecha;?>" id="fecha1" name="fecha1" required maxlength="45">     
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Nombre:</label>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <input class="form-control" type="text" value="" id="nomTra1" name="nomTra1" required maxlength="45">
                </div>
                <label for="example-text-input" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Descripción:</label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <textarea class="form-control" type="text" value="" id="descripcion1" name="descripcion1" required maxlength="45"> </textarea>
                </div>  
            </div> 
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-form-label">Observaciones</label>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-form-label">
              <textarea class="form-control" name="observaciones1" id="observaciones1" maxlength="300"></textarea>
            </div><br><br><br><br><br>              
          </div>  
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="modal-footer" >
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
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
<!--fin modal -->

					 <!-- Bootstrap modal  ELIMINAR -->
<div class="modal fade" id="modal-4" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Eliminar Tratamiento</h3>
      </div>
      <div class="modal-body form">
        <form action="<?php echo URL;?>ExpedienteMedico/Tratamiento/EliminarTratamiento" method="POST" id="form" class="form-horizontal">
          <input type="hidden" value="" name="book_id"/>
          <div class="form-body">
            <h3>Seguro que desea eliminarlo?</h3>
            <div class="form-group">
              <div class="col-md-9">
                <input class="form-control" type="text" value="" id="idTrat1" name="idTrat1" style="display: none;">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-xs-5"></div>
          <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
          <button id="enviar" name="enviar" type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  <!-- End Bootstrap modal -->
<div class="container-fluid">
<div class="modal fade" id="modal-5" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="form-signin-heading">Receta</h2><br><br>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <input hidden="hidden" type="datetime" value="<?php echo $fecha;?>" id="fecha" name="fecha">
          <input type="text" hidden="hidden" id="idTrt" name="idTrt">
          <input type="text" hidden="hidden" name="id" id="id" >
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <label>Producto</label>
            <input class="form-control" type="text" name="nomPro" id="nomPro" required maxlength="450">
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <label>Indicaciones</label>
            <input class="form-control" type="text" name="indicaciones" id="indicaciones" required maxlength="500">
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <label>Cantidad</label>
            <input class="form-control" type="text" name="cantidad" id="cantidad" required maxlength="45">
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <label>Observaciones</label>
            <input class="form-control" type="text" name="observaciones" id="observaciones" maxlength="500">
          </div>
        </div><br><br><span id="espaRec"></span><br><br>
        <button style="margin-left: 5%;" class="btn btn-success" type="button" id="btnAdd"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Agregar Receta</button>
        <button style="margin-left: 5%; display: none;" class="btn btn-warning" type="button" id="btnUpd"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Modificar Receta</button>
      </div>
      <div>
        <div class="container-fluid">
          <table cellspacing="0" width="100%" id="receta" class="table table-bordered table-striped table-hover table-responsive">
            <thead>
            <tr>
            <th>Fecha</th>
            <th>Producto</th>
            <th>Indicaciones</th>
            <th>Cantidad</th>
            <th>Observaciones</th>
            <th>Modificar</th>
            <th>Eliminar</th>
            </tr>
            </thead>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
          <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
      </div>
    </div>
  </div>
</div>
</div>

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
                  <table id="tratamientos" class="table table-stripped">
                    <thead>
                      <tr>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Observaciones</th>
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

<div class="modal fade" id="modal-7" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <h3 class="modal-title col-xs-12 col-sm-12 col-md-12 col-lg-12">Está seguro que desea eliminar este item</h3>
            </div>
          </div><br>
          <div class="modal-body form">
              <div class="form-body" style="margin-left: 25%;">
                <h2>Producto: <label id="produEli"></label></h2>
              </div><br><br>
              <div class="modal-footer" >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                <a href="" class="btn btn-default" data-dismiss="modal" id="btnCerrarelimi">Cerrar</a>
                <button class="btn btn-danger" id="btnEliminar" name="btnEliminar">Eliminar</button>
              </div>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

<div class="container-fluid" style="margin-top: 135px;">
  <div class="alert alert-info"></div>
  <button class="btn btn-success" onclick="window.location = '<?php echo URL;?>ExpedienteMedico/Diagnostico/mostrarDia/<?php echo $_SESSION["cedula"]."-".$_SESSION["nombre"]."-".$_SESSION["sexo"];?>';">Regresar</button>
  <button id="verHist" class="btn btn-primary">Ver historial</button>
  <a style="margin-left: 71%;" class="btn btn-danger" href="<?php echo URL;?>ExpedienteMedico/Diagnostico/FinalizarConsulta">Finalizar consulta</a>
</div><br>

<script type="text/javascript">
  $(document).ready(function(){
      $(document).on('click','#btnReceta',function(){
        $("#receta").DataTable();
        var _trEdit = $(this).closest('tr');
        var _idTrat = $(_trEdit).find('td:eq(0)').text();
        $.ajax({
          data: "idTrata="+_idTrat,
          type: 'POST',
          url: '<?php echo URL;?>ExpedienteMedico/Receta/iniciarSesion',
          dataType: 'json',
          success: function(response){
            var tabla = $("#receta tbody").html('');
            $.each(response, function(index, record){
              var row = $("<tr />");
              $("<td hidden='hidden'/>").text(record.idRec).appendTo(row);
              $("<td />").text(record.Fecha).appendTo(row);
              $("<td />").text(record.Producto).appendTo(row);
              $("<td />").text(record.Indicaciones).appendTo(row);
              $("<td />").text(record.Cantidad).appendTo(row);
              $("<td />").text(record.Observaciones).appendTo(row);
              $("<td />").html('<button class="btn btn-warning" type="button" id="btnModi" name="btnModi" onclick="seleccionarTablaRec()">Modificar</button>').appendTo(row);
              $("<td />").html('<button class="btn btn-danger" type="button" id="btnEli" name="btnEli" onclick="eliminarRec()">Eliminar</button>').appendTo(row);
              row.appendTo('#receta');
            });
          },
          error: function(err){
            console.log(err);
          }
        });
      });

      $(document).on('click','#btnAdd',function(){
        var _producto = $('input[name="nomPro"]').val();
        var _indicaciones = $('input[name="indicaciones"]').val();
        var _cantidad = $('input[name="cantidad"]').val();
        var _observaciones = $('input[name="observaciones"]').val();
        var _idTrt = $('input[name="idTrt"]').val();
        var _fecha = $('input[name="fecha"]').val();
        var datos = {"nomPro" : _producto, "indicaciones" : _indicaciones, "cantidad" : _cantidad,
        "observaciones" : _observaciones, "idTrt" : _idTrt, "fecha": _fecha};
        if((_producto == null || _producto.length == 0 || /^\s+$/.test(_producto) || _producto == ' ') || 
          (_indicaciones == null || _indicaciones.length == 0 || /^\s+$/.test(_indicaciones) || _indicaciones == ' ') || 
          (_cantidad == null || _cantidad.length == 0 || /^\s+$/.test(_cantidad) || _cantidad == ' ')){
          $("#espaRec").text("Debe completar los campos Producto, Indicaciones y Cantidad");
        }else{
          $.ajax({
            data: datos,
            type: 'POST',
            url: '<?php echo URL;?>ExpedienteMedico/Receta/AgregarReceta',
            dataType: 'json',
            success: function(response){
              var tabla = $("#receta tbody").html('');
              $.each(response, function(index, record){
                var row = $("<tr />");
                $("<td hidden='hidden'/>").text(record.idRec).appendTo(row);
                $("<td />").text(record.Fecha).appendTo(row);
                $("<td />").text(record.Producto).appendTo(row);
                $("<td />").text(record.Indicaciones).appendTo(row);
                $("<td />").text(record.Cantidad).appendTo(row);
                $("<td />").text(record.Observaciones).appendTo(row);
                $("<td />").html('<button class="btn btn-warning" type="button" id="btnModi" name="btnModi" onclick="seleccionarTablaRec()">Modificar</button>').appendTo(row);
                $("<td />").html('<button class="btn btn-danger" type="button" id="btnEli" name="btnEli" onclick="eliminarRec()">Eliminar</button>').appendTo(row);
                row.appendTo('#receta');
              });
              console.log(response);
              $('input[name="nomPro"]').val('');
              $('input[name="indicaciones"]').val('');
              $('input[name="cantidad"]').val('');
              $('input[name="observaciones"]').val('');
            },
            error: function(err){
                console.log(err);
            }
          });
        }
        console.log(datos);
      });

      $(document).on('click','#btnUpd',function(){
        var _producto = $('input[name="nomPro"]').val();
        var _indicaciones = $('input[name="indicaciones"]').val();
        var _cantidad = $('input[name="cantidad"]').val();
        var _observaciones = $('input[name="observaciones"]').val();
        var _id = $('input[name="id"]').val();
        var _fecha = $('input[name="fecha"]').val();
        var _idTrt = $('input[name="idTrt"]').val();
        var datos = {"id": _id, "nomPro" : _producto, "indicaciones" : _indicaciones, "cantidad" : _cantidad, "observaciones" : _observaciones, "fecha": _fecha, "idTrt": _idTrt};

        $.ajax({
          data: datos,
          type: 'POST',
          url: '<?php echo URL;?>ExpedienteMedico/Receta/ModificarReceta',
          dataType: 'json',
          success: function(response){
            var tabla = $("#receta tbody").html('');
            $.each(response, function(index, record){
              var row = $("<tr />");
              $("<td hidden='hidden'/>").text(record.idRec).appendTo(row);
              $("<td />").text(record.Fecha).appendTo(row);
              $("<td />").text(record.Producto).appendTo(row);
              $("<td />").text(record.Indicaciones).appendTo(row);
              $("<td />").text(record.Cantidad).appendTo(row);
              $("<td />").text(record.Observaciones).appendTo(row);
              $("<td />").html('<button class="btn btn-warning" type="button" id="btnModi" name="btnModi" onclick="seleccionarTablaRec()">Modificar</button>').appendTo(row);
              $("<td />").html('<button class="btn btn-danger" type="button" id="btnEli" name="btnEli" onclick="eliminarRec()">Eliminar</button>').appendTo(row);
              row.appendTo('#receta');
            });
            console.log(response);
            $('input[name="nomPro"]').val('');
            $('input[name="indicaciones"]').val('');
            $('input[name="cantidad"]').val('');
            $('input[name="observaciones"]').val('');
            $("#btnAdd").fadeIn("slow");
            $("#btnUpd").fadeOut("slow");
          },
          error: function(err){
              console.log(err);
          }
        });
      });

      $.ajax({
        type: 'POST',
        url: '<?php echo URL;?>ExpedienteMedico/Tratamiento/mostrarHistorial',
        dataType: 'json',
        success: function(response){
          var tabla = $("#tratamientos tbody").html('');
        $.each(response, function(index, record){
          var row = $("<tr />");    
          $("<td />").text(record.Fecha).appendTo(row);
          $("<td />").text(record.Nombre).appendTo(row);
          $("<td />").text(record.Descripcion).appendTo(row);
          $("<td />").text(record.Observaciones).appendTo(row);
          row.appendTo('#tratamientos');
          filtrar();
        })  
        },
        error: function(){
          console.log("error");
        }
    });

    $(document).on('click','#verHist', function(){
      $("#modal-6").modal('show');
      return false; 
    });
    $("#btnCerrarelimi").click(function(){
      $("#modal-5").modal('show');
    });
    $("#btnEliminar").click(function(){
      var datos = {"idRec": id,"idTrt": idTrt};
      $.ajax({
        data: datos,
        type: 'POST',
        url: '<?php echo URL;?>ExpedienteMedico/Receta/EliminarReceta',
        dataType: 'json',
        success: function(response){
          $("#modal-7").modal('hide');
          $("#modal-5").modal('show');
          var tabla = $("#receta tbody").html('');
          $.each(response, function(index, record){
            var row = $("<tr />");
            $("<td hidden='hidden'/>").text(record.idRec).appendTo(row);
            $("<td />").text(record.Fecha).appendTo(row);
            $("<td />").text(record.Producto).appendTo(row);
            $("<td />").text(record.Indicaciones).appendTo(row);
            $("<td />").text(record.Cantidad).appendTo(row);
            $("<td />").text(record.Observaciones).appendTo(row);
            $("<td />").html('<button class="btn btn-warning" type="button" id="btnModi" name="btnModi" onclick="seleccionarTablaRec()">Modificar</button>').appendTo(row);
            $("<td />").html('<button class="btn btn-danger" type="button" id="btnEli" name="btnEli" onclick="eliminarRec()">Eliminar</button>').appendTo(row);
            row.appendTo('#receta');
          });
        },
        error: function(err){
          $("#receta tbody").html('');
          $("#modal-7").modal('hide');
          $("#modal-5").modal('show');
        }
      });     
    });
  });
    
    function seleccionarTabla(){
      var _trEdit = null;
      $(document).on('click', '#btnModi',function(){
        _trEdit = $(this).closest('tr');
        var _id = $(_trEdit).find('td:eq(0)').text();
        var _fecha = $(_trEdit).find('td:eq(1)').text();
        var _observacion = $(_trEdit).find('td:eq(2)').text();
        var _nombre = $(_trEdit).find('td:eq(3)').text();
        var _descripcion = $(_trEdit).find('td:eq(4)').text();
     
        $('input[name="idTrat1"]').val(_id);
        $('input[name="nomTra1"]').val(_nombre);
        $('textarea[name="descripcion1"]').val(_descripcion);
        $('textarea[name="observaciones1"]').val(_observacion);
      }); 
    }

    function seleccionarTablaReceta() {
      var _trEdit = null;
      $(document).on('click', '#btnReceta',function(){
        _trEdit = $(this).closest('tr');
        var _id = $(_trEdit).find('td:eq(0)').text();     
        $('input[name="idTrt"]').val(_id);
      }); 
    }

    function seleccionarTablaRec(){
      var _trEdit = null;
      $(document).on('click', '#btnModi',function(){
        $("#btnAdd").fadeOut("slow");
        $("#btnUpd").fadeIn("slow");
        _trEdit = $(this).closest('tr');
        var _id = $(_trEdit).find('td:eq(0)').text();
        var _fecha = $(_trEdit).find('td:eq(1)').text();
        var _nombre = $(_trEdit).find('td:eq(2)').text();
        var _indicaciones = $(_trEdit).find('td:eq(3)').text();
        var _cantidad = $(_trEdit).find('td:eq(4)').text();
        var _observaciones = $(_trEdit).find('td:eq(5)').text();

       
        $('input[name="id"]').val(_id);
        $('input[name="nomPro"]').val(_nombre);
        $('input[name="cantidad"]').val(_cantidad);
        $('input[name="fecha"]').val(_fecha);
        $('input[name="indicaciones"]').val(_indicaciones);
        $('input[name="observaciones"]').val(_observaciones);
      });
    }

      function filtrar(){
        var $rows = $('#tratamientos tr');
        $('#buscar').keyup(function() {
          var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
              
          $rows.show().filter(function() {
          var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
          }).hide();
        });
      }


      var id = null;
      var nombre = null;
      var idTrt = null;
      function eliminarRec(){
         $(document).on('click','#btnEli', function(){
          $("#modal-5").modal('hide');
          $("#modal-7").modal('show');
          _trEdit = $(this).closest('tr');
          id = $(_trEdit).find('td:eq(0)').text();
          nombre = $(_trEdit).find('td:eq(2)').text();
          idTrt = $('input[name="idTrt"]').val();
          $("#produEli").text(nombre);
        });  
      }     
</script>
</body>
</html>