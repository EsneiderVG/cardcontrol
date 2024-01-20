<script>
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })
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
$id_usuario = $_SESSION['id'];
// limitar a el colegio
$usuario_verific_all_sql = "SELECT * FROM usuarios WHERE id = '" . $id_usuario . "'";
$res_verific_all_sql = mysqli_query($conn, $usuario_verific_all_sql);
$data_verific_all_sql = mysqli_fetch_array($res_verific_all_sql);

$colegio_sec_n = $data_verific_all_sql['colegio_sec'];

$verifi_coleg_section_sql = "SELECT * FROM colegios WHERE id = '".$colegio_sec_n."'";
$res_verifi_section = mysqli_query($conn, $verifi_coleg_section_sql);
$data_obt_res_verifi_section = mysqli_fetch_array($res_verifi_section);

$colegio_sec = $data_obt_res_verifi_section['nombre_colegio'];

// $cod_estudiante = "1035";
$cod_estudiante = $_POST['cod_estudiante'];
// echo $cod_estudiante;
$consult_sql_fecha = "SELECT * FROM alumnos_info WHERE cod_estudiante = '" . $cod_estudiante . "' and institucion = '".$colegio_sec."'";
$res_consult_sql_fecha = mysqli_query($conn, $consult_sql_fecha);
$data_consult_sql_fecha = mysqli_fetch_array($res_consult_sql_fecha);

if(mysqli_num_rows($res_consult_sql_fecha) <= 0){
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

date_default_timezone_set('america/bogota');

$fecha_dia_mes_a = date('Y-m-d');
$fecha_con_horas_minutos = date('g:i:s');
$pm_am_sub = date('a');
$id_alumno = $data_consult_sql_fecha['id'];

// control outputs
// echo $id_alumno;
// echo $fecha_dia_mes_a;
// echo $fecha_con_horas_minutos;


$update_fechas = "INSERT INTO historial_fecha (id_alumno, dia_fecha, fecha_entrada) VALUES ('" . $id_alumno . "', '" . $fecha_dia_mes_a . "', '" . $fecha_con_horas_minutos . "')";
// $res_update_fechas = mysqli_query($conn, $update_fechas);

$verific_other_registro = "SELECT * FROM historial_fecha WHERE id_alumno = '" . $id_alumno . "' and dia_fecha = '" . $fecha_dia_mes_a . "'";
$res_verific_other = mysqli_query($conn, $verific_other_registro);
// echo $verific_other_registro;
$cont_reg_history = mysqli_num_rows($res_verific_other);

$data_history_converse = mysqli_fetch_array($res_verific_other);
$entrada_histoy_veri = $data_history_converse['fecha_entrada'];
$salida_histoy_veri = $data_history_converse['fecha_salida'];

if ($cont_reg_history > 0 and $entrada_histoy_veri > 0 and $salida_histoy_veri > 0) {

    
?>
    <span id="fe"></span>

    <script>
        swalWithBootstrapButtons.fire({
            title: 'Ya saliste del colegio en el dia!',
            text: "ya saliste del colegio el dia <?php echo $data_history_converse['dia_fecha']; ?> a las <?php echo $data_history_converse['fecha_salida']; ?>, quieres reemplazar la hora de salida por la actual? ",
            icon: 'warning',
            iconColor: 'aqua',
            showCancelButton: true,
            confirmButtonText: 'Si, reemplazar hora',
            cancelButtonText: 'No, deseo conservar la actual',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                var dataen_fe = 'fecha_con_horas_minutos=' + '<?php echo $fecha_con_horas_minutos; ?>' + '&id_alumno=' + '<?php echo $id_alumno; ?>' + '&fecha_dia_mes_a=' + '<?php echo $fecha_dia_mes_a; ?>' + '&pm_am_entrada=' + '<?php echo $pm_am_sub; ?>' ;

                $.ajax({
                    type: 'POST',
                    url: 'share/update_yes_fe_salida.php',
                    data: dataen_fe,
                    success: function(resp) {

                        $('#fe').html(resp);
                        clearInterval(act_fe);
                        
                    }
                });

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Entendido',
                    'la fecha de salida se dejo tal cual :)',
                    'warning'
                )
                document.getElementById('cod_estudiante_salida').value = "";
               

            }
        });
        qr_confirm = 0;
    </script>
    <?php
} elseif($cont_reg_history > 0 and $entrada_histoy_veri > 0 and $salida_histoy_veri <= 0) {
    $verific_other_registro_2 = "SELECT * FROM historial_fecha WHERE id_alumno = '" . $id_alumno . "'";
    $res_verific_other_2 = mysqli_query($conn, $verific_other_registro_2);
    $data_history_converse_2 = mysqli_fetch_array($res_verific_other_2);

    $id_alumno_2 = $data_history_converse_2['id_alumno'];

    // echo $id_alumno_2;
    $exist_alumno_sql = "SELECT * FROM alumnos_info WHERE id = '" . $id_alumno . "' and cod_estudiante = '" . $cod_estudiante . "'";
    // echo $exist_alumno_sql;
    // echo $verific_other_registro_2;
    $res_exist_alumno_sql = mysqli_query($conn, $exist_alumno_sql);
    if (mysqli_num_rows($res_exist_alumno_sql) <= 0) {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'al parecer no existe el alumno del codigo <?php echo $cod_estudiante ?>',
                footer: '<a href="">si tienes algun tipo error aqui puedes comentarlo?</a>'
            })
        </script>
    <?php
    } elseif (mysqli_num_rows($res_exist_alumno_sql) == 1) {
    ?>
    <span id="fe2"></span>
        <script>
            var dataen_fe = 'fecha_con_horas_minutos=' + '<?php echo $fecha_con_horas_minutos; ?>' + '&id_alumno=' + '<?php echo $id_alumno; ?>' + '&fecha_dia_mes_a=' + '<?php echo $fecha_dia_mes_a; ?>' + '&pm_am_entrada=' + '<?php echo $pm_am_sub; ?>' ;
            $.ajax({
                type: 'POST',
                url: 'share/insert_fecha_alumn_salida.php',
                data: dataen_fe,
                success: function(resp) {

                    $('#fe2').html(resp);
                    clearInterval(act_fe);

                }
            });
        </script>
<?php
    }
}elseif($cont_reg_history <= 0){
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'al parecer no entraste al colegio hoy, retifica el modo de asistencia y vuelve a intentarlo',
                footer: '<a href="">si tienes algun tipo error aqui puedes comentarlo?</a>'
            })
        </script>
    <?php
}

// echo $update_fechas;

?>
<!-- <button onclick="

">lol</button> -->



<?php

?>