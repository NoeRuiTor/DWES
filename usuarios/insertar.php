<?php
session_start();
//print_r($_SESSION);


include("../funciones.php");

if(isset ($_REQUEST['btnVolver'])){
    
    header("Location:../index.php");
   
}
if(isset($_SESSION['rol'])  ){
    if($_SESSION['rol'] != 'administrador'){
        header("location:../menuPrincipal.php");
    }
}

$existenDatos=false;
$correctoDni=false;
$existeDni=false;
$repeUser=false;
$existeUsuario=false;
$existePassword=false;
$existeRol=false;
$estadoCorrecto=false;


   

if(isset ($_REQUEST['enviar'])){
    $dni =  $_REQUEST['dni'];
    $email = $_REQUEST['email'];
    $nombre = $_REQUEST['nombre'];
    $apellidos = $_REQUEST['apellidos'];
    $direccion = $_REQUEST['direccion'];
    $localidad = $_REQUEST['localidad'];
    $provincia =$_REQUEST['provincia'];
    $telefono = $_REQUEST['telefono'];
    $pwd = $_REQUEST['password'];
    $rol = $_REQUEST['rol'];
    $estado = $_REQUEST['estado'];

    if(isset ($_REQUEST['enviar'])){
    
        if(!empty ($dni)) {
        $existeDni=true;
    }
        $correctoDni=analizaDNI($dni);
    //comprobar si existe el dni en la base de datos 
        $con = conectar_db("electricidad_fcv");
        $sentencia = $con->prepare("SELECT * FROM usuarios WHERE dni like :dni");
        $resultado = $sentencia->execute([':dni'=>$dni]); 
        $fila = $sentencia->rowCount();

        if($fila == 1){
            $correctoDni=false;
        }
        
 //Comprobar que existe contraseña y encriptación de la contraseña
        if(!empty ($pwd)) {
            $existePassword=true;    
        }
    $pwdHash=password_hash($pwd, PASSWORD_DEFAULT);

//comprobar si el email existe 
    if(!empty ($email)){
        $existeUsuario=true;
    }

//comprobar que es correcto
     if(filter_var($email, FILTER_VALIDATE_EMAIL)){
         $existeUsuario=true;
    }
//y comprobar que no exista en la base de datos

        $sentencia = $con->prepare("SELECT * FROM usuarios WHERE email like :email");
        $resultado = $sentencia->execute([':email'=>$email]); 
        $fila = $sentencia->rowCount();
        
        if($fila != 0){
            $repeUser = true;
        }
    
//comprobar si el rol existe y es usuario, administrador o empleado
    if(!empty ($rol)){    
        
     if($rol == "administrador" || $rol == "usuario" || $rol == "empleado"){
        $existeRol=true;          
    }else{
        $existeRol=false;
    }
    
 
         //comprobar que existe estado y es correcto
         if(!empty ($estado)){
            if($estado == 'alta'|| $estado == 'baja'){
                $estadoCorrecto=true;
            }else{
                $estadoCorrecto = false;
            }
        }else{
            $estadoCorrecto=false;
        }  

 //Comprobar que el resto de datos existen    
    if(!empty($direccion) || !empty($localidad) || !empty($provincia) || !empty($telefono) || !empty($estado) || !empty($nombre) || !empty($apellidos) ) {
        $existenDatos=true;
    }



//Si existen los datos y son correcto insertarlos en la base de datos    
    if ($existeDni==true && $existeUsuario==true && $correctoDni==true && $existeRol==true && $existePassword==true && $repeUser==false && $existenDatos==true && $estadoCorrecto==true){       
        
    // Con esta sentencia SQL insertaremos los datos en la base de datos
    $sentencia = $con->prepare("INSERT INTO usuarios (dni,nombre,apellidos,direccion,localidad,provincia,telefono,email,password,rol,estado)
                                VALUES (:dni,:nombre,:apellidos,:direccion,:localidad,:provincia,:telefono,:email,:password,:rol,:estado)");

    // Ahora ejecutamos la consulta y comprobaremos que todo ha ido correctamente
    if($sentencia->execute(array(':dni'=>$dni,':nombre'=>$nombre,':apellidos'=>$apellidos,':direccion'=>$direccion,':localidad'=>$localidad,
                            ':provincia'=>$provincia,':telefono'=>$telefono,':email'=>$email,':password'=>$pwdHash,':rol'=>$rol,':estado'=>$estado))){                                
            
            header("Location:../iniciaSesion.php");   

        }

        else{
            $error = "Error al intentar insertar los datos";
            if(isset($_SESSION['rol'])){
                header("location:../menuPrincipal.php?error=$error");
            }else{
             header("Location:../iniciaSesion.php?error=$error");
            }
        }
    
        
    
// Si los campos están vacíos o son erróneos manda mensaje 

}
else {
    if(isset($_SESSION['rol'])){
        header("location:../AltaClientes_porAdmin.php?dni=$dni&email=$email&nombre=$nombre&apellidos=$apellidos&direccion=$direccion&localidad=$localidad&provincia=$provincia&telefono=$telefono&rol=$rol&estado=$estado&existeUsuario=$existeUsuario&existenDatos=$existenDatos&repeUser=$repeUser&existeRol=$existeRol&existeDni=$existeDni&correctoDni=$correctoDni&estadoCorrecto=$estadoCorrecto&existePassword=$existePassword");   
    }else{
    header("location:../usuarioNuevo.php?dni=$dni&email=$email&nombre=$nombre&apellidos=$apellidos&direccion=$direccion&localidad=$localidad&provincia=$provincia&telefono=$telefono&rol=$rol&estado=$estado&existeUsuario=$existeUsuario&existenDatos=$existenDatos&repeUser=$repeUser&existeRol=$existeRol&existeDni=$existeDni&correctoDni=$correctoDni&estadoCorrecto=$estadoCorrecto&existePassword=$existePassword");      
    }      
   }
}
}

}
?>