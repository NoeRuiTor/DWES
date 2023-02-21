<?php

if(isset ($_REQUEST["btnAlta"])){
    header("location:../usuarioNuevo.php");
}else{
    $email=$_REQUEST['email'];
    $pwd=$_REQUEST['password'];
    
    // Conexión con la base de datos
    include_once("../funciones.php");
    include("claseUsuario.php");

    $con= conectar_db("electricidad_fcv");
   
//Comprobar que en la base de datos hay registros

    $sentencia = $con->prepare("SELECT * FROM usuarios");
    $resultado = $sentencia->execute();
    $filas = $sentencia->rowCount();
    
    if($filas != 0){
    
    //Comprobar si el usuario ya está en la base de datos y si su estado es alta

        $sentencia = $con->prepare("SELECT * FROM usuarios WHERE email = ? AND estado LIKE 'alta';");
        $sentencia -> execute([$email]);       
        $filas = $sentencia->rowCount();
        $usuario = $sentencia ->fetch(PDO::FETCH_OBJ);  

    // Y verificar password

        $correcto = true;
        if(password_verify($pwd,$usuario -> password)){
            $correcto;
        }else{
           
            $correcto=false;
        }

    //Si existe iniciar sesión   
       if($filas == 1 && $correcto == true){ 
            
           
            $rol = $usuario -> rol; 
            
            //comprobar el rol del usuario y según su rol iniciar sesión     
            switch($rol){
                case 'administrador':
                            session_start();
                            $_SESSION['usuario'] = $email;  
                            $_SESSION['nombre'] = $usuario -> nombre;    
                            $_SESSION['rol'] = 'administrador';      
                            $_SESSION['autentificado'] = "OK";
                            $_SESSION['id'] = $usuario -> id;                
                            header ("Location:../menuPrincipal.php");
                         break;
                case 'usuario':
                            session_start();
                            $_SESSION['usuario'] = $email;
                            $_SESSION['nombre'] = $usuario -> nombre;        
                            $_SESSION['rol'] = 'usuario';     
                            $_SESSION['autentificado'] = "OK"; 
                            $_SESSION['id'] = $usuario -> id; 
                            if(isset($_SESSION['productos'])) {
                                header("location:../pedido.php");
                            }else{             
                               header ("Location:../menuPrincipal.php");
                            }
                         break;
                case 'empleado' :
                            session_start();
                            $_SESSION['usuario'] = $email;
                            $_SESSION['nombre'] = $usuario -> nombre;        
                            $_SESSION['rol'] = 'empleado';     
                            $_SESSION['autentificado'] = "OK"; 
                            $_SESSION['id'] = $usuario -> id;               
                            header ("Location:../menuPrincipal.php");
                         break; 
            }
        }else {
           $error = "El usuario no existe en la base de datos o la contraseña es incorrecta";
           header("Location:../iniciaSesion.php?error=$error");
       
        
        }
   }else{
      
      $error = "La base de datos no tiene ningun registro";
      header("location:../iniciaSesion.php?error=$error");
       
   }
}  
?>
