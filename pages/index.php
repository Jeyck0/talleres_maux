<?php
include ('includes/header.php');  
require_once ('../clases/Alumno.php');


$alumno = new Alumno();
$datos = $alumno->obtenerAlumnosRut($_SESSION['s_id']);

for($i=0;$i<sizeof($datos);$i++){
    $nombre = $datos[$i]['primer_nombre'];
    $segundo_nombre = $datos[$i]['segundo_nombre'];
    $apellido_paterno = $datos[$i]['apellido_paterno'];
    $curso = $datos[$i]['curso'];
    $nivel = $datos[$i]['nivel'];
    $seccion = $datos[$i]['seccion'];

    $id_curso = $datos[$i]['id_curso_f'];
}


?>

<h2 class="h3 text-gray-800">Bienvenid@ <?php echo $nombre." ".$segundo_nombre." ".$apellido_paterno." ".$curso."° ".$nivel." ".$seccion ?></h2>

<hr>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Inicio</h6>
    </div>
    <div class="card-body">
        <div class="text-center">
        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="../img/undraw_creative_woman_v415.svg" alt="">
        </div>
        <div class="text-center">
        <button class="btn btn-success" id="btn_inscribir">Inscribir Taller</button>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Condiciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <h4>Antes de hacer su selección lea atentamente las siguientes consideraciones:</h4>
        <ol>
            <li value="1">Los talleres que a continuación se detallan son de carácter obligatorio ya que son parte de la jornada de clases.</li>
            <li value="2">Solo se puede elegir un taller en el horario y día al ciclo que corresponda. </li>
            <li value="3">El taller seleccionado tiene una duración anual, no existe la posibilidad de cambio una vez elegido.</li>
            <li value="4">Cada taller tiene sus requerimientos que deben ser cumplidos por el estudiante.</li>
        </ol>
        <div class="text-right">Anette Barbet Ampuero</div>
        <div class="text-right">Coordinación de MJS</div>
        <div class="text-right">Valdivia</div>
        

      </div>
      <div class="modal-footer">
        <a href="talleres_cursos.php" type="button" class="btn btn-success" >Aceptar</a>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="../js/modal_index.js"></script>
<?php include ('includes/footer.php'); ?>