<?php include_once ("../clases/Alumno.php");
session_start();
if(!isset($_SESSION['s_id'])){
header('Location:../login.php');
}
$html='
<style>
.nombre{
    padding-left:350px;
    padding-top:293px;
    width:200px;
}
.nombre2{
padding-left:450px;
padding-top:-19px;
}

.rut{
padding-left:30px;
padding-top:14px;
}

.curso{
padding-left:320px;
padding-top:-19px;
}
.nivel{
padding-left:350px;
padding-top:-19px;
}
  .seccion{
padding-left:420px;
padding-top:-18px;
}

    .taller{
padding-left:380px;
padding-top:13px;
}

    .fecha{
padding-left:380px;
padding-top:50px;
}
table, th, td {
border: 1px solid black;
  }
.thead{
background-color:#0000FF;
color:white;
  }
</style>
';
function tabla($arut){
$conexion = new Conexion();
$conectar =$conexion->conectar();
$query ="SELECT a.fecha_taller as fecha,a.id_curso_f,primer_nombre,segundo_nombre,apellido_paterno,rut,a.id_taller,t.nombre as nombre,c.curso as curso,c.nivel as nivel,c.seccion as seccion
        FROM `alumnos`a
        INNER JOIN talleres t
        ON a.id_taller = t.id_taller
        INNER JOIN cursos c
        ON a.id_curso_f = c.id_curso
        WHERE rut LIKE '$arut%'";
    $consultar = mysqli_query($conectar,$query);
    $tabla="";
	while($row=$consultar->fetch_assoc()){
        $tabla.='<div class="nombre">'.$row['primer_nombre'].'</div>';
        $tabla.='<div class="nombre2">'.$row['apellido_paterno'].'</div>';
        $tabla.='<div class="rut">'.$row['rut'].'</div>';
	    $tabla.='<div class="curso">'.$row['curso'].'</div>';
	    $tabla.='<div class="nivel">'.$row['nivel'].'</div>';
	    $tabla.='<div class="seccion">'.$row['seccion'].'</div>';
	    $tabla.='<div class="taller">'.$row['nombre'].'</div>';
	    $tabla.='<div class="fecha">'.$row['fecha'].'</div>';
	}
	return $tabla;}
$html.=(tabla($_SESSION['s_id']));
include("../mpdf/mpdf.php");
ob_end_clean();
$mpdf = new mPDF('c','A4');
$mpdf->SetImportUse();
$mpdf->SetDocTemplate('../img/forma_comprobante.pdf',true);
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
$mpdf->allow_charset_conversion=true;
$mpdf->charset_in='UTF-8';
$mpdf->writeHTML($html);
$mpdf->Output('planilla.pdf','I');