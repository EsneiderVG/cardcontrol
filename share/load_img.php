<?php 

session_start();
require "../bd/database.php";

$cod_estudiante = $_POST['cod_estudiante'];

if(isset($_POST['perfil_default'])){
    

}

if($cod_estudiante > 0){
    $consult_sql_img = "SELECT * FROM alumnos_info WHERE cod_estudiante = '" . $cod_estudiante . "'";
    $res_consult_sql_img = mysqli_query($conn, $consult_sql_img);
    $data_consult_sql_img = mysqli_fetch_array($res_consult_sql_img);

}
// echo $cod_estudiante;

if(isset($_POST['perfil_default'])){
    ?>
    <img class="img-cover" src="https://grandimageinc.com/wp-content/uploads/2015/09/icon-user-default.png" alt="" width="" height="">
    <?php
}

if($cod_estudiante <= 0 and (!isset($_POST['perfil_default']))){
    ?>
    <div class="img_default">
        
    </div>
    <?php
}elseif($cod_estudiante > 0){
    ?>
    <img class="img-cover" src="data:image/png;base64, <?php echo base64_encode($data_consult_sql_img['img_alumno']) ?>" alt="" width="" height="">
    <?php
}


?>