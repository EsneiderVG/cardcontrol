<?php 
session_start();
$id_usuario = $_SESSION['id'];
require "../bd/database.php";
?>

<script>
alert("llol");
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

$nombres = $_POST['nombres'];
// echo $id_user;

$modificar_sql_user = "UPDATE usuarios
SET nombres = '$nombres' WHERE id = '" . $id_usuario . "'";
$res_modificar_sql = mysqli_query($conn, $modificar_sql_user);

$consult_data_users = "SELECT * FROM usuarios WHERE id = '".$id_usuario."'";
$res_consult_data_users = mysqli_query($conn, $consult_data_users);
$data_consult_data_users = mysqli_fetch_array($res_consult_data_users);


if ($res_modificar_sql) {
?>
    <script>
        Toast.fire({
            icon: 'success',
            title: 'se cambio el nombre del usuario <?php echo $data_consult_data_users['usuario']; ?>'
        })
        load_perfil_user();
    </script>
<?php
}




?>