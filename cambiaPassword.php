<?php

include_once("funciones.php");

$titulo_pagina = "Electricidad FCV - Acceso Usuarios";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";
$current_page = 'iniciaSesion.php';

include("cabecera.php");

 
 if(isset($_SESSION["autentificado"]) && ($_SESSION["autentificado"] == "OK")){
   header('Location:menuPrincipal.php');
 }

 if(isset ($_GET['enviar'] )){
    $dni = $_GET['dni'];
      
 }
 if(isset ($_GET['volver'] )){
   header("location:iniciaSesion.php");
 }
 ?>
 
 <main class="formularios">
    <section class="formularios__section"> 
            
        <form class="formulario-alta" name="cambiaPwd" method="GET" >
          <fieldset>
            <div>
            <label for="dni">DNI:</label>            
            <input id="dni" type="text" size="15" maxlength="9" name="dni" 
                 value="<?php if(isset($dni)) echo $dni; ?>"><br><br>  
            </div>

            <div class="btns">
              <input class="btn" type="submit" value="Enviar" name="enviar">
              <input class="btn"  value="Volver" type="submit" name="volver">
            </div>

          </fieldset>
        </form>
    </section>
          <?php
        
           if(isset ($_GET['enviar'])  && !empty ($_GET['dni'])){    
            
           

                //Conectamos con la base de datos 
              
                $con = conectar_db("electricidad_fcv"); 
                $sentencia = $con -> prepare("SELECT * FROM usuarios WHERE dni like ? ;");
                $sentencia -> execute([$dni]);       
                $filas = $sentencia -> rowCount();
            
                if($filas!=0){
                 
                  ?>
          <section class="formularios__section">
                    <form  class="formulario-alta" method="post" action="usuarios/verificaCambiaPassword.php">
                          <fieldset>
                             <div>
                                <label for="password">Nueva Contraseña:</label>
                                
                                <input id="password" type="password" maxlength="8" size="40" name="password" placeholder="8 caracteres">                       
                                <input type="hidden" name="dni" value="<?php echo $dni ?> ">
                             </div>
                             <div class="btns">
                                <input class="btn" type="submit" value="Enviar" name="cambiarPwd">
                                <input class="btn"  value="Volver" type="submit" name="btnCancelar">
                              </div>
                          </fieldset>
                     </form>
                
                  <?php
                }else{
                    echo "<div>";         
                    echo "<h3>NO EXISTEN CLIENTES CON ESE DNI</h3>"; 
                    echo "</div>";                   
                }
          }        
          
          
          
          ?>          
  </section>
 </main>
 <?php
 include("pie.php");
 ?>