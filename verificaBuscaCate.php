<?php

include("productos/claseCategoria.php");
include ("seguridad.php");
include ("funciones.php");
$usuario= $_SESSION['usuario'];     
$rol = $_SESSION['rol'];


    if(isset ($_REQUEST['btnBuscar'])){    
       if(isset($_REQUEST['id'])){
        $id=$_REQUEST['id'];
       }
       if(isset($_REQUEST['descripcion'])){
        $des=$_REQUEST['descripcion'];
       }
        
    }
include("cabecera.php"); 
    ?>
    <main class="panelUsu">
         <div class="panelUsu__heading">
            <h1>Hola <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];} ?></h1>
            <p>Mantenimiento de categorias</p>            
        </div> 
    <?php
    if($rol == 'administrador'){       
    ?>
        <table class="normal">
       
        <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>                               
                <th class="edit">Editar</th>
            <?php 
              
                //Conectamos con la base de datos
                $con = conectar_db("electricidad_fcv"); 
                
                
         if($id){       
                
                $sentencia = $con -> prepare("SELECT * FROM categoria WHERE id like ?;");
                $sentencia -> execute([$id]);       
                $filas = $sentencia -> rowCount();
                if($filas!=0){      
                 
                    $categoria = $sentencia->setFetchMode(PDO::FETCH_CLASS, "categoria");
                    while($categoria = $sentencia->fetch())
                    echo $categoria -> listarCategorias();
                }      
         }
         if($des){

                $descripcion= '%'.$des.'%';
                $sentencia = $con -> prepare("SELECT * FROM categoria WHERE descripcion like ?;");
                $sentencia -> execute([$descripcion]);       
                $filas = $sentencia -> rowCount();
                if($filas!=0){
                    
                 
                    $categoria = $sentencia->setFetchMode(PDO::FETCH_CLASS, "categoria");
                    while($categoria = $sentencia->fetch())
                    echo $categoria -> listarCategorias();
               }
                //Comprobamos que hay artículos con ese código
        }   
                
                
                if($filas ==0){ 
                     //Si no existen artículos con el código, volver al listado y mostrar el mensaje              
                    $error = "NO EXISTEN CATEGORIAS CON ESE CÓDIGO O NOMBRE";
                    header("location:listaCategorias.php?error=$error");        
                }    
                                         
                  
                        
            
            ?> 
            </table>
            <div class="btns">
             <form method="get"><button class="btn" id='volver' name="btnVolver" type="submit">Volver</button></form>        
        </div>
    </main>   
        <?php    
        if(isset ($_REQUEST['btnVolver'])){

            header("location:listaCategorias.php");
            
        }
    }else{
        header("location:menuPrincipal.php");
    }
  include("pie.php");
  ?>