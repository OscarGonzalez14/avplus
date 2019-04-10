
<?php


/*validamos si no existe una variable de session entonces el id de session es menor que 1 entonces iniciaria la session y si ya existen una session iniciada entonces no vamos hacer nada, esto para omitir algunos errores de que si ya ha existido la session anteriormente*/
 if(strlen(session_id()) < 1)

  session_start();



   require_once("../config/conexion.php");

    if(isset($_SESSION["id_usuario"])){

      /*Se llaman los modelos y se crean los objetos para llamar el numero de registros en el menu lateral izquierdo y en el home*/
      require_once("../modelos/Categorias.php");
      require_once("../modelos/Productos.php");
      require_once("../modelos/Proveedores.php");
      require_once("../modelos/Usuarios.php");
      require_once("../modelos/Compras.php");
      require_once("../modelos/Pacientes.php");
      require_once("../modelos/Ventas.php");

       $categoria = new Categoria();
       $producto = new Producto();
       $proveedor = new Proveedor();
       $compra = new Compras();
       $paciente = new Paciente();
       $venta = new Ventas();
       $usuario = new Usuarios();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Optica AV+</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../public/bower_components/Ionicons/css/ionicons.min.css">

  <!-- DataTables -->

  <!--<link rel="stylesheet" href="../public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">-->

  <link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
  <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>


  <!-- Theme style -->
  <link rel="stylesheet" href="../public/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../public/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../public/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../public/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!--ESTILOS-->
<!--ESTILOS-->
  <link rel="stylesheet" href="../public/css/estilos.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">AV+</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Optica AV+</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             
            <span class="hidden-xs"> <?php echo $_SESSION["usuario"]?></span>
            <i class="fa fa-sign-out" aria-hidden="true"> Cerrar Sesión</i>
            </a>
            <ul class="dropdown-menu">
               <li class="user-footer">

                <div class="pull-right">
                  <a href="logout.php" class="btn btn-dark btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
       
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li class="">
          <a href="home.php">
            <i class="fa fa-home" aria-hidden="true"></i> <span>Inicio</span>
          </a>
          
        </li>

         <?php if($_SESSION["categoria"]==1)
          {

            echo '<li class="">

              <a href="sucursales.php">
                <i class="fa fa-list" aria-hidden="true"></i> <span>Sucursales</span>

              </a>
         
          </li>';

          }

         ?>

        
        <?php if($_SESSION["productos"]==1)
         
          {

           echo ' 

         <li class="">
          <a href="productos.php">
            <i class="fa fa-tasks" aria-hidden="true"></i> <span>Inventario</span>

          </a>
         
        </li>';

             }

         ?>


         <?php if($_SESSION["pacientes"]==1)
          {

            echo '

             <li class="">
              <a href="pacientes.php">
                <i class="fa fa-users"></i> <span>Pacientes</span>
              </a>
           
            </li>';

            }

         ?>


          <?php if($_SESSION["ventas"]==1)
          {
          
          echo ' 

         <li class="treeview">
          <a href="ventas.php">
            <i class="fa fa-suitcase" aria-hidden="true"></i> <span>Ventas</span>
           
          </a>

          <ul class="treeview-menu">
            <li><a href="ventas.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
            <li><a href="consultar_ventas.php"><i class="fa fa-circle-o"></i> Consultar Ventas</a></li>
            <li><a href="consultar_ventas_fecha.php"><i class="fa fa-circle-o"></i> Consultar Ventas Fecha</a></li>
            <li><a href="consultar_ventas_mes.php"><i class="fa fa-circle-o"></i> Consultar Ventas Mes</a></li>
           
          </ul>
         
        </li>';

         }

       ?>


       <?php if($_SESSION["reporte_compras"]==1)
          {

          echo '

       <li class="treeview">
          <a href="reporte_compras.php">
            <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Reportes de Compras</span>
            <span class="pull-right-container badge bg-blue">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="reporte_general_compras.php"><i class="fa fa-circle-o"></i>Reporte General Compras</a></li>
            
            <li><a href="reporte_compras_mensual.php"><i class="fa fa-circle-o"></i> Reporte Mensual Compras</a></li>

            <li><a href="reporte_compras_proveedor.php"><i class="fa fa-circle-o"></i> Reporte Compras-Proveedor</a></li>


          </ul>
         
        </li>';
       
       }

     ?>

         
           <?php if($_SESSION["reporte_ventas"]==1)
          {
            
            echo '

         <li class="treeview">
          <a href="reporte_ventas.php">
          <i class="fa fa-pie-chart" aria-hidden="true"></i> <span>Reportes de Ventas</span>
            <span class="pull-right-container badge bg-blue">
                 <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

           <ul class="treeview-menu">
            <li><a href="reporte_general_ventas.php"><i class="fa fa-circle-o"></i>Reporte General Ventas</a></li>
            
            <li><a href="reporte_ventas_mensual.php"><i class="fa fa-circle-o"></i> Reporte Mensual Ventas</a></li>

             <li><a href="reporte_ventas_paciente.php"><i class="fa fa-circle-o"></i> Reporte Ventas-paciente</a></li>

             
          </ul>
         
        </li>';
        }

     ?>


       <?php if($_SESSION["usuarios"]==1)
          {

            echo ' 

        <li class="">
          <a href="usuarios.php">
            <i class="fa fa-user" aria-hidden="true"></i> <span>Usuarios</span>
            <span class="pull-right-container badge bg-blue">
              <i class="fa fa-bell pull-right">'.$usuario->get_filas_usuario().'</i>
            </span>
          </a>
         
        </li>';

       }

     ?>

         <!--<li class="">
          <a href="backup.php">
            <i class="fa fa-database" aria-hidden="true"></i> <span>BackUp</span>
            <span class="pull-right-container badge bg-blue">
              <i class="fa fa-bell pull-right">3</i>
            </span>
          </a>
         
        </li>-->

         <?php if($_SESSION["empresa"]==1)
          {

          echo '

        <li class="">
          <a href="" onclick="mostrar_empresa('.$_SESSION["id_usuario"].')" data-toggle="modal" data-target="#empresaModal">
            <i class="fa fa-building" aria-hidden="true"></i> <span>Empresa</span>
            
          </a>
         
        </li>';

        }

     ?>

       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div id="resultados_ajax" class="text-center"></div>


 <!--FORMULARIO PERFIL USUARIO MODAL-->

<div id="perfilModal" class="modal fade">
  <div class="modal-dialog">
    <form action="" class="form-horizontal" method="post" id="perfil_form">
      <div class="modal-content">
      
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Perfil</h4>
        </div>
        <div class="modal-body">


               <div class="form-group">
                  <label for="inputText3" class="col-lg-1 control-label">Cédula</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="cedula_perfil" name="cedula_perfil" placeholder="Cédula" required pattern="[0-9]{0,15}">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputText1" class="col-lg-1 control-label">Nombres</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="nombre_perfil" name="nombre_perfil" placeholder="Nombres" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">
                  </div>
              </div>

                <div class="form-group">
                  <label for="inputText1" class="col-lg-1 control-label">Apellidos</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="apellido_perfil" name="apellido_perfil" placeholder="Apellidos" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">
                  </div>
              </div>

              

               <div class="form-group">
                  <label for="inputText1" class="col-lg-1 control-label">Usuario</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="usuario_perfil" name="usuario_perfil" placeholder="Nombres" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">
                  </div>
              </div>


               <div class="form-group">
                  <label for="inputText3" class="col-lg-1 control-label">Password</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="password" class="form-control" id="password1_perfil" name="password1_perfil" placeholder="Password" required>
                  </div>
              </div>

               
               <div class="form-group">
                  <label for="inputText3" class="col-lg-1 control-label">Repita Password</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="password" class="form-control" id="password2_perfil" name="password2_perfil" placeholder="Repita Password" required>
                  </div>
              </div>



               <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Teléfono</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="telefono_perfil" name="telefono_perfil" placeholder="Teléfono" required pattern="[0-9]{0,15}">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Correo</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="email" class="form-control" id="email_perfil" name="email_perfil" placeholder="Correo" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputText5" class="col-lg-1 control-label">Dirección</label>
                 
                 <div class="col-lg-9 col-lg-offset-1">
                 <textarea class="form-control  col-lg-5" rows="3" id="direccion_perfil" name="direccion_perfil"  placeholder="Direccion ..." required pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$"></textarea>
                 </div>
                 
                </div>



          
          </div>
                 <!--modal-body-->

        <div class="modal-footer">
        <input type="hidden" name="id_usuario_perfil" id="id_usuario_perfil"/>
          <!--<input type="hidden" name="operation" id="operation"/>-->

          <button type="submit" name="action" id="" class="btn btn-success pull-left" value="Add"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar </button>

          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
        </div>
      </div>
    </form>
  </div>
</div>


 <!--FIN FORMULARIO PERFIL USUARIO MODAL-->

 <!--VISTA MODAL PARA EDITAR EMPRESA-->

   <?php 

     require_once("modal/empresa_modal.php");

    ?>
  <!--VISTA MODAL PARA EDITAR EMPRESA-->


 <script src="../public/bower_components/jquery/dist/jquery.min.js"></script>

 
<script type="text/javascript" src="js/perfil.js"></script> 

<script type="text/javascript" src="js/empresa.js"></script>



<?php
     
     } else {

        header("Location:".Conectar::ruta()."vistas/index.php");
        exit();
     }
  ?>