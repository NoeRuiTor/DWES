<?php 
include ("seguridad.php");
//Conectamos con MySQL y la base de datos clientes_db
include ("funciones.php");
include ("produtos/clasePedido.php");

$usuario= $_SESSION['usuario'];   
$rol = $_SESSION['rol'];


$titulo_pagina = "Electricidad FCV - Editar Pedido";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

include("cabecera.php") ;
//por seguridad comprobamos que el usuario es adminstrador o empleado, si no salta al menú principal

if($rol == 'administrador' || $rol == 'empleado'){
//comprobamos que se recibe el id del artículo  

if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
}else{
    header("Location: listaPedidos.php");
  }

//Conectamos a la base de datos para recibir los datos de ese artículo

  $con = conectar_db("electricidad_fcv");
  $sentencia = $con->prepare ("SELECT * FROM pedido WHERE id = ?;");
  $sentencia -> execute([$id]);  
  $pedido = $sentencia ->fetch(PDO::FETCH_OBJ);
 
  if(isset($_REQUEST['error'])){
    echo "<div id='error'><h2>{$_REQUEST['error']}</h2></div>";
  }

?>

<main class="panelUsu">
      <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Selecciona una opción:</p>            
      </div>    
     

      <form class="formulario-alta" method="POST" action="productos/modificarPedido.php" >
        <h2>Edita pedido:</h2> 
             <input type="hidden" id='id' name='id' value="<?php echo $id; ?>">
            <div>
                <label for="codigo">Código</label>
                <input id="codigo" type="text"  name="id" 
                value="<?php echo $pedido -> id; ?> " disabled>             
                <label for=fecha>Fecha</label>
                <input id="fecha" type="text"  name="fecha" disabled
                value="<?php echo $pedido -> fecha; ?>">
            </div>
            <div>
                <label for=importe>Importe</label>
                <input type="num" id="importe" value="<?php echo $pedido -> importe; ?>"
                name="importe" disabled>             
                <label for="id_usuario">ID Usuario:</label>
                <input id="id_usuario" type="number"  name="id_usuario" disabled
                value="<?php echo $pedido -> id_usuario; ?>"/>              
            </div>
            <div>
             <label for="estado">Estado: </label>
                <select name="estado" id="estado">              
                  <option value="confirmado">Confirmado</option>
                  <option value="preparado">Preparado</option>
                  <option value="en_transito">En transito</option>  
                  <option value="entregado">Entregado</option>  
                  <option value="anulado">Anulado</option>                         
                </select>
            </div>
            <div class="btns">
              <input class="btn" type="submit" value="Modificar datos" name="modificar"/>                
              <input class="btn"  value="Cancelar" type="submit" name="btnCancelar"/>
            </div>      
      
      </form>
      
      <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>     
</main> 
  <?php

include("pie.php");

}else{
    header("location:menuPrincipal.php");
}
?>


