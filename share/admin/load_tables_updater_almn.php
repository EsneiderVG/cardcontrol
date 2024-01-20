<?php
require "../../bd/database.php";
$filtro_filas_registros = $_POST['filtro_filas_registros'];
$filtro_grados = $_POST['filtro_grados'];

$select_filter_sql = "SELECT * FROM alumnos_info WHERE grado = '" . $filtro_grados . "' ORDER BY id DESC LIMIT $filtro_filas_registros";
$res_select_filter_sql = mysqli_query($conn, $select_filter_sql);
// echo $select_filter_sql;

?>
<div class="container_card_history_table">        
<span>registros mas recientes <i class="fa-solid fa-arrow-up-short-wide"></i></span>

    <div class="table_contenedor_box_2 mar-bot" style="padding:0px;">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>institucion</th>
                    <th>nombres</th>
                    <th>grado</th>
                    <th>codigo estudiantil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data_obt_alumnos = mysqli_fetch_array($res_select_filter_sql)) {
                ?>
                    <tr class="active-row">
                        <td><?php echo $data_obt_alumnos['institucion'] ?></td>
                        <td><?php echo $data_obt_alumnos['nombres'] ?> <?php echo $data_obt_alumnos['apellidos'] ?></td>
                        <td><?php echo $data_obt_alumnos['grado'] ?></td>
                        <td><?php echo $data_obt_alumnos['cod_estudiante'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>