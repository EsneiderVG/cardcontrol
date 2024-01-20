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
require "../../bd/database.php";

$colegio = $_POST['colegio'];
$id_alm = $_POST['id_alm'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$ti = $_POST['ti'];
$correo = $_POST['correo'];
$estado = $_POST['estado'];

$cod_estudiante = $_POST['cod_estudiante'];
$ciudad = $_POST['ciudad'];
$barrio = $_POST['barrio'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$sede = $_POST['sede'];
$grado = $_POST['grado'];
$jornada = $_POST['jornada'];


$modificar_sql_alumno = "UPDATE alumnos_info
SET cod_estudiante = '".$cod_estudiante."', nombres = '" . $nombres . "', apellidos = '" . $apellidos . "', numero_id = '" . $ti . "', estado = '" . $estado . "', ciudad = '".$ciudad."', barrio = '".$barrio."', direccion = '".$direccion."', telefono = '".$telefono."', correo = '".$correo."', institucion = '".$colegio."', sede = '".$sede."', grado = '".$grado."', jornada = '".$jornada."'  WHERE id = '" . $id_alm . "'";
$res_modificar_sql_alumno = mysqli_query($conn, $modificar_sql_alumno);

$select_alumn_sql = "SELECT * FROM alumnos_info WHERE id = '".$id_alm."'";
$res_alumn_sql = mysqli_query($conn, $select_alumn_sql);
$data_alumn = mysqli_fetch_array($res_alumn_sql);


if($res_modificar_sql_alumno){
    ?>
    <script>
        Toast.fire({
            icon: 'success',
            title: 'se cambio las credenciales del alumno <?php echo $data_alumn['nombres']; ?> <?php echo $data_alumn['apellidos']; ?> '
        })
        load_admin_alumn_tables();
    </script>
    <?php
}

?>