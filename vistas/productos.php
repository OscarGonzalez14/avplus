<?php

   require_once("../config/conexion.php");

    if(isset($_SESSION["id_usuario"])){

       require_once("../modelos/Categorias.php");

       $categoria = new Categoria();

       $cat = $categoria->get_categorias();
       
       
?>



<?php
 
  require_once("header.php");

?>


    <?php if($_SESSION["productos"]==1)
     {

     ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#agregar').click(function() {
            // Recargo la página
            location.reload();
        });
    });
</script>
  <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
             
             <div id="resultados_ajax"></div>

             <h2>INVENTARIO</h2>

            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">
              <button class="btn btn-dark btn-lg" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#productoModal"><span class="glyphicon glyphicon-sunglasses" aria-hidden="true"></span> Agregar Aros</button></h1>

              <a href="ingresos.php"><button class="btn btn-infos btn-lg" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#productoModal"><span class="glyphicon glyphicon-import" aria-hidden="true"></span> Ingreso a Inventario</button></h1></a>

                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive">
                          
                          <table id="producto_data" class="table table-bordered table-striped">

                            <thead>
                              
                                <tr>
                                  
                                <th width="10%">Modelo</th>
                                <th width="12%">Marca</th>
                                <th width="10%">Color</th>
                                <th width="5%">Precio de Venta</th>
                                <th width="10%">Stock</th>
                                <th width="10%">Medidas</th>
                                
                               
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
<div class="modal fade" id="productoModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Agregar Aros</h4>
        </div>
        <div class="modal-body">

    <form class="form-horizontal" method="post" id="producto_form" enctype="multipart/form-data">
    <div class="form-group row">
     
      <div class="col-xs-4">
        <label for="ex1">Marca</label>
        <input class="form-control" id="marca" name="marca" type="text" placeholder="marca" required>
      </div>
      <div class="col-xs-4">
        <label for="ex3">Modelo</label>
        <input class="form-control" id="modelo" type="text" name="modelo" placeholder="modelo">
      </div>

      <div class="col-xs-4">
        <label for="ex2">Color</label>
        <input class="form-control" id="color" type="text" name="color" placeholder="Color">
      </div>

      <div class="col-xs-4">
        <label for="ex3">Medidas</label>
        <input class="form-control" id="medidas" type="text" name="medidas" placeholder="medidas" required>
      </div>

      <div class="col-xs-4">
        <label for="ex3">Precio</label>
        <input class="form-control" id="precio_venta" type="text" name="precio_venta" placeholder="Precio">
      </div>

      <div class="col-xs-4">
        <label for="ex3">Stock Inicial</label>
        <input class="form-control" id="stock" type="text" name="stock" value="0" placeholder="0" readonly>
      </div>

     </div>
    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
          <input type="hidden" name="id_producto" id="id_producto"/>
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

       require_once("noacceso.php");
  }
   
  ?><!--CIERRE DE SESSION DE PERMISO -->


<?php

  require_once("footer.php");
?>

<script type="text/javascript" src="js/productos.js"></script>



<?php
   
  } else {

        header("Location:".Conectar::ruta()."vistas/index.php");

  }

  

?>

