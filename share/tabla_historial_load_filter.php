<?php
session_start();
$id_usuario = $_SESSION['id'];


require "../bd/database.php";
$cod_estudiante = $_POST['cod_estudiante'];


$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];


$select_filas = $_POST['select_filas'];

// limitar a el colegio
$usuario_verific_all_sql = "SELECT * FROM usuarios WHERE id = '" . $id_usuario . "'";
$res_verific_all_sql = mysqli_query($conn, $usuario_verific_all_sql);
$data_verific_all_sql = mysqli_fetch_array($res_verific_all_sql);

$colegio_sec_n = $data_verific_all_sql['colegio_sec'];

$verifi_coleg_section_sql = "SELECT * FROM colegios WHERE id = '".$colegio_sec_n."'";
$res_verifi_section = mysqli_query($conn, $verifi_coleg_section_sql);
$data_obt_res_verifi_section = mysqli_fetch_array($res_verifi_section);

$colegio_sec = $data_obt_res_verifi_section['nombre_colegio'];
// echo $colegio_sec;


$consult_id_alumno_sql = "SELECT * FROM alumnos_info WHERE cod_estudiante = '" . $cod_estudiante . "' and institucion = '".$colegio_sec."'";
$res_consult_id_alumno_sql = mysqli_query($conn, $consult_id_alumno_sql);
$data_consult_id_alumno_sql = mysqli_fetch_array($res_consult_id_alumno_sql);
$id_alumno_for_cod = $data_consult_id_alumno_sql['id'];

if(mysqli_num_rows($res_consult_id_alumno_sql) <= 0){
    ?>
    <script>
        swalWithBootstrapButtons.fire(
            'Revisa bien tus datos',
            'los datos son incorrectos, intentalo de nuevo o diga su codigo explicitamente (D.O.C)',
            'warning'
        )
    </script>
    <?php 
    exit();
}


if (empty($fecha1 and $fecha2)) {
    $consult_history_alumn = "SELECT * FROM historial_fecha WHERE id_alumno = '" . $id_alumno_for_cod . "' ORDER BY dia_fecha ASC limit $select_filas";
    // echo $consult_history_alumn;
    $res_consult_history = mysqli_query($conn, $consult_history_alumn);
}

if (!empty($fecha1 and $fecha2)) {
    $consult_history_alumn = "SELECT * FROM historial_fecha WHERE id_alumno = '" . $id_alumno_for_cod . "' AND dia_fecha BETWEEN '" . $fecha1 . "' AND '" . $fecha2 . "'  ORDER BY dia_fecha ASC limit $select_filas";
    // echo $consult_history_alumn;
    $res_consult_history = mysqli_query($conn, $consult_history_alumn);
}

$count_rows_history = mysqli_num_rows($res_consult_history);

if($count_rows_history > 0){


?>



<span>historial de el estudiante: <?php echo $data_consult_id_alumno_sql['nombres'] ?></span>


<table class="styled-table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Hora de entrada</th>
            <th>Hora de salida</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($data_history_consult = mysqli_fetch_array($res_consult_history)) {
        ?>
            <tr>
                <td><?php echo $data_history_consult['dia_fecha']; ?></td>
                <td><?php echo $data_history_consult['fecha_entrada'];?> <?php echo $data_history_consult['pm_am_entrada']; ?></td>
                <td><?php echo $data_history_consult['fecha_salida']; ?> <?php echo $data_history_consult['pm_am_salida']; ?></td>
            </tr>
        <?php } ?>
        <!-- <tr class="active-row">
            <td>Melissa</td>
            <td>5150</td>
        </tr> -->
    </tbody>
</table>

<?php }elseif($count_rows_history <= 0){ 
?>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora de entrada</th>
                        <th>Hora de salida</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <tr>
                            <td colspan="3">No se encontro ningun resultado</td>
                        </tr>

                </tbody>
            </table>

<?php } ?>