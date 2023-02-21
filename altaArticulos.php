<?php 
include ("seguridad.php");

include_once("funciones.php");

$titulo_pagina = "Electricidad FCV - Alta Articulos";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

include("cabecera.php");
if(isset($_SESSION['rol'])){   
  $rol = $_SESSION['rol'];
}


//Comprobar que el usuario de la sesión es administrador o empleado, si es usuario no puede dar de alta artículos

if($rol == 'administrador' || $rol == 'empleado'){

 
?>
<main class="panelUsu">
      <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Selecciona una opción:</p>            
      </div>
     
           

      <form class="formulario-alta" method="post" action="productos/insertarArticulo.php" name="formNuevoArticulo" enctype="multipart/form-data">
            <h2>Alta de artículos:</h2>
            <div>       
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
            <div>
              <label for="categoria">Categoría: </label>
              <select name="id_categoria" id="categoria">              
                <option value="1">Lamparas</option>
                <option value="2">Bombillas</option>
                <option value="3">Mecanismos</option>                         
              </select>
              <label for="precio">Precio: </label>
              <input id="precio" type="number"  min="1" max="9999" name="precio" 
              value="<?php if(isset($_REQUEST['precio'])) echo $_REQUEST['precio']; ?>">
              <label for="stock">Stock: </label>
              <input type="number" min="0" name="stock" value="<?php if(isset($_REQUEST['stock'])) 
               echo $_REQUEST['stock']; ?>">
            </div>
            <div>             
              <label for="imagen">Imagen(300kb max.):</label>
              <input id="img" type="file" name="img" accept=".jpg, .jpeg, .png, .gif">
              <label for="estado">Estado: </label>
              <select name="estado" id="estado">                    
                  <option value="alta" selected>Alta</option>
                  <option value="baja">baja</option> 
              </select>   
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
    if(isset($_REQUEST['errorImg']) && ($_REQUEST['errorImg']) == false){
      echo "<div class='error'>La imagen introducida no tiene el formato correcto</div>";
    }
    if(isset($_REQUEST['estadoCorrecto']) && ($_REQUEST['estadoCorrecto']) == false){
      echo "<div class='error'>Debe introducir un estado o no es una opción correcta</div>";
    }
    if(isset($_REQUEST['stockCorrecto']) && ($_REQUEST['stockCorrecto']) == false){
      echo "<div class='error'>Debe introducir un stock o no es un formato correcto</div>";
    }
    echo "</div>";
} else{
    header("Location:menuPrincipal.php");
  }

include("pie.php");
?>
