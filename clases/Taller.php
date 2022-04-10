<?php

require_once ('Conexion.php');

class Taller{
    
    public $id_taller;
    public $nombre;


    public $talleres;

    public function Taller(){
        $this->conectar = new Conexion();
        $this->talleres = array();
        
    }

    public function obtenerTalleres(){
        $conectar = $this->conectar->conectar();
        $query ="SELECT * FROM talleres";
        $consultar = mysqli_query($conectar,$query);

        while($dado = mysqli_fetch_assoc($consultar)){
            $this->talleres[] = $dado;
        }

        return $this->talleres;
    }

    public function actualizarTallerAlumno($tid,$aid,$fecha){
        $conectar = $this->conectar->conectar();
        $query ="UPDATE alumnos SET id_taller='$tid',fecha_taller='$fecha' WHERE id_alumno='$aid'";
        $consultar = mysqli_query($conectar,$query);

        
    }
    
    public function restarCupo($tid,$cid){
        $conectar = $this->conectar->conectar();
        $query ="UPDATE talleres_cursos SET cupos=cupos-1 WHERE id_taller='$tid' AND id_curso='$cid'";
        $consultar = mysqli_query($conectar,$query);

        
    }

    public function comprobarTaller($aid){
        $conectar = $this->conectar->conectar();
        $query ="SELECT id_taller, IF(id_taller IS NULL,0,1)as switch FROM alumnos WHERE id_alumno ='$aid'";
        $consultar = mysqli_query($conectar,$query);

        while($dado = mysqli_fetch_assoc($consultar)){
            $this->talleres[] = $dado;
        }


        return $this->talleres;
    }
  

    

}

