<?php
    
     
    include("productos/clasePedido.php");
    include ("seguridad.php");
    include ("funciones.php");
 
    
    $titulo_pagina = "Electricidad FCV - Listado Pedidos";
    $description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
    energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
    $keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

    include ("cabecera.php");
    
    
      $rol=$_SESSION['rol'];
      
    
      
    if(isset ($_REQUEST['btnVolver'])){

      header("location:menuPrincipal.php");
    }

        
        
    if(isset($_REQUEST['error'])){
      echo "<div id='error'><h2>{$_REQUEST['error']}</h2></div>";
    }
                
      

      ?>
        <main class="panelUsu">
         <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Mantenimiento de usuarios</p>            
        </div>
    <?php
    $con = conectar_db("electricidad_fcv");

    if($rol == 'administrador' || $rol == 'empleado'){  
    ?>
        <div class="btns">                 

                    <form method="get" action="buscaPedido.php"><button class="btn" type="submit" name="buscar">Buscar</button></form> 
                    
                    <form method="get"><button class="btn" type="submit" name="ordenaAscen">Ordena Ascendente</button></form>  
                    
                    <form method="get"><button class="btn" type="submit" name="ordenaDescen">Ordena Descendente</button></form>
                    
                    <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>
                
                </div>
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
                
            
              if(isset($_REQUEST['ordenaAscen'])){
                $sql = "SELECT * FROM pedido ORDER BY fecha ASC";
              }elseif(isset($_REQUEST['ordenaDescen'])){
                $sql = "SELECT * FROM pedido ORDER BY fecha DESC";
              }else{
                $sql = "SELECT * FROM pedido";
              }
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'pedido');
              while($articulo = $sentencia->fetch())
                echo $articulo -> listarPedidos();
              
            ?>
             </table>

                <div class="btns">
                    
                    <form method="get" action="buscaPedido.php"><button class="btn" type="submit" name="buscar">Buscar</button></form> 
                    
                    <form method="get"><button class="btn" type="submit" name="ordenaAscen">Ordena Ascendente</button></form>  
                    
                    <form method="get"><button class="btn" type="submit" name="ordenaDescen">Ordena Descendente</button></form>
                    
                    <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>
                
                </div>

                <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div> 

        </main>           
            <?php
      

    }
    if($rol == 'usuario' ){
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
                
                $id = $_SESSION['id'];
                  
                    $sql = "SELECT * FROM pedido WHERE id_usuario = ? ";
                  
                  $sentencia = $con->prepare($sql);
                  $sentencia -> execute([$id]);
                  $pedido = $sentencia->setFetchMode(PDO::FETCH_CLASS,'pedido');
                  while($pedido = $sentencia->fetch())
                    echo $pedido -> listarPedidosUsu();
                  
                ?>
             </table>
                 <div class="btns">
                    
                    <form method="get" action="buscaPedido.php"><button class="btn" type="submit" name="buscar">Buscar</button></form>                   
                    
                    
                    <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>
                
                </div>
                <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>
    </main> 
    <?php
    }
        
    
    if(isset ($_REQUEST['btnVolver'])){

        header("location:menuPrincipal.php");
      }
  include("pie.php");

    ?>
   
 