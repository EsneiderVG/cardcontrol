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
$colegio = $_POST['colegio'];
$id_col_m = $_POST['id_col_m'];
echo $colegio;
echo $id_col_m;
$modificar_sql_colegio = "UPDATE colegios
SET nombre_colegio = '" . $colegio . "' WHERE id = '" . $id_col_m . "'";
$res_modificar_sql = mysqli_query($conn, $modificar_sql_colegio);

if ($res_modificar_sql) {
?>
    <script>
        Toast.fire({
            icon: 'success',
            title: 'se cambio el colegio <?php echo $colegio ?> id <?php echo $id_col_m ?> '
        })
        load_tables_colegios();
    </script>
<?php
}




?>