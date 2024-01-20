<script>
    alert("lololood save");
    none_up();
</script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 2000,
        width: '600px',
        iconColor: 'aqua',
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
</script>
<?php
session_start();
require "../bd/database.php";


$id_usuario_changer = $_SESSION['id'];
$observaciones = $_POST['observaciones'];
$cod_estudiante = $_POST['cod_estudiante'];

$upload_save_alum_sql = "UPDATE alumnos_info SET observacion = '" . $observaciones . "' WHERE cod_estudiante = '" . $cod_estudiante . "'";
$res_upload_save_alum_sql = mysqli_query($conn, $upload_save_alum_sql);
if ($res_upload_save_alum_sql) {
    $save_data_log_sql = "INSERT INTO cambios_obs_log (cod_estudiante_obs, id_change_user, fecha_cambio) VALUES ('" . $cod_estudiante . "',  '" . $id_usuario_changer . "', NOW())";
    $res_save_data_log_sql = mysqli_query($conn, $save_data_log_sql);
    if ($res_save_data_log_sql) {
        $consult_obt_data_almn = "SELECT * FROM alumnos_info WHERE cod_estudiante = '".$cod_estudiante."'";
        $res_consult_obt_data_almn = mysqli_query($conn, $consult_obt_data_almn);
        $data_obt_almn = mysqli_fetch_array($res_consult_obt_data_almn);
?>
        <script>
            Toast.fire({
                icon: 'success',
                title: 'se guardo la nueva observacion del estudiante: <?php echo $data_obt_almn['nombres']; ?> <?php echo $data_obt_almn['apellidos']; ?>'
            })
            load_buscar();
        </script>
<?php
    }
}



// echo $observaciones;
// echo $cod_estudiante;

?>