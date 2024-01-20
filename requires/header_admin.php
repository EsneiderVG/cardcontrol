<?php

require "bd/database.php";
$id_usuario = $_SESSION['id'];

// echo $id_usuario;


?>

<header class="l-header">
    <nav class="nav bd-grid">
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
                <li class="nav__item" onclick="load_admin_colegios();"><span id="marcaje" class="nav__link">Colegios<i class="fa-brands fa-markdown"></i></a></li>
                <li class="nav__item" onclick="load_admin_alumnos();"><span class="nav__link active">Alumnos<i class="fa-brands fa-searchengin"></i></a></li>
                <li class="nav__item color-admin" onclick="load_admin_inicio()"><span class="nav__link">Admin<i class="fa-solid fa-clock-rotate-left"></i></span></li>
                
                <li class="nav__item color-admin" onclick="window.location= 'inicio.php'"><span class="nav__link">Card Control<i class="fa-solid fa-clock-rotate-left"></i></span></li>
                
                
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