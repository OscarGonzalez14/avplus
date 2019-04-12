<?php

	  //llamo a la conexion de la base de datos 
      require_once("../config/conexion.php");
     //llamo al modelo pacientes
      require_once("../modelos/Pacientes.php");

      //llamo al modelo Ventas
     require_once("../modelos/Ventas.php");

  
     $pacientes = new Paciente();


     //declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo
   
   //los valores vienen del atributo name de los campos del formulario
   /*el valor id_usuario y cedula_paciente se carga en el campo hidden cuando se edita un registro*/
   //se copian los campos de la tabla pacientes
   $id_usuario=isset($_POST["id_usuario"]);
   $id_paciente=isset($_POST["id_paciente"]);
   $codigo = isset($_POST["codigo"]);
   $nombres=isset($_POST["nombres"]);
   $telefono=isset($_POST["telefono"]);
   $edad=isset($_POST["edad"]);
   $ocupacion=isset($_POST["ocupacion"]);
   $empresa=isset($_POST["empresa"]);
   $correo=isset($_POST["correo"]);


      switch($_GET["op"]){

           case "guardaryeditar":

	       	   /*si la cedula_paciente no existe entonces lo registra
	           importante: se debe poner el $_POST sino no funciona*/
	          //if(empty($_POST["codigo"])){

	       	  /*verificamos si la cedula del paciente en la base de datos, si ya existe un registro con el paciente entonces no se registra*/


               //importante: se debe poner el $_POST sino no funciona
               //$datos = $pacientes->get_datos_paciente($_POST["cedula"],$_POST["nombre"],$_POST["email"]);


			       	   //if(is_array($datos)==true and count($datos)==0){

			       	   	  //no existe el paciente por lo tanto hacemos el registros

		 $pacientes->registrar_paciente($codigo,$nombres,$telefono,$edad,$ocupacion,$empresa,$correo,$id_usuario);


			       	   	  $messages[]="El paciente se registró correctamente";


    
      
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

     case 'agregaConsulta':
     	$datos=$pacientes->get_pacientes();

     	foreach ($datos as $row) {
     		$output["id_paciente"]=$row["id_paciente"];
     		$output["nombres"]=$row["nombres"];
     	}

     	echo json_encode($output);


     	break;

     case 'mostrar':

    
	$datos=$pacientes->get_paciente_por_id($_POST["id_paciente"]);



    				foreach($datos as $row)
    				{
    					$output["id_paciente"] = $row["id_paciente"];
						$output["nombres"] = $row["nombres"];
						$output["codigo"] = $row["codigo"];
						
    				}




         
         echo json_encode($output);


	 break;

      case "activarydesactivar":
     
     //los parametros id_paciente y est vienen por via ajax
     $datos=$pacientes->get_paciente_por_id($_POST["id_paciente"]);

          // si existe el id del paciente entonces recorre el array
	      if(is_array($datos)==true and count($datos)>0){

              //edita el estado del paciente
		      $pacientes->editar_estado($_POST["id_paciente"],$_POST["est"]);
		     
	        } 

     break;

     case "listar":

     $datos=$pacientes->get_pacientes();

     //Vamos a declarar un array
 	 $data= Array();

     foreach($datos as $row)

			{
				$sub_array = array();


				
			
	             $sub_array[] = $row["codigo"];
				 $sub_array[] = $row["nombres"];
				 $sub_array[] = $row["telefono"];
				 $sub_array[] = $row["correo"];
				 $sub_array[] = date("d-m-Y",strtotime($row["fecha_reg"]));
            
               $sub_array[] = '<button type="button" onClick="mostrarc('.$row["id_paciente"].');" id="'.$row["id_paciente"].'" class="btn btn-infos btn-md"><i class="fa fa-hospital-o" aria-hidden="true"></i> Agregar Consulta</button>';

                 
                 $sub_array[] = '<button type="button" onClick="editar('.$row["id_paciente"].');" id="'.$row["id_paciente"].'" class="btn btn-edit btn-md"><i class="glyphicon glyphicon-edit"></i> Editar</button>';


                 $sub_array[] = '<button type="button" onClick="eliminar('.$row["id_paciente"].');" id="'.$row["id_paciente"].'" class="btn btn-dark btn-md"><i class="glyphicon glyphicon-remove"></i> Eliminar</button>';
                
				$data[] = $sub_array;
			}

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


     break;

      /*se muestran en ventana modal el datatable de los pacientes en ventas para seleccionar luego los pacientes activos y luego se autocomplementa los campos de un formulario*/
     case "listar_en_ventas":

     $datos=$pacientes->get_pacientes();

     //Vamos a declarar un array
 	 $data= Array();

     foreach($datos as $row)
			{
				$sub_array = array();

				$est = '';
				
				 $atrib = "btn btn-success btn-md estado";
				if($row["estado"] == 0){
					$est = 'INACTIVO';
					$atrib = "btn btn-warning btn-md estado";
				}
				else{
					if($row["estado"] == 1){
						$est = 'ACTIVO';
						
					}	
				}
				
				
	             $sub_array[] = $row["cedula_paciente"];
				 $sub_array[] = $row["nombre_paciente"];
				 $sub_array[] = $row["apellido_paciente"];
				 
				
                 $sub_array[] = '<button type="button"  name="estado" id="'.$row["id_paciente"].'" class="'.$atrib.'">'.$est.'</button>';


                 $sub_array[] = '<button type="button" onClick="agregar_registro('.$row["id_paciente"].','.$row["estado"].');" id="'.$row["id_paciente"].'" class="btn btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>';
                
				$data[] = $sub_array;
			}

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


     break;


     /*valida los pacientes activos y se muestran en un formulario*/
     case "buscar_paciente":


	$datos=$pacientes->get_paciente_por_id_estado($_POST["id_paciente"],$_POST["est"]);


          // comprobamos que el paciente esté activo, de lo contrario no lo agrega
	      if(is_array($datos)==true and count($datos)>0){

				foreach($datos as $row)
				{
					$output["cedula_paciente"] = $row["cedula_paciente"];
					$output["nombre"] = $row["nombre_paciente"];
					$output["apellido"] = $row["apellido_paciente"];
					$output["direccion"] = $row["direccion_paciente"];
					$output["estado"] = $row["estado"];
					
				}

			

	        } else {
                 
                 //si no existe el registro entonces no recorre el array
                
                 $output["error"]="El paciente seleccionado está inactivo, intenta con otro";


	        }

	        echo json_encode($output);

     break;

     case "eliminar_paciente":

        	 
  //IMPORTANTE:normalmente las compras y ventas no se pude eliminar pero aqui le estamos aplicando seguridad en PHP para tener mas seguridad con los haquers
        //verificamos si el paciente existe en la tabla ventas y detalle_ventas, si existe entonces no se puede eliminar el paciente

        //$ventas = new Ventas();

        //$vent= $ventas->get_ventas_por_id_paciente($_POST["id_paciente"]);

        //$detalle_vent= $ventas->get_detalle_ventas_por_id_paciente($_POST["id_paciente"]);

        
        //if(is_array($vent)==true and count($vent)>0 && is_array($detalle_vent)==true and count($detalle_vent)>0){


        	   //si existe el paciente en ventas y detalle_ventas entonces no lo elimina
					
					
			    //$//errors[]="El paciente existe en ventas y en detalle ventas, no se puede eliminar";


   	    //}//fin

   	    //else{

            
             //validamos si existe el registro en la bd
            $datos= $pacientes->get_paciente_por_id($_POST["id_paciente"]);


		       if(is_array($datos)==true and count($datos)>0){

		            $pacientes->eliminar_paciente($_POST["id_paciente"]);

		            $messages[]="El paciente se eliminó exitosamente";

		       
		       }
		      
   	 // }




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

	   //fin de mensaje de error


     break;


	 	
	 }
  


   ?>