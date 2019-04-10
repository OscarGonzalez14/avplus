
<?php

  require_once("../config/conexion.php");

    if(isset($_SESSION["id_usuario"])){
        

?>


<!-- INICIO DEL HEADER - LIBRERIAS -->
<?php require_once("header.php");?>

<!-- FIN DEL HEADER - LIBRERIAS -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
   
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Detalle de Ingresos a Inventario
       
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
    
   <div id="resultados_ajax"></div>

     <div class="panel panel-default">
        
        <div class="panel-body">

         <div class="btn-group text-center">
          <a href="ingresos.php" id="add_button" class="btn btn-primary btn-lg" ><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Ingreso</a>
         </div>

       </div>
      </div>


       <!--VISTA MODAL PARA VER DETALLE COMPRA EN VISTA MODAL-->
     <?php require_once("modal/detalle_compra_modal.php");?>
    
   
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
             <table id="compras_data" class="table table-bordered table-striped">
                <thead>
                <tr>
                  
                  <th>Número de Ingreso</th>
                  <th>Sucursal</th>
                  <th>Fecha de Ingreso</th>                  
                  <th>Modelo</th>
                  <th>Marca</th>
                  <th>Color</th>
                  <th>Cantidad</th>
                  <th>Usuario</th>
        
                  
                 
                </tr>
                </thead>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   
  

   <?php require_once("footer.php");?>

    <!--AJAX PROVEEDORES-->
<script type="text/javascript" src="js/compras.js"></script>


<?php
   
  } else {

         header("Location:".Conectar::ruta()."vistas/index.php");
     }

?>