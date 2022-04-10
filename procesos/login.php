<?php
require_once ("../clases/Alumno.php");

$conexion = new Conexion();
$conexion->conectar();
session_start();


if(isset($_POST["btn_login"])){

$rut_in = $_POST['rut_in'];

}

$alumno = new Alumno();
$datos = $alumno->obtenerAlumnosRut($rut_in);

for($i=0;$i<sizeof($datos);$i++){
    $rut_recibido = $datos[$i]['rut'];
}

if($rut_recibido == $rut_in){
    header("Location:../pages/index.php");
    echo $rut_in;
}

else{
    header("Location:../pages/error_login.php");
    echo $rut_in;
}


$_SESSION['s_id'] = $rut_in;






