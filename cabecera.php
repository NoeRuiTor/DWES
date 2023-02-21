<?php
include_once("funciones.php");
session_start();
$lamparas=1;
$bombillas=2;
$mecanismos=3;
$total_articulos=0;
if(isset($_REQUEST['buscador']) && isset($_REQUEST['descripcion'])){
    $desc = $_REQUEST['descripcion'];
 }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php parametro_plantilla("description"); ?>">
    <meta name="Keywords" content="<?php parametro_plantilla("keywords"); ?>"> 
    <link rel="shortcut icon" type="image/x-icon" href="imgs/favicon.png">
   
    <link rel="stylesheet" href="css/estilos.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
	<title><?php parametro_plantilla("titulo_pagina"); ?></title>
    
</head>
<body>
   <div class="site">
    <header>
        <nav class="navegador">
            
            <img class="logo"src="imgs/logo.png" alt="electricidadFCV" width="150" height="150">
                            
            <ul class="menu">
                <li class="menu__opcion"><a class="<?php active('index.php'); ?>" href="index.php">Inicio</a></li>
                <li class="menu__opcion"><a class="<?php active('servicios.php'); ?>" href="servicios.php">Servicios</a></li>                
                <li class="menu__opcion" id="submenu-li"><a class="<?php active('tienda.php'); ?>" href="tienda.php">Tienda</a>
                    <ul class="submenu">
                        <li><a href="tienda.php?id_categoria=<?php echo $lamparas;?>">Lámparas</a></li>
                        <li><a href="tienda.php?id_categoria=<?php echo $bombillas;?>">Bombillas</a></li>
                        <li><a href="tienda.php?id_categoria=<?php echo $mecanismos;?>">Mecanismos</a></li>
                    </ul>
                </li>
                <li class="menu__opcion"><a class="<?php active('contacto.php'); ?>" href="contacto.php">Contacto</a></li>
            </ul>            
            <div class="navegador__iconos">
           
            <div class="search-container">
                <form method="post" action="tienda.php">
                    <input type="text" placeholder="Search..." name="descripcion">
                    <button type="submit" name="buscador">
                    <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <?php
            if(isset($_SESSION['autentificado']) && ($_SESSION['autentificado']=='OK')){
            ?>
            <a href="menuPrincipal.php" class="login"><img src="imgs/acceso.png" alt="login" width="30px" height="30px"></a>
            <?php    
            }else{
            ?>
            <a href="iniciaSesion.php" class="login"><img src="imgs/acceso.png" alt="login" width="30px" height="30px"></a>
            <?php
            }
            ?>
            <a class="header__carrito" href="pedido.php"><img src="imgs/carrito-de-compras.png" alt="carrito" width="30px" height="30px">
              <span id="unidades">
                <?php                 
                  if(isset($_SESSION['productos'])){
                    $carrito=$_SESSION['productos'];
                    $total_articulos=0;
                    foreach ($carrito as $cantidad){
                       $total_articulos += $cantidad;
                    }
                     echo $total_articulos;
                } ?>
            </span>
            </a>
            
            </div>
        </nav>
    </header>
    