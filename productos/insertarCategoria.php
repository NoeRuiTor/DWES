  
  <?php
  include ("../seguridad.php");
  include_once ("../funciones.php"); 


  $nombreCorrecto = true;
  $descripcionCorrecto = true;
  

  if(isset($_REQUEST['enviar'])){   

    // Comprobar que existe el nombre

    if(isset($_REQUEST['nombre'])){
      $nombre = $_REQUEST['nombre'];
    }else{
        $nombreCorrecto = false;
    }

    
    // Comprobar que existe descripción

    if(isset($_REQUEST['descripcion'])){        
        $descripcion = $_REQUEST['descripcion'];
     }else{
        $descripcionCorrecto = false;
     }

    
        // Si todos los campos son correcto insertar datos en tabla

        if ( $nombreCorrecto == true && $descripcionCorrecto == true){

             // Con esta sentencia SQL insertaremos los datos en la base de datos
            $con = conectar_db("electricidad_fcv");
            $sentencia = $con->prepare("INSERT INTO categoria(nombre,descripcion) VALUES (:nombre,:descripcion;");

            // Ahora ejecutamos la consulta y comprobaremos que todo ha ido correctamente
            if($sentencia->execute(array(':nombre'=>$nombre,':descripcion'=> $descripcion))){                                
                    
                    header("location:../listaCategorias.php");   

                }
                else{
                    $error = "Error al intentar insertar los datos";
                    header("location:../listaCategorias.php?error=$error");
                }

        }else{
            $error = "Faltan datos o son incorrectos, vuelva a introducirlos";
            header("location:../altaCategorias.php?error=$error&nombre=$nombre&descrip=$descripcion");
        }

    }
    if(isset ($_REQUEST['btnVolver'])){

        header("location:../listaCategorias.php");
    }
    