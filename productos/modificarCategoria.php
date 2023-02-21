<?php

 
  include ("../seguridad.php");
  include_once ("../funciones.php"); 
  
  
 
  
    $datosCorrectos=true;

  if(isset($_REQUEST['modificar'])){
    $id = $_REQUEST['id'];
    $nombre = $_REQUEST['nombre'];
    $descripcion = $_REQUEST['descripcion'];
    
    
    // Comprobar que existe el nombre

    if(empty($nombre)){
        $datosCorrectos = false;
    }

    
    // Comprobar que existe descripción

    if(empty($descripcion)){      
       
        $datosCorrectos = false;
     }

        // Si todos los campos son correcto insertar datos en tabla

        if ($datosCorrectos == true){

            //Si existen conectamos con base de datos y modificamos los datos
        
            $con = conectar_db("electricidad_fcv");
            $sentencia = $con->prepare ("UPDATE categoria SET nombre=:nombre, descripcion=:descripcion WHERE id like :id;");
             if($sentencia -> execute(array(':nombre' => $nombre, ':descripcion' => $descripcion,':id' => $id))){            
           
                header("location:../listaCategorias.php");
            
            
             }else{
                    $error = "Error al modificar los datos";
                    header("location:../listaCategorias.php?error=$error");
             }

        }else{
            $error = "Faltan datos o son incorrectos, vuelva a introducirlos";
            header("location:../listaCategorias.php?error=$error&datosCorrectos=$datosCorrectos");
        }

    
}if(isset ($_REQUEST['btnCancelar'])){

    header("location:../listaCategorias.php");

} 


?>