<?php
include("seguridad.php");

include ("funciones.php");
        
        $titulo_pagina = "Electricidad FCV - Pedidos";
        $description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
        energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
        $keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

        include ("cabecera.php");
?>
        <main class="panelUsu">
            <div class="panelUsu__heading">
                <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>                          
            </div>
            <div class="panelUsu__content">
                <div class="confirmacion">
                    <h2>Pedido confirmado, en breve lo recibirá en la dirección indicada.
                        <p>Puede seguir el estado de su pedido en su panel de usuario en</p>
                        <p><a href="listaPedidos.php">Pedidos</a>
                    </h2>
                </div>
            </div> 
           <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>
       </main>
  <?php
  include("pie.php");
  ?>