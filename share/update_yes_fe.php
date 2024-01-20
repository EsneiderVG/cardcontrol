<!-- <script>
    alert("hptaaaaaaa yes fe");
</script> -->

<?php

require "../bd/database.php";
$fecha_con_horas_minutos = $_POST['fecha_con_horas_minutos'];
$id_alumno = $_POST['id_alumno'];
$fecha_dia_mes_a = $_POST['fecha_dia_mes_a'];
$pm_am_entrada = $_POST['pm_am_entrada'];

$verific_other_registro_2 = "SELECT * FROM historial_fecha WHERE id_alumno = '" . $id_alumno . "' and dia_fecha = '" . $fecha_dia_mes_a . "'";
$res_verific_other_2 = mysqli_query($conn, $verific_other_registro_2);
$data_history_converse_2 = mysqli_fetch_array($res_verific_other_2);




$actualizar_fecha_entrada = "UPDATE historial_fecha SET fecha_entrada = '" . $fecha_con_horas_minutos . "', pm_am_entrada = '".$pm_am_entrada."' WHERE id_alumno = '" . $id_alumno . "' and dia_fecha = '" . $fecha_dia_mes_a . "'";
$res_actualizar_fecha = mysqli_query($conn, $actualizar_fecha_entrada);
if ($res_actualizar_fecha) {
?>
<script>
    swalWithBootstrapButtons.fire(
    'Reemplazado!',
    'Se actualizo la fecha de entrada de el dia <?php echo $data_history_converse_2['dia_fecha']; ?> ',
    'success'
    )
    document.getElementById('cod_estudiante').value = "";
    
</script>
<?php
}
?>