<?php include_once ("../clases/Alumno.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../phpmailer/Exception.php';
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
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
$file_name="comprobante.pdf";
$mpdf = new mPDF('c','A4');
$mpdf->SetImportUse();
$mpdf->SetDocTemplate('../img/forma_comprobante.pdf',true);
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
$mpdf->allow_charset_conversion=true;
$mpdf->charset_in='UTF-8';
$mpdf->writeHTML($html);
$pdf_doc = $mpdf->Output('planilla.pdf','S');
file_put_contents($pdf,$filename);
//phpMailer
// Instantiation and passing `true` enables exceptions
$correo = $_POST['email'];
$mail = new PHPMailer(true);

try {

    //Recipients
    $mail->setFrom('info_talleres@auxiliadoravaldivia.com', 'Maria Auxiliadora');
    $mail->addAddress($correo);     // Add a recipient
  


    // Attachments
    $mail->addStringAttachment($pdf_doc,'comprobante.pdf');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Comprobante de inscripcion';
    $mail->Body    = 'Comprobante de inscripcion';
    $mail->AltBody = 'Comprobante de inscripción';

    $mail->send();
    header('Location: mail_enviado.php'); 
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}