<script>
    document.getElementById('cod_estudiante').style.display = "none";
    document.getElementById('cod_estudiante_salida').style.display = "none";
    document.getElementById('cod_estudiante_h').style.display = "block";
    document.getElementById('cod_estudiante_buscar').style.display = "none";

</script>

<?php
session_start();
$id_usuario = $_SESSION['id'];
require "../bd/database.php";

$usuario_verific_all_sql_2 = "SELECT * FROM usuarios WHERE id = '" . $id_usuario . "'";
$res_verific_all_sql_2 = mysqli_query($conn, $usuario_verific_all_sql_2);
$data_verific_all_sql_2 = mysqli_fetch_array($res_verific_all_sql_2);

// retificador de usuarios tipo invitado
$verific_user_inv_2 = $data_verific_all_sql_2['type_user_inv'];
if ($verific_user_inv_2 == 1) {

} elseif ($verific_user_inv_2 == 0) {

}

$cod_estudiante = $_POST['cod_estudiante'];

if (empty($cod_estudiante)) {
?>
    <div class="container_card_history_table">
        <div class="table_contenedor_box mar-bot">

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora de entrada</th>
                        <th>Hora de salida</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td row="3"> dijital el cod del estudiante</td>
                    </tr>

                    <!-- <tr class="active-row">
            <td>Melissa</td>
            <td>5150</td>
        </tr> -->
                </tbody>
            </table>

        </div>
    </div>
<?php
} else {




?>



    <div class="container_card_history_table">

        <div class="table_contenedor_box mar-bot">
            <!-- <form method="post"> -->
            <p>Filtro de registros</p>
            <div class="control_rows_filter">
                <div class="fecha_filter_cont">
                    <div class="fechas_1">
                        <input type="date" class="fecha_design" name="fecha1" id="fecha1">
                    </div>
                    <span>To</span>
                    <div class="fecha_1">
                        <input type="date" class="fecha_design" name="fecha2" id="fecha2">
                    </div>
                </div>
                <div class="select_limiter_cont" style="height:139px; margin-left: 20px;">
                    <span>numero de filas:</span>
                    <select name="filtro_cup_registros" id="filtro_cup_registros" onchange="load_table_content_limiter()">
                        <option value="25">25 filas</option>
                        <option value="50">50 filas</option>
                        <option value="75">75 filas</option>
                        <option value="100">100 filas</option>
                    </select>
                </div>
                <!-- </form> -->

            </div>
            <div class="btn_cont">
                <button onclick="load_table_content_full_content()" class="btn_filter_history">buscar</button>
            </div>
        </div>
        <div class="table_contenedor_box" id="load_table_content">
            <script>
                function load_table_content() {

                    var dataen_table = 'cod_estudiante=' + '<?php echo $cod_estudiante; ?>';
                    $.ajax({
                        type: 'POST',
                        url: 'share/tabla_historial_load_sample.php',
                        data: dataen_table,
                        success: function(resp) {
                            $('#load_table_content').html(resp);
                        }
                    });

                }

                function load_table_content_limiter() {

                    var fecha1 = document.getElementById('fecha1').value;
                    var fecha2 = document.getElementById('fecha2').value;
                    var select_filas = document.getElementById('filtro_cup_registros').value;
                    var dataen_table = 'cod_estudiante=' + '<?php echo $cod_estudiante; ?>' + '&fecha1=' + fecha1 + '&fecha2=' + fecha2 + '&select_filas=' + select_filas;
                    $.ajax({
                        type: 'POST',
                        url: 'share/tabla_historial_load_filter.php',
                        data: dataen_table,
                        success: function(resp) {
                            $('#load_table_content').html(resp);
                        }
                    });
                }

                function load_table_content_full_content() {

                    var fecha1 = document.getElementById('fecha1').value;
                    var fecha2 = document.getElementById('fecha2').value;
                    var select_filas = document.getElementById('filtro_cup_registros').value;
                    var dataen_table = 'cod_estudiante=' + '<?php echo $cod_estudiante; ?>' + '&fecha1=' + fecha1 + '&fecha2=' + fecha2 + '&select_filas=' + select_filas;
                    $.ajax({
                        type: 'POST',
                        url: 'share/tabla_historial_load_filter.php',
                        data: dataen_table,
                        success: function(resp) {
                            $('#load_table_content').html(resp);
                        }
                    });
                }
                load_table_content();
            </script>

        </div>
    </div>

<?php } ?>