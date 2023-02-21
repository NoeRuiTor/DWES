<?php
    
    include ("seguridad.php");
    include ("funciones.php");
    
    $titulo_pagina = "Electricidad FCV - Listado Articulos";
    $description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
    energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
    $keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";

    include ("cabecera.php");
    
    if(isset($_SESSION['rol'])){
      $rol=$_SESSION['rol'];
    }
    if(isset ($_REQUEST['btnVolver'])){

      header("location:menuPrincipal.php");
    }
    if(isset ($_REQUEST['imprimir'])){

        header("location:menuPrincipal.php");
      }
  
        
        
    if(isset($_REQUEST['error'])){
      echo "<div id='error'><h2>{$_REQUEST['error']}</h2></div>";
    }
 if($rol == 'administrador'){  
            if(isset($_REQUEST['tipoInfo'])){
                $tipoInfo = $_REQUEST['tipoInfo'];
           
             } 
             if($tipoInfo == 'ventas'){
               if(!empty($_REQUEST['fechaIni']) && !empty($_REQUEST['fechaFin'])){
                    $fechaIni = $_REQUEST['fechaIni'];
                    $fechaFin = $_REQUEST['fechaFin'];
                }else{
                    $error= "Introduzca un rango de fechas";
                    header("location:informes.php?error=$error");
             } 
             }
             $con = conectar_db("electricidad_fcv");
      ?>
    <main class="panelUsu">
         <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Informe de <?php echo $tipoInfo ?>:</p>            
        </div>
        <div class="informes">
           <?php
            switch($tipoInfo){
                case('altas/bajas-Usuarios'):
                        ?>
                        <table class="normal">
                            
                                
                            <tr>
                                <th>Altas usuarios en el sistema</th>
                                <th>Bajas usuarios en el sistema</th>            
                                
                            </tr>
                            <?php
                                //Consulta altas
                                    $sqlaltas = "SELECT SUM(CASE WHEN estado = 'alta' THEN 1 ELSE 0 END)  AS total_altas FROM usuarios WHERE rol LIKE 'usuario'";
                                    $sentencia = $con->prepare($sqlaltas);
                                    $sentencia->execute();              
                                    $resultadoAltas = $sentencia->fetch(PDO::FETCH_ASSOC);

                                //Consulta bajas
                                    $sqlbajas = "SELECT SUM(CASE WHEN estado = 'baja' THEN 1 ELSE 0 END)  AS total_bajas FROM usuarios WHERE rol LIKE 'usuario'";
                                    $sentencia = $con->prepare($sqlbajas);
                                    $sentencia->execute();              
                                    $resultadoBajas = $sentencia->fetch(PDO::FETCH_ASSOC); 

                                        echo "<tr>";
                                        echo "<td>".$resultadoAltas['total_altas']."</td>";
                                        echo "<td>".$resultadoBajas['total_bajas']."</td>";
                                        echo "</tr>";
                    break;
                    case('altas/bajas-Articulos'):
                        ?>
                        <table class="normal">
                            
                                
                            <tr>
                                <th>Altas articulos en el sistema</th>
                                <th>Bajas articulos en el sistema</th>            
                                
                            </tr>
                            <?php
                                //Consulta altas
                                    $sqlaltas = "SELECT SUM(CASE WHEN estado = 'alta' THEN 1 ELSE 0 END)  AS total_altas FROM articulos ";
                                    $consulta = $con->prepare($sqlaltas);
                                    $consulta->execute();              
                                    $resultadoAltas = $consulta->fetch(PDO::FETCH_ASSOC);

                                //Consulta bajas
                                    $sqlbajas = "SELECT SUM(CASE WHEN estado = 'baja' THEN 1 ELSE 0 END)  AS total_bajas FROM articulos ";
                                    $consulta = $con->prepare($sqlbajas);
                                    $consulta->execute();              
                                    $resultadoBajas = $consulta->fetch(PDO::FETCH_ASSOC); 

                                        echo "<tr>";
                                        echo "<td>".$resultadoAltas['total_altas']."</td>";
                                        echo "<td>".$resultadoBajas['total_bajas']."</td>";
                                        echo "</tr>";
                    break;
                    case('ventas'):
                        ?>
                        <table class="normal">
                            
                                
                            <tr>
                                <th>Total ventas desde <?php echo $fechaIni?> hasta <?php echo $fechaFin ?></th>                                           
                                
                            </tr>
                            <?php
                               $sql = "SELECT SUM(importe) AS importe_total FROM pedido WHERE fecha BETWEEN :fecha_ini AND :fecha_fin and estado NOT LIKE 'anulado'";
                               $consulta = $con->prepare($sql);                             
                               
                               $consulta->execute([':fecha_ini'=>$fechaIni,':fecha_fin'=>$fechaFin]);
                               
                               $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

                                        echo "<tr>";
                                        echo "<td>".$resultado['importe_total']."€</td>";                                       
                                        echo "</tr>";
                    break;
            }
           ?>
      </table>
     </div>
     <div class="btns">
                    
                    <form method="get" action=""><button class="btn" type="submit" name="imprimir">Imprimir</button></form>                    
                    
                    
                    <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>
                
     </div>

     <div class='logout'><h3><a href="usuarios/logout.php">Desconectar</a></h3></div> 

    </main>         
<?php
 include("pie.php");    
    
    
}else{
     header("Location:menuPrincipal.php");
 }   
        
    
    if(isset ($_REQUEST['btnVolver'])){

        header("location:infomes.php");
      }
   
     
?>
   
 