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
// extract files img

if (isset($_FILES['file']['name'])) {

    $tipoArchivo = $_FILES['file']['type'];
    $nombreArchivo = uniqid();
    $tamañanoarchivo = $_FILES['file']['size'];
    $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
    // binario also is tmp_data
    $binariosImagen = fread($imagenSubida, $tamañanoarchivo);
    require "../../../bd/database.php";
    $binariosImagen = mysqli_escape_string($conn, $binariosImagen);

    $usuario = $_POST['usuario'];
    $nombres = $_POST['nombres'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $contraseña = password_hash($contraseña, PASSWORD_BCRYPT);
    // $contraseña_confirm = $_POST['contraseña_confirm'];
    $admin = $_POST['admin'];
    $admin_p = 0;
    $user_inv = $_POST['user_inv'];
    $sc_google = 0;
    $cero = 0;

    // include "validacion.php";

    $query = "INSERT INTO usuarios (usuario, nombres, email, contraseña, avatar, tipo_de_archivo, nombre_archivo, confirm_correo, reset_contraseña, cod_confirm, admin, admin_p, sc_google, type_user_inv) values (
        '" . $usuario . "', '" . $nombres . "', '" . $email . "','" . $contraseña . "', '" .  $binariosImagen . "',  '" . $tipoArchivo . "', '" . $nombreArchivo . "', '" . $cero . "', '" . $cero . "', '', '" . $admin . "', '" . $admin_p . "', '" . $sc_google . "', '" . $user_inv . "') ";
        // echo $query;

    $verificar_email = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '$email'");

    if (mysqli_num_rows($verificar_email) > 0) {
        ?>
        <script>
            Toast.fire({
                icon: 'success',
                title: 'el usuario ya existe, intenta de nuevo, o intenta con otro usuario'
            })
        </script>
        <?php
        exit();
    }

    $res = mysqli_query($conn, $query);
    if ($res) {
        ?>
        <script>
            Toast.fire({
                icon: 'success',
                title: 'se creo con exito el usuario <?php echo $usuario; ?>'
            })
            load_admin_users();
        </script>
        <?php

    } else {
        echo mysqli_error($conn);
    };
}

?>