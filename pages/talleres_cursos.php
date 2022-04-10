<?php
include ('includes/header.php');  
require_once ('../clases/Alumno.php');
require_once ('../clases/Curso.php');
require_once ('../clases/Taller.php');







$alumno = new Alumno();
$datos = $alumno->obtenerAlumnosRut($_SESSION['s_id']);




for($i=0;$i<sizeof($datos);$i++){
    $id_alumno = $datos[$i]['id_alumno'];
    $nombre = $datos[$i]['primer_nombre'];
    $segundo_nombre = $datos[$i]['segundo_nombre'];
    $apellido_paterno = $datos[$i]['apellido_paterno'];
    $curso = $datos[$i]['curso'];
    $nivel = $datos[$i]['nivel'];
    $seccion = $datos[$i]['seccion'];


    $id_curso = $datos[$i]['id_curso_f'];
}

$datos_a_t = $alumno->obtenerTallerAlumno($id_alumno);

for($i=0;$i<sizeof($datos_a_t);$i++){
    $nombre_taller = $datos_a_t[$i]['nombre_taller'];
}

$taller = new Taller();
$datos_taller =$taller->comprobarTaller($id_alumno);

for($i=0;$i<sizeof($datos_taller);$i++){
    $switch = $datos_taller[$i]['switch'];
}


$objeto_curso = new Curso();
$datos2 = $objeto_curso->obtenerTalleresPorCurso($id_curso);


?>

<?php if($switch==0){?>
<h2 class="h3 text-gray-800">Bienvenid@ <?php echo $nombre." ".$segundo_nombre." ".$apellido_paterno." ".$curso." °".$nivel." ".$seccion; ?></h2>

<div class="card shadow mb-4">
    
    <div class="card-body">
    <div class="table-responsive">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary"> <?php echo $datos2[$i]["horario"];?></h4>
                </div>
                    <select name="id_curso" id="id_curso" hidden>
                        <option value="<?php echo $id_curso?>"></option>
                    </select>
                <tr>
                    <th>Taller</th>
                    <th class="text-center">Accion</th>
                </tr>
                </thead>
                <?php for($i=0;$i<sizeof($datos2);$i++){?>        
                <tbody>
                <tr>
                    <th class="text-center"><?php echo $datos2[$i]["nombre_taller"]."  "?><span class="badge badge-<?php echo $datos2[$i]["badge"];?>"><?php echo $datos2[$i]["badgem"];?></span></th>
                    <th class="text-center"><a href="ver_cupos_inscribir.php?id=<?php echo $id_curso?>&tid=<?php echo $datos2[$i]["rid_taller"];?>&aid=<?php echo $id_alumno;?>" class="btn <?php echo $datos2[$i]["boton"];?>"><?php echo $datos2[$i]["boton_mensaje"];?></a></th>
                </tr>
                <?php }?>   
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php }else{?>
    <h2 class="h3 text-gray-800">Bienvenid@ <?php echo $nombre." ".$segundo_nombre." ".$apellido_paterno." ".$curso."  ".$nivel." ".$seccion; ?></h2>
    <div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="text-center">
        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="../img/write-paper-ink.svg" alt="">
        </div>
        <div class="text-center">
        <h2 class="m-0 font-weight-bold text-primary">Te has inscrito en el taller de <?php echo $nombre_taller?></h2>
        <a href="login.php" class="btn btn-danger">Salir</a>
        <button class="btn btn-success" id="btn_comprobante">Descargar Comprobante</button>
        </div>

</div>

<!-- Modal -->
    <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Comprobante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="text-center"><p>Enviar por correo</p></div>
                        <form  action="pdf_correo.php" method="POST">
                            <div class=form-group>
                                <input class="form-control " type="email" name="email" placeholder="Ej : nombre@correo.com" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-block" >Enviar al correo</button>
                                
                            </div>
                            

                            <div class="text-center"><p>o solo descargar</p></div>
                            
                        </div>
                            
                        </form>
                        <div class="form-group">
                            <a href="pdf_comprobante.php" class="btn btn-success form-control">Descargar</a>
                        </div>
                        
                    </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
<?php } ?>    




<script src="../js/jquery-3.3.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $('#btn_comprobante').click(function(){
        $('#miModal').modal("show");
    })
})
</script>






<?php include ('includes/footer.php'); ?>