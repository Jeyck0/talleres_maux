<?php
require_once ('../clases/Conexion.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');




$conexion = new Conexion();
$cnn =$conexion->conectar();


$curso_id = $_GET["curso_id"];


$query ="SELECT `id_curso`,id_t_c,talleres.nombre as nombre_taller,talleres_cursos.cupos as cupos,talleres.id_taller as id_taller,if(talleres_cursos.cupos=0,'disabled btn-danger','btn-success') as boton,if(talleres_cursos.cupos=0,'Sin cupos','Inscribir Taller') as boton_mensaje
FROM `talleres_cursos`
INNER JOIN talleres
ON talleres_cursos.id_taller =talleres.id_taller
WHERE talleres_cursos.id_curso = '$curso_id'";   
$consultar = mysqli_query($cnn,$query);

        while($dado = mysqli_fetch_assoc($consultar)){
            $data["data"][]=$dado;
        }
        echo json_encode($data);

