<?php 
include ("seguridad.php");

include_once("funciones.php");

$titulo_pagina = "Electricidad FCV - Alta Categoria";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

include("cabecera.php");
if(isset($_SESSION['rol'])){   
  $rol = $_SESSION['rol'];
}


//Comprobar que el usuario de la sesión es administrador o empleado

if($rol == 'administrador' || $rol == 'empleado' ){

 
?>
<main class="panelUsu">
      <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Selecciona una opción:</p>            
      </div>
     
           

      <form class="formulario-alta" method="post" action="productos/insertarCategoria.php" name="formNuevaCategoria">
            <h2>Alta de Categoria:</h2>
            <div>       
              <label for="nombre">ID: </label>
              <input id="nombre" type="number" min="1" maxlength="3" name="id"
              value="<?php if(isset($_REQUEST['id'])) echo $_REQUEST['id']; ?>">    
                  
              <label for="nombre">Nombre: </label>
              <input id="nombre" type="text" maxlength="40" size="40" name="nombre"
              value="<?php if(isset($_REQUEST['nombre'])) echo $_REQUEST['nombre']; ?>">
            </div>
            <div>
              <label for="descripcion">Descripción: </label>
              <input type="text" id="descripcion" placeholder="Añade una descripción" 
              name="descripcion" maxlength='100' ><?php if(isset($_REQUEST['descripcion'])) 
              echo $_REQUEST['descripcion']; ?>
            </div>         
           
            <div class="btns">
              <input class="btn" type="submit" value="Enviar" name="enviar">
              <input class="btn" type="reset" value="Borrar" name="borrar">
              <input class="btn"  value="Volver" type="submit" name="btnVolver">
            </div>

      </form>
      <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>     
</main>       
<?php   
    echo "<div class='errores'>";

    if(isset($_REQUEST['error'])){
      echo "<div class='error'>{$_REQUEST['error']}</div>";
    }
   
    echo "</div>";
} else{
    header("Location:menuPrincipal.php");
  }

include("pie.php");
?>
