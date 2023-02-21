<?php
class articulo{
    private $id;
    private $nombre;
    private $descripcion;
    private $id_categoria;
    private $precio;
    private $stock;
    private $imagen;
    private $estado;
    
    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getPrecio(){
        return $this->precio;
    }

    public function getStock(){
        return $this->stock;
    }
    public function getImagen(){
        return $this->imagen;
    }
    public function listarArticulos(){
    
        echo "<tr>";
        echo "<td>".$this->id."</td>";
        echo "<td>".$this->nombre."</td>";
        echo "<td>".$this->descripcion."</td>";
        echo "<td>".$this->id_categoria."</td>";
        echo "<td>".$this->precio."</td>";
        echo "<td>".$this->stock."</td>";
        echo "<td>".$this->estado."</td>";
        echo "<td><img class='foto' src='{$this->imagen}'></td>";       
        echo "<td><a href='editarArticulo.php?id=".$this->id."'><img src='imgs/edit.svg'></a></td>";        
        echo "</tr>";
    }
    public function muestraArticulo(){
    
         echo "<div class='articulo'>";
         echo "<img src='" . $this -> imagen . "' alt='" . $this -> imagen. "'>";
         echo "<h3>" . $this -> nombre . "</h3>";
         echo "<p>"  . $this -> descripcion. "</p>";
         echo "<h3 class='precio'>" . $this -> precio." €</h3>";
         echo "<form method='post'>";
         echo "<input type='hidden' name='id_articulo' value='".$this->id."'>";                
         echo "<input class='btn' type='submit' name='añadir' value='Añadir al carrito'>";
         echo "</form>";        
         echo "</div>";
    } 

   
}
?>