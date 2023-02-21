<?php

if(isset($_REQUEST['btnCancelarPed'])){

    header("location:tienda.php");
}
include ("seguridad.php");
include_once ("funciones.php"); 
include("productos/claseArticulo.php");

$titulo_pagina = "Electricidad FCV - Pedidos";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

include ("cabecera.php");

if($_SESSION['rol']=='administrador' || $_SESSION['rol']=='empleado'){
    header("location:../menuPrincipal.php");
}
//Cambio las cantidades del array del carrito asignando las cantidades que ha puesto nuevas el usuario;

if(isset($_REQUEST['cantidad'])){
        $cantidades = $_REQUEST['cantidad'];
        $carrito = $_SESSION['productos'];
        foreach ($cantidades as $clave => $valor) {
            if (array_key_exists($clave, $carrito)) {
                $carrito[$clave] = $valor;
            }
        }

        //Si algún producto ha puesto cantidad=0, lo borro del array.

        foreach($carrito as $clave => $valor){
            if($carrito[$clave] == 0){
                unset($carrito[$clave]);
            }
        }
    }        
        $con = conectar_db("electricidad_fcv");
        if(!empty($carrito)){

           
            ?>

<main class="panelPedido">
    <div class="panelPedido__heading">
          <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
           <p>Pedido</p>
    </div>
    <?php
    if(isset($_REQUEST['error'])){
          echo "<div id='error'>{$_REQUEST['error']}</div>";
        }
    ?>    
    <div>
    <form class="formPedido"  method="post" action="productos/finalizaPedido.php">                    
         <section class="resumenPed">           
               
                  <h3>Resumen pedido:</h3>
                    <table class="normal">
                            <thead>
                                <tr>               
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cant</th>                       
                                <th>Subtotal</th>                          
                                </tr>
                            </thead>                            
                            </tbody>                            
                                <?php
                                $ids = implode( ', ', array_keys($carrito));
                                $total=0;
                                $consulta="SELECT * FROM articulos WHERE id IN ($ids);";
                                $sentencia = $con->prepare($consulta);
                                $sentencia -> execute();
                                        $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
                                        while($articulo = $sentencia->fetch()){
                                            $cantidad=$carrito[$articulo->getId()];
                                            $subtotal = $cantidad * $articulo->getPrecio();
                                            $total += $subtotal;
                                            echo "<tr>";
                                            echo "<td>".$articulo->getNombre()."</td>";
                                            echo "<td>".$articulo->getPrecio()."€</td>";
                                            echo "<td>".$cantidad."</td>";
                                            echo "<td>".$subtotal."€</td>";                                    
                                            echo "</tr>";         
                                            
                                        }   $gastos_envio=0;
                                            if($total>60){$gastos_envio;}else{$gastos_envio+=6;}
                                            $total_compra=$total+$gastos_envio;
                                            echo "<tr>";
                                            echo "<td colspan='4' class='total-carrito'>
                                                  <p>Subtotal:  ".number_format(($total/1.21),2)."€</p>
                                                  <p>IVA:  ".number_format(($total*21/100),2)."€</p>
                                                  <p>GASTOS DE ENVIO:  ".$gastos_envio."€</p>
                                                  <p>TOTAL(IVA incluido):  ".$total_compra."€</p>
                                                  </td>";
                                        ?>
                             </tbody>
                    </table>
                    <div class="legal">
                    <input class="condiciones" name="condiciones" type="checkbox" value="condiciones"/>
                    <p><a href="termCondi.php">HE LEÍDO Y ACEPTO LOS TERMINOS DE USO Y CONDICIONES</a></p>
                    </div>
                           
        </section>        
        <section class="metodo-pago">       
                <h3>Método de pago:</h3>
                    <div>                                     
                    <img class="paypal" src="imgs/cc-paypal.svg" alt="paypal"><input type="radio" name="cobro" value="paypal"/>Pago con Paypal
                    </div>
                    <div>                                     
                    <img class="visa" src="imgs/cc-visa.svg" alt="visa"><input type="radio" name="cobro" value="tarjeta"/>Pago con tarjeta
                    </div>
                    <div>                                     
                    <img class="bizum" src="imgs/bizum.svg" alt="bizum"><input type="radio" name="cobro" value="bizum"/>Pago por Bizum
                    </div>
        </section>
                <?php
                $id=$_SESSION['id'];
                $sentencia = $con->prepare ("SELECT nombre,apellidos,direccion,localidad,provincia FROM usuarios WHERE id LIKE ?;");
                $sentencia -> execute([$id]);  
                $usuario = $sentencia ->fetch(PDO::FETCH_OBJ);
                ?>
        <section class="datos-envio">
                 <h3>Datos envío:</h3>
                 <div>   
                    <label for="nombre">Nombre:</label>
                    <input class="input" id="nombre" type="text" maxlength="20" name="nombre" pattern="[A-Za-zñáéíóú ]+" disabled
                    value="<?php echo $usuario -> nombre; ?>">
                </div>              
                <div>
                    <label for="apellidos">Apellidos:</label>
                    <input class="input" id="apellidos" type="text" maxlength="30" name="apellidos" pattern="[A-Za-zñáéíóú ]+"disabled 
                    value="<?php echo $usuario -> apellidos; ?>">                    
                </div>
                <div>
                    <label for="direccion">Dirección:</label>
                    <input type="text"  name="direccion" maxlength="30" disabled
                    value="<?php echo $usuario -> direccion; ?>">               
                </div>             
                <div>
                    <label for="localidad">Localidad:</label>
                    <input type="text" maxlength="30"  name="localidad" pattern="[A-Za-zñáéíóú ]+" disabled                    
                    value="<?php echo $usuario -> localidad; ?>">
                </div>
                <div>
                    <label for="provincia">Provincia:</label>
                    <input type="text" maxlength="30"  name="provincia" pattern="[A-Za-zñáéíóú ]+" disabled
                    value="<?php echo $usuario -> provincia; ?>">
                </div>
                <div class="privacidad">
                <input  name="privacidad" type="checkbox" value="privacidad"/>
                <p><a href="poliPriva.php">ACEPTO LAS CONDICIONES GENERALES Y POLÍTICAS DE PRIVACIDAD</a></p>
                </div>
        </section>
      </div>
      <?php $_SESSION['productos']=$carrito; $_SESSION['total_compra'] = $total_compra;?>
      <div class="btns-pedido">  
                <div class="btns">
                    <input class="btn" type="submit" value="Finalizar Pedido" name="finaliza"/>                
                    <input class="btn"  value="Cancelar" type="submit" name="btnCancelar"/>
                    <input class="btn"  value="Cambiar dirección" type="submit" name="btnEditar"/>
                </div> 
      </div>   
    </form>
    <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div>
                    
</main>
        <?php
        } 
       
include("pie.php");


?>