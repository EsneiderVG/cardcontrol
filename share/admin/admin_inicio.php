<?php
session_start();
$id_usuario = $_SESSION['id'];
require "../../bd/database.php";

$consult_colegios_all = "SELECT * FROM colegios";
$res_consult_colegios_all = mysqli_query($conn, $consult_colegios_all);

?>

<?php
    $consult_check_admin_p = "SELECT * FROM usuarios WHERE id = '" . $id_usuario . "'";
    $res_check_admin_p = mysqli_query($conn, $consult_check_admin_p);
    $data_check_admin_p = mysqli_fetch_array($res_check_admin_p);

    $id_admin_p = $data_check_admin_p['admin_p'];
    if ($id_admin_p == 1) {
    ?>

        <script>
            function load_admin_users() {

                var usuario = document.getElementById('usuario').value;
                var filtro_filas_registros = document.getElementById('filtro_filas_registros').value;
                var dataen = 'usuario=' + usuario + '&filtro_filas_registros=' + filtro_filas_registros;
                $.ajax({
                    type: 'POST',
                    url: 'share/admin/user_admins.php',
                    data: dataen,
                    success: function(resp) {
                        var act = setInterval(function() {
                            $('#user_admins').html(resp);
                            clearInterval(act);
                        }, 200);
                    }
                });

            }
            function subir_datos_alumno() {
            

            var usuario = document.getElementById('usuario_s').value;
            var nombres = document.getElementById('nombres').value;
            var email = document.getElementById('email').value;
            var contraseña = document.getElementById('contraseña').value;
            var contraseña_confirm_2 = document.getElementById('contraseña_confirm_2').value;
            var admin = document.getElementById('admin').value;
            var user_inv = document.getElementById('user_inv').value;


            var formData = new FormData();
            var files = $('#foto_user')[0].files[0];
            formData.append('file', files);
            formData.append('usuario', usuario);
            formData.append('nombres', nombres);
            formData.append('email', email);
            formData.append('contraseña', contraseña);
            formData.append('admin', admin);
            formData.append('user_inv', user_inv);





            // var dataen = 'nombres=' + nombres + '&apellidos=' + apellidos + '&id=' + id + '&estado=' + estado + '&barrio=' + barrio + '&direccion=' + direccion + '&telefono=' + telefono + '&correo=' + correo + '&instituto=' + instituto + '&sede=' + sede + '&grado=' + grado + '&jornada=' + jornada + '&cod_estudiante=' + cod_estudiante;


            $.ajax({
                type: 'POST',
                url: 'share/admin/actions_admin_users/agregar_usuario_loader.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(resp) {
                    $('#upload_user').html(resp);

                }
            });
        }

        function agregar_usuario_admin() {

            var usuario = document.getElementById('usuario').value;
            var filtro_filas_registros = document.getElementById('filtro_filas_registros').value;
            var dataen = 'usuario=' + usuario + '&filtro_filas_registros=' + filtro_filas_registros;
            $.ajax({
                type: 'POST',
                url: 'share/admin/actions_admin_users/agregar_usuario_content.php',
                data: dataen,
                success: function(resp) {
                    var act = setInterval(function() {
                        $('#user_add').html(resp);
                        clearInterval(act);
                    }, 200);
                }
            });

        }
            $(document).ready(function() {
                load_admin_users();
            });
        </script>

        <span id="upload_user"></span>
    <div class="button_add_almn_admin">
        <button class="btn_add_almn" onclick="agregar_usuario_admin();">Agregar Usuarios<i class="fa-solid fa-plus"></i></button>
    </div>
    <div class="table_contenedor_box mar-bot fl_left" style="margin-top: 10px;">

        <h1>Control de usuarios admin y de invitado</h1>
        <br>
        <br>
        <!-- <form method="post"> -->
        <p>Filtro de registros</p>
        <div class="control_rows_filter_2">
            <div class="fecha_filter_cont_2">
                <input required type="text" class="fecha_design alarge" name="usuario" id="usuario">
            </div>
            <div class="select_limiter_cont">
                <span>numero de filas:</span>
                <select name="filtro_filas_registros" id="filtro_filas_registros" onchange="load_table_content_limiter()">
                    <option value="25">25 filas</option>
                    <option value="50">50 filas</option>
                    <option value="75">75 filas</option>
                    <option value="100">100 filas</option>
                </select>
            </div>
            <!-- </form> -->
        </div>
        <div class="btn_cont">
            <button onclick="load_admin_users();" class="btn_filter_history">buscar</button>
        </div>
    </div>
    <span id="user_add"></span>
    <span id="user_admins"></span>

    <?php } else {
        ?>
        <script>
            Swal.fire(
              'No eres el administrador principal',
              'No tienes acceso a esta seccion de administradores',
              'question'
            )
        </script>
        <?php
    } ?>
</div>