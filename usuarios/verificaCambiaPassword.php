
<?php

 session_start();
 if(isset($_SESSION["autentificado"]) && ($_SESSION["autentificado"] == "OK")){
   header('Location:menuPrincipal.php');
 }
 include ("../funciones.php");
 if(isset ($_REQUEST['cambiarPwd']) && !empty ($_REQUEST['password'])){
    $dni = $_REQUEST['dni'];
    $pwd = $_REQUEST['password'];
    $clave="password";                
    $pwdHash=password_hash($pwd, PASSWORD_DEFAULT);

    if (password_verify($pwd, $pwdHash)) {

        $con = conectar_db("electricidad_fcv");
        $sentencia = $con->prepare ("UPDATE usuarios SET $clave = :$clave WHERE dni = :dni ;");
             if($sentencia -> execute(array(':password' => $pwdHash,':dni' => $dni))){            
                 $mensaje='CONTRASEÑA ACTUALIZADA';
                 header("location:../iniciaSesion.php?mensaje=$mensaje");
                    
             }else {
                 $error = 'ERROR AL INTRODUCIR LOS DATOS, VUELVA A INTENTARLO';
                 header("location:../inicaSesion.php?error=$error");
            }
    } else {
       $error = 'ERROR AL INTRODUCIR LOS DATOS, VUELVA A INTENTARLO';
                 header("location:../inicaSesion.php?error=$error");
    }   
   
   
}else{
    header("location:cambiaPassword.php");
}

?>                   