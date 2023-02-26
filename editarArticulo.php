<?php 
include ("seguridad.php");
//Conectamos con MySQL y la base de datos clientes_db
include ("funciones.php");
include ("produtos/claseArticulo.php");

$usuario= $_SESSION['usuario'];   
$rol = $_SESSION['rol'];


$titulo_pagina = "Electricidad FCV - Editar Artículo";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

include("cabecera.php") ;
//por seguridad comprobamos que el usuario es adminstrador o empleado, si no salta al menú principal

if($rol == 'administrador' || $rol == 'empleado'){
//comprobamos que se recibe el id del artículo  

$id = $_REQUEST['id'];
  if(!isset($id)){
    header("Location: listaArticulos.php");
  }

//Conectamos a la base de datos para recibir los datos de ese artículo

  $con = conectar_db("electricidad_fcv");
  $sentencia = $con->prepare ("SELECT * FROM articulos WHERE id like ?;");
  $sentencia -> execute([$id]);  
  $articulo = $sentencia ->fetch(PDO::FETCH_OBJ);
 
  if(isset($_REQUEST['error'])){
    echo "<div id='error'><h2>{$_REQUEST['error']}</h2></div>";
  }

?>

<main class="panelUsu">
      <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Selecciona una opción:</p>            
      </div>    
     

      <form class="formulario-alta" method="POST" action="productos/modificarArticulo.php" name="formInsertar" enctype="multipart/form-data">
        <h2>Edita articulo:</h2> 
            <input type="hidden" id='id' name='id' value="<?php echo $id; ?>">
            <div>
              <label for="codigo">Código</label>
              <input id="codigo" type="text" size="15" maxlength="8" name="id" 
              value="<?php echo $articulo -> id; ?> " disabled>             
              <label for=nombre>Nombre</label>
              <input id="nombre" type="text" maxlength="40" size="40" name="nombre"
              value="<?php echo $articulo -> nombre; ?>">
            </div>
            <div>
            <label for=descripción>Descripción</label>
            <input type="text" id="descripcion" value="<?php echo $articulo -> descripcion; ?>"
            name="descripcion"  maxlength='100'>
            </div>
            <div>
              <label for="categoria">Categoría: </label>
                <select name="id_categoria" id="categoria">              
                  <option value="1">Lamparas</option>
                  <option value="2">Bombillas</option>
                  <option value="3">Mecanismos</option>                         
                </select>
              <label for="precio">Precio:</label>
              <input id="precio" type="number" step="1" min="1" max="9999" name="precio" 
              value="<?php echo $articulo -> precio; ?>"/>
              <label for="stock">Stock: </label>
              <input type="number" min="0" name="stock" value="<?php echo $articulo -> stock; ?>"/>
            </div>
            <div>            
              <label for="estado">Estado: </label>
              <select name="estado" id="estado">                    
                  <option value="alta" selected>alta</option>
                  <option value="baja">baja</option> 
              </select>     
            </div>
            <div>           
              <label for="imagen">Imagen(300kb max.):</label>
              <input id="img" type="file" name="img" accept=".jpg, .jpeg, .png, .gif" value="<?php echo $articulo -> imagen; ?>"/>                      
            </div>
            <div><?php echo "<img src='{$articulo -> imagen}'>"; ?></div>
            <div class="btns">
              <input class="btn" type="submit" value="Modificar datos" name="modificar"/>                
              <input class="btn"  value="Cancelar" type="submit" name="btnCancelar"/>
            </div>      
      
      </form>
      
      <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>     
</main> 
  <?php
} else{
    header("Location:menuPrincipal.php");
}
include("pie.php");
?>


