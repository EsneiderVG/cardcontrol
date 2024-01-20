

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

$insert_colegios = "INSERT INTO colegios (nombre_colegio) values ('$colegio')";
$res_insert_colegios = mysqli_query($conn, $insert_colegios);
if ($res_insert_colegios) {
?>
    <script>
        load_tables_colegios();
    </script>
<?php
}
