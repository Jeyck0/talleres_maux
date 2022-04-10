<?php include_once ("../clases/Alumno.php");
$id = $_GET['id'];
$html='
<style>
@page {
margin-top:150;
}
.alinear{
    text-align:center;
    padding-left:0px;
    padding-top:10px;}
.titulo{
text-align:center;
padding-left:0px;}
table{
    border-collapse: collapse;
    width: 100%;
    font-style:Calibri;
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
function tabla($cid){
$conexion = new Conexion();
$conectar =$conexion->conectar();
$query ="select a.id_curso_f, a.rut, a.primer_nombre ,a.segundo_nombre,a.apellido_paterno,a.apellido_materno,talleres.nombre as tnombre,c.curso as curso,c.nivel as nivel,c.seccion as seccion 
    FROM alumnos a
    LEFT JOIN talleres
    ON a.id_taller = talleres.id_taller
    INNER JOIN cursos c
    ON a.id_curso_f = c.id_curso 
    where a.id_curso_f = '$cid' 
    ORDER BY `tnombre` ASC";
    $consultar = mysqli_query($conectar,$query);
    while($row=$consultar->fetch_assoc()){
        $curso=$row['curso'];
        $nivel=$row['nivel'];
        $seccion=$row['seccion'];
    }
    $tabla="";
    $tabla.="<h1 class='titulo'>".$curso.' '.$nivel.' '.$seccion."</h1>";
    $tabla.="<div class='alinear'>";
    $tabla.="<table class='table'>";
    $tabla.='<thead>';
    $tabla.='<tr>';
    $tabla.="<th class='thead'>"."RUT".'</th>';
    $tabla.="<th  class='thead'>APELLIDOS</th>";
    $tabla.="<th class='thead'>"."NOMBRES".'</th>';
    $tabla.="<th class='thead'>"."TALLER".'</th>';
    $tabla.='</tr>';
    $tabla.='</thead>';
    $tabla.='<tbody>';
    $consultar = mysqli_query($conectar,$query);
	while($row=$consultar->fetch_assoc()){
        $tabla.='<tr>';
        $tabla.='<th>'.$row['rut'].'</th>';
        $tabla.='<th>'.$row['apellido_paterno'].'   '.$row['apellido_materno'].'</th>';
        $tabla.='<th>'.$row['primer_nombre'].'   '.$row['segundo_nombre'].'</th>';
        $tabla.='<th>'.$row['tnombre'].'</th>';
        $tabla.='</tr>';}
    $tabla.='</tbody>';
    $tabla.='</table>'; 
    $tabla.='</div>'; 
	return $tabla;}
$html.=(tabla($id));
include("../mpdf/mpdf.php");
ob_end_clean();
$mpdf = new mPDF('c','A4');
$mpdf->SetImportUse();
$mpdf->SetDocTemplate('../img/forma.pdf',true);
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
$mpdf->allow_charset_conversion=true;
$mpdf->charset_in='UTF-8';
$mpdf->writeHTML($html);
$mpdf->Output('planilla.pdf','I');