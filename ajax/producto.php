<?php

  //llamo a la conexion de la base de datos 
  require_once("../config/conexion.php");
  //llamo al modelo Producto
  require_once("../modelos/Productos.php");

  $productos = new Producto();

      //declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo
   
   //los valores vienen del atributo name de los campos del formulario
   /*el valor id_producto, id_categoria y id_usuario se carga en el campo hidden cuando se edita un registro*/
   
   $id_producto=isset($_POST["id_producto"]);
   $modelo=isset($_POST["modelo"]);
   $id_usuario=isset($_POST["id_usuario"]);
   $marca=isset($_POST["marca"]);
   $color=isset($_POST["color"]);
   $medidas=isset($_POST["medidas"]);
   $precio_venta=isset($_POST["precio_venta"]);
   $stock=isset($_POST["stock"]);

        

         switch($_GET["op"]){

              case "guardaryeditar":

           	   /*si el id no existe entonces lo registra
	           importante: se debe poner el $_POST sino no funciona*/
	          if(empty($_POST["id_producto"])){

	       	  /*verificamos si existe el producto en la base de datos, si ya existe un registro con la categoria entonces no se registra*/

	       	    //importante: se debe poner el $_POST sino no funciona
              $datos = $productos->get_producto_nombre($_POST["modelo"]);


			       	   if(is_array($datos)==true and count($datos)==0){

			       	   	  //no existe el producto por lo tanto hacemos el registros

			$productos->registrar_producto($modelo,$marca,$color,$medidas,$precio_venta,$stock,$id_usuario);



			       	   	  $messages[]="El producto se registró correctamente";

			       	   } //cierre de validacion de $datos 


			       	      /*si ya existe el producto entonces aparece el mensaje*/
				              else {

				              	  $errors[]="El producto ya existe";
				              }

			    }//cierre de empty

	            else {


	            	/*si ya existe entonces editamos el producto*/


	             $productos->editar_producto($id_producto,$modelo,$marca,$color,$medidas,$precio_venta,$stock,$id_usuario);


	            	  $messages[]="El producto se editó correctamente";

	            	 
	            }

    
      
     //mensaje success
     if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
	 //fin success

	 //mensaje error
         if (isset($errors)){
			
			?>
				<div class="alert alert-danger" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Error!</strong> 
						<?php
							foreach ($errors as $error) {
									echo $error;
								}
							?>
				</div>
			<?php

			}

	 //fin mensaje error


     break;


     case 'mostrar':

	//selecciona el id del producto
    
    //el parametro id_producto se envia por AJAX cuando se edita el producto
	$datos=$productos->get_producto_por_id($_POST["id_producto"]);


                
				foreach($datos as $row)
				{
					$output["producto_id"] = $row["id_producto"];
					$output["marca"] = $row["marca"];
					$output["modelo"] = $row["modelo"];
					$output["color"] = $row["color"];
					$output["precio_venta"] = $row["precio_venta"];
					$output["stock"] = $row["stock"];
					$output["medidas"] = $row["medidas"];
					
				}



            echo json_encode($output);


	 break;

	     case "activarydesactivar":
     
     //los parametros id_producto y est vienen por via ajax
     $datos=$productos->get_producto_por_id($_POST["id_producto"]);

          // si existe el id del producto entonces recorre el array
	      if(is_array($datos)==true and count($datos)>0){

              //edita el estado del producto
		      $productos->editar_estado($_POST["id_producto"],$_POST["est"]);


		       //editar estado de la categoria por producto

		    $productos->editar_estado_categoria_por_producto($_POST["id_categoria"],$_POST["est"]);

		
		     
	        } 

     break;

        case "listar":

     $datos=$productos->get_productos();

     //Vamos a declarar un array
 	 $data= Array();

     foreach($datos as $row)
			{
				$sub_array = array();

			

				  if($row["stock"]<=5){
                      
                     $stock = $row["stock"];
                     $atributo = "badge bg-red-active";
                            
				 
				  } else {

				     $stock = $row["stock"];
                     $atributo = "badge bg-green";
                 
                 }


			
				//$sub_array = array();
				$sub_array[] = $row["modelo"];
				$sub_array[] = $row["marca"];
				$sub_array[] = $row["color"];
				$sub_array[] = '$'.' '.$row["precio_venta"];
				$sub_array[] = '<span class="'.$atributo.'">'.$row["stock"].'
                  </span>';
				$sub_array[] = $row["medidas"];


				$sub_array[] = '<button type="button" onClick="mostrar('.$row["id_producto"].');" id="'.$row["id_producto"].'" class="btn btn-infos btn-md"><i class="glyphicon glyphicon-edit"></i> Editar</button>';


				
				$sub_array[] = '<button type="button" onClick="eliminar('.$row["id_producto"].');" id="'.$row["id_producto"].'" class="btn btn-dark btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';
              
         
			

				$data[] = $sub_array;
			 
			 }


      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


     break;

      case "listar_en_compras":

    $datos=$productos->get_productos();

     //Vamos a declarar un array
 	 $data= Array();

    foreach($datos as $row)
			{
				$sub_array = array();



				  //STOCK, si es menor de 10 se pone rojo sino se pone verde
				  $stock=""; 

				  if($row["stock"]<=5){
                      
                     $stock = $row["stock"];
                     $atributo = "badge bg-red-active";
                            
				 
				  } else {

				     $stock = $row["stock"];
                     $atributo = "badge bg-green";
                 
                 }


                 //moneda

                //$moneda = $row[""];

				
				//$sub_array = array();
				$sub_array[] = $row["modelo"];
				$sub_array[] = $row["marca"];
				$sub_array[] = $row["color"];
				//$sub_array[] = $row["precio_venta"];
                $sub_array[] = '<span class="'.$atributo.'">'.$row["stock"].'
                  </span>';

				

				
               
			$sub_array[] = '<button type="button" name="" id="'.$row["id_producto"].'" class="btn btn-primary btn-md " onClick="agregarDetalle('.$row["id_producto"].')"><i class="fa fa-plus"></i> Agregar</button>';
                
			

				$data[] = $sub_array;
			 
			 }


      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


     break;


     case "buscar_producto";
          
          $datos=$productos->get_producto_por_id($_POST["id_producto"]);

            /*comprobamos que el producto esté activo, de lo contrario no lo agrega
	      if(is_array($datos)==true and count($datos)>0){*/

				foreach($datos as $row)
				{
					
					$output["id_producto"] = $row["id_producto"];
					$output["modelo"] = $row["modelo"];
					$output["marca"] = $row["marca"];
					$output["color"] = $row["color"];
					//$output["precio_venta"] = $row["precio_venta"];
					$output["stock"] = $row["stock"];
				     
					
					
				}
		


	        echo json_encode($output);

     break;

     case "registrar_compra";

        //se llama al modelo Compras.php

        require_once('../modelos/Compras.php');

	    $compra = new Compras();

	    $compra->agrega_detalle_compra();



     break;


     /****************VENTAS*******************************/

       case "listar_en_ventas":

     $datos=$productos->get_productos_en_ventas();

     //Vamos a declarar un array
 	 $data= Array();

    foreach($datos as $row)
			{
				$sub_array = array();

				$est = '';
				//$atrib = 'activo';
				 $atrib = "btn btn-success btn-md estado";
				if($row["estado"] == 0){
					$est = 'INACTIVO';
					$atrib = "btn btn-warning btn-md estado";
				}
				else{
					if($row["estado"] == 1){
						$est = 'ACTIVO';
						//$atrib = '';
					}	
				}

				  //STOCK, si es mejor de 10 se pone rojo sino se pone verde
				  $stock=""; 

				  if($row["stock"]<=10){
                      
                     $stock = $row["stock"];
                     $atributo = "badge bg-red-active";
                            
				 
				  } else {

				     $stock = $row["stock"];
                     $atributo = "badge bg-green";
                 
                 }

                


                 //moneda

                 $moneda = $row["moneda"];

				
				//$sub_array = array();
				$sub_array[] = $row["categoria"];
				$sub_array[] = $row["producto"];
				$sub_array[] = $row["presentacion"];
				$sub_array[] = $row["unidad"];
				$sub_array[] = $moneda." ".$row["precio_compra"];
				$sub_array[] = $moneda." ".$row["precio_venta"];

				$sub_array[] = '<span class="'.$atributo.'">'.$row["stock"].'
                  </span>';

               

				$sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["id_producto"].','.$row["estado"].');" name="estado" id="'.$row["id_producto"].'" class="'.$atrib.'">'.$est.'</button>';

               

               /*declaro la variable fecha*/
               $fecha= date("d-m-Y", strtotime($row["fecha_vencimiento"]));				


				if($row["imagen"] != '')
					{
						$sub_array[] = '

		 <img src="upload/'.$row["imagen"].'" class="img-thumbnail" width="100" height="100" /><input type="hidden" name="hidden_producto_imagen" value="'.$row["imagen"].'" />

         <span><i class="fa fa-calendar" aria-hidden="true"></i>  '.$fecha.' <br/><strong>(vencimiento)</strong></span> 



						';
					}
					else
					{
						

				$sub_array[] = '<button type="button" id="" class="btn btn-primary btn-md"><i class="fa fa-picture-o" aria-hidden="true"></i> Sin imagen</button>';
					}
               			
				

			$sub_array[] = '<button type="button" name="" id="'.$row["id_producto"].'" class="btn btn-primary btn-md " onClick="agregarDetalleVenta('.$row["id_producto"].',\''.$row["producto"].'\','.$row["estado"].')"><i class="fa fa-plus"></i> Agregar</button>';
        
			

				$data[] = $sub_array;
			 
			 }


      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


     break;

      case "buscar_producto_en_venta":
          
          $datos=$productos->get_producto_por_id_estado($_POST["id_producto"], $_POST["estado"]);

            /*comprobamos que el producto esté activo, de lo contrario no lo agrega*/
	      if(is_array($datos)==true and count($datos)>0){

				foreach($datos as $row)
				{
					$output["id_producto"] = $row["id_producto"];
					$output["producto"] = $row["producto"];
					$output["moneda"] = $row["moneda"];
					$output["precio_venta"] = $row["precio_venta"];
					$output["stock"] = $row["stock"];
					$output["estado"] = $row["estado"];
					
				}
		
		     


	        } else {
                 
                 //si no existe el registro entonces no recorre el array
                 $output["error"]="El producto seleccionado está inactivo, intenta con otro";

	        }

	        echo json_encode($output);

     break;

     case "registrar_venta";

        //se llama al modelo Ventas.php

        require_once('../modelos/Ventas.php');

	    $venta = new Ventas();

	    $venta->agrega_detalle_venta();



     break;


     case "eliminar_producto":

case "eliminar_producto":


        //verificamos si el producto existe en la bd y si el stock es igual a 0

        $datos= $productos->get_producto_por_id($_POST["id_producto"]);

          

            //verifica si el id_producto tiene registro asociado a detalle_compra
	      $producto_detalle_compra=$productos->get_producto_por_id_detalle_compra($_POST["id_producto"]);

       
  
          
	       //si no hay productos en detalle_compras y en detalle_ventas entonces se elimina el producto
            if(is_array($datos)==true and count($datos)>0 and is_array($producto_detalle_compra)==true and count($producto_detalle_compra)==0){

            	
	        	$productos->eliminar_producto($_POST["id_producto"]);

					
			    $messages[]="El producto se eliminó correctamente";
                

            } 

            else {

            	
   	  	         $errors[]="El producto no se puede eliminar por que tiene ingresos Asociados y el Stock es mayor a cero";
            }

        
       

	//prueba mensaje de success

     if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}


	//fin mensaje success


	   //inicio de mensaje de error

				if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}


     break;
  	
       }

?>