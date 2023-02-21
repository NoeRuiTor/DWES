<?php 
 

include_once ("seguridad.php");
include_once("funciones.php");


$titulo_pagina = "Electricidad FCV - Buscador";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

include("cabecera.php");
if(isset($_SESSION['rol'])){   
  $rol = $_SESSION['rol'];
}

$con = conectar_db("electricidad_fcv");
//Comprobar que el usuario de la sesión es administrador o empleado

if($rol == 'administrador' || $rol == 'empleado'){
      
        ?>
        <main class="panelUsu">
            <div class="panelUsu__heading">
                    <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
                    <p>Complete una opción:</p>            
            </div>        
            <form  name="formBusca" method="post" action="verificaBuscaPed.php">
                    <h2>Buscador:</h2>
                    <div>                
                        <label for="codigo">Código:</label>
                        <input id="codigo" type="num"  name="id"/>
                    </div>
                    <div>
                        <label for="usuario">Id_usuario:</label>
                        <input id="id_usuario" type="num"  name="id_usuario"/>

                    </div>
                    <div class="btns">
                        <input name="btnBuscar" type="submit" class="btn" id="btnLogA" value="Buscar"/>
                        <input name="btnVolver" type="submit" class="btn" id="btnLogC" value="Volver"/>
                    </div>          
                </form>
        </main>    
        

            <?php

}

if($rol == 'usuario'){
    $hoy=date('Y-m-d'); 
    ?>
    <main class="panelUsu">
      <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Complete:</p>            
      </div>        
      <form  name="formBusca" method="post" action="verificaBuscaPed.php">
            <h2>Buscador:</h2>
              <div>                
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha"
                        value="<?php echo $hoy; ?>";
                        min="2023-02-020" max="<?php echo $hoy; ?>";>
              </div>
             
              <div class="btns">
                <input name="btnBuscar" type="submit" class="btn" id="btnLogA" value="Buscar"/>
                <input name="btnVolver" type="submit" class="btn" id="btnLogC" value="Volver"/>
            </div>          
          </form>
</main>    
<?php
  }
include("pie.php");

?>


    
