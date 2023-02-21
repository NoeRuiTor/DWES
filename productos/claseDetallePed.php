<?php
class detallePed{
    private $id; 
    private $id_articulo;      
    private $id_pedido;
    private $cantidad;
    private $precio;    
    
    
    public function listarDetallePed(){
    
        echo "<tr>";
        echo "<td>".$this->id."</td>";
        echo "<td>".$this->id_articulo."</td>";
        echo "<td>".$this->id_pedido."</td>";
        echo "<td>".$this->cantidad."</td>";
        echo "<td>".$this->precio."€</td>";                        
        echo "</tr>";
    }
}