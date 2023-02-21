
<?php

  
      include_once("funciones.php");

      $titulo_pagina = "Electricidad FCV - Alta Usuario";
      $description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
      energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
      $keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";
      
     
      include_once("cabecera.php");
      if(isset($_SESSION["autentificado"]) && ($_SESSION["autentificado"] == "OK")){
        header('Location:menuPrincipal.php');
      }

      if(isset($_GET['existenDatos']) || isset($_GET['existeRol']) || isset($_GET['repeUser']) || isset($_GET['existeApellidos'])
      || isset ($_GET['existeDni']) || isset ($_GET['correctoDni']) || isset ($_GET['existeUsuario'])){
      
       
            
              echo "<div class='errores'>";
              if($_GET['existeUsuario']==false){
                echo "<p>Error en el campo USUARIO. El email no tiene un formato correcto.</p>";        
              }
              if($_GET['existeDni']==false || ($_GET['correctoDni']== false)){
                echo "<p>Error en el campo DNI, vuelva a introducirlo</p>";        
              }
              if($_GET['existenDatos']==false){
                echo "<p>Compruebe que ha introducido todos los datos</p>";     
              }
              
              if($_GET['repeUser']==true){
                echo "<p>El correo introducido ya existe en la base de datos</p>";
              } 
              
              if($_GET['existeRol']==false){
                echo "<p>Debe indicar el rol del usuario</p>";
              }
              echo "</div> ";
            }  
      
    ?>

     <main class="formularios">
        <section class="formularios__section">              

            <form class="formulario-alta" method="post" action="usuarios/insertar.php" name="formInsertar">
                    <h2>Nuevo usuario:</h2>                
                    <div>
                      <label for="dni">DNI: </label>
                      <input id="dni" type="text" size="15" maxlength="9" name="dni" pattern="[0-9]{8}[a-zA-Z]" 
                      value="<?php if(isset($_GET['dni'])) echo $_GET['dni']; ?>">                    
                      <label for="nombre">Nombre: </label>
                      <input class="input" id="nombre" type="text" maxlength="20" name="nombre" pattern="[A-Za-zñáéíóú ]+" 
                      value="<?php if(isset($_GET['nombre'])) echo $_GET['nombre']; ?>">
                    </div>
                    <div>
                      <label for="apellidos">Apellidos: </label>
                      <input class="input" id="apellidos" type="text" maxlength="30" name="apellidos" pattern="[A-Za-zñáéíóú ]+" 
                      value="<?php if(isset($_GET['apellidos'])) echo $_GET['apellidos']; ?>">
                      <label for="telefono">Teléfono:</label>
                      <input type="tel"  name="telefono" pattern="[0-9]{9}" 
                      value="<?php if(isset($_GET['telefono'])) echo $_GET['telefono']; ?>">
                    </div>
                    <div>
                      <label for="direccion">Dirección: </label>
                      <input type="text"  name="direccion" maxlength="30"
                      value="<?php if(isset($_GET['direccion'])) echo $_GET['direccion']; ?>">
                    </div>                                   
                    <div>
                      <label for="localidad">Localidad:</label>
                      <input type="text" maxlength="30"  name="localidad" pattern="[A-Za-zñáéíóú ]+" 
                      value="<?php if(isset($_GET['localidad'])) echo $_GET['localidad']; ?>">
                      <label for="provincia">Provincia:</label>
                      <input type="text" maxlength="30"  name="provincia" pattern="[A-Za-zñáéíóú ]+" 
                      value="<?php if(isset($_GET['provincia'])) echo $_GET['provincia']; ?>">
                    </div>
                    <div>
                      <label for="email">Usuario:</label>
                      <input id="correo" type="email" maxlength="40"  name="email" placeholder="correo@example.com"
                      pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}" 
                      value="<?php if(isset($_GET['email'])) echo $_GET['email']; ?>">
                      <label for="password">Contraseña:</label>
                      <input id="clave" type="password" maxlength="60"  name="password" placeholder="8 caracteres">      
                    </div> 
                    <div>                                            
                      <input id="rol" type="hidden"  name="rol" value="usuario">         
                      <input id="estado" type="hidden" name="estado" value="alta">
                    </div>  
                    <div class="btns">
                      <input class="btn" type="submit" value="Enviar" name="enviar">
                      <input class="btn" type="reset" value="Borrar" name="borrar">
                      <input class="btn"  value="Volver" type="submit" name="btnVolver">
                    </div>
                
            
          </form>
          
      </section>
    </main>
<?php
 
include_once("pie.php");
          
         
          ?>
              

       
      
    
   

