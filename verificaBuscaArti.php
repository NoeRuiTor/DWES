<?php

include("productos/claseArticulo.php");
include ("seguridad.php");
include ("funciones.php");
$usuario= $_SESSION['usuario'];     
$rol = $_SESSION['rol'];


    if(isset ($_REQUEST['btnBuscar'])){    
       if(isset($_REQUEST['id'])){
        $id=$_REQUEST['id'];
       }
       if(isset($_REQUEST['nombre'])){
        $nom=$_REQUEST['nombre'];
       }
        
    }
include("cabecera.php"); 
    ?>
    <main class="panelUsu">
         <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Mantenimiento de articulos</p>            
        </div> 
    <?php
    if($rol == 'administrador' || $rol == 'empleado'){       
    ?>
        <table class="normal">
       
        <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Imagen</th>                
                <th class="edit">Editar</th>
            <?php 
              
                //Conectamos con la base de datos
                $con = conectar_db("electricidad_fcv"); 
                
                
         if($id){       
                
                $sentencia = $con -> prepare("SELECT * FROM articulos WHERE id like ?;");
                $sentencia -> execute([$id]);       
                $filas = $sentencia -> rowCount();
                if($filas!=0){      
                 
                    $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS, "articulo");
                    while($articulo = $sentencia->fetch())
                    echo $articulo -> listarArticulos();
                }      
         }
         if($nom){

                $nombre= '%'.$nom.'%';
                $sentencia = $con -> prepare("SELECT * FROM articulos WHERE nombre like ?;");
                $sentencia -> execute([$nombre]);       
                $filas = $sentencia -> rowCount();
                if($filas!=0){
                    
                 
                    $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS, "articulo");
                    while($articulo = $sentencia->fetch())
                    echo $articulo -> listarArticulos();
               }
                //Comprobamos que hay artículos con ese código
        }   
                
                
                if($filas ==0){ 
                     //Si no existen artículos con el código, volver al listado y mostrar el mensaje              
                    $error = "NO EXISTEN ARTICULOS CON ESE CÓDIGO O NOMBRE";
                    header("location:listaArticulos.php?error=$error");        
                }    
                                         
                  
                        
            
            ?> 
            </table>
            <div class="btns">
             <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>        
        </div>
    </main>   
        <?php    
        if(isset ($_REQUEST['btnVolver'])){

            header("location:listaArticulos.php");
            
        }
    }else{
        header("location:menuPrincipal.php");
    }
  include("pie.php");
  ?>