<?php
class usuario{
    private $id;
    private $dni;
    private $nombre;
    private $apellidos;
    private $email;
    private $direccion;
    private $localidad;
    private $provincia;
    private $telefono;
    private $rol;
    private $password;
    private $estado;
    

    public function listarDatosAdmin(){
        echo "<tr>";
        echo "<td>".$this->id."</td>";
        echo "<td>".$this->dni."</td>";
        echo "<td>".$this->nombre."</td>";
        echo "<td>".$this->apellidos."</td>";
        echo "<td>".$this->direccion."</td>";
        echo "<td>".$this->localidad."</td>";
        echo "<td>".$this->provincia."</td>";
        echo "<td>".$this->telefono."</td>";
        echo "<td>".$this->email."</td>";
        echo "<td>".$this->rol."</td>";
        echo "<td>".$this->estado."</td>";
        echo "<td><a href='editarCliente.php?id=".$this->id."'><img class='edit' src='imgs/edit.svg'></i></a></td>";       
        echo "</tr>";
    } 

    public function listarDatos(){
        echo "<tr>"; 
        echo "<td>".$this->id."</td>";       
        echo "<td>".$this->dni."</td>";
        echo "<td>".$this->nombre."</td>";
        echo "<td>".$this->apellidos."</td>";
        echo "<td>".$this->direccion."</td>";
        echo "<td>".$this->localidad."</td>";
        echo "<td>".$this->provincia."</td>";
        echo "<td>".$this->telefono."</td>";
        echo "<td>".$this->email."</td>";        
        echo "<td><a href='editarCliente.php?id=".$this->id."'><img class='edit' src='imgs/edit.svg'></i></a></td>";       
        echo "</tr>";
    } 
    
}
?>