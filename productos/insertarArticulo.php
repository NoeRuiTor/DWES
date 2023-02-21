<?php
  include ("../seguridad.php");
  include_once ("../funciones.php"); 


  $nombreCorrecto = true;
  $descripcionCorrecto = true;
  $categoriaCorrecta = true;
  $precioCorrecto = true;
  $imagenCorrecta = true;
  $estadoCorrecto = true;
  $stockCorrecto = true;

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

    //Comprobar que existe categoría y que es una de las categorías existentes
    
    if(isset($_REQUEST['id_categoria'])){
        $categoria = $_REQUEST['id_categoria'];
        if($categoria == '1'|| $categoria == '2' || $categoria == '3' ){
            $categoriaCorrecta;
        }else{
            $categoriaCorrecta = false;
        }
     }else{
        $categoriaCorrecta = false;
     }

     //Comprobar que existe precio y que es el formato correcto
    if(isset($_REQUEST['precio'])){
        $precio = $_REQUEST['precio'];
        $precio = number_format($precio);
    }else{
        $precioCorrecto = false;
    }

    //Comprobar que existe imagen y tiene el formato correcto jpg, jpeg, gif o png. No debe tener más de 300 kb y un tamaño máximo de 200x200.
        
        
        $temp = $_FILES['img']['tmp_name'];
        $nombreArchivo=$_FILES['img']['name'];
        $imagen = "imgs/articulos/".$nombreArchivo;

        if( !empty($_FILES['img']) && $_FILES['img']['size']>0){
           $imagenCorrecta;
        }else{
           $imagenCorrecta = false;
        }
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
        
         //comprobar que existe estado y es correcto
         if(isset($_REQUEST['estado'])){
            $estado = $_REQUEST['estado'];
            if($estado == 'alta'|| $estado == 'baja'){
                $estadoCorrecto;
            }else{
                $estadoCorrecto = false;
            }
         }else{
            $estadoCorrecto = false;
         }
         //Comprobar que existe stock y es correcto
         if(isset($_REQUEST['stock'])){
            $stock = $_REQUEST['stock'];
            $stock = number_format($stock);
        }else{
            $stockCorrecto = false;
        }

        // Si todos los campos son correcto insertar datos en tabla

        if ($estadoCorrecto == true && $nombreCorrecto == true && $descripcionCorrecto == true && $categoriaCorrecta == true &&
                $precioCorrecto == true && $imagenCorrecta == true &&$stockCorrecto==true){

             // Con esta sentencia SQL insertaremos los datos en la base de datos
            $con = conectar_db("electricidad_fcv");
            $sentencia = $con->prepare("INSERT INTO articulos(nombre,descripcion,imagen,precio,stock,estado,id_categoria) VALUES (:nombre,:descripcion,
                                        :imagen,:precio,:stock,:estado,:id_categoria);");

            // Ahora ejecutamos la consulta y comprobaremos que todo ha ido correctamente
            if($sentencia->execute(array(':nombre'=>$nombre,':descripcion'=> $descripcion,':imagen'=>$imagen,':precio'=>$precio, ':stock'=>$stock,
                                    ':estado'=>$estado, ':id_categoria'=> $categoria))){                                
                    
                    header("location:../listaArticulos.php");   

                }
                else{
                    $error = "Error al intentar insertar los datos";
                    header("location:../listaArticulos.php?error=$error");
                }

        }else{
            $error = "Faltan datos o son incorrectos, vuelva a introducirlos";
            header("location:../altaArticulos.php?error=$error&errorImg=$imagenCorrecta&errorCod=$estadoCorrecto&cod=$codigo&nombre=$nombre&descripcion=$descripcion&precio=$precio&stock=$stock&stockCorrecto=$stockCorrecto");
        }

    }
    if(isset ($_REQUEST['btnVolver'])){

        header("location:../listaArticulos.php");
    }
    