<?php
session_start();
$id_usuario = $_SESSION['id'];
require "../../bd/database.php";

// limitar a el colegio
$usuario_verific_all_sql = "SELECT * FROM usuarios WHERE id = '" . $id_usuario . "'";
$res_verific_all_sql = mysqli_query($conn, $usuario_verific_all_sql);
$data_verific_all_sql = mysqli_fetch_array($res_verific_all_sql);

$colegio_sec_n = $data_verific_all_sql['colegio_sec'];


$consult_colegios_all = "SELECT * FROM colegios WHERE id = '".$colegio_sec_n."'";
$res_consult_colegios_all = mysqli_query($conn, $consult_colegios_all);

?>


<div class="container_card_history_table">
    <div class="table_contenedor_box mar-bot fl_left">
        <div class="button_add_almn_admin">
            <button class="btn_add_almn" onclick="load_admin_add_alumn_tables();">Agregar Alumno<i class="fa-solid fa-plus"></i></button>
        </div>
    </div>
    <div class="table_contenedor_box mar-bot fl_left">

        <!-- <form method="post"> -->
            <p>Filtro de registros</p>
            <div class="control_rows_filter_2">
                <div class="fecha_filter_cont_2" style="padding:10px;"> 
                    <select style="width:300px;" name="colegio" id="colegio" onchange="load_table_content_limiter()">
                        <?php 
                        while($data_colegios_op = mysqli_fetch_array($res_consult_colegios_all)){
                        ?>
                        <option value="<?php echo $data_colegios_op['nombre_colegio']; ?>"><?php echo $data_colegios_op['nombre_colegio']; ?></option>
                        <?php } ?> 
                        
                    </select>
                </div>
                <div class="select_limiter_cont left-cot" style="padding:10px; margin-right:10px; ">
                    <span>numero de filas:</span>
                    <select name="filtro_filas_registros" id="filtro_filas_registros" onchange="load_table_content_limiter()">
                        <option value="25">25 filas</option>
                        <option value="50">50 filas</option>
                        <option value="75">75 filas</option>
                        <option value="100">100 filas</option>
                    </select>
                </div>
                <div class="select_limiter_cont" style="padding:10px;">
                    <span>grado:</span>
                    <input type="text"  class="fecha_design alarge" id="filtro_grados" onchange="load_table_content_limiter()">
                </div>
                <!-- </form> -->
    </div>
    <div class="btn_cont">
        <button onclick="load_admin_alumn_tables()" class="btn_filter_history">buscar</button>
    </div>


</div>
<span id="table_loader"></span>




<script>
    function load_admin_alumn_tables() {

        var colegio = document.getElementById('colegio').value;
        var filtro_filas_registros = document.getElementById('filtro_filas_registros').value;
        var filtro_grados = document.getElementById('filtro_grados').value;
        var dataen = 'colegio=' + colegio + '&filtro_filas_registros=' + filtro_filas_registros + '&filtro_grados=' + filtro_grados;
        $.ajax({
            type: 'POST',
            url: 'share/admin/tabla_alumnos.php',
            data: dataen,
            success: function(resp) {
                var act = setInterval(function() {
                    $('#table_loader').html(resp);
                    clearInterval(act);
                }, 200);
            }
        });

    }


    $(document).ready(function() {
        load_admin_alumn_tables();
    });
</script>