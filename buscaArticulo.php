<?php 
 


include_once ("../seguridad.php");
include_once("funciones.php");

$titulo_pagina = "Electricidad FCV - Buscador";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

include("cabecera.php");
if(isset($_SESSION['rol'])){   
  $rol = $_SESSION['rol'];
}

//Comprobar que el usuario de la sesión es administrador o empleado

if($rol == 'administrador' || $rol == 'empleado'){
$con = conectar_db("electricidad_fcv");
?>
<main class="panelUsu">
      <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Complete una opción:</p>            
      </div>        
      <form  name="formBusca" method="post" action="verificaBuscaArti.php">
            <h2>Buscador:</h2>
              <div>                
                <label for="codigo">Código:</label>
                <input id="codigo" type="text" size="15" maxlength="8" name="id"/>
              </div>
              <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" size="15" maxlength="8" name="nombre"/>
              </div>
              <div class="btns">
                <input name="btnBuscar" type="submit" class="btn" id="btnLogA" value="Buscar"/>
                <input name="btnVolver" type="submit" class="btn" id="btnLogC" value="Volver"/>
            </div>          
          </form>
</main>    
   

    <?php
} else{
    header("Location:listaArticulos.php");
  }
include("pie.php");
?>


    
