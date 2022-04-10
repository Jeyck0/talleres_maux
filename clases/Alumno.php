<?php

require_once ('Conexion.php');

class Alumno{
    
    public $rut;
    public $nombre;
    public $appaterno;
    public $apmaterno;

    public $alumnos;

    public function Alumno(){
        $this->conectar = new Conexion();
        $this->alumnos = array();
        
    }

    public function obtenerAlumnos(){
        $conectar = $this->conectar->conectar();
        $query ="SELECT * FROM alumnos";
        $consultar = mysqli_query($conectar,$query);

        while($dado = mysqli_fetch_assoc($consultar)){
            $this->alumnos[] = $dado;
        }

        return $this->alumnos;
    }

    public function obtenerAlumnosRut($arut){
        $conectar = $this->conectar->conectar();
        $query ="SELECT a.rut as rut,a.id_alumno, a.primer_nombre, a.segundo_nombre, a.apellido_paterno, a.apellido_materno, a.id_curso_f, a.id_taller,c.id_curso,c.curso,c.nivel,c.seccion,tc.id_taller,t.nombre as nombre_taller
        FROM `alumnos` a 
        INNER JOIN cursos c 
        ON a.id_curso_f = c.id_curso
        INNER JOIN talleres_cursos tc
        ON c.id_curso = tc.id_curso
        INNER JOIN talleres t
        ON tc.id_taller = t.id_taller
        WHERE a.rut LIKE '$arut%'";
        $consultar = mysqli_query($conectar,$query);


        while($dado = mysqli_fetch_assoc($consultar)){
            $this->alumnos[] = $dado;
        }

    

        return $this->alumnos;
    }

    public function obtenerTallerAlumno($aid){
        $conectar = $this->conectar->conectar();
        $query ="SELECT talleres.nombre as nombre_taller
        FROM `alumnos` 
        INNER JOIN talleres
        ON alumnos.id_taller = talleres.id_taller
        WHERE alumnos.id_alumno = '$aid'";
        $consultar = mysqli_query($conectar,$query);
        
        while($dado = mysqli_fetch_assoc($consultar)){
            $this->alumnos[] = $dado;
        }

    

        return $this->alumnos;

    }

    public function obtenerAlumnosCurso($cid){
        $conectar = $this->conectar->conectar();
        $query ="select alumnos.primer_nombre ,alumnos.segundo_nombre,alumnos.apellido_paterno,alumnos.apellido_materno,talleres.nombre from alumnos
        LEFT JOIN talleres
        ON alumnos.id_taller = talleres.id_taller
        where id_curso_f = '$cid' 
        ORDER BY `id_curso_f` ASC";
        $consultar = mysqli_query($conectar,$query);
        
        while($dado = mysqli_fetch_assoc($consultar)){
            $this->alumnos[] = $dado;
        }

    

        return $this->alumnos;

    }




}

