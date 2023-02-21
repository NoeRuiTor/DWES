<?php 

include("seguridad.php");

include_once ("funciones.php");

include_once ("usuarios/claseUsuario.php");

$titulo_pagina = "Electricidad FCV - Editar Usuario";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

include("cabecera.php") ;
?>
<main class="panelUsu">
      <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Selecciona una opción:</p>            
      </div>   
<?php
//comprobamos que se recibe el id del cliente  
$id = $_REQUEST['id'];
  if(!isset($id)){
    header("Location: datosUsuario.php");
  }

//Conectamos a la base de datos para recibir los datos de ese cliente

  $con = conectar_db("electricidad_fcv");
if($_SESSION['rol']=='administrador'){
  $sentencia = $con->prepare ("SELECT dni,nombre,apellidos,direccion,localidad,provincia,email,telefono,rol,estado FROM usuarios WHERE id LIKE ?;");
  $sentencia -> execute([$id]);  
  $usuario = $sentencia ->fetch(PDO::FETCH_OBJ);


?>
     

      <form class="formulario-alta" method="post" action="usuarios/modificar.php" name="formInsertar">
        <h2>Edita usuario:</h2> 
               
              <div>               
                <label for="dni">DNI:</label>
                <input id="dni" type="text" size="15" maxlength="9" name="dni" pattern="[0-9]{8}[a-zA-Z]" disabled
                value="<?php echo $usuario -> dni; ?> ">
                <label for="nombre">Nombre:</label>
                <input class="input" id="nombre" type="text" maxlength="20" name="nombre" pattern="[A-Za-zñáéíóú ]+" disabled
                value="<?php echo $usuario -> nombre; ?>">
              </div>              
              <div>
                <label for="apellidos">Apellidos:</label>
                <input class="input" id="apellidos" type="text" maxlength="30" name="apellidos" pattern="[A-Za-zñáéíóú ]+" disabled 
                value="<?php echo $usuario -> apellidos; ?>">
                <label for="telefono">Teléfono:</label>
                <input type="tel"  name="telefono" pattern="[0-9]{9}" 
                value="<?php echo $usuario -> telefono; ?>">
              </div>
              <div>
                <label for="direccion">Dirección:</label>
                <input type="text"  name="direccion" maxlength="30"
                value="<?php echo $usuario -> direccion; ?>">               
              </div>             
              <div>
                <label for="localidad">Localidad:</label>
                <input type="text" maxlength="30"  name="localidad" pattern="[A-Za-zñáéíóú ]+" 
                 value="<?php echo $usuario -> localidad; ?>">
                <label for="provincia">Provincia:</label>
                <input type="text" maxlength="30"  name="provincia" pattern="[A-Za-zñáéíóú ]+" 
                value="<?php echo $usuario -> provincia; ?>">
            </div>
            <div>
              <label for="email">Usuario:</label>
              <input id="correo" type="email" maxlength="40"  name="email" placeholder="correo@example.com" disabled
              pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}" 
              value="<?php echo $usuario -> email; ?>">              
            </div>                                          
            <div>
              <label for="rol">Rol</label>            
              <select name="rol" id="rol">                    
                  <option value="usuario" selected>Usuario</option>
                  <option value="administrador">Administrador</option>
                  <option value="empleado">Empleado</option>                    
              </select> 
              <label for="estado">Estado</label>
              <select name="estado" id="estado">                    
                  <option value="alta" selected>Alta</option>
                  <option value="baja">baja</option> 
              </select>   
              <input type="hidden" name="id" value="<?php echo $id ?>" >           
            </div>            
          <div class="btns">
            <input class="btn" type="submit" value="Enviar" name="modificar">
            <input class="btn"  value="Volver" type="submit" name="btnCancelar">
          </div>
    
      
     </form>       


     <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>

</main>

<?php
}else{

  $sentencia = $con->prepare ("SELECT dni,nombre,apellidos,direccion,localidad,provincia,email,telefono FROM usuarios WHERE id LIKE :id;");
  $sentencia -> execute([':id'=>$id]);  
  $usuario = $sentencia ->fetch(PDO::FETCH_OBJ);


?>


      <form class="formulario-alta" method="post" action="usuarios/modificar.php" name="formInsertar">
        <h2>Edita usuario:</h2> 
               
              <div>               
                <label for="dni">DNI:</label>
                <input id="dni" type="text" size="15" maxlength="9" name="dni" pattern="[0-9]{8}[a-zA-Z]" disabled
                value="<?php echo $usuario -> dni; ?> ">
                <label for="nombre">Nombre:</label>
                <input class="input" id="nombre" type="text" maxlength="20" name="nombre" pattern="[A-Za-zñáéíóú ]+" disabled
                value="<?php echo $usuario -> nombre; ?>">
              </div>              
              <div>
                <label for="apellidos">Apellidos:</label>
                <input class="input" id="apellidos" type="text" maxlength="30" name="apellidos" pattern="[A-Za-zñáéíóú ]+" disabled
                value="<?php echo $usuario -> apellidos; ?>">
                <label for="telefono">Teléfono:</label>
                <input type="tel"  name="telefono" pattern="[0-9]{9}" 
                value="<?php echo $usuario -> telefono; ?>">
              </div>
              <div>
                <label for="direccion">Dirección:</label>
                <input type="text"  name="direccion" maxlength="30"
                value="<?php echo $usuario -> direccion; ?>">               
              </div>             
              <div>
                <label for="localidad">Localidad:</label>
                <input type="text" maxlength="30"  name="localidad" pattern="[A-Za-zñáéíóú ]+" 
                 value="<?php echo $usuario -> localidad; ?>">
                <label for="provincia">Provincia:</label>
                <input type="text" maxlength="30"  name="provincia" pattern="[A-Za-zñáéíóú ]+" 
                value="<?php echo $usuario -> provincia; ?>">
            </div>
            <div>
              <label for="email">Usuario:</label>
              <input id="correo" type="email" maxlength="40"  name="email" placeholder="correo@example.com" disabled
              pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}" 
              value="<?php echo $usuario -> email; ?>">              
            </div>                                     
           
              <input type="hidden" name="id" value="<?php echo $id ?>" >           
            </div>            
          <div class="btns">
            <input class="btn" type="submit" value="Enviar" name="modificar">
            <input class="btn"  value="Volver" type="submit" name="btnCancelar">
          </div>
    
      
     </form>       


     <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>

</main>

<?php

}
include("pie.php");
if(isset($_REQUEST['existeNombre']) || isset($_REQUEST['existeEstado']) || isset ($_REQUEST['existeRol'])){

  echo " <div class='errores'>"; 
    if($_REQUEST['existeEstado']){
      echo "<p>Error en el campo ESTADO. Vuelva a introducirlo</p>";
      echo "<style type='text/css'> #correo {background-color: red;}</style>";
    }
    if($_REQUEST['existeNombre']){
      echo "<p>Error en el campo NOMBRE. Vuelva a introducirlo</p>";
      echo "<style type='text/css'> #nombre {background-color: red;}</style>";
    }
    if($_REQUEST['existeRol']){
      echo "<p>Error en el campo ROL. Vuelva a introducirlo</p>";
      echo "<style type='text/css'> #rol {background-color: red;}</style>";
    }
    if($_REQUEST['existenDatos']){
      echo "<p>Error complete todos los campos</p>";
      echo "<style type='text/css'> #rol {background-color: red;}</style>";
    }
  echo "</div>";
  }  

?>