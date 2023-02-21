<?php 
include ("seguridad.php");
//Conectamos con MySQL y la base de datos clientes_db
include ("funciones.php");
include ("productos/claseCategoria.php");

$usuario= $_SESSION['usuario'];   
$rol = $_SESSION['rol'];


$titulo_pagina = "Electricidad FCV - Editar Categoria";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

include("cabecera.php") ;
//por seguridad comprobamos que el usuario es adminstrador o empleado, si no salta al menú principal

if($rol == 'administrador' || $rol == 'empleado'){
//comprobamos que se recibe el id de la categoria 

$id = $_REQUEST['id'];
  if(!isset($id)){
    header("Location: listaCategorias.php");
  }

//Conectamos a la base de datos para recibir los datos de ese artículo

  $con = conectar_db("electricidad_fcv");
  $sentencia = $con->prepare ("SELECT * FROM categoria WHERE id like ?;");
  $sentencia -> execute([$id]);  
  $categoria = $sentencia ->fetch(PDO::FETCH_OBJ);
 
  if(isset($_REQUEST['error'])){
    echo "<div id='error'><h2>{$_REQUEST['error']}</h2></div>";
  }

?>

<main class="panelUsu">
      <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Selecciona una opción:</p>            
      </div>    
     

      <form class="formulario-alta" method="POST" action="productos/modificarCategoria.php" name="formInsertar">
        <h2>Edita articulo:</h2> 
            <input type="hidden" id='id' name='id' value="<?php echo $id; ?>">
            <div>
              <label for="codigo">Código</label>
              <input id="codigo" type="text" size="15" maxlength="8" name="id" 
              value="<?php echo $categoria -> id; ?> " disabled>             
              <label for=nombre>Nombre</label>
              <input id="nombre" type="text" maxlength="40" size="40" name="nombre"
              value="<?php echo $categoria -> nombre; ?>">
            </div>
            <div>
            <label for=descripción>Descripción</label>
            <input type="text" id="descripcion" value="<?php echo $categoria -> descripcion; ?>"
            name="descripcion"  maxlength='100'>
            </div>
            
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


