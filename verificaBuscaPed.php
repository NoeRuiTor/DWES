<?php

include("productos/clasePedido.php");
include ("seguridad.php");
include ("funciones.php");
$usuario= $_SESSION['usuario'];     
$rol = $_SESSION['rol'];


    if(isset ($_REQUEST['btnBuscar'])){    
       if(isset($_REQUEST['id'])){
        $id=$_REQUEST['id'];
       }
       if(isset($_REQUEST['id_usuario'])){
        $id_usuario = $_REQUEST['id_usuario'];
       }
       if(isset($_REQUEST['fecha'])){
        $fecha = $_REQUEST['fecha'];
       }
    }
    if(empty($id) && empty($id_usuario) && empty($fecha) ){
        header("location:buscaPedido.php");
    }
include("cabecera.php"); 
    ?>
    <main class="panelUsu">
         <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Mantenimiento de articulos</p>            
        </div> 
    <?php
//Conectamos con la base de datos
$con = conectar_db("electricidad_fcv"); 

    if($rol == 'administrador' || $rol == 'empleado'){       
    ?>
        <table class="normal">
       
            <tr>
                <th>ID_Pedido</th>
                <th>Fecha</th>
                <th>Importe</th>
                <th>Estado</th>
                <th>ID_Usuario</th>
                <th class="edit">Detalle</th>                              
                <th class="edit">Editar</th>
                
            </tr>
            <?php 
              
                
                
                
         if($id){       
                
                $sentencia = $con -> prepare("SELECT * FROM pedido WHERE id like ?;");
                $sentencia -> execute([$id]);       
                $filas = $sentencia -> rowCount();
                if($filas!=0){      
                 
                    $pedido = $sentencia->setFetchMode(PDO::FETCH_CLASS, "pedido");
                    while($pedido = $sentencia->fetch())
                    echo $pedido -> listarPedidos();
                }      
         }
         if($id_usuario){

                
                $sentencia = $con -> prepare("SELECT * FROM pedido WHERE id_usuario LIKE ?;");
                $sentencia -> execute([$id_usuario]);       
                $filas = $sentencia -> rowCount();
                if($filas!=0){
                    
                 
                    $pedido = $sentencia->setFetchMode(PDO::FETCH_CLASS, "pedido");
                    while($pedido = $sentencia->fetch())
                    echo $pedido -> listarPedidos();
               }
                
        }  
        
                
                //Comprobamos que hay artículos con ese código
                if($filas ==0){ 
                     //Si no existen artículos con el código, volver al listado y mostrar el mensaje              
                    $error = "NO EXISTEN PEDIDOS CON ESOS PARAMETROS DE BUSQUEDA";
                    header("location:listaPedidos.php?error=$error");        
                }    
                                         
                  
                        
            
            
    }else{
        ?>
        <table class="normal">
         
            
        <tr>
            <th>ID_Pedido</th>
            <th>Fecha</th>
            <th>Importe</th>
            <th>Estado</th>
            <th>ID_Usuario</th>                
            <th class="edit">Detalle</th>
            
        </tr>
        <?php   
                $date = $fecha."%";
                $sentencia = $con -> prepare("SELECT * FROM pedido WHERE fecha like ?;");
                $sentencia -> execute([$date]);       
                $filas = $sentencia -> rowCount();
                if($filas!=0){
                    
                 
                    $pedido = $sentencia->setFetchMode(PDO::FETCH_CLASS, "pedido");
                    while($pedido = $sentencia->fetch())
                    echo $pedido -> listarPedidosUsu();
               }
                //Comprobamos que hay artículos con ese código
        }   
                
                
                if($filas ==0){ 
                     //Si no existen artículos con el código, volver al listado y mostrar el mensaje              
                    $error = "NO EXISTEN PEDIDOS EN ESA FECHA";
                    header("location:listaPedidos.php?error=$error");        
                }    
     ?>   
    </table>
    <div class="btns">
             <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>        
        </div>
</main>   
<?php

if(isset ($_REQUEST['btnVolver'])){

    header("location:listaPedidos.php");
    
}          
    
  include("pie.php");
  ?>