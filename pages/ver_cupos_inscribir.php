<?php
include ('includes/header.php');  
require_once ('../clases/Alumno.php');
require_once ('../clases/Curso.php');
require_once ('../clases/Taller.php');
 $id_curso = $_GET['id'];
 $id_taller = $_GET['tid'];
 $id_alumno = $_GET['aid'];



 $objeto_curso = new Curso();
 $datos2 = $objeto_curso->obtenerCuposCursoTller($id_curso,$id_taller);

 for($i=0;$i<sizeof($datos2);$i++){
    $cupos = $datos2[$i]['cupos'];
    $boton = $datos2[$i]['boton'];
    $boton_mensaje = $datos2[$i]['boton_mensaje'];

}



?>



<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
    <div class="card-body">
        <div class="text-center">
            <h1>cupos</h1>
            <h1 style="font-size:100px"><?php if($cupos>=30){echo "Cupos Ilimitados";}else{echo $cupos;} ?></h1>
        </div>
        <div class="text-center">
        <button class="btn <?php if($cupos<=0){echo "hidden disabled";}else{echo $boton;};?>" <?php if($cupos<=0){echo "hidden";} ?> id="btn_inscribir">Inscribir Taller</button>
        </div>
        <div class="text-center pt-1">
        <a href="talleres_cursos.php" id="btn_volver">Volver</button>
        </a>
    </div>
</div>

   <!-- Modal -->
    <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Recordatorio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Al inscribir este taller no podrás editar tu selección</h3>
                    <h4>¿Estás segur@?</h4>
                </div>
                <div class="modal-footer">
                    <a href="../procesos/talleres_cursos.php?id=<?php echo $id_taller?>&id_alumno=<?php echo $id_alumno?>&id_curso=<?php echo $id_curso?>&cupos=<?php echo $cupos ?>"  type="submit" class="btn <?php if($cupos<=0){echo "hidden";}else{echo $boton;} ?>" >Aceptar</a>
                </div>
            </div>
        </div>
    </div>


<script src="../js/jquery-3.3.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    $('#btn_inscribir').click(function(){
        $('#miModal').modal("show");
    })
})
</script>






<?php include ('includes/footer.php'); ?>