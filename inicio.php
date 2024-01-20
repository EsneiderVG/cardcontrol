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

$colegio_sec_n = $data_verific_all_sql['colegio_sec'];

$verifi_coleg_section_sql = "SELECT * FROM colegios WHERE id = '".$colegio_sec_n."'";
$res_verifi_section = mysqli_query($conn, $verifi_coleg_section_sql);
$data_obt_res_verifi_section = mysqli_fetch_array($res_verifi_section);

$colegio_sec = $data_obt_res_verifi_section['nombre_colegio'];
echo $colegio_sec;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/marcaje.css">
    <link rel="stylesheet" href="assets/css/historial_1.css">
    <link rel="stylesheet" href="assets/css/buscar.css">
    <link rel="stylesheet" href="assets/css/camera_box.css">
    <link rel="stylesheet" href="assets/css/perfil_usuario.css">

    <!-- =====BOX ICONS===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/15c45fe034.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script type="text/javascript" src="assets/js/jquery.js"></script> -->
    <script type="text/javascript" src="assets/js/qrcodelib.js"></script>
    <script type="text/javascript" src="assets/js/webcodecamjquery.js"></script>

    <title>Control box Goodmax</title>
    <link rel="icon" type="image/jpg" href="assets/img/icon_pestaña.png" width="200" height="200
    "/>
    
    <style>
        .disclaimer{
            display:none;
        }
        .bd-grid {
          max-width: 1424px;
          
        }

    </style>
    <script>
        function play_qr_fun() {
            decoder.play();
            document.getElementById("play_qr_btn").style.display = "none";
            document.getElementById("stop_qr_btn").style.display = "block";
            document.getElementById("camero_open").style.opacity = "100";
            document.getElementById("content_camera_selected").style.display = "block";
        }

        function stop_qr_fun() {
            decoder.stop();
            document.getElementById("play_qr_btn").style.display = "block";
            document.getElementById("stop_qr_btn").style.display = "none";
            document.getElementById("camero_open").style.opacity = "0";
            document.getElementById("content_camera_selected").style.display = "none";

        }
        // 1 es entrada, 2 es salida
        var qr_confirm = 1;
        var salida_o_entrada = 1;
        var cod_estudiante_tmp = "";
        
        function validaCheckbox() {
            var salida_o_entrada_check = document.getElementById('switch');

            var checked = salida_o_entrada_check.checked;
            if (checked) {
                // alert("wow entrada1");
                salida_o_entrada = 2;
                // alert(salida_o_entrada);
                select_salida_o_entrada();
            } else {
                // alert("wow entrada2");
                salida_o_entrada = 1;
                // alert(salida_o_entrada);
                select_salida_o_entrada();
            }
        }

        function open_function_load_content() {
            // alert(qr_confirm);
            // alert(salida_o_entrada);
            if (salida_o_entrada == 1) {
                // alert(cod_estudiante_tmp);
                // document.getElementById("cod_estudiante").value = cod_estudiante_tmp;
                if (qr_confirm == 0) {
                    // marcaje de entrada
                    document.getElementById("cod_estudiante").value = cod_estudiante_tmp;

                    load_content();
                    qr_confirm = 1;
                    return false;
                }
                if (qr_confirm >= 1) {
                    
                    qr_confirm = 0;
                    return false;
                }
                if (qr_confirm >= 2) {
                    
                    qr_confirm = 0;
                    return false;
                }
                qr_confirm = 0;
            }
            if (salida_o_entrada == 2) {
                
                if (qr_confirm == 0) {
                    document.getElementById('cod_estudiante_salida').value = cod_estudiante_tmp;
                    load_content_marcaje_salida();
                    qr_confirm = 1;
                    return false;
                }
                if (qr_confirm >= 1) {
                    qr_confirm = 0;
                    return false;
                }
                if (qr_confirm >= 2) {
                    return false;
                }
                
            }
            qr_confirm = 0;
        }


        // var salida_o_entrada = 1;


        function select_salida_o_entrada() {
            if (salida_o_entrada == 1) {
                // alert("esta en mod entrada");
                document.getElementById('cod_estudiante_salida').style.display="none";
                document.getElementById('cod_estudiante').style.display="block";
                
                var btn_entrada = document.getElementById('btn_entrada');
                var btn_salida = document.getElementById('btn_salida');

                btn_entrada.className = 'btn_op_entrada_marcaje';
                btn_salida.className = 'btn_op_entrada_marcaje';

                btn_salida.classList.remove('active_b');
                btn_entrada.classList.add('active_b');
                load_content_default();
            }
            if (salida_o_entrada == 2) {
                // alert("esta en mod salida");
                document.getElementById('cod_estudiante_salida').style.display="block";
                document.getElementById('cod_estudiante').style.display="none";
                
                var btn_entrada = document.getElementById('btn_entrada');
                var btn_salida = document.getElementById('btn_salida');

                btn_entrada.className = 'btn_op_entrada_marcaje';
                btn_salida.className = 'btn_op_entrada_marcaje';
                btn_entrada.classList.remove('active_b');
                btn_salida.classList.add('active_b');
                content_marcaje_salida();
                
            }
        }
    </script>
    
</head>

<body>
    <!--===== HEADER =====-->
    <?php
    require "requires/header.php";
    ?>

    <main class="l-main">
        <!--===== HOME =====-->
        <section class="bd-grid cord-up-max" id="home" style="margin-top: 100px;">
            <span id="alert_update_fechas"></span>
            
            
            <div id="btn_lector_qr" style="margin-bottom: 25px;">
                <div class="row_btn_movil_p">
                    <!--<div class="btn_marcajes">-->
                    <!--    <button id="btn_entrada" onclick="-->
                    <!--    salida_o_entrada = 1;-->
                    <!--    select_salida_o_entrada();-->
                    <!--    " class="btn_op_entrada_marcaje active_b">E</button>-->

                    <!--    <button id="btn_salida" onclick="-->
                    <!--    salida_o_entrada = 2;-->
                    <!--    select_salida_o_entrada();-->
                    <!--    " class="btn_op_entrada_marcaje">S</button>-->
                    <!--</div>-->
                    <div class="content_salida_entrada">
                        <span>Entrada/Salida</span>
                         <div class="swtich-container">
                
                            <input onchange="validaCheckbox();" type="checkbox" id="switch">
                            <label for="switch" class="lbl"></label>
                        </div>
                    </div>
                    <button style="width: 75%; float:right;" class="btn_filter_history" id="play_qr_btn" onclick="play_qr_fun()">Empezar la lectura si estas en pc</button>
                    <button class="btn_filter_history" style="display:none; width: 75%;" id="stop_qr_btn" onclick="stop_qr_fun()">Parar lectura de qr</button>
                </div>
            </div>
            
            <div class="home__data" id="zone_no_admin">
                <div class="row_channels">
                    <!-- bloque de la izquierda -->
                    <div class="cont_box_row_op cord_right animation-left">
                        <div class="decode_user_impress">
                            <div class="img_service_good">
                                <img src="assets/img/logo_cards.png" alt="" width="281" height="216">
                            </div>
                            <div class="box_input" id="input_cod_estudiante">
                                <input class="text_inp" type="text" name="cod_estudiante" id="cod_estudiante" placeholder="Cod_student" onchange="load_content();">
                                <input class="text_inp" style="display:none;" type="text" name="cod_estudiante_salida" id="cod_estudiante_salida" placeholder="Cod_student_salida" onchange="load_content_marcaje_salida();">
                                <input class="text_inp" style="display:none;" type="text" name="cod_estudiante_buscar" id="cod_estudiante_buscar" placeholder="Cod_student_buscar" onchange="load_buscar();">

                                <input class="text_inp" style="display:none;" type="text" name="cod_estudiante_h" id="cod_estudiante_h" placeholder="Cod_student_h" onchange="load_historial()">

                            </div>
                            <div class="container_profil" id="img_al">
                                <!-- <img class="img-cover" src="assets/img/user1.png" alt="" width="" height=""> -->

                            </div>
                        </div>
                    </div>
                    <div class="cont_box_row_op">
                        <div class="row_cards">
                            <div class="row_cards" id="cont"></div>
                            <script>
                                // script de lector de qr

                                // $("#cod_estudiante").keyup(function(event) {
                                //     load_content();
                                // });
                                
                                // $("#cod_estudiante_salida").keyup(function(event) {
                                //     load_content();
                                // });

                                

                                function load_buscar(){
                                    
                                    document.getElementById('btn_lector_qr').style.display="none";
                                        
                                    document.getElementById('content_camera_selected').style.display="none";
                                    document.getElementById("play_qr_btn").style.display = "block";
                                    document.getElementById("stop_qr_btn").style.display = "none";
                                    var cod_estudiante = document.getElementById('cod_estudiante_buscar').value;
                                    var dataen = 'cod_estudiante=' + cod_estudiante;
                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/buscar.php',
                                        data: dataen,
                                        success: function(resp) {
                                            var act = setInterval(function() {
                                                $('#cont').html(resp);
                                                clearInterval(act);
                                            }, 200);


                                        }
                                    });
                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/load_img.php',
                                        data: dataen,
                                        success: function(resp) {
                                            // <img class="center_img_alert" src="assets/img/loading.gif" alt="">

                                            var act_interval2 = setInterval(function() {
                                                $('#img_al').html(resp);
                                                clearInterval(act_interval2);
                                            }, 200);

                                        }
                                    });
                                }

                                function load_historial() {
                                    // alert("lol");
                                    document.getElementById('btn_lector_qr').style.display="none";
                                    
                                    document.getElementById('content_camera_selected').style.display="none";
                                    document.getElementById("play_qr_btn").style.display = "block";
                                    document.getElementById("stop_qr_btn").style.display = "none";
                                    var cod_estudiante = document.getElementById('cod_estudiante_h').value;
                                    var dataen = 'cod_estudiante=' + cod_estudiante;
                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/historial.php',
                                        data: dataen,
                                        success: function(resp) {
                                            var act = setInterval(function() {
                                                $('#cont').html(resp);
                                                clearInterval(act);
                                            }, 200);


                                        }
                                    });

                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/load_img.php',
                                        data: dataen,
                                        success: function(resp) {
                                            // <img class="center_img_alert" src="assets/img/loading.gif" alt="">

                                            var act_interval2 = setInterval(function() {
                                                $('#img_al').html(resp);
                                                clearInterval(act_interval2);
                                            }, 200);

                                        }
                                    });


                                }


                                function load_content_default() {
                                    document.getElementById('btn_lector_qr').style.display="block";

                                    var cod_estudiante = document.getElementById('cod_estudiante').value;
                                    var dataen = 'cod_estudiante=' + cod_estudiante;
                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/marcaje.php',
                                        data: dataen,
                                        success: function(resp) {
                                            var act = setInterval(function() {
                                                $('#cont').html(resp);
                                                clearInterval(act);
                                            }, 200);


                                        }
                                    });

                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/load_img.php',
                                        data: dataen,
                                        success: function(resp) {
                                            // <img class="center_img_alert" src="assets/img/loading.gif" alt="">

                                            var act_interval2 = setInterval(function() {
                                                $('#img_al').html(resp);
                                                clearInterval(act_interval2);
                                            }, 200);

                                        }
                                    });


                                }

                                function load_content() {
                                    
                                    document.getElementById('btn_lector_qr').style.display="block";
                                    var cod_estudiante = document.getElementById('cod_estudiante').value;
                                    var dataen = 'cod_estudiante=' + cod_estudiante;
                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/marcaje.php',
                                        data: dataen,
                                        success: function(resp) {
                                            
                                            $('#cont').html(resp);
                        
                                        }
                                    });

                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/load_img.php',
                                        data: dataen,
                                        success: function(resp) {
                                            // <img class="center_img_alert" src="assets/img/loading.gif" alt="">
                                            // let timerInterval
                                            // Swal.fire({
                                            //     title: 'Cargando Alumno',
                                            //     html: 'cargando en <b></b>, ',
                                            //     timer: 2000,
                                            //     timerProgressBar: true,
                                            //     didOpen: () => {
                                            //         Swal.showLoading()
                                            //         const b = Swal.getHtmlContainer().querySelector('b')
                                            //         timerInterval = setInterval(() => {
                                            //             b.textContent = Swal.getTimerLeft()
                                            //         }, 100)
                                            //     },
                                            //     willClose: () => {
                                            //         clearInterval(timerInterval)
                                            //     }
                                            // }).then((result) => {
                                            //     /* Read more about handling dismissals below */
                                            //     if (result.dismiss === Swal.DismissReason.timer) {
                                            //         console.log('I was closed by the timer')
                                            //     }
                                            // })

                                            
                                            $('#img_al').html(resp);
                                                

                                        }
                                    });

                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/update_fechas.php',
                                        data: dataen,
                                        success: function(resp) {
                                            
                                            $('#alert_update_fechas').html(resp);
                                        }
                                    });



                                }
                                // default de salida
                                function content_marcaje_salida(){
                                    document.getElementById('btn_lector_qr').style.display = "block";
                                    var cod_estudiante = document.getElementById('cod_estudiante_salida').value;
                                    var dataen = 'cod_estudiante=' + cod_estudiante;
                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/marcaje_salida.php',
                                        data: dataen,
                                        success: function(resp) {
                                            var act_salida = setInterval(function() {
                                                $('#cont').html(resp);
                                                clearInterval(act_salida);
                                            }, 200);


                                        }
                                    });

                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/load_img.php',
                                        data: dataen,
                                        success: function(resp) {

                                            var act_interval2_salida = setInterval(function() {
                                                $('#img_al').html(resp);
                                                clearInterval(act_interval2_salida);
                                            }, 200);

                                        }
                                    });
                                }

                                // funcion para cargar marcaje salida
                                function load_content_marcaje_salida() {

                                    document.getElementById('btn_lector_qr').style.display = "block";
                                    var cod_estudiante = document.getElementById('cod_estudiante_salida').value;
                                    var dataen = 'cod_estudiante=' + cod_estudiante;
                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/marcaje_salida.php',
                                        data: dataen,
                                        success: function(resp) {
                                            
                                            $('#cont').html(resp);

                                        }
                                    });

                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/load_img.php',
                                        data: dataen,
                                        success: function(resp) {

                                            $('#img_al').html(resp);

                                        }
                                    });

                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/update_fecha_salida.php',
                                        data: dataen,
                                        success: function(resp) {

                                            $('#alert_update_fechas').html(resp);

                                        }
                                    });
                                }
                                function load_perfil_user(){
                                    document.getElementById('btn_lector_qr').style.display = "none";
                                    
                                    
                                    // document.getElementById('cod_estudiante').style.display = "block";
                                    // document.getElementById('cod_estudiante_buscar').style.display = "block";
                                    // document.getElementById('cod_estudiante_h').style.display = "block";                                    

                                    var cod_estudiante = 0;
                                    var perfil_default = 2;
                                    var dataen = 'cod_estudiante=' + cod_estudiante;
                                    
                                    var dataen = 'cod_estudiante=' + cod_estudiante;
                                    var dataen2 = 'cod_estudiante=' + cod_estudiante + '&perfil_default=' + perfil_default;
                                    $.ajax({
                                        type: 'POST',
                                        url: 'share_2/pu.php',
                                        data: dataen,
                                        success: function(resp) {
                                            // <img class="center_img_alert" src="assets/img/loading.gif" alt="">

                                            var act_interval2 = setInterval(function() {
                                                $('#cont').html(resp);
                                                clearInterval(act_interval2);
                                            }, 200);

                                        }
                                    });
                                    $.ajax({
                                        type: 'POST',
                                        url: 'share/load_img.php',
                                        data: dataen2,
                                        success: function(resp) {

                                            $('#img_al').html(resp);

                                        }
                                    });
                                }

                                <?php
                                // retificador de usuarios tipo invitado
                                $retific_user_inv = $data_verific_all_sql['type_user_inv'];
                                if ($retific_user_inv == 0) {
                                ?>
                                    $(document).ready(function() {
                                        load_content_default();
                                    });
                                <?php
                                } elseif ($retific_user_inv == 1) {
                                ?>
                                    $(document).ready(function() {
                                        Swal.fire(
                                            'Usuario de invitado',
                                            'actualmente señor padre de familia, solo tiene acceso a historial',
                                            'question'
                                        )
                                        load_historial();
                                    });
                                <?php
                                }
                                ?>
                            </script>
                            <!-- cut -->
                            <div class="container_card_history_table_2" style="margin-bottom: 25px; display:none;" id="content_camera_selected">
                                <div class="table_contenedor_box camara_op">
                                    <div class="row_camara_op">
                                        <div class="camera_film">
                                            <canvas id="camero_open"></canvas>
                                        </div>
                                        <div class="select_camera">
                                            <div class="seting_camara_op">
                                                <span>Seleciona la camara</span>
                                                <select class="form-control select-camera" id="camera-select" onchange="decoder.play();"></select>
                                            </div>

                                            <!-- espace for more -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="home__social">
                 <a href="https://goodmax.com.co/" class="home__social-icon"><i class='bx bx-world'></i></a>
                <a href="" class="home__social-icon"><i class='bx bxl-behance'></i></a>
                <a href="" class="home__social-icon"><i class='bx bxl-github'></i></a>
            </div>

            <!-- <div class="home__social_2">
                <button class="button_save"><i class="fa-solid fa-floppy-disk"></i></button>
            </div> -->


        </section>

        <!--===== ABOUT =====-->


        <!--===== FOOTER =====-->
        <footer class="footer" style="margin: 0px;">
            <!--<p class="footer__title">Card control</p>-->
            <p> Copyright © 2022 GoodMax. Reservados todos los derechos</p>
        </footer>


        <!--===== SCROLL REVEAL =====-->
        <script src="https://unpkg.com/scrollreveal"></script>

        <!--===== MAIN JS =====-->
        <script src="assets/js/main.js"></script>
        <script type="text/javascript">
            var arg = {
                resultFunction: function(result) {
                    var resultado_analisis_qr = ($('<span>' + result.code + '</span>'));
                    var convert_to_s = toString(resultado_analisis_qr);
                    // $('body').append(resultado_analisis_qr);
                    cod_estudiante_tmp = result.code;
                    document.getElementById("play_qr_btn").style.display="none";
                    document.getElementById("stop_qr_btn").style.display="block";
                    var act_qr = setInterval(function() {
                            qr_confirm = 0;
                            open_function_load_content();
                            clearInterval(act_qr);
                    }, 500);
                }

            };
            var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
            decoder.buildSelectMenu("select");

            /*  Without visible select menu
                decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
            */
            $('select').on('change', function() {
                decoder.stop();
                return decoder;
            });
        </script>
</body>

</html>