<?php
require_once ('../clases/Alumno.php');


$alumno  = new Alumno();
$datos = $alumno->obtenerAlumnos();

for($i=0;$i<sizeof($datos);$i++){
    echo intval(preg_replace('/[^0-9]+/', '', $datos[$i]['rut']), 10)." | ";   
}



