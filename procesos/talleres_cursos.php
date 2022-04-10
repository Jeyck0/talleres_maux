<?php
require_once ('../clases/Taller.php');
require_once ('../clases/Curso.php');


$id_taller = $_GET['id'];
$id_alumno = $_GET['id_alumno'];
$id_curso = $_GET['id_curso'];
$fecha = date("d/m/y H:i:s");

$objeto_curso = new Curso();
$datos = $objeto_curso->obtenerCuposCursoTller($id_curso,$id_taller);

for($i=0;$i<sizeof($datos);$i++){
    $cupos = $datos[$i]['cupos'];

}

$taller = new Taller();

if($cupos>0){
    $taller->actualizarTallerAlumno($id_taller,$id_alumno,$fecha);
    $taller-> restarCupo($id_taller,$id_curso); 
    header("Location:../pages/talleres_cursos.php");
}

else{
    header("Location:../pages/error_cupos.php");
}



