<?php

require "bd/database.php";

if($_SESSION['active'] = true){
    $id_usuario = $_SESSION['id'];
}
 echo $id_usuario;

$usuario_verific_all_sql_21 = "SELECT * FROM usuarios WHERE id = '" . $id_usuario . "'";
$res_verific_all_sql_21 = mysqli_query($conn, $usuario_verific_all_sql_21);
$data_verific_all_sql_21 = mysqli_fetch_array($res_verific_all_sql_21);

?>

<header class="l-header">
    <nav class="nav bd-grid" style="padding: 40px 0px;">
        <div>
            <a href="https://goodmax.com.co/" class="nav__logo">
                <!--<span class="logo_gd">-->
                <!--    <i class="fa-solid fa-g"></i><i class="fa-solid fa-m"></i>-->
                <!--</span>-->
                <div class="logo_img_gm" style="margin: 10px 0px;">
                    <img style="margin: 10px 0px;" src="assets/img/goodmax.png" alt="" width="186" height="90">
                </div>
            </a>
        </div>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <?php
                $verific_user_inv_21 = $data_verific_all_sql_21['type_user_inv'];

                if($verific_user_inv_21 == 1){
                    ?>
                    <li class="nav__item" ><span id="marcaje" class="nav__link active">Marcaje <i class="fa-brands fa-markdown"></i></a></li>
                    <li class="nav__item" ><span class="nav__link">Buscar <i class="fa-brands fa-searchengin"></i></a></li>
                    <?php
                }
                if($verific_user_inv_21 == 0){
                ?>
                <li class="nav__item" onclick="load_content_default();"><span id="marcaje" class="nav__link active">Marcaje <i class="fa-brands fa-markdown"></i></a></li>
                <li class="nav__item" onclick="load_buscar();"><span class="nav__link">Buscar <i class="fa-brands fa-searchengin"></i></a></li>
                <?php } ?>
                
                <li class="nav__item " onclick="load_historial();"><span id="hst" class="nav__link">Historial <i class="fa-solid fa-clock-rotate-left"></i></span></li>
                <li class="nav__item" onclick="load_perfil_user();"><span class="nav__link">
                    
                <?php
                if (!empty($_SESSION['id'])) {
                    $select_user_imp = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
                    // echo $select_user_imp;
                    $sql_user_res = mysqli_query($conn, $select_user_imp);
                    $data_conv_array = mysqli_fetch_array($sql_user_res);
                    echo $data_conv_array['usuario'];
                } else {
                    echo "Usuario";
                }
                ?>
                <i class="fa-solid fa-user"></i></a></li>
                <?php
                if (!empty($_SESSION['id'])) {
                    $select_user_imp = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
                    $sql_user_res = mysqli_query($conn, $select_user_imp);
                    $data_conv_array = mysqli_fetch_array($sql_user_res);
                    if ($data_conv_array['admin'] == 1 or $data_conv_array['admin'] == 1) {
                        ?>
                        <li class="nav__item color-admin" onclick="window.location='admin.php'"><span class="nav__link">Admin<i class="fa-brands fa-buysellads"></i></span></li>
                        <?php
                    }
                }

                ?>
                <?php
                if ($_SESSION['active'] = true) {
                ?>
                    <li class="nav__item"><a href="pages/logout.php" class="nav__link">Salir <i class="fa-solid fa-clock-rotate-left"></i></a></li>
                <?php
                }
                ?>

                <!-- <li class="nav__item"><a href="#contact" class="nav__link">Salir</a></li> -->
            </ul>
        </div>

        <div class="nav__toggle" id="nav-toggle">
            <i class='bx bx-menu'></i>
        </div>
    </nav>
</header>