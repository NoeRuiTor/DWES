<?php
//print_r($_REQUEST);
include_once("../funciones.php");
include_once ("../seguridad.php");



$existeRol=false;
$existeEstado=false;
$existenDatos=false;



 if(isset ($_REQUEST['modificar'])){
            $id = $_REQUEST['id'];
            $nombre=$_REQUEST['nombre'];
            $apellidos=$_REQUEST['apellidos'];
            $direccion=$_REQUEST['direccion'];
            $localidad=$_REQUEST['localidad'];
            $provincia=$_REQUEST['provincia'];
            $telefono=$_REQUEST['telefono'];    
            
$con = conectar_db("electricidad_fcv");               

  //si el rol es administrador

    if($_SESSION['rol']=='administrador'){
        $rol=$_REQUEST['rol'];
        $estado=$_REQUEST['estado'];

            
            
            if(!empty($rol) && ($rol == 'administrador' || $rol == 'usuario' || $rol == 'editor')){
                $existeRol=true;
            }

            if(!empty ($estado)){
                if($estado == 'alta'|| $estado == 'baja'){
                    $existeEstado=true;
                }else{
                    $existeEstado = false;
                }
            }else{
                $existeEstado=false;
            }  
            if(!empty($telefono) || !empty($localidad) || !empty($provincia) || !empty($direccion)){
                $existenDatos=true;
            }else{
                $existenDatos=false;
            }

            if ( $existeEstado==true && $existeRol==true && $existenDatos==true){ 
                
        //Si existen  modificamos los datos
                    
                    $sentencia = $con->prepare ("UPDATE usuarios SET direccion=:direccion, localidad=:localidad, provincia=:provincia,
                                                telefono=:telefono, rol=:rol, estado=:estado WHERE id = :id;");
                    if($sentencia -> execute(array(':direccion' => $direccion, ':localidad' => $localidad, 
                                            ':provincia' => $provincia,':telefono' => $telefono, ':rol' => $rol, ':estado'=>$estado, ':id'=>$id ))){            
                
                        header("Location:../datosUsuario.php");
                    
                    }else {
                        $error = "Error al intentar modificar los datos";
                        header("location:../datosUsuario.php?error=$error");
                    }
            
            
            // Si los campos están vacíos o son erróneos manda mensaje y muestra el campo en rojo
        }else {
            header("location:../datosUsuario.php?&existeEstado=$existeEstado&existeRol=$existeRol&existenDatos=$existenDatos");
        
            }
 
 //si el rol es usuario o empleado

  }else{
        
        
        } 
        if(!empty($direccion) || !empty($localidad) || !empty($provincia) || !empty($telefono) ){
            $existenDatos=true;
        
        } 
        if ($existenDatos==true){

            $sentencia = $con->prepare ("UPDATE usuarios SET direccion=:direccion, localidad=:localidad, provincia=:provincia,
                                                telefono=:telefono  WHERE id like :id;");
                    if($sentencia -> execute(array(':direccion' => $direccion, ':localidad' => $localidad, 
                                            ':provincia' => $provincia,':telefono' => $telefono, ':id'=>$id ))){            
                
                        header("Location:../datosUsuario.php");
                    
                    }else {
                        $error = "Error al intentar modificar los datos";
                        header("location:../datosUsuario.php?error=$error");
                    }
            
            
            // Si los campos están vacíos o son erróneos manda mensaje y muestra el campo en rojo
        }else {
            header("location:../datosUsuario.php?existenDatos=$existenDatos");
        
            }

    }

 


if(isset ($_REQUEST['btnCancelar'])){

    header("location:../datosUsuario.php");

}
?>