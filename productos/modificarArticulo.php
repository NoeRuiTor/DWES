<?php

 
  include ("../seguridad.php");
  include_once ("../funciones.php"); 
  
  
  $imagenCorrecta = true;
  $datosCorrectos = true;
 

  if(isset($_REQUEST['modificar'])){
    $id = $_REQUEST['id'];
    $nombre = $_REQUEST['nombre'];
    $descripcion = $_REQUEST['descripcion'];
    $id_categoria = $_REQUEST['id_categoria'];
    $precio = $_REQUEST['precio'];
    $imagen = $_FILES['img'];
    $estado = $_REQUEST['estado'];
    $stock = $_REQUEST['stock'];
    
    // Comprobar que existe el nombre

    if(empty($nombre)){
        $datosCorrectos = false;
    }

    
    // Comprobar que existe descripción

    if(empty($descripcion)){      
       
        $datosCorrectos = false;
     }

    //Comprobar que existe categoría y que es una de las categorías existentes
    
    if(isset($id_categoria)){
       
        if($id_categoria == '1'|| $id_categoria == '2' || $id_categoria == '3'){
            $datosCorrectos;
        }else{
                $datosCorrectos = false;
        }
     }else{
            $datosCorrectos = false;
     }

     //Comprobar que existe precio y que es el formato correcto
    if(empty($precio)){       
        $datosCorrectos = false;
    }

            //Comprobar que existe imagen y tiene el formato correcto jpg, jpeg, gif o png. No debe tener más de 300 kb y un tamaño máximo de 200x200.
                    
    if( !empty($_FILES['img']) && $_FILES['img']['size']>0){
         $imagenCorrecta; 

            $temp = $_FILES['img']['tmp_name'];
            $nombreArchivo=$_FILES['img']['name'];
            $imagen = "imgs/articulos/".$nombreArchivo;

            
            //Comprobar que no excede de 300kb
            
            if($_FILES['img']['size'] >3000000){
                $imagenCorrecta == false;
            }

            // Comprobar que es imagen
            list($ancho, $alto, $tipos, $atributos) = getimagesize($temp);
                if($tipos == 1 || $tipos == 2 || $tipos == 3){
                    $imagenCorrecta == true;    
                }else{
                    $imagenCorrecta = false;
                }

            //Comprobar el tamaño

            if($ancho > 250 || $alto > 350){
                $imagenCorrecta = false;
            }

            // Si todo es correcto guardar imagen
            if($imagenCorrecta == true){       
                    move_uploaded_file($temp,$imagen);
                    
            }
        }else{
            $imagenCorrecta = false;
         }

          //comprobar que existe estado y es correcto
          if(isset($_REQUEST['estado'])){
            
            if($estado == 'alta'|| $estado == 'baja'){
                $datosCorrectos;
            }else{
                $datosCorrectos = false;
            }
         }else{
            $datosCorrectos = false;
         }
         //Comprobar que existe stock y es correcto
         if(empty($_REQUEST['stock'])){           
        
            $datosCorrectos = false;
        }

        // Si todos los campos son correcto insertar datos en tabla

        if ($datosCorrectos == true && $imagenCorrecta == true){

            //Si existen conectamos con base de datos y modificamos los datos
        
            $con = conectar_db("electricidad_fcv");
            $sentencia = $con->prepare ("UPDATE articulos SET nombre=:nombre, descripcion=:descripcion, id_categoria=:id_categoria, precio=:precio,
                                        stock=:stock, imagen=:imagen, estado=:estado  WHERE id like :id;");
             if($sentencia -> execute(array(':nombre' => $nombre, ':descripcion' => $descripcion, ':id_categoria' => $id_categoria, 
                                     ':precio' => $precio,':stock'=>$stock,':imagen' => $imagen, ':estado'=>$estado, ':id' => $id))){            
           
                header("location:../listaArticulos.php");
            
            
             }else{
                    $error = "Error al modificar los datos";
                    header("location:../listaArticulos.php?error=$error");
             }

        }else{
            $error = "Faltan datos o son incorrectos, vuelva a introducirlos";
            header("location:../listaArticulos.php?error=$error&datosCorrectos=$datosCorrectos&imagenCorrecta=$imagenCorrecta");
        }

    
}if(isset ($_REQUEST['btnCancelar'])){

    header("location:../listaArticulos.php");

} 


?>