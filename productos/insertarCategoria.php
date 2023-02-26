  
  <?php
 // print_r($_REQUEST);
  
  include ("../seguridad.php");
  include_once ("../funciones.php"); 


  $nombreCorrecto = true;
  $descripcionCorrecto = true;
  $idCorrecto = true;

  
    //Comprobar que existe ID
    if(!empty($_REQUEST['id'])){
        $id = $_REQUEST['id'];
      }else{
          $idCorrecto = false;
      }  
      
    //comprobar si existe el id en la base de datos 
    $con = conectar_db("electricidad_fcv");
    $sentencia = $con->prepare("SELECT * FROM categoria WHERE id like :id");
    $resultado = $sentencia->execute([':id'=>$id]); 
    $fila = $sentencia->rowCount();

    if($fila == 1){
        $idCorrecto =false;
    }

    // Comprobar que existe el nombre

    if(!empty($_REQUEST['nombre'])){
      $nombre = $_REQUEST['nombre'];
    }else{
        $nombreCorrecto = false;
    }

    
    // Comprobar que existe descripción

    if(!empty($_REQUEST['descripcion'])){        
        $descripcion = $_REQUEST['descripcion'];
     }else{
        $descripcionCorrecto = false;
     }

    
        // Si todos los campos son correcto insertar datos en tabla

        if ( $nombreCorrecto == true && $descripcionCorrecto == true && $idCorrecto == true){

             // Con esta sentencia SQL insertaremos los datos en la base de datos
            $con = conectar_db("electricidad_fcv");
            $sentencia = $con->prepare("INSERT INTO categoria(id,nombre,descripcion) VALUES (:id,:nombre,:descripcion);");

            // Ahora ejecutamos la consulta y comprobaremos que todo ha ido correctamente
            if($sentencia->execute(array(':id'=>$id,':nombre'=>$nombre,':descripcion'=> $descripcion))){                                
                    
                    header("location:../listaCategorias.php");   

                }
                else{
                    $error = "Error al intentar insertar los datos";
                    header("location:../listaCategorias.php?error=$error");
                }

        }else{
            $error = "Faltan datos o son incorrectos, vuelva a introducirlos";
            header("location:../altaCategoria.php?error=$error&nombre=$nombre&descrip=$descripcion&id=$id");
        }

    
    if(isset ($_REQUEST['btnVolver'])){

        header("location:../listaCategorias.php");
    }
    
 ?>   