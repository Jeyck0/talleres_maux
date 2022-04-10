<?php
require_once ("../clases/User.php");




$usuario = $_POST['usuario_input'];
$pass = $_POST['pass_input'];

$user = new User();
$datos=$user->obtenerUsers($usuario,$pass);

for($i=0;$i<sizeof($datos);$i++){
    $u_in=$datos[$i]['name'];
    $p_in=$datos[$i]['password'];
    

}

if($usuario==$u_in && $pass==$p_in){
    header("Location:../pages/listado_cursos.php");
}
else{
    echo "error de usuario o contraseña intente de nuevo";
}

