
    <?php
    include("seguridad.php");
    include("usuarios/claseUsuario.php");
    include_once("funciones.php"); 
    
   
    
    $titulo_pagina = "Electricidad FCV - Panel Usuario";
    $description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
    energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
    $keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";
   
    
    include("cabecera.php");

    
      
    ?>
    <main class="panelUsu">
         <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Mantenimiento de usuarios</p>            
        </div>
        <table class="normal">
         
          
    
    <?php
    
    $sesion = $_SESSION['autentificado'];
    $usuario = $_SESSION['usuario'];
    $rol =  $_SESSION['rol'];
    $id = $_SESSION['id'];

    if(isset($_REQUEST['error'])){
      echo "<div id='error'><h2>{$_REQUEST['error']}</h2></div>";
    }
    if(isset ($_REQUEST['btnVolver'])){
      $error="";
      header("location:menuPrincipal.php?error=$error");
    }
    
    $con = conectar_db("electricidad_fcv");  
    
    if($_SESSION['rol']=='administrador'){ 
    ?> 
      <tr>
              <th>ID</th>
              <th>Dni</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Dirección</th>
              <th>Localidad</th>
              <th>Provincia</th>
              <th>Teléfono</th>            
              <th>Correo Electrónico</th>
              <th>Rol</th>
              <th>Estado</th>
              <th class="edit">Editar</th>            
          </tr>
   <?php

         
  
   
           if(isset($_REQUEST['misdatos'])){
              $sql = "SELECT * from usuarios WHERE id = ? ";
            
           }else{            
              
              $sql = "SELECT * FROM usuarios WHERE id NOT LIKE ?";              
             
                    
               if(isset($_REQUEST['ordenaAscen'])){
                  $sql = "SELECT * FROM usuarios WHERE id NOT LIKE ? ORDER BY nombre ASC";
              }
              if(isset($_REQUEST['ordenaDescen'])){
                $sql = "SELECT * FROM usuarios WHERE id NOT LIKE ? ORDER BY nombre DESC";;
              }
             
         }
         $sentencia = $con->prepare($sql);
         $sentencia -> execute([$id]);
         $usuario= $sentencia->setFetchMode(PDO::FETCH_CLASS,'usuario');
         while($usuario = $sentencia->fetch())
         echo $usuario -> listarDatosAdmin();
         ?>
    </table>

            <div class="btns">
                <a href="AltaClientes_porAdmin.php"><button class="btn" type="submit" name="altaUsuario">Alta</button></a>
        
                <a href="buscaCliente.php"><button class="btn" type="submit" name="buscar">Buscar</button></a>
                
                <form method="get"><button class="btn" type="submit" name="ordenaAscen">Ordena Ascendente</button></form>  
                
                <form method="get"><button class="btn" type="submit" name="ordenaDescen">OrdenaDescendente</button></form>
                
                <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>
               
            </div>
           
            <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>
         <?php
       
   
           

  }
  if($_SESSION['rol']=='usuario'|| $_SESSION['rol']=='empleado'){
    ?>   
      <tr>     
              <th>ID</th>        
              <th>Dni</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Dirección</th>
              <th>Localidad</th>
              <th>Provincia</th>
              <th>Teléfono</th>            
              <th>Correo Electrónico</th>              
              <th class="edit">Editar</th>            
          </tr>


    <?php
            
            $sql = "SELECT id,dni,nombre,apellidos,direccion,localidad,provincia,telefono,email FROM usuarios WHERE id LIKE :id;";
            $sentencia = $con->prepare($sql);
            $sentencia -> execute([':id' => $id]);
    
            $usuario = $sentencia->setFetchMode(PDO::FETCH_CLASS,'usuario');
    
            while($usuario = $sentencia->fetch())
              echo $usuario -> listarDatos();           
      ?>
        
    </table>  
            <div class='btns'> 
              <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>
            </div>

            <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>
  <?php
} 

  ?>
  
</main>
     
  <?php
  include("pie.php");
  
  ?>