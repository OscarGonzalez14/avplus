<?php
  
     //conexión a la base de datos

   require_once("../config/conexion.php");

   class Producto extends Conectar{


       public function get_filas_producto(){

             $conectar= parent::conexion();
           
             $sql="select * from producto";
             
             $sql=$conectar->prepare($sql);

             $sql->execute();

             $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

             return $sql->rowCount();
        
        }

          
      //método para seleccionar registros

   	  public function get_productos(){

           $conectar= parent::conexion();
       
          $sql= "select*from producto";

           $sql=$conectar->prepare($sql);

           $sql->execute();

           return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

         
         }

          //método para seleccionar registros

      public function get_productos_en_ventas(){

           $conectar= parent::conexion();
       
          $sql= "select p.id_producto,p.id_categoria,p.producto,p.presentacion,p.unidad, p.moneda, p.precio_compra, p.precio_venta, p.stock, p.estado, p.imagen, p.fecha_vencimiento as fecha_vencimiento,c.id_categoria, c.categoria as categoria
           
           from producto p 
              
              INNER JOIN categoria c ON p.id_categoria=c.id_categoria


              where p.stock > 0 and p.estado='1'
             

           ";

           $sql=$conectar->prepare($sql);

           $sql->execute();

           return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

         
         }


           /*poner la ruta vistas/upload*/
         public function upload_image() {

            if(isset($_FILES["producto_imagen"]))
            {
              $extension = explode('.', $_FILES['producto_imagen']['name']);
              $new_name = rand() . '.' . $extension[1];
              $destination = '../vistas/upload/' . $new_name;
              move_uploaded_file($_FILES['producto_imagen']['tmp_name'], $destination);
              return $new_name;
            }


          }


          //método para insertar registros

        public function registrar_producto($modelo,$marca,$color,$precio_venta,$stock,$id_usuario,$medidas){


            $conectar=parent::conexion();
            parent::set_names();
           
            $sql="insert into producto
            values(null,?,?,?,?,?,?,?);";


            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $_POST["modelo"]);
            $sql->bindValue(2, $_POST["marca"]);
            $sql->bindValue(3, $_POST["color"]);            
            $sql->bindValue(4, $_POST["precio_venta"]);
            $sql->bindValue(5, $_POST["stock"]);
            $sql->bindValue(6, $_POST["id_usuario"]);
            $sql->bindValue(7, $_POST["medidas"]);
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
        public function get_producto_por_modelo($modelo){

           $conectar= parent::conexion();


            $sql="select * from producto where modelo=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $modelo);
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
