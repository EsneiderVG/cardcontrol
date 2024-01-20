<?php
session_start();
$id_usuario = $_SESSION['id'];
require "bd/database.php";


if (empty($_SESSION['id'])) {
    header("location: index.php");
}

$usuario_verific_all_sql = "SELECT * FROM usuarios WHERE id = '" . $id_usuario . "'";
$res_verific_all_sql = mysqli_query($conn, $usuario_verific_all_sql);
$data_verific_all_sql = mysqli_fetch_array($res_verific_all_sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css" />

    <!-- =====BOX ICONS===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/15c45fe034.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/styles_admin.css">
    
    <link rel="stylesheet" href="assets/css/historial_1.css">
    <link rel="stylesheet" href="assets/css/admin_alumnos.css">
    <title>Control box Goodmax</title>
    <link rel="icon" type="image/jpg" href="assets/img/icon_pestaña.png" width="200" height="200
    "/>

    <style>
        .disclaimer{
            display:none;
        }
    </style>

</head>

<body>

    <?php require "requires/header_admin.php"; ?>
    <main class="l-main">
        <!--===== HOME =====-->
        <section class="bd-grid cord-up-max" id="home" style="margin-top: 100px;">
            <div class="home_data" id="admin_zone">
                <!-- zone null_load -->
            </div>

        </section>
    </main>



    <script>
        function load_admin_colegios() {
            var data = 1;
            var dataen = 'data=' + data;
            $.ajax({
                type: 'POST',
                url: 'share/admin/admin_colegios.php',
                data: dataen,
                success: function(resp) {
                    var act = setInterval(function() {
                        $('#admin_zone').html(resp);
                        clearInterval(act);
                    }, 200);
                }
            });
        }
        
        function load_admin_alumnos() {
            var data = 1;
            var dataen = 'data=' + data;
            $.ajax({
                type: 'POST',
                url: 'share/admin/admin_alumnos.php',
                data: dataen,
                success: function(resp) {
                    var act = setInterval(function() {
                        $('#admin_zone').html(resp);
                        clearInterval(act);
                    }, 200);
                }
            });
        }

        function load_admin_inicio() {
            var data = 1;
            var dataen = 'data=' + data;
            $.ajax({
                type: 'POST',
                url: 'share/admin/admin_inicio.php',
                data: dataen,
                success: function(resp) {
                    var act = setInterval(function() {
                        $('#admin_zone').html(resp);
                        clearInterval(act);
                    }, 200);


                }
            });
        }

        function load_admin_add_alumn_tables() {

            var data = 1;
            var dataen = 'data=' + data;
            $.ajax({
                type: 'POST',
                url: 'share/admin/add_alumn_admin.php',
                data: dataen,
                success: function(resp) {
                    var act = setInterval(function() {
                        $('#admin_zone').html(resp);
                        clearInterval(act);
                    }, 200);
                }
            });

        }
        $(document).ready(function() {
            // var historial_border_btn = document.getElementById('hst');
            // var marcaje_border_btn = document.getElementById('marcaje');
    
            // historial_border_btn.className = "nav__link";
            // marcaje_border_btn.className = "nav__link";
    
            // marcaje_border_btn.classList.remove('active');
            // historial_border_btn.classList.add('active');
            
            load_admin_alumnos();
        });
    </script>
    
    <?php require "requires/footer.php"; ?>
    
    <script src="assets/js/main.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'></script>
</body>

</html>