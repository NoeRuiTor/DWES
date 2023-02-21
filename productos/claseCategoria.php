<?php
class categoria{
    private $id;
    private $nombre; 
    private $descripcion;   
    
       

    public function listarCategorias(){
    
        echo "<tr>";
        echo "<td>".$this->id."</td>";
        echo "<td>".$this->nombre."</td>"; 
        echo "<td>".$this->descripcion."</td>";
        echo "<td><a href='editarCategoria.php?id=".$this->id."'><img src='imgs/edit.svg'></a></td>";                     
        echo "</tr>";
    } 
}