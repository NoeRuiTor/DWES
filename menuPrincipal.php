<?php
include_once("funciones.php");
include("seguridad.php");

$titulo_pagina = "Electricidad FCV - Panel Usuario";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";


include("cabecera.php");
 
    ?>
    <main class="panelUsu">
        <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Selecciona una opción:</p>            
        </div>
        <div class="panelUsu__content">
           <ul>

            <?php
             if(isset($_REQUEST['error'])){
                echo "<div id='error'><h2>{$_REQUEST['error']}</h2></div>";
              }
              
            
            switch($_SESSION['rol']){
            case 'administrador':
                
                echo '<li><h3><a href="datosUsuario.php?misdatos=$misdatos">Mis datos personales</a></h3></li>';

                echo '<li><h3><a href="datosUsuario.php">Usuarios</a></h3></li>';
           
                echo '<li><h3><a href="listaArticulos.php">Articulos</a></h3></li>';

                echo '<li><h3><a href="listaCategorias.php">Categorías</a></h3></li>';

                echo '<li><h3><a href="listaPedidos.php">Pedidos</a></h3></li>';

                echo '<li><h3><a href="informes.php">Informes</a></h3></li>';
            break;
            case 'empleado':
                echo '<li><h3><a href="datosUsuario.php">Mis datos personales</a></h3></li>';               

                echo '<li><h3><a href="listaArticulos.php">Articulos</a></h3></li>';

                echo '<li><h3><a href="listaCategorias.php">Categorías</a></h3></li>';

                echo '<li><h3><a href="listaPedidos.php">Pedidos</a></h3></li>';
            break;
            case 'usuario':
                echo '<li><h3><a href="datosUsuario.php">Mis datos personales</a></h3></li>';
           
                echo '<li><h3><a href="listaPedidos.php">Mis pedidos</a></h3></li>';             
            break;
            }
           
        ?>
          </ul>
        </div> 
        <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>
    </main>
  <?php
  include("pie.php");
  ?>

