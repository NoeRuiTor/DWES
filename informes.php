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
            $rol=$_SESSION['rol'];
            if($rol != 'administrador'){
                header("location:menuPrincipal.php");
            }
            
             ?>
              
              <form class="formulario-alta" method="post" action="listadoInforme.php">
              <h2>Informes:</h2>
              <div>       
                <label for="tipo">Tipo informe: </label>
                <select name="tipoInfo" id="tipoInfo">                    
                  <option value="altas/bajas-Usuarios">Usuarios de alta y baja</option>
                  <option value="altas/bajas-Articulos">Artículos de alta y baja</option>                   
                  <option value="ventas">Ventas</option> 
              </select>   
            </div>
             <h3>Si selecciona VENTAS, elija un rango de fechas</h3>
              <div>
                <label for="fechaIni">Desde: </label>
                <input type="date" id="fechaIni" name="fechaIni"
                        value="<?php echo $hoy; ?>";
                        min="2023-02-020" max="<?php echo $hoy; ?>";>
              </div> 
              <div>
                <label for="fechaFin">Hasta: </label>
                <input type="date" id="fechaFin" name="fechaFin"
                        value="<?php echo $hoy; ?>";
                        min="2023-02-020" max="<?php echo $hoy; ?>";>
              </div>       
             
              <div class="btns">
                <input class="btn" type="submit" value="Enviar" name="enviar">
                
                <input class="btn"  value="Volver" type="submit" name="btnVolver">
              </div>
              <?php
              
            
                if(isset($_REQUEST['error'])){
                    echo "<div class='errores'>";
                    echo "<div id='error'>{$_REQUEST['error']}</div>";
                    echo "</div>";
                }
                
                
            ?>
  
        </form>
        <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>     
  </main>       
  <?php   
      
  
  include("pie.php");
  ?>
  
?>           