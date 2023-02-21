<?php

 print_r($_REQUEST);
 
  include ("../seguridad.php");
  include_once ("../funciones.php");
  $id = $_REQUEST['id'];
  $estadoCorrecto=true;
  
   //comprobar que existe estado y es correcto
          if(isset($_REQUEST['estado'])){           
            $estado=$_REQUEST['estado'];
            if($estado == 'confirmado'|| $estado == 'preparado' || $estado == 'en_transito' || $estado == 'entregado' || $estado == 'anulado'){
                $estadoCorrecto;
            }else{
                $estadoCorrecto = false;
            }
         }else{
            $estadoCorrecto = false;
         }

     if($estadoCorrecto == true){
        //Si existen conectamos con base de datos y modificamos los datos
        
        $con = conectar_db("electricidad_fcv");
        $sentencia = $con->prepare ("UPDATE pedido SET estado=:estado  WHERE id like :id;");
         if($sentencia -> execute(array(':estado'=>$estado, ':id' => $id))){            
       
            header("location:../listaPedidos.php");
        
        
         }else{
                $error = "Error al modificar los datos";
                header("location:../listaPedidos.php?error=$error");
         }

    }else{
        $error = "Falta estado o no es correcto";
        header("location:../listaPedidos.php?error=$error");
    }


if(isset ($_REQUEST['btnCancelar'])){

header("location:../listaPedidos.php");

} 


?>
     }