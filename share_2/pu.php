<?php
session_start();
$id = $_SESSION['id'];
require "../bd/database.php";
$query = "SELECT * FROM usuarios WHERE id = '$id'";
$res = mysqli_query($conn, $query);
while ($data = mysqli_fetch_array($res)) {
    $admin_p = $data['admin_p'];
    $admin_n = $data['admin'];
    $user_inv = $data['type_user_inv'];
?>

<span id="view2"></span>
<script>
    document.getElementById('cod_estudiante').style.display = "none";
    document.getElementById('cod_estudiante_buscar').style.display = "none";
    document.getElementById('cod_estudiante_h').style.display = "none";
    
    var realFileBtn = document.getElementById("real-file");
    var customBtn = document.getElementById("custom-button");
    var customTxt = document.getElementById("custom-text");

    customBtn.addEventListener("click", function() {
        realFileBtn.click();
    });

    realFileBtn.addEventListener("change", function() {
        if (realFileBtn.value) {
            customTxt.innerHTML = realFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            customTxt.innerHTML = "No file chosen, yet.";
        }
    });

    function load_img_1() {
        var formData = new FormData();
        var files = $('#real-file')[0].files[0];
        formData.append('file', files);
        $.ajax({
            type: 'POST',
            url: 'share_2/perfil_usuario_act.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#view2').html(resp);

            }
        });

    }
</script>



    <section class="seccion-perfil-usuario" style="width: 100%;">
        <div class="perfil-usuario-header">
            <div class="perfil-usuario-portada">
                <!-- <img class="portada" src="" alt=""> -->
                <div class="perfil-usuario-avatar">
                    <img src="data:image/png;base64, <?php echo base64_encode($data['avatar']) ?> " alt="">
                    <?php if ($user_inv == 0) { ?>
                        <button type="button" id="custom-button" class="boton-avatar">
                            <form id="img_perfil" method="post" enctype="multipart/form-data">
                                <input type="file" id="real-file" hidden="hidden" name="imagen" required />
                                <span id="custom-text"><i class="far fa-image"></i></span>
                            </form>
                            <!--  -->
                        </button>
                    <?php } ?>
                </div>
                <!-- <button type="button" id="custom-button2" class="boton-portada">
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" id="real-file2" hidden="hidden" name="imagen" required />
                        <span id="custom-text2"><i class="far fa-image"></i>Cambiar fondo</span>
                    </form>
                </button> -->
            </div>
        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <h3 class="titulo"><?php echo $data['usuario'] ?></h3>
                <p class="titulo2">
                    <?php
                    if ($admin_n == 1) {
                        echo "Admin";
                    }
                    if ($user_inv == 1) {
                        echo "Usuario de invitado";
                    }
                    if ($admin_n == 1 and $admin_p == 1) {
                        echo " principal";
                    }

                    ?>
                    <i class="fas fa-edit"></i></span>
                </p>
            </div><span id="popus_m"></span>
            <div style="margin-bottom: 25px;" class="perfil-usuario-editers">

                <div class="titles_selection">
                    <span><?php echo $data['nombres']; ?></span>
                    <?php
                    if ($user_inv == 0) {
                    ?>
                        <button class="btn_edits_pe" onclick="
                        Swal.fire({
                        title: 'Cambia tu nombre',
                        input: 'text',
                        inputValue: '<?php echo $data['nombres']; ?>',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Cambiar',
                        showLoaderOnConfirm: true,
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var nombres = result.value;
                            var dataen = 'nombres=' + nombres ;
                            $.ajax({
                                type: 'POST',
                                url: 'share_2/cambiar_nombres.php',
                                data: dataen,
                                success: function(resp) {
                                    $('#popus_m').html(resp);

                                }
                            });
                            alert(colegio);
                        }
                    })
                    ">editar<i class="fas fa-edit"></i></button>
                    <?php } ?>
                </div>
                <div class="titles_selection">
                    <span><?php echo $data['email']; ?></span>
                    <?php
                    if ($user_inv == 0) {
                    ?>
                        <button class="btn_edits_pe" onclick="
                    Swal.fire({
                        title: 'Cambia tu gmail',
                        input: 'text',
                        inputValue: '<?php echo $data['email']; ?>',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Cambiar',
                        showLoaderOnConfirm: true,
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var email = result.value;
                            var dataen = 'email=' + email ;
                            $.ajax({
                                type: 'POST',
                                url: 'share_2/cambiar_email.php',
                                data: dataen,
                                success: function(resp) {
                                    $('#popus_m').html(resp);

                                }
                            });
                            alert(colegio);
                        }
                    })
                    ">editar<i class="fas fa-edit"></i></button>
                    <?php } ?>
                </div>


            </div>
            <!-- <div class="row_col">
                <div class="perfil-usuario-footer2">
                    <div class="container_friends">
                        <div class="seeing_friends">
                            <span>Friends <a class="see_friends" href="">Ver todos los amigos</a></span><br>
                        </div>
                        <div class="total_friends" style="margin: 10px 0px;">
                            <span class="only_color_blue"> 1.456</span>
                            <span>amigos </span>
                        </div>
                        <div class="img_friends">
                            <div class="container_friend_chap">
                                <img src="https://i.pinimg.com/originals/ee/14/dc/ee14dce669236b59994d615a09775b66.jpg" alt="" srcset=""><br>
                                <span>Manuela Pèrez</span>
                            </div>
                            <div class="container_friend_chap">
                                <img src="https://i.pinimg.com/originals/ee/14/dc/ee14dce669236b59994d615a09775b66.jpg" alt="" srcset=""><br>
                                <span>Manuela Pèrez</span>
                            </div>
                            <div class="container_friend_chap">
                                <img src="https://i.pinimg.com/originals/ee/14/dc/ee14dce669236b59994d615a09775b66.jpg" alt="" srcset=""><br>
                                <span>Manuela Pèrez</span>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="perfil-usuario-footer" style="text-align:left; display:block;" id="load_cred">
                    
                </div>


            </div> -->
    </section>
    <!--====  End of html  ====-->
    </div>
    <button class="floating-btn" onclick="
        var c =true;
        var o = document.getElementById('real-file');
        var uploadFile = o.files[0];

        if (o.files.length>0) {
            load_img_1();
        }
        return c;              
        alert('dwaddwa');
        ">
        <i style="font-size:25px;" id="btn_help" title="ajustes" class="fas fa-save"></i>
    </button>
<?php
};
?>
<!-- <script src="assets/js/buttons.js"></script> -->