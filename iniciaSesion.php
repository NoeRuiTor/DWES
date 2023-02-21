<?php

include_once("funciones.php");

$titulo_pagina = "Electricidad FCV - Acceso Usuarios";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";
$current_page = 'iniciaSesion.php';

include("cabecera.php");

?>

<main>
 <section class="formularioLogin">
     <div class="contenedor">
        <h2>Inicia sesión</h2>
        <div>
        <form class="formularioUser" action="usuarios/login.php" method="post" name="formLog">        
            <table class=formulariolog__tabla >
              <tr> <td colspan="3">
                <span>Usuario:</span><br/>
                <input class="cajas" type="email" name="email" placeholder="correo@example.com"> </td> 
              </tr>
              <tr> <td colspan="3">
                <span>Contraseña:</span><br/>
                <input class="cajas" type="password" name="password" placeholder="8 caracteres"> </td>
              </tr>
              <tr>
                <td> <br/> <input type="submit" class="btn" value="Enviar"> </td>
                <td> <br/> <input type="reset" class="btn" value="Borrar"> </td>
                <td> <br/> <input name="btnAlta" type="submit" class="btn"  value="Registro"/></td>
              </tr>
              <tr> <td colspan="3">            
                <div class="cambia"><a href="cambiaPassword.php">Olvidé mi contraseña</a></div></td> 
              </tr>
            </table>
        </form>
        </div>
        <?php
         if(isset($_REQUEST['error'])){
          echo "<div id='error'>{$_REQUEST['error']}</div>";
        }
        if(isset($_REQUEST['mensaje'])){
          echo "<div id='mensaje'>{$_REQUEST['mensaje']}</div>";
        }
        ?>
    </div>
 </section>
<main>
<?php
include("pie.php");
?>
