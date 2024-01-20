<?php 
session_start();
$id_usuario = $_SESSION['id'];
require "../bd/database.php";
?>

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

ini_set("error_reporting", 0);



if (isset($_FILES['file'])) {
    
    $tamañanoarchivo = $_FILES['file']['size'];


    $archivo_img_1 = $_FILES['file'];
    $nombre_archivo = $archivo_img_1['name'];
    $ruta_temporal = $archivo_img_1["tmp_name"];
    $dimensiones = getimagesize($ruta_temporal);
    $ancho = $dimensiones[0];
    $altura = $dimensiones[1];
    $ruta_temporal = $archivo_img_1["tmp_name"];
    // echo $ancho;
    // echo "x";
    // echo $altura;
    // echo $tamañanoarchivo;

    if ($tamañanoarchivo > 805681) {
    ?>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Ups! El tamaño de tu imagen <?php echo $nombre_archivo; ?>, supera los 800kb permitidos."',
                showConfirmButton: true,
            })
        </script>
    <?php
        exit();
    }

    $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
    // binario also is tmp_data
    $binariosImagen = fread($imagenSubida, $tamañanoarchivo);
    $binariosImagen = mysqli_escape_string($conn, $binariosImagen);


    $id_usuario = $_SESSION['id'];
    $act_perfil = "UPDATE usuarios SET avatar = '" . $binariosImagen . "' WHERE id = $id_usuario ";
    $response_act = mysqli_query($conn, $act_perfil);
    if ($response_act) {
    ?>
        <script>
            

            Toast.fire({
                icon: 'success',
                title: 'Se cambio el avatar exitosamente!'
            })
            load_perfil_user();
        </script>
    <?php
    }

    ?>
    <!-- <img src="data:image/png;base64, <?php echo base64_encode($binariosImagen) ?> " alt=""> -->
    <?php
}

?>