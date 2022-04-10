<?php

require_once ('Conexion.php');

class User{
    

    public $users;

    public function User(){
        $this->conectar = new Conexion();
        $this->users = array();
        
    }

    public function obtenerUsers($user,$pass){
        $conectar = $this->conectar->conectar();
        $query ="SELECT name,password FROM users where name='$user' AND password= '$pass'";
        $consultar = mysqli_query($conectar,$query);

        while($dado = mysqli_fetch_assoc($consultar)){
            $this->users[] = $dado;
        }

        return $this->users;
    }

    
    
    



}

