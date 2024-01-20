<?php 

require "../bd/database.php";
$fecha_con_horas_minutos = $_POST['fecha_con_horas_minutos'];
$id_alumno = $_POST['id_alumno'];
$fecha_dia_mes_a = $_POST['fecha_dia_mes_a'];
$pm_am_entrada = $_POST['pm_am_entrada'];

$consult_sql_fecha_2 = "SELECT * FROM alumnos_info WHERE id = '" . $id_alumno . "'";
$res_consult_sql_fecha_2 = mysqli_query($conn, $consult_sql_fecha_2);
$data_consult_sql_fecha_2 = mysqli_fetch_array($res_consult_sql_fecha_2);


$update_fechas_2 = "INSERT INTO historial_fecha(id_alumno, dia_fecha, fecha_entrada, pm_am_entrada, fecha_salida, pm_am_salida) VALUES ('$id_alumno', '$fecha_dia_mes_a', '$fecha_con_horas_minutos', '$pm_am_entrada', '0', '')";
$res_update_fechas_2 = mysqli_query($conn, $update_fechas_2);

        if ($res_update_fechas_2) {
            
        ?>
            <script>
            // alert("locura");
                Toast.fire({
                    icon: 'success',
                    title: 'El marcaje es valido de el alumno: <?php echo $data_consult_sql_fecha_2['nombres'] ?>'
                })
                document.getElementById('cod_estudiante').value = "";
                
            </script>
        <?php
        }
?>