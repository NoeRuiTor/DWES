<?php
  include("seguridad.php");
   
   //Si el usuario es administrador o empleado, no pueden comprar, borra carrito y los lleva a su panel de usuario

   if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'administrador' || $_SESSION['rol'] == 'empleado'){
      foreach ($_SESSION['productos'] as $clave => $valor) {
         unset($_SESSION['productos'][$clave]);
      }                                            
      header("location:menuPrincipal.php");
   }
   
   if((!empty($_SESSION['productos']) && isset($_REQUEST['quitaProducto']))){
    unset($_SESSION['productos'][$_REQUEST['quitaProducto']]);
    
   }
 

   if(!empty($_SESSION['productos'])){
      $carrito=$_SESSION['productos'];    
        
    
 

      //print $carrito['1'];
      //print_r($_SESSION);
      
      include("productos/claseArticulo.php");
      
        include ("funciones.php");
        
        $titulo_pagina = "Electricidad FCV - Pedidos";
        $description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
        energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
        $keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

        include ("cabecera.php");

        
        $ids = implode( ', ', array_keys($carrito));
        $con = conectar_db("electricidad_fcv");
          ?>
        <main class="panelUsu">
         <div class="panelUsu__heading">
            <h1>Hola <?php
              if(isset($_SESSION['nombre'])){
                  echo $_SESSION['nombre'];
              }else{
                header("location:iniciaSesion.php");
              }
                             
            ?></h1>
            <p>Detalle pedido:</p>
            <p>Confirme cantidades</p>            
        </div>
          <table class="normal">
            
            <form class="formularioUser"  method="POST" action="verificaPedido.php"  name="prePedido"> 
                    <thead>
                        <tr>
                        <th>Imagen</th>              
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cant</th>                       
                        <th>Subtotal</th>                          
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total=0;
                    $consulta="SELECT * FROM articulos WHERE id IN ($ids);";
                    $sentencia = $con->prepare($consulta);
                    $sentencia -> execute();
                      $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
                      while($articulo = $sentencia->fetch()){
                      $cantidad=$_SESSION['productos'][$articulo->getId()];                      
                      $subtotal = $cantidad * $articulo->getPrecio();
                      $total += $subtotal;

                      echo "<tr>";
                      echo "<td><img src='" .$articulo->getImagen(). "' alt='".$articulo->getImagen()."'></td>";
                      echo "<td>".$articulo->getNombre()."</td>";
                      echo "<td>".$articulo->getPrecio()."€</td>";
                      echo "<td><input type='number' name='cantidad[".$articulo->getId()."]' value='".$cantidad."' min='0' max='".$articulo->getStock()."'></td>";                     
                      echo "<td>".$subtotal."€</td>";                      
                      echo "</tr>";         
                      
                      } 
                    
                    ?>
                  </tbody>
                  </table>
                  <div class="btns">
                    <input class="btn" type="submit" value="Confirmar pedido" name="confirma"/> 

                    <input class="btn"  value="Cancelar" type="submit" name="btnCancelarPed"/>                    
                  </div>  
            </form>
            <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>
           
            <?php
         
         
         ?>  
        </main>
    <?php
    
    include("pie.php");
}else{
  $error="No hay productos en su cesta";
  header("location:tienda.php?error=$error");
}
    
?>