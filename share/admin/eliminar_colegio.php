<script>
    // alert("ai hpta si dio");
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
$id_col = $_POST['id_col'];
echo $colegio;
echo $id_col;
$eliminar_sql_colegio = "DELETE FROM colegios WHERE id = '".$id_col."'
";
$res_eliminar_sql = mysqli_query($conn, $eliminar_sql_colegio);
if ($res_eliminar_sql) {
?>
    <script>
        Toast.fire({
            icon: 'success',
            title: 'se elimino el id <?php echo $id_col ?> '
        })
        load_tables_colegios();
    </script>
<?php
}




?>