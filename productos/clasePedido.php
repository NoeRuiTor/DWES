<?php
class pedido{
    private $id; 
    private $fecha;      
    private $importe;
    private $estado;
    private $id_usuario;    
    
    
    public function listarPedidos(){
    
        echo "<tr>";
        echo "<td>".$this->id."</td>";
        echo "<td>".$this->fecha."</td>";
        echo "<td>".$this->importe."</td>";
        echo "<td>".$this->estado."</td>";
        echo "<td>".$this->id_usuario."</td>"; 
        echo "<td><a href='detallePedido.php?id=".$this->id."'><img src='imgs/eye.svg'></a></td>";            
        echo "<td><a href='editarPedido.php?id=".$this->id."'><img src='imgs/edit.svg'></a></td>";        
        echo "</tr>";
    }
    public function listarPedidosUsu(){
    
        echo "<tr>";
        echo "<td>".$this->id."</td>";
        echo "<td>".$this->fecha."</td>";
        echo "<td>".$this->importe."</td>";
        echo "<td>".$this->estado."</td>";
        echo "<td>".$this->id_usuario."</td>";            
        echo "<td><a href='detallePedido.php?id=".$this->id."'><img src='imgs/eye.svg'></a></td>";        
        echo "</tr>";
    }
}