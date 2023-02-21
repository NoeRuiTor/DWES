<?php


include("usuarios/claseUsuario.php");
include ("seguridad.php");
include ("funciones.php");

$titulo_pagina = "Electricidad FCV - Buscador";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

include ("cabecera.php");

if(isset($_SESSION['rol'])){
  $rol=$_SESSION['rol'];
}
   
    
if(isset($_REQUEST['error'])){
  echo "<div id='error'><h2>{$_REQUEST['error']}</h2></div>";
}

    if(isset ($_REQUEST['btnBuscar']) && !empty ($_REQUEST['dni'])){    
        
        $dni = $_REQUEST['dni'];
    } 
?>  
    <main class="panelUsu">
         <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Mantenimiento de usuarios</p>            
        </div>
        <table class="normal">

           
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
        </tr>

                <?php
                $con = conectar_db("electricidad_fcv"); 
                if($rol == 'administrador') {      
                              
                    $sentencia = $con -> prepare("SELECT * FROM usuarios WHERE dni like ?;");
                    $sentencia -> execute([$dni]);       
                    $filas = $sentencia -> rowCount();
                }
                if($rol == 'empleado'){

                    $sentencia = $con -> prepare("SELECT * FROM usuarios WHERE dni like :dni && rol = 'usuario';");
                    $sentencia -> execute([':dni'=>$dni]);       
                    $filas = $sentencia -> rowCount();
                }

                if($filas!=0){ 
                    $usuario = $sentencia->setFetchMode(PDO::FETCH_CLASS, "usuario");
                    while($usuario = $sentencia->fetch())
                    echo $usuario -> listarDatosAdmin();
                    
                }else{               
                    $error = "NO EXISTEN USUARIOS CON ESE DNI";
                    header("location:menuPrincipal.php?error=$error");                     
                }

                ?>
        </table>
        <div class="btns">
             <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>        
        </div>

        <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>
    </main>
    <?php    
    if(isset ($_REQUEST['btnVolver'])){
        $error="";
        header("location:menuPrincipal.php?error=$error");
    }
  include("pie.php");
  ?>