<?php
  
     //conexión a la base de datos

   require_once("../config/conexion.php");

   class Consulta extends Conectar{


    public function get_consultas(){

           $conectar= parent::conexion();
       
          $sql= "select c.fecha_reg,c.id_consulta,p.nombres,c.sugeridos,c.diagnostico,u.usuario 
from usuarios as u inner join consulta as c on u.id_usuario=c.id_usuario inner join pacientes as p on c.id_paciente=p.id_paciente;
             

           ";

           $sql=$conectar->prepare($sql);

           $sql->execute();

           return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

         
         }

       public function get_detalle_consultas($id_consulta){

          $conectar=parent::conexion();
           parent::set_names();

          $sql="select p.codigo,p.nombres,u.usuario,c.id_consulta,c.motivo,c.patologias,c.id_paciente,c.id_usuario,c.fecha_reg,c.oiesfreasl,c.oicilindrosl,c.oiejesl,c.oiprismal,c.oiadicionl,c.odesferasl,c.odcilndrosl,c.odejesl,c.odprismal,c.odadicionl,c.oiesferasa,c.oicolindrosa,c.oiejesa,c.oiprismaa,c.oiadiciona,c.odesferasa,c.odcilindrosa,c.odejesa ,c.dprismaa,c.oddiciona,c.sugeridos,c.diagnostico,c.medicamento,c.observaciones,c.oiesferasf,c.oicolindrosf,c.oiejesf,c.oiprismaf,c.oiadicionf,c.odesferasf,c.odcilindrosf,c.odejesf,c.dprismaf,c.oddicionf from usuarios as u inner join consulta as c on u.id_usuario=c.id_usuario inner join pacientes as p on c.id_paciente=p.id_paciente where id_consulta=?;";

          //echo $sql; exit();

          $sql=$conectar->prepare($sql);
              

          $sql->bindValue(1,$id_consulta);
          $sql->execute();
          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

       
            
       }


        public function registrar_consulta($motivo,$patologias,$id_paciente){


            $conectar=parent::conexion();
            parent::set_names();
           
            $sql="insert into consulta
            values(null,?,?,?);";


            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $_POST["motivo"]);
            $sql->bindValue(2, $_POST["patologias"]);
            $sql->bindValue(3, $_POST["id_paciente"]);            
           
            $sql->execute();

           

        }


         //obtiene el registro por id despues de editar
        public function get_producto_por_id($id_producto){

          $conectar= parent::conexion();

          //$output = array();

            $sql="select * from producto where id_producto=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_producto);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


        }


         /*metodo que valida si hay registros activos*/
        public function get_producto_por_id_modelo($id_producto,$modelo){

           $conectar= parent::conexion();




            $sql="select * from producto where id_producto=? and modelo=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_producto);
            $sql->bindValue(2, $modelo);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


    }


    //método para editar producto

    public function editar_producto($id_producto,$modelo,$marca,$color,$medidas,$precio_venta,$stock,$id_usuario){

      $conectar=parent::conexion();
      parent::set_names();
                
                $sql="update producto set 
                       modelo=?,
                       marca=?,
                       color=?,
                       precio_venta=?,
                       stock=?,
                       medidas=?,
                       id_usuario=?
                       where 
                       id_producto=?
                ";

                $sql=$conectar->prepare($sql);

                $sql->bindValue(1, $_POST["modelo"]);
                $sql->bindValue(2, $_POST["marca"]);
                $sql->bindValue(3, $_POST["color"]);
                $sql->bindValue(4, $_POST["precio_venta"]);
                $sql->bindValue(5, $_POST["stock"]);
                $sql->bindValue(6, $_POST["medidas"]);
                $sql->bindValue(7, $_POST["id_usuario"]);

                $sql->bindValue(8, $_POST["id_producto"]);
                $sql->execute();




    }


      
        //método para activar Y/0 desactivar el estado del producto

             public function editar_estado($id_producto,$estado){

              $conectar=parent::conexion();
              parent::set_names();
                    
              //si estado es igual a 0 entonces lo cambia a 1
              //el parametro est viene por via ajax, viene de est:est
              $estado = 0;
              if($_POST["est"] == 0){
                $estado = 1;
              }


              $sql="update producto set 
                    
                    estado=?
                    where 
                    id_producto=?
                      ";

                    $sql=$conectar->prepare($sql);

                    $sql->bindValue(1, $estado);
                    $sql->bindValue(2, $id_producto);
                    $sql->execute();

                   
          }


          public function get_producto_nombre($producto){

              $conectar=parent::conexion();

              $sql= "select * from producto where producto=?";

              $sql=$conectar->prepare($sql);

              $sql->bindValue(1, $producto);
              $sql->execute();
              return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }


        //editar estado del producto por categoria

    public function editar_estado_producto_por_categoria($id_categoria,$estado){

      $conectar=parent::conexion();
      parent::set_names();
            
            //si estado es igual a 0 entonces lo cambia a 1
      $estado = 0;
      //el parametro est se envia por via ajax, viene del $est:est
      if($_POST["est"] == 0){
        $estado = 1;
      }


      $sql="update producto set 
            
            estado=?
            where 
            id_categoria=?
              ";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $estado);
            $sql->bindValue(2, $id_categoria);
            $sql->execute();

            
    }


       //editar estado de la categoria por producto

        public function editar_estado_categoria_por_producto($id_categoria,$estado){

          $conectar=parent::conexion();
          parent::set_names();
          

             //si es inactivo entonces la categoria pasa a activo
          if($_POST["est"] == 0){



            $sql="update categoria set 
                
                estado=?
                where 
                id_categoria=?
                  ";

                $sql=$conectar->prepare($sql);

                $sql->bindValue(1, 1);
                $sql->bindValue(2, $id_categoria);
                $sql->execute();

               

           }

          
    }


        //metodo para consultar si la tabla productos tiene registros asociados con categorias
         public function get_prod_por_id_cat($id_categoria){

      $conectar= parent::conexion();

      //$output = array();

      $sql="select * from producto where id_categoria=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_categoria);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

          
          }


                 //consulta si el id del producto con tiene un detalle_compra asociado
    public function get_producto_por_id_detalle_compra($id_producto){

             
             $conectar=parent::conexion();
             parent::set_names();


      $sql="select p.id_producto,p.modelo,c.id_producto, c.modelo as modelo_compra from producto p INNER JOIN detalle_compras c ON p.id_producto=c.id_producto where p.id_producto=?;

              ";

             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,$id_producto);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

      }


       //consulta si el id del producto con tiene un detalle_venta asociado
    public function get_producto_por_id_detalle_venta($id_producto){

             
             $conectar=parent::conexion();
             parent::set_names();



              $sql="select p.id_producto,p.producto, v.id_producto, v.producto as producto_ventas
                 
           from producto p 
              
              INNER JOIN detalle_ventas v ON p.id_producto=v.id_producto

              where p.id_producto=?

              ";

             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,$id_producto);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

      }

        public function eliminar_producto($id_producto){

        $conectar=parent::conexion();

              $sql="delete from producto where id_producto=?";

              $sql=$conectar->prepare($sql);

              $sql->bindValue(1, $id_producto);
              $sql->execute();

              return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
      }
        
        public function get_producto_por_id_usuario($id_usuario){

        $conectar= parent::conexion();

        //$output = array();

        $sql="select * from producto where id_usuario=?";

              $sql=$conectar->prepare($sql);

              $sql->bindValue(1, $id_usuario);
              $sql->execute();

              return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


      }

   	
   }



?>
