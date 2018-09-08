<?php session_set_cookie_params(0,"/");
session_start();
if(!isset($_SESSION['funcionario'])){
    header('location: '.URL.'Login/iniciarSesion');
}
$fecha = getdate();
$fecha = date('Y-m-d H:i:s');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EMD SYS</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/Bootstrap/bootstrap/css/bootstrap.min.css">
    <link href="<?php echo URL;?>Assets/datatables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/CSS/style.css">
    <link rel="stylesheet" href="<?php echo URL;?>Public/Bootstrap/fonts/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/CSS/reportes.css">
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="shortcut icon" href="../favicon.ico" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
    <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <a href="<?php echo URL;?>Index/indexRes"><i class="fa fa-home fa-3x" aria-hidden="true"></i></a>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                <h1 id="ec" style="margin-left: 60%;">Agenda Diaria</h1>
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
        </div>
    </div><br><br>
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form action="<?php echo URL;?>Agenda/agregarAgenda" method="POST" id="formAgenda">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Paciente</label>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                           <input type="text" name="idPac" id="idPac" class="form-control" required>
                           <span id="resultPac"></span>
                        </div>
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Triage</label>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                           <select name="tipo" id="tipo" class="form-control" required>
                               <option value="Rojo">Rojo</option>
                               <option value="Amarillo">Amarillo</option>
                               <option value="Verde">Verde</option>
                               <option value="Negro">Negro</option>
                           </select> 
                        </div>
                    </div><br><br><br><br>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Observaciones</label>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                           <input type="text" name="observacion" id="observacion" class="form-control" required> 
                        </div>
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Fecha</label>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                           <input type="datetime" name="fecha" id="fecha" class="form-control" value="<?php echo $fecha;?>" readonly required> 
                        </div>
                    </div><br><br>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11"></div>
                        <button id="btnAgregar" class="btn btn-success col-lg-1 col-md-1 col-sm-1 col-xs-1">Agregar</button>
                    </div>
                    <br><br><hr>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10"></div>
                        <button class="btn btn-success col-lg-2 col-md-2 col-sm-2 col-xs-2" id="btnBuscarCita">Buscar Cita</button>
                    </div>
                </div>
            </form>
        </div>
    </div><br><br>
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#enespera">En espera</a></li>
                <li><a data-toggle="tab" href="#atendidos">Atendidos</a></li>
            </ul>
            <div class="tab-content">
                <div id="enespera" class="tab-pane fade in active">
                    <div>
                        <table class="table table-bordered table-stripped table-responsive" id="reporte">
                                <thead>
                                    <th>Paciente</th>
                                    <th>Fecha</th>
                                    <th>Triage</th>
                                    <th>Observaciones</th>
                                    <th>Modificar</th>
                                    <th>Eliminar</th>
                                    <th>Estado</th>
                                </thead>
                                <tbody>
                                    <?php foreach($this->agenda as $elemento){ ?>
                                    <tr>
                                        <td style="display: none;"><?php echo $elemento['EMD03IDCIT']?></td>
                                        <td><?php echo $elemento['emd01pac_EMD01IDPAC']?></td>
                                        <td><?php echo $elemento['EMD03FECHCIT']?></td>
                                        <td><?php echo $elemento['EMD03TRIACIT']?></td>
                                        <td><?php echo $elemento['EMD03OBSECIT']?></td>
                                        <td><button class="btn btn-warning" id="btnModi" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-1"><span class="glyphicon glyphicon-edit"></span>&nbsp;Modificar</button></td>
                                        <td><button class="btn btn-danger" id="btnModi" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-2">Eliminar</button></td>
                                        <td><?php echo $elemento['EMD03ESTACIT']?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                    </div> 
                </div>
                <div id="atendidos" class="tab-pane fade">
                    <div>
                        <table class="table table-bordered table-stripped table-responsive" id="reporte2">
                            <thead>
                                <th>Paciente</th>
                                <th>Fecha</th>
                                <th>Triage</th>
                                <th>Observaciones</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                                <th>Estado</th>
                                <th>Cobrar</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>  
                </div>
            </div>
        </div>
    </div><br><br>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <button class="btn btn-success" onclick="window.location = '<?php echo URL;?>Index/indexRes';">Regresar</button>
        <a href="<?php echo URL;?>Agenda/listaEspera" style="margin-left: 65%;" class="btn btn-primary">Lista de espera</a>
    </div>
<div class="container">
    <div class="modal fade" id="modal-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Modificar Agenda</h3>
                </div>
                <div class="modal-body">
                    <form action="<?php echo URL;?>Agenda/modificarAgenda" method="POST">    
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <input type="hidden" name="id1" id="id1" class="form-control"> 
                            </div>
                            <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Fecha</label>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <input type="date" name="fecha1" id="fecha1" class="form-control" value="<?php echo $fecha;?>">
                            </div>
                            <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Triage</label>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <select name="tipo1" id="tipo1" class="form-control">
                                   <option value="Rojo">Rojo</option>
                                   <option value="Amarillo">Amarillo</option>
                                   <option value="Verde">Verde</option>
                                   <option value="Negro">Negro</option>
                                </select> 
                            </div>
                        </div><br><br><br>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Observaciones</label>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <input type="text" name="observacion1" id="observacion1" class="form-control"> 
                            </div>
                            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Paciente</label>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <input type="text" name="idPac1" id="idPac1" class="form-control">
                            </div>
                        </div><br><br><br>
                        <div class="modal-footer" >
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
                            <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <button id="enviar" name="enviar" type="submit" class="btn btn-warning">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="modal fade" id="modal-2" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Eliminar de Agenda</h3>
                </div>
                <div class="modal-body">
                    <form action="<?php echo URL;?>Agenda/eliminarAgenda" method="POST">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3>Seguro que desea eliminarlo?</h3>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <input type="text" name="id1" id="id1" class="form-control" style="display: none;"> 
                            </div>
                        </div><br><br><br>
                        <div class="modal-footer" >
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                            <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            <button id="enviar" name="enviar" type="submit" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-5" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3 class="modal-title col-xs-3 col-sm-3 col-md-3 col-lg-3">La persona</h3>
                </div>
            </div><br>
            <div class="modal-body form">
                <form>
                    <div class="form-body">
                        <table id="persona" class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>Cédula</th>
                                    <th>Nombre</th>
                                    <th>Apellido 1</th>
                                    <th>Apellido 2</th>
                                </tr>
                            </thead>
                            <tbody id="perbody"></tbody>
                        </table>
                    </div><br><br>
                    <div class="modal-footer" >
                        <div class="col-xs-5"></div>
                        <a href="" class="btn btn-default" data-dismiss="modal" id="btnCerrar">Cerrar</a>
                    </div>
                </form>
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
                    <h3 class="modal-title">Agregar Persona</h3>
                </div>
            </div><br>
            <div class="modal-body form">
                <form class="form-group row" name="Paciente">
                    <div class="col-md-12">
                        <div class="form-group row" class="col-md-2">
                            <label for="example-text-input" class="col-md-2 col-form-label">Cédula:</label>
                            <div class="col-xs-3">
                              <input class="form-control" type="text" value="" id="idP" name="idP">
                            </div>
                            <label for="example-text-input" class="col-md-2 col-form-label">Segundo Apellido:</label>
                            <div class="col-xs-3">
                              <input class="form-control" type="text" value="" id="apellido1" name="apellido1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nombre:</label>
                            <div class="col-xs-3">
                              <input class="form-control" type="text" value="" id="nombre" name="nombre">
                            </div>
                            <label for="example-text-input" class="col-md-2 col-form-label">Sexo:</label>
                            <div class="col-xs-3">
                              <label class="form-check-inline">
                              <input class="form-check-input" type="radio" name="gender" id="gender" value="M">M</label>
                              <label class="form-check-inline">
                              <input class="form-check-input" type="radio" name="gender" id="gender" value="F">F</label>
                            </div>           
                        </div>
                        <div class="form-group row">
                             <label for="example-text-input" class="col-md-2 col-form-label">Primer Apellido:</label>
                            <div class="col-xs-3">
                              <input class="form-control" type="text" value="" id="apellido2" name="apellido2">
                            </div>
                        </div>
                        <div class="form-group row"></div>
                    </form>        
                        <div class="modal-footer" >
                            <div class="col-xs-5"></div>
                            <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                             <button id="enviar" name="enviar" id="enviar" type="button" class="btn btn-success">Agregar</button>
                        </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-7" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Buscar Cita</h3>
            </div><br>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label>Cédula:</label>
                            <input type="text" class="form-control" id="cedula" name="cedula">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label>Fecha:</label>
                            <input type="datetime" class="form-control" id="fechaBus" name="fechaBus">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-xs-5"></div>
                <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                <button type="button" class="btn btn-success" id="btnBuscarFecha" name="btnBuscarFecha">Buscar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal-8" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">No se encontraron resultados</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-9" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">La cita es</h3>
            </div>
            <div class="modal-body">
                <table id="citaBuscada" class="table table-bordered table-responsive table-stripped">
                    <thead>
                        <th>Cédula</th>
                        <th>Fecha</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </thead>
                    <tbody id="citbody"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo URL;?>Public/JS/jquery-3.1.0.min.js"></script>
<script src="<?php echo URL;?>Public/Bootstrap/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function seleccionarTabla() {
        $("#modal-9").modal('hide');
        var _trEdit = null;
        $(document).on('click', '#btnModi',function(){
            _trEdit = $(this).closest('tr');
            var _id = $(_trEdit).find('td:eq(0)').text();
            var _idPac = $(_trEdit).find('td:eq(1)').text();
            var _fecha = $(_trEdit).find('td:eq(2)').text();
            var _tipo = $(_trEdit).find('td:eq(3)').text();
            var _observacion = $(_trEdit).find('td:eq(4)').text();
            
            $('input[name="id1"]').val(_id);
            $('input[name="fecha1"]').val(_fecha);
            $('select[name="tipo1"]').val(_tipo);
            $('input[name="idPac1"]').val(_idPac);
            $('input[name="observacion1"]').val(_observacion);
        }); 
    }

    function seleccionarTabla2() {
        $("#modal-9").modal('hide');
        var _trEdit = null;
        $(document).on('click', '#btnModi',function(){
            _trEdit = $(this).closest('tr');
            var _id = $(_trEdit).find('td:eq(0)').text();
            var _idPac = $(_trEdit).find('td:eq(1)').text();
            var _fecha = $(_trEdit).find('td:eq(2)').text();
            
            $('input[name="id1"]').val(_id);
            $('input[name="fecha1"]').val(_fecha);
            $('input[name="idPac1"]').val(_idPac);
        }); 
    }

    $(document).ready(function(){
        $.ajax({
            type: 'POST',
            url: '<?php echo URL;?>Agenda/mostrarAtendidos',
            dataType: 'json',
            success: function(response){
                console.log(response);
                $.each(response, function(index, record){
                    var row = $("<tr />");
                    $("<td style='display: none;'/>").text(record.ID).appendTo(row);
                    $("<td />").text(record.Paciente).appendTo(row);
                    $("<td />").text(record.Fecha).appendTo(row);
                    $("<td />").text(record.Triage).appendTo(row);
                    $("<td />").text(record.Observaciones).appendTo(row);
                    $("<td />").html('<button class="btn btn-warning" id="btnModi" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-1"><span class="glyphicon glyphicon-edit"></span>&nbsp;Modificar</button>').appendTo(row);
                    $("<td />").html('<button class="btn btn-danger" id="btnModi" onclick="seleccionarTabla()" data-toggle="modal" data-target="#modal-2">Eliminar</button>').appendTo(row);
                    $("<td />").text(record.Estado).appendTo(row);
                    $("<td />").html('<a id="btnFact" href="javascript:void(0);">Factura</a>').appendTo(row);
                    row.appendTo('#reporte2');
                });
            },
            error: function(err){
                console.log(err);
            }
        });

        $(document).on("focus", "#fecha", function(){
            $(this).removeAttr("readonly");
        });

        $(document).on("focusout", "#fecha", function(){
            $(this).prop("readonly", true);
        });        

        $(document).on('focus', "#idPac", function(){
            $("#resultPac").text('');
        });

        $(document).on('click', '#btnAgregar', function(e){
            e.preventDefault();
            var id = $("#idPac").val();
            $.ajax({
                data: 'id='+id,
                type: 'POST',
                url: '<?php echo URL;?>Paciente/BuscarPaciente',
                success: function(data){
                    console.log(data);
                    if(data == 0){
                       $("#resultPac").css('font-size', '20px'); 
                       $("#resultPac").text("La persona no existe"); 
                       setTimeout(function(){
                        var id = $("#idPac").val();
                        $("#idP").val(id);
                        $("#modal-6").modal('show'); 
                       }, 1500);
                    }else{
                      $("#formAgenda").submit();  
                    }
                }
            });
        });

        $(document).on('click', '#btnFact',function(){
            _trEdit = $(this).closest('tr');
            var _id = $(_trEdit).find('td:eq(1)').text();
            window.location = '<?php echo URL;?>Factura/agregar2?id='+_id;
        }); 

        $(document).on('click','#enviar',function(){
            var id = $('#idP').val();
            var nombre = $('#nombre').val();
            var apellido1 = $('#apellido1').val();
            var apellido2 = $('#apellido2').val();
            var sexo = $('input:radio[name=gender]:checked').val();
            datos = {'idP' : id, 'nombre' : nombre, 'apellido1' : apellido1, 'apellido2' : apellido2, 'sexo' : sexo};
            $.ajax({
                data: datos,
                type: 'POST',
                url: '<?php echo URL;?>Paciente/AgregarPacienteAgenda',
                success: function(data){
                    console.log(data);
                    $("#modal-6").modal("hide");
                },
                error: function(err){
                    console.log(err);
                }
            });
        });

        $(document).on('click','#btnBuscarCita',function(e){
            e.preventDefault();
            $("#modal-7").modal('show');
        });

        $("#btnBuscarFecha").click(function(){
            var idPa = $('#cedula').val();
            var fechaPa = $('#fechaBus').val();
            datos = {'id': idPa, 'fecha': fechaPa};
            $.ajax({
                data: datos,
                type: 'POST',
                url: '<?php echo URL;?>Agenda/BuscarCita',
                dataType: 'json',
                success: function(response){
                    $("#modal-7").modal('hide');
                    $("#modal-9").modal('show');
                    $("#citbody > tr").empty();
                    $.each(response, function(index, record){
                        var row = $("<tr />");
                        $("<td hidden='hidden'/>").text(record.ID).appendTo(row);
                        $("<td />").text(record.Cedula).appendTo(row);
                        $("<td />").text(record.Fecha).appendTo(row);
                        $("<td><button type='button' class='btn btn-warning' id='btnModi' onclick='seleccionarTabla2()' data-toggle='modal' data-target='#modal-1'>Modificar</button></td>").appendTo(row);
                        $("<td><button type='button' class='btn btn-danger' id='btnModi' onclick='seleccionarTabla2()' data-toggle='modal' data-target='#modal-2'>Eliminar</button></td>").appendTo(row);
                        row.appendTo('#citaBuscada');
                    })
                },
                error: function(err){
                    console.log(err);
                    $("#modal-8").modal('show');  
                }
            });
        });
    });
</script>
</body>
</html>