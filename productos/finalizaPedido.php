<?php

include ("../seguridad.php");
//print_r($_REQUEST);
//print_r($_SESSION);

include_once ("../funciones.php");

 

if(isset($_REQUEST['finaliza']) && isset($_SESSION)){
    $carrito = $_SESSION['productos'];
    $id = $_SESSION['id'];
    $fecha_actual = date('Y-m-d H:i:s');
    $total_compra = $_SESSION['total_compra'];
    $estado = 'confirmado';
    $correcto = true;
    //comprobar que ha marcado, forma de pago y casillas de condiciones legales

    if(isset($_REQUEST['condiciones']) && isset($_REQUEST['privacidad']) && isset($_REQUEST['cobro'])){
            
             // Con esta sentencia SQL insertaremos los datos en la base de datos pedidos
             $con = conectar_db("electricidad_fcv");
             $sentencia = $con->prepare("INSERT INTO pedido(fecha,importe,estado,id_usuario) VALUES (:fecha,:importe,
                                         :estado,:id_usuario);");
 
             // Ahora ejecutamos la consulta y comprobaremos que todo ha ido correctamente
             if($sentencia->execute(array(':fecha'=>$fecha_actual,':importe'=> $total_compra,':estado'=>$estado,':id_usuario'=>$id))){
                        $correcto;
             }else{
                   $error = "Error al intentar insertar los datos";
                    header("location:../verificaPedido.php?error=$error");
             }           
                     //consulta para conocer el id del pedido
                     $consulta = "SELECT id FROM pedido WHERE id_usuario = :id AND fecha LIKE :fecha";
                     $sentencia = $con->prepare($consulta);
                     $sentencia->execute(array(':id' => $id, ':fecha' => $fecha_actual.'%'));
                     $datos = $sentencia->fetch(PDO::FETCH_ASSOC);
                     $id_pedido = $datos['id'];
                    //Recorro array del carrito para insertar cada articulo en la base de datos detalles_pedidos
                        foreach($carrito as $clave=>$valor){
                                    $id_articulo = $clave;
                                    $cantidad = $carrito[$clave];
                           
                            //Consulta para conocer el precio y stock de cada artículo
                                $consulta="SELECT precio,stock FROM articulos WHERE id = ?";
                                $sentencia = $con->prepare($consulta);
                                $sentencia -> execute(array($id_articulo)); 
                                $datos = $sentencia->fetch(PDO::FETCH_ASSOC);
                                    $precio = $datos['precio'];
                                    $stock = $datos['stock'];
                            $sentencia =$con->prepare("INSERT INTO detalle_pedido(id_articulo,id_pedido,cantidad,precio) VALUES (:id_articulo,:id_pedido,
                            :cantidad,:precio);");
                            if($sentencia->execute(array(':id_articulo'=>$id_articulo,':id_pedido'=> $id_pedido,':cantidad'=>$cantidad,':precio'=>$precio))){
                                  
                                $correcto;
                            }else{
                                $error = "Error al intentar insertar los datos";
                                header("location:../verificaPedido.php?error=$error");   
                            }
                                //modifico stock del articulo
                                $stock -= $cantidad;
                                $sentencia = $con->prepare ("UPDATE articulos SET stock=:stock WHERE id like :id;");
                                if($sentencia ->execute(array(':stock'=>$stock, ':id' => $id_articulo))){
                                
                                    header("location:../paginaConfirmaPedido.php");
                                } else{
                                    $error = "Error al intentar insertar los datos";
                                    header("location:../verificaPedido.php?error=$error");
                                }
                           
                        }
                
         }else{
            $error = "Por favor, marque las casillas de aceptación de condiciones y elija un metodo de pago";
            header("location:../verificaPedido.php?error=$error");
        }
}
if(isset($_REQUEST['btnCancelar'])){

    header("location:../tienda.php");
}  
if(isset($_REQUEST['btnEditar'])){

    header("location:../datosUsuario.php");
} 

?>
