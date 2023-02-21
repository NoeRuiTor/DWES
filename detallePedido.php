<?php
include ("seguridad.php");
include ("funciones.php");
include ("productos/claseDetallePed.php");
        
        $titulo_pagina = "Electricidad FCV - Pedidos";
        $description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
        energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
        $keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

        include ("cabecera.php");

        
if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
}else{
header("Location: listaPedidos.php");
}


?>
<main class="panelUsu">
 <div class="panelUsu__heading">
    <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
    <p>Detalle del pedido: <?php echo $id; ?></p>            
</div>
<?php
$con = conectar_db("electricidad_fcv");
?>
 <table class="normal">
         
            
         <tr>
             <th>ID Detalle</th>             
             <th>ID Artículo</th>
             <th>ID Pedido</th>            
             <th>Cantidad</th>             
             <th>Precio</th>           
            
         </tr>
<?php
              $sql= "SELECT * FROM detalle_pedido WHERE id_pedido = ?";
              $sentencia = $con->prepare($sql);
              $sentencia -> execute([$id]);
              $detalle = $sentencia->setFetchMode(PDO::FETCH_CLASS,'detallePed');
              while($detalle = $sentencia->fetch())               
                echo $detalle -> listarDetallePed();
                
              
            ?>
             </table>

                <div class="btns">                
                   
                    
                    <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>
                
                </div>

                <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div> 

        </main>
        
    
        
    <?php
    if(isset ($_REQUEST['btnVolver'])){

        header("location:menuPrincipal.php");
      }
  include("pie.php");

    ?>           
