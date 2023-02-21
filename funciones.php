<?php
//FUNCION PARA CREAR VARIABLES QUE MODIFIQUEN EL CONTENIDO DEL HEAD
function parametro_plantilla($variable){
    
   if(isset($GLOBALS[$variable])){
       echo $GLOBALS[$variable];
   }else{
       echo "Sin datos";
   }
    
}
//FUNCION PARA QUE ASIGNE LA CLASE ACTIVE AL ENLACE A DE LA PÁGINA EN LA QUE NOS ENCONTRAMOS Y EN CSS ACTIVE CAMBIA DE COLOR
function active($current_page){
   $url_array = explode('/',$_SERVER['REQUEST_URI']);
   $url = end($url_array);
   if($current_page == $url){
       echo 'active';
   }

}
//FUNCION PARA CONECTAR CON LA BASE DE DATOS

function conectar_db($bd){ 
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");     
    define ("USER_DB","noelia"); 
    define ("PASSWORD","password1234"); 
    try {
        $dsn = "mysql:host=localhost;dbname=".$bd;
        $con = new PDO($dsn, USER_DB, PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $opciones;

        } catch (PDOException $e){

        echo 'Error: '.$e->getMessage()."<br/>";
        
        }   
    
    
    return $con;
}


//FUNCION PARA VERIFICAR UN DNI

function analizaDni($dni){
    $dniCorrecto=false;
    $longitud=true;    
    $esNumero=true;
    $esLetra=true;
    $letraCorrecta=true;
//Comprobar que la longitud es la correcta
if(strlen($dni)==9){ 
   $numeros=substr($dni,0,8);
   $letra=$dni[8];
   //Comprobar que la parte numerica son todos los caracteres numeros
      for ($i=0 ; $i<strlen($numeros)-1 ; $i++){
         if(ord($numeros[$i]) >= 48 && ord($numeros[$i])<=57){
         $esNumero;
         }else {
         $esNumero=false;
         } 
      }
   //Comprobar que la letra es letra
      if (ord($letra) >= 65 && ord($letra) <= 90) {
         $esLetra;
      }else if(ord($letra) >= 97 && ord($letra) <= 122){
         $esLetra;
      }else {
         $esLetra=false;
      }

   //Comprobar que la letra es la correcta
      if (substr("TRWAGMYFPDXBNJZSQVHLCKE",$numeros%23,1) == strtoupper($letra)){
         $letraCorrecta;
      }else{
         $letraCorrecta=false;
      }   


   }else{
      $longitud=false;
   }

   if(!$esNumero or !$esLetra or !$longitud or !$letraCorrecta){
      $dniCorrecto=false;
   }else{
      $dniCorrecto=true;
   }

return $dniCorrecto;
}
//Devuelve el número de registros de un campo

function numRegistros($db,$tabla,$campo){
   $con = conectar_db($db); 
   $sentencia = $con -> prepare("SELECT * FROM $tabla WHERE $campo like ?;");
   $sentencia -> execute([$campo]);       
   $filas = $sentencia -> rowCount();
   return $filas;
}

function AccesAdmin(){  
   if(isset($_SESSION['autentificado']) && isset($_SESSION['rol'])) {
      $autentificado=$_SESSION['autentificado'];
      $rol=$_SESSION['rol'];
   }
   if($autentificado=='OK' && $rol == 'administrador'){
      return true;
   }
}

function AccesEmp(){
   if(isset($_SESSION['autentificado']) && isset($_SESSION['rol'])) {
      $autentificado=$_SESSION['autentificado'];
      $rol=$_SESSION['rol'];
   }   
   if($autentificado=='OK' && $rol == 'empleado'){
      return true;
   }
}
//listados

function listadoArticulos($con){  
   
   $sql = "SELECT * FROM articulos";
   $sentencia = $con->prepare($sql);
   $sentencia -> execute();
   $articulo = $sentencia->setFetchMode(PDO::FETCH_CLASS,'articulo');
   while($articulo = $sentencia->fetch())
     echo $articulo -> listarArticulos();
}

//funciones carrito

function borraCarrito($producto) {
   $carrito = $_SESSION['productos'];   
   unset($carrito[$producto]);
}

function muestraCarrito($con,$carrito) {
  
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
               echo "<td>".$articulo->getPrecio()."</td>";
               echo "<td>".$cantidad."</td>";
               echo "<td>".$subtotal."€</td>";
               echo "<td><form method='post'>";
               echo "<input type='hidden' name='quitaProducto' value='".$articulo->getId()."'>";                
               echo "<input class='btn-carrito' type='submit' name='borra' value='Quitar'>";
               echo "</td>";
               echo "</tr>";         
               
              } 
              echo "<tr>";
              echo "<td colspan='4' class='total-carrito'>Total:".$total."€</td>";
            ?>
         </tbody>
         </table>
         
       
      <?php              
   
 

}


?>
