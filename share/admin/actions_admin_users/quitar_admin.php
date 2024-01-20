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
require "../../../bd/database.php";
$id_user = $_POST['id_user'];
// echo $id_user;

$modificar_sql_user = "UPDATE usuarios
SET admin = '0' WHERE id = '" . $id_user . "'";
$res_modificar_sql = mysqli_query($conn, $modificar_sql_user);

$consult_data_users = "SELECT * FROM usuarios WHERE id = '".$id_user."'";
$res_consult_data_users = mysqli_query($conn, $consult_data_users);
$data_consult_data_users = mysqli_fetch_array($res_consult_data_users);


if ($res_modificar_sql) {
?>
    <script>
        Toast.fire({
            icon: 'success',
            title: 'el usuario <?php echo $data_consult_data_users['usuario']; ?> ya no es admin '
        })
        load_admin_users();
    </script>
<?php
}




?>