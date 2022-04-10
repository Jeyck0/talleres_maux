<?php

require_once ('Conexion.php');

class Curso{
    
    public $id_curso;
    public $curso;
    public $nivel;
    public $seccion;

    public $cursos;

    public function Curso(){
        $this->conectar = new Conexion();
        $this->cursos = array();
        
    }

    public function obtenerCursos(){
        $conectar = $this->conectar->conectar();
        $query ="SELECT * FROM cursos WHERE id_curso >4 AND id_curso < 17 ";
        $consultar = mysqli_query($conectar,$query);

        while($dado = mysqli_fetch_assoc($consultar)){
            $this->cursos[] = $dado;
        }

        return $this->cursos;
    }

    public function obtenerTalleresPorCurso($cid){
        $conectar = $this->conectar->conectar();
        $query ="SELECT `id_curso`,id_t_c,talleres_cursos.id_taller as rid_taller,talleres.nombre as nombre_taller,talleres_cursos.cupos as cupos,talleres.id_taller as id_taller,talleres_cursos.horario as horario,if(talleres_cursos.cupos<=0,'disabled btn-danger','btn-success') as boton,if(talleres_cursos.cupos<=0,'Sin cupos','Ver Cupos') as boton_mensaje,if(talleres.nombre !='Orquesta' AND talleres.nombre !='Flauta y Oboe','warning','success') as badge,if(talleres.nombre !='Orquesta' AND talleres.nombre !='Flauta y Oboe','Cupos Limitados','Cupos Ilimitados') as badgem
        FROM `talleres_cursos`
        INNER JOIN talleres
        ON talleres_cursos.id_taller =talleres.id_taller
        WHERE talleres_cursos.id_curso = '$cid' ";
        $consultar = mysqli_query($conectar,$query);

        while($dado = mysqli_fetch_assoc($consultar)){
            $this->cursos[] = $dado;
        }

        return $this->cursos;
    }

    public function obtenerCuposCursoTller($cid,$tid){
        $conectar = $this->conectar->conectar();
        $query ="SELECT `id_curso`,id_t_c,talleres_cursos.id_taller as rid_taller,talleres.nombre as nombre_taller,talleres_cursos.cupos as cupos,talleres.id_taller as id_taller,talleres_cursos.horario as horario,if(talleres_cursos.cupos=0,'disabled btn-danger','btn-success') as boton,if(talleres_cursos.cupos=0,'Sin cupos','Ver Cupos') as boton_mensaje
        FROM `talleres_cursos`
        INNER JOIN talleres
        ON talleres_cursos.id_taller =talleres.id_taller
        WHERE talleres_cursos.id_curso = '$cid' AND talleres_cursos.id_taller='$tid' ";
        $consultar = mysqli_query($conectar,$query);

        while($dado = mysqli_fetch_assoc($consultar)){
            $this->cursos[] = $dado;
        }

        return $this->cursos;
    }
    

    

}

