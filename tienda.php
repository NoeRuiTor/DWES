<?php

include_once("funciones.php");
include("productos/claseArticulo.php");

$titulo_pagina = "Electricidad FCV - Tienda";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, lámparas, Castalla";
$current_page = 'tienda.php';

session_start();
if(isset($_REQUEST['añadir']) && isset($_REQUEST['id_articulo'])){
if (!array_key_exists('productos', $_SESSION)) {
    $_SESSION['productos'] = [];
}
  $producto=$_REQUEST['id_articulo'];
 $_SESSION['productos'][$producto] = array_key_exists($producto, $_SESSION['productos']) ? $_SESSION['productos'][$producto] + 1 : 1;

 //print_r($_SESSION); 
}
include("cabecera.php");

//PAGINACIÓN

//Limito la búsqueda de cada página
$PAGS = 6;
//inicializamos la pagina y el inicio para el límite de SQL
$pagina = 1;
$inicio = 0;
//examino la página a mostrar y la muestro si existe
if(isset($_GET["pagina"])){
$pagina = $_GET["pagina"];
$inicio = ($pagina - 1) * $PAGS;
}


$con = conectar_db("electricidad_fcv");

if(isset($_REQUEST['id_categoria'])){
  $id_categoria=$_REQUEST['id_categoria'];

  //según la variable id_categoria recibida consultamos los articulos en la base de datos que corresponden a esa categoría

  switch($id_categoria){
    case 1:         
            
            //filtro
            if(isset($_REQUEST['filtrar']) && $_REQUEST['filtro']=='asc'){
              $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 1 ORDER BY precio ASC";              
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              //contar los registros y las páginas con la división entera
              $num_total_registros = $sentencia->rowCount();
              $total_paginas = ceil($num_total_registros / $PAGS);
              $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 1 ORDER BY precio ASC LIMIT ".$inicio."," .$PAGS."");
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
            }
            elseif(isset($_REQUEST['filtrar']) && $_REQUEST['filtro']=='des'){
              $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 1 ORDER BY precio DESC";              
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              //contar los registros y las páginas con la división entera
              $num_total_registros = $sentencia->rowCount();
              $total_paginas = ceil($num_total_registros / $PAGS);
              $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 1 ORDER BY precio DESC LIMIT ".$inicio."," .$PAGS."");
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
            }
            else{
              $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 1";              
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              //contar los registros y las páginas con la división entera
              $num_total_registros = $sentencia->rowCount();
              $total_paginas = ceil($num_total_registros / $PAGS);
              $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 1 LIMIT ".$inicio."," .$PAGS."");
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
            }
        break;
    case 2:
            
            //filtro
            if(isset($_REQUEST['filtrar']) && $_REQUEST['filtro']=='asc'){
              $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 2 ORDER BY precio ASC";              
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              //contar los registros y las páginas con la división entera
              $num_total_registros = $sentencia->rowCount();
              $total_paginas = ceil($num_total_registros / $PAGS);
              $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 2 ORDER BY precio ASC LIMIT ".$inicio."," .$PAGS."");
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
            }
            elseif(isset($_REQUEST['filtrar']) && $_REQUEST['filtro']=='des'){
              $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 2 ORDER BY precio DESC";              
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              //contar los registros y las páginas con la división entera
              $num_total_registros = $sentencia->rowCount();
              $total_paginas = ceil($num_total_registros / $PAGS);
              $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 2 ORDER BY precio DESC LIMIT ".$inicio."," .$PAGS."");
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
            }else{
              $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 2";            
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              //contar los registros y las páginas con la división entera
              $num_total_registros = $sentencia->rowCount();
              $total_paginas = ceil($num_total_registros / $PAGS);
              $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 2 LIMIT ".$inicio."," .$PAGS."");
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
            }
        break;
    case 3: 
            
            //filtro
            if(isset($_REQUEST['filtrar']) && $_REQUEST['filtro']=='asc'){
              $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 3 ORDER BY precio ASC";              
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              //contar los registros y las páginas con la división entera
              $num_total_registros = $sentencia->rowCount();
              $total_paginas = ceil($num_total_registros / $PAGS);
              $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 3 ORDER BY precio ASC LIMIT ".$inicio."," .$PAGS."");
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
            }
            elseif(isset($_REQUEST['filtrar']) && $_REQUEST['filtro']=='des'){
              $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 3 ORDER BY precio DESC";              
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              //contar los registros y las páginas con la división entera
              $num_total_registros = $sentencia->rowCount();
              $total_paginas = ceil($num_total_registros / $PAGS);
              $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 3 ORDER BY precio DESC LIMIT ".$inicio."," .$PAGS."");
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
            }else{
              $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 3";            
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              //contar los registros y las páginas con la división entera
              $num_total_registros = $sentencia->rowCount();
              $total_paginas = ceil($num_total_registros / $PAGS);
              $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and id_categoria = 3 LIMIT ".$inicio."," .$PAGS."");
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
            }
        break;
    
  }
  // si recibimos una busqueda a traves del buscador de la cabecera
}elseif(isset($desc)){
  $descripcion = '%'.$desc.'%' ;            
 
  $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and descripcion like ?";
  $sentencia = $con->prepare($sql);
  $sentencia -> execute([$descripcion]);
  $filas = $sentencia -> rowCount();

  if($filas>=1){
      //contar los registros y las páginas con la división entera
      $num_total_registros = $sentencia->rowCount();
      $total_paginas = ceil($num_total_registros / $PAGS);
      $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 and descripcion like ? LIMIT ".$inicio."," .$PAGS."");
      $sentencia -> execute([$descripcion]);
      $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
     
  }else{

      echo "<h2 class='noExiste'>No existen coincidencias, inténtelo de nuevo</h2>";
  }
 //y si no, mostrar todo el catálogo

}else{
    
            //filtro
            if(isset($_REQUEST['filtrar']) && $_REQUEST['filtro']=='asc'){
              $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0  ORDER BY precio ASC";              
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              //contar los registros y las páginas con la división entera
              $num_total_registros = $sentencia->rowCount();
              $total_paginas = ceil($num_total_registros / $PAGS);
              $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0  ORDER BY precio ASC LIMIT ".$inicio."," .$PAGS."");
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
            }
            elseif(isset($_REQUEST['filtrar']) && $_REQUEST['filtro']=='des'){
              $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0  ORDER BY precio DESC";              
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              //contar los registros y las páginas con la división entera
              $num_total_registros = $sentencia->rowCount();
              $total_paginas = ceil($num_total_registros / $PAGS);
              $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0  ORDER BY precio DESC LIMIT ".$inicio."," .$PAGS."");
              $sentencia -> execute();
              $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
            }else{
              $sql = "SELECT * FROM articulos WHERE estado = 'alta' and stock > 0";    
              $sentencia = $con->prepare($sql);
              $sentencia -> execute();
              //contar los registros y las páginas con la división entera
                $num_total_registros = $sentencia->rowCount();
                $total_paginas = ceil($num_total_registros / $PAGS);
                $sentencia = $con->prepare("SELECT * FROM articulos WHERE estado = 'alta' and stock > 0 LIMIT ".$inicio."," .$PAGS."");
                $sentencia -> execute();
                $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
            }
}

?>
<main class="tienda">
        <div class="banner-info">
              <h3>Gastos de envío gratis por compras superiores a 60 €</h3>
        </div>
        <section class="content">        
             
              <div class="aside">
                  <div class="aside__left">
                      <h3>Catálogo</h3>
                      <ul>
                          <li><a class="<?php if($id_categoria == 1){active('tienda.php?id_categoria='.$lamparas);}?>" href="tienda.php?id_categoria=<?php echo $lamparas;?>">Lámparas</a></li>
                          <li><a class="<?php if($id_categoria == 2){active('tienda.php?id_categoria='.$bombillas);}?>" href="tienda.php?id_categoria=<?php echo $bombillas;?>">Bombillas</a></li>
                          <li><a class="<?php if($id_categoria == 3){active('tienda.php?id_categoria='.$mecanismos);}?>" href="tienda.php?id_categoria=<?php echo $mecanismos;?>">Mecanismos</a></li>
                      </ul>
                  </div>
      
              </div>
             <div id="tienda">
              <div class="catalogo"> 
            
              
            <!-----filtro por precio---->

                  <div class="filtro">
                    <form method="post" >
                    <label for="filtro-precio">Filtrar por precio:</label>
                    <select name="filtro" id="filtro">              
                        <option value="asc">Precio más bajo</option>
                        <option value="des">Precio más alto</option>                                            
                    </select> 
                    <input type="submit" name="filtrar" value="Filtrar">                
                    </form>
                  </div>
                <?php 
                  
                    //listamos articulos           
                   
                    
                    while($articulo = $sentencia->fetch())
                    echo $articulo -> muestraArticulo();

                echo "</div>";   
                echo "<div class='paginas'>";
                    if ($total_paginas > 1){
                       for ($i=1;$i<=$total_paginas;$i++){
                          if ($pagina == $i){
                          //si muestro el índice de la página actual, no coloco enlace
                          echo $pagina . " ";
                          }else{
                            //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
                            echo "<a href='tienda.php?pagina=". $i ."'>" . $i . "</a> ";
                          }
                       }
                      }
                      //número de registros total, el tamaño de página y la página que se muestra
                      //echo "<br> Número de registros encontrados: " . $num_total_registros . "<br>";
                     // echo "Se muestran páginas de " . $PAGS . " registros cada una<br>";
                     // echo "Mostrando la página " . $pagina . " de " . $total_paginas . "<p>";                     
                echo "</div>"
                ?>

              </div>
              <div class="aside">
                  <div class="aside__right">
                    <?php
                      if(isset($_SESSION['autentificado']) && $_SESSION['autentificado'] == 'OK' ){   
                    ?>                 
                        <h3><?php if(isset($_SESSION['nombre'])){echo 'Hola '.$_SESSION['nombre'];}; ?></h3>
                        <ul>
                          <li><a href="menuPrincipal.php">Mi Cuenta</a></li>
                          
                          <li><a href="usuarios/logout.php">Cerrar sesión</a></li>
                        </ul>

                    <?php
                      }else{
                    ?>
                      <h3>Login</h3>
                      <form class=form-login action="usuarios/login.php" method="post">
                          <label for="usuario">Usuario</label>
                          <input type="email" name="email" placeholder="correo@example.com">
                          <label for="contraseña">Contraseña</label>
                          <input  type="password" name="password" placeholder="8 caracteres">
                          <input type="submit" class="btn" value="Enviar">                      
                          <a href="cambiaPassword.php">Olvidé mi contraseña</a>
                          <a href="usuarioNuevo.php">Registro</a>
                          <?php
                          if(isset($_REQUEST['error'])){
                            echo "<div id='error'>{$_REQUEST['error']}</div>";
                          }
                          if(isset($_REQUEST['mensaje'])){
                            echo "<div id='mensaje'>{$_REQUEST['mensaje']}</div>";
                          }
                        }
                          ?>
                      </form>
                      <div class="aside-carrito">                        
                         <h3>Mi Carrito</h3>
                         <div class='carrito'>  
                          <?php
                            
                            if((!empty($_SESSION['productos']) && isset($_REQUEST['quitaProducto']))){
                                 $id_quita=$_REQUEST['quitaProducto'];
                              unset($_SESSION['productos'][$id_quita]);
                              
                            }
                           if(!empty($_SESSION['productos']) && isset($_REQUEST['vaciarCarro']) && isset($_REQUEST['reset'])) {                             
                            foreach ($_SESSION['productos'] as $clave => $valor) {
                              unset($_SESSION['productos'][$clave]);
                              }                                            
                            
                            }
                            if(!empty($_SESSION['productos'])){
                               $carrito = $_SESSION['productos'];
                               ?>
                               <table class="carrito-tabla">
                               <thead>
                                  <tr>               
                                     <th>Nombre</th>
                                     <th>Precio</th>
                                     <th>Cant</th>
                                     <th>Subtotal</th>
                                     <th> </th>    
                                  </tr>
                               </thead>
                               <tbody>
                               <?php 
                                muestraCarrito($con,$carrito); 
                            }else{
                              echo "<p>El carrito está vacío</p>";
                            }                           
                          
                           ?>
                                                
                           <div class="btns"> 
                              <form method='post'>
                                 <input type='hidden' name='vaciarCarro' value='vaciar'>                
                                 <input class='btn-carrito' type='submit' name='reset' value='Vaciar Carrito'>
                              </form>        
                         </div>
                         <div class="btns">
                              <div><a href="pedido.php"><button class="btn" name="pedir">Pedido</button></a></div> 
                           </div>                   
                          
                    </div>
                  </div>
              </div>
        </section>
</main>      
       
    

<?php
      
include("pie.php");


?>

