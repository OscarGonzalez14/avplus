<?php

   require_once("../config/conexion.php");

    if(isset($_SESSION["id_usuario"])){
    
    require_once("../modelos/Usuarios.php");
    require_once("../modelos/Pacientes.php");
    $codigo = new Paciente();
    
       
       
?>



<?php
 
  require_once("header.php");

?>


  <?php if($_SESSION["pacientes"]==1)
     {

     ?>

  <style>
    #tamanoModal{
      width: 75% !important;
    }
     #encabezado{
        background-color: #034f84;
        color: white;
    }

  </style>
  <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
             
             <div id="resultados_ajax"></div>

             <h2>Modulo de Pacientes</h2>

            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">
                            <button class="btn btn-dark btn-lg" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#pacienteModal"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Paciente</button></h1>

                            <a href="consultas.php"><button class="btn btn-blue btn-lg"><i class="fa fa-address-card-o" aria-hidden="true"></i>
                              Consultas</button></h1></a>

                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive">
                          
                          <table id="paciente_data" class="table table-bordered table-striped">

                            <thead>
                              
                                <tr>
                                  
                                <th>Codigo</th>
                                <th>Nombres</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Fecha de Registro</th>
                                <th>Agregar consulta</th>
                                <th width="10%">Editar</th>
                                <th width="10%">Eliminar</th>

                                </tr>
                            </thead>

                            <tbody>
                              

                            </tbody>


                          </table>
                     
                    </div>
                  
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
    
   <!--FORMULARIO VENTANA MODAL-->
  
<div class="modal fade" id="pacienteModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Agregar Paciente</h4>
        </div>
<div class="modal-body">

  <form method="post" action="../ajax/registra.php">
    <div class="form-group row">

      <div class="col-xs-3">
       <label>Codigo de Paciente</label>
    <input type="text" class="form-control" id="codigo" name="codigo" value="<?php $codigos=$codigo->codigo_paciente(); ?>" readonly>
      </div>

      <div class="col-xs-12">
        <label for="ex1">Nombre</label>
        <input class="form-control" id="nombres" name="nombres" type="text" placeholder="Escriba el Nombre del paciente" required>
      </div>
      <div class="col-xs-3">
        <label for="ex2">Telefono del Paciente</label>
        <input class="form-control" id="telefono" type="text" name="telefono">
      </div>

      <div class="col-xs-3">
        <label for="ex3">Edad</label>
        <input class="form-control" id="edad" type="number" name="edad" placeholder="edad" required>
      </div>

      <div class="col-xs-6">
        <label for="ex3">Ocupación</label>
        <input class="form-control" id="ocupacion" type="text" name="ocupacion" placeholder="ocupacion del paciente">
      </div>

      <div class="col-xs-6">
        <label for="ex3">Empresa</label>
        <input class="form-control" id="empresa" type="text" name="empresa" placeholder="empresa">
      </div>

      <div class="col-xs-6">
        <label for="ex3">Correo</label>
        <input class="form-control" id="correo" type="text" name="correo" placeholder="correo del paciente">
      </div>


    </div>

  <input type="hidden" name="id_paciente" id="id_paciente"/>
  <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
  <input type="hidden" name="codigo_paciente" id="codigo_paciente"/>

<button type="submit"  class="btn btn-primary btn-block"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span>
Guardar</button>
  </form>

  </div>
        <div class="modal-footer">
          <button class="btn btn-dark" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

 <!--FIN FORMULARIO VENTANA MODAL-->


 <!--FORMULARIO VENTANA MODAL CONSULTAS-->
<div class="modal fade" id="consultasModal" role="dialog">
    <div class="modal-dialog" id="tamanoModal">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" id="encabezado">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
<i class="fa fa-user-md" aria-hidden="true"></i> <strong>          NUEVA CONSULTA</strong>
        
      </div>  
        <div class="modal-body">

    <form class="form-horizontal" method="post" action="../ajax/regista_consulta.php">
    <div class="form-group row">

  <div class="col-xs-3">
        <label for="ex1">Cod.Paciente</label>
        <input class="form-control" id="codigop" name="codigop" type="text" readonly>
  </div>



      <div class="col-xs-9">
        <label for="ex3">Nombre</label>
        <input class="form-control" id="nombre_pac" type="text" name="nombre_pac" >
      </div>
     
 <div class="col-xs-12">
      <label for="comment">Motivo de Consulta</label>
      <textarea cols="80" class="form-control" rows="2" id="motivo" name="motivo"></textarea>
    </div>

    <div class="col-xs-12">
      <label for="comment">Patologias</label>
      <textarea cols="80" class="form-control" rows="2" id="patologias" name="patologias"></textarea>
    </div>

<p>.</p>
<hr style="color:blue;">
    <div><center><h5 style="color:blue;"><strong>Lensometria</strong></h5></center></div>

<table class="table">

    <thead class="thead-light">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>
        <th style="text-align:center">PRISMA</th>
        <th style="text-align:center">ADICION</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiesfreasl" ></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oicilindrosl" ></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiejesl" ></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiprismal" ></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiadicionl"></td>
      </tr>
      <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasl"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilndrosl"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesl"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odprismal"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odadicionl"></td>
        
      </tr>
    </tbody>
  </table>

<hr style="color:blue;">
    <div><center><h5 style="color:blue;"><strong>RX Autorefractometro</strong></h5></center></div>


<table class="table">

    <thead class="thead-light">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:cente---r">CILIDROS</th>
        <th style="text-align:center">EJE</th>
        <th style="text-align:center">PRISMA</th>
        <th style="text-align:center">ADICION</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiesferasa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oicolindrosa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiejesa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiprismaa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiadiciona"></td>
      </tr>
      <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilindrosa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="dprismaa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oddiciona"></td>        
      </tr>
    </tbody>
  </table>

  <!--==================== FIN Autoreflejado==================-->

    <!--==================== Rx Final==================-->

    <div><center><h5 style="color:blue;"><strong>RX Final</strong></h5></center></div>


<table class="table">

    <thead class="thead-light">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>
        <th style="text-align:center">PRISMA</th>
        <th style="text-align:center">ADICION</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiesferasf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oicolindrosf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiejesf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiprismaf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiadicionf"></td>
      </tr>
      <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilindrosf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="dprismaf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oddicionf"></td>        
      </tr>
    </tbody>
  </table>

 
    <div class="col-xs-12">
        <label for="ex3">Lentes Sugeridos</label>
        <input class="form-control" id="sugeridos" type="text" name="sugeridos" placeholder="Lentes sugeridos">
    </div>

    <div class="col-xs-12">
      <label for="comment">Diagnostico</label>
      <textarea cols="80" class="form-control" rows="2" id="diagnostico" name="diagnostico" placeholder="Diagnostico"></textarea>
    </div>

    <div class="col-xs-12">
        <label for="ex3">Medicamento</label>
        <input class="form-control" id="medicamento" type="text" name="medicamento" placeholder="Medicamento">
    </div>

        <div class="col-xs-12">
      <label for="comment">Observaciones</label>
      <textarea cols="80" class="form-control" rows="2" id="observaciones" name="observaciones" placeholder="Observaciones"></textarea>
    </div>

    <div class="col-xs-12">
      
        <input class="form-control" id="codigos" name="codigos" type="hidden" value="codigos" readonly>
  </div>
 <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
     </div>


    <button type="submit" id="agregar" name="agregar" class="btn btn-blue btn-block"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span>
Guardar</button>
  </form>

  </div>
        <div class="modal-footer">
          <button class="btn btn-dark" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
 <!--FIN FORMULARIO VENTANA MODAL-->


  
  <?php  } else {

       require("noacceso.php");
  }
   
  ?><!--CIERRE DE SESSION DE PERMISO -->

<?php

  require_once("footer.php");
?>

<script type="text/javascript" src="js/paciente.js"></script>
<script type="text/javascript" src="js/consultas.js"></script>

<?php
   
  } else {

        header("Location:".Conectar::ruta()."vistas/index.php");

  }

  

?>

