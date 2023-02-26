
    <?php
    include("productos/claseArticulo.php");
    include ("seguridad.php");
    include ("funciones.php");
    
    $titulo_pagina = "Electricidad FCV - Listado Articulos";
    $description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
    energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
    $keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

    include ("cabecera.php");
    
    if(isset($_SESSION['rol'])){
      $rol=$_SESSION['rol'];
    }
    if(isset ($_REQUEST['btnVolver'])){

      header("location:menuPrincipal.php");
    }

        
     if($rol == 'administrador' || $rol == 'empleado'){                     
      

      ?>
        <main class="panelUsu">
    <?php           
    if(isset($_REQUEST['error'])){
      echo "<div id='error'><h2>{$_REQUEST['error']}</h2></div>";
    }
    ?>  
         <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Mantenimiento de usuarios</p>            
        </div>
        <div class="btns">
                    <form method="get" action="altaArticulos.php"><button class="btn" type="submit" name="nuevoArticulo">Alta</button></form>

                    <form method="get" action="buscaArticulo.php"><button class="btn" type="submit" name="buscar">Buscar</button></form> 
                    
                    <form method="get"><button class="btn" type="submit" name="ordenaAscen">Ordena Ascendente</button></form>  
                    
                    <form method="get"><button class="btn" type="submit" name="ordenaDescen">Ordena Descendente</button></form>
                    
                    <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>
                
                </div>
        <table class="normal">
         
            
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Imagen</th>                
                <th class="edit">Editar</th>
                
            </tr>

      <?php
                
            $con = conectar_db("electricidad_fcv");
              if(isset($_REQUEST['ordenaAscen'])){
                $sql = "SELECT * FROM articulos ORDER BY nombre ASC";
              }elseif(isset($_REQUEST['ordenaDescen'])){
                $sql = "SELECT * FROM articulos ORDER BY nombre DESC";
              }else{
                $sql = "SELECT * FROM articulos";
              }
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
              while($articulo = $sentencia->fetch())
                echo $articulo -> listarArticulos();
              
            ?>
             </table>

                <div class="btns">
                    <form method="get" action="altaArticulos.php"><button class="btn" type="submit" name="nuevoArticulo">Alta</button></form>

                    <form method="get" action="buscaArticulo.php"><button class="btn" type="submit" name="buscar">Buscar</button></form> 
                    
                    <form method="get"><button class="btn" type="submit" name="ordenaAscen">Ordena Ascendente</button></form>  
                    
                    <form method="get"><button class="btn" type="submit" name="ordenaDescen">Ordena Descendente</button></form>
                    
                    <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>
                
                </div>

                <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div> 

        </main>           
            <?php
      

        }else{
          header("Location:index.php");
        }   
        
    
    if(isset ($_REQUEST['btnVolver'])){

        header("location:menuPrincipal.php");
      }
  include("pie.php");
    ?>
   
 