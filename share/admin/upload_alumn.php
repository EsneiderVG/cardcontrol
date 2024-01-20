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





if ($_FILES['file'] > 0) {
    
    // validacion space 1
    $tamañanoarchivo = $_FILES['file']['size'];
    $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
    // binario also is tmp_data
    $binariosImagen = fread($imagenSubida, $tamañanoarchivo);
    $binariosImagen = mysqli_escape_string($conn, $binariosImagen);


    $archivo_img_1 = $_FILES['file'];

    $nombre_archivo = $archivo_img_1['name'];

    $ruta_temporal = $archivo_img_1["tmp_name"];
    $dimensiones = getimagesize($ruta_temporal);
    $ancho = $dimensiones[0];
    $altura = $dimensiones[1];
    $ruta_temporal = $archivo_img_1["tmp_name"];

    $verific_alumn_code_sql = "SELECT * FROM alumnos_info WHERE cod_estudiante = '" . $cod_estudiante . "' ";
    $res_verific_alumn_code_sql = mysqli_query($conn, $verific_alumn_code_sql);

    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $numero_de_id = $_POST['id'];
    $estado_estudiante = $_POST['estado'];
    $ciudad = $_POST['ciudad'];
    $barrio = $_POST['barrio'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $instituto = $_POST['instituto'];
    $sede = $_POST['sede'];
    $grado = $_POST['grado'];
    $jornada = $_POST['jornada'];
    $cod_estudiante = $_POST['cod_estudiante'];
    $OBS = '';
    
$insert_sql = "INSERT INTO alumnos_info(cod_estudiante, nombres, apellidos, img_alumno, numero_id, estado, ciudad, barrio, direccion, telefono, correo, institucion, sede, grado, jornada, observacion) VALUES ('$cod_estudiante', '$nombres', '$apellidos', '$binariosImagen', '$numero_de_id', '$estado_estudiante', '$ciudad', '$barrio', '$direccion', '$telefono', '$correo', '$instituto', '$sede', '$grado', '$jornada', '')";

$verific_alumn_code_sql = "SELECT * FROM alumnos_info WHERE cod_estudiante = '" . $cod_estudiante . "' ";
    $res_verific_alumn_code_sql = mysqli_query($conn, $verific_alumn_code_sql);

    $cont_rows_alumn = mysqli_num_rows($res_verific_alumn_code_sql);

    if ($cont_rows_alumn <= 0) {
        $res_insert_sql = mysqli_query($conn, $insert_sql);
        
        if ($res_insert_sql) {
            ?>
            <script>
                Toast.fire({
                    icon: 'success',
                    title: 'se subio el alumno <?php echo $nombres ?> exitosamente'
                })
                load_inputs_uplo();
                reload_table_data_alumn();
            </script>
            <?php
        }else{
            echo "lol nada";
        }
    }else{
        ?>
        <script>
            Toast.fire({
                icon: 'success',
                title: 'ya existe el alumno con el codigo <?php echo $cod_estudiante; ?>'
            })
            exit();
        </script>
        <?php
    }
} else {
    ?>
    <script>
        Toast.fire({
            icon: 'error',
            title: 'no se pudo subir el alumno con exito'
        })
    </script>
<?php
}
?>