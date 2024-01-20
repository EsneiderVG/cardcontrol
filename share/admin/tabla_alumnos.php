<?php
require "../../bd/database.php";



$colegio = $_POST['colegio'];
$filtro_filas_registros = $_POST['filtro_filas_registros'];
$filtro_grados = $_POST['filtro_grados'];
// echo $colegio;


if (empty($colegio)) {
    $select_filter_sql = "SELECT * FROM alumnos_info WHERE grado = '" . $filtro_grados . "' LIMIT $filtro_filas_registros";
    $res_select_filter_sql = mysqli_query($conn, $select_filter_sql);
} 
// si el filtro de grados no esta vacio
elseif (!empty($colegio) and (!empty($filtro_grados))) {
    // echo "filtro no vacio";
    $select_filter_sql = "SELECT * FROM alumnos_info WHERE institucion LIKE '%" . $colegio . "%' and grado = '" . $filtro_grados . "' LIMIT $filtro_filas_registros";
    $res_select_filter_sql = mysqli_query($conn, $select_filter_sql);
} else {
    $select_filter_sql = "SELECT * FROM alumnos_info WHERE institucion LIKE '%" . $colegio . "%' and grado = '" . $filtro_grados . "' LIMIT $filtro_filas_registros";
    $res_select_filter_sql = mysqli_query($conn, $select_filter_sql);
}

// si el filtro de grados esta vacio
if (!empty($colegio) and (empty($filtro_grados))) {
    // echo "filtro vacio";
    $select_filter_sql = "SELECT * FROM alumnos_info WHERE institucion LIKE '%" . $colegio . "%' LIMIT $filtro_filas_registros";
    $res_select_filter_sql = mysqli_query($conn, $select_filter_sql);
}
?>

<div class="container_card_history_table">
    <div class="table_contenedor_box mar-bot">



        <?php
        if (!empty($colegio)) {
        ?>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th class="border_tables">codigo estudiante</th>
                        <th class="border_tables">nombres</th>
                        <th class="border_tables">apellidos</th>
                        <th class="border_tables">T.I</th>
                        <th class="border_tables">estado</th>
                        <th class="border_tables">institucion</th>
                        <th class="border_tables">correo</th>
                        <th class="border_tables">Acciones</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($data_obt_alumnos = mysqli_fetch_array($res_select_filter_sql)) {
                    ?>
                        <tr class="active-row">
                            <td><?php echo $data_obt_alumnos['cod_estudiante']; ?></td>
                            <td><?php echo $data_obt_alumnos['nombres']; ?></td>
                            <td><?php echo $data_obt_alumnos['apellidos']; ?></td>
                            <td><?php echo $data_obt_alumnos['numero_id']; ?></td>
                            <span id="result_mod"></span>
                            <td>
                                <?php
                                $status_student = $data_obt_alumnos['estado'];
                                if ($status_student == 1) {
                                ?>
                                    <span>Activo<i class="fa-solid fa-circle active_status"></i></span>
                                <?php
                                } elseif ($status_student == 0) {
                                ?>
                                    <span>no-Activo<i class="fa-solid fa-circle no_active_status"></i></span>
                                <?php
                                }
                                ?>
                            </td>

                            <td><?php echo $data_obt_alumnos['institucion']; ?></td>
                            <td><?php echo $data_obt_alumnos['correo']; ?></td>
                            <td><button onclick="
                            var id_alumn = '<?php echo $data_obt_alumnos['id']; ?>';
                            var dataen = 'id_alumn=' + id_alumn;
                                            $.ajax({
                                                type: 'POST',
                                                url: 'share/admin/mod_alumno_popu.php',
                                                data: dataen,
                                                success: function(resp) {
                                                    $('#result_mod').html(resp);

                                                }
                                            });
                            "><i class="fa-solid fa-m"></i></button></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        <?php
        } elseif (empty($colegio)) {
        ?>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th class="border_tables">codigo estudiante</th>
                        <th class="border_tables">nombres</th>
                        <th class="border_tables">apellidos</th>
                        <th class="border_tables">T.I</th>
                        <th class="border_tables">estado</th>
                        <th class="border_tables">institucion</th>
                        <th class="border_tables">correo</th>
                        <th class="border_tables">Acciones</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($data_obt_alumnos = mysqli_fetch_array($res_select_filter_sql)) {
                    ?>
                        <tr class="active-row">
                            <td><?php echo $data_obt_alumnos['cod_estudiante']; ?></td>
                            <td><?php echo $data_obt_alumnos['nombres']; ?></td>
                            <td><?php echo $data_obt_alumnos['apellidos']; ?></td>
                            <td><?php echo $data_obt_alumnos['numero_id']; ?></td>
                            <span id="result_mod"></span>
                            <td>
                                <?php
                                $status_student = $data_obt_alumnos['estado'];
                                if ($status_student == 1) {
                                ?>
                                    <span>Activo<i class="fa-solid fa-circle active_status"></i></span>
                                <?php
                                } elseif ($status_student == 0) {
                                ?>
                                    <span>no-Activo<i class="fa-solid fa-circle no_active_status"></i></span>
                                <?php
                                }
                                ?>
                            </td>

                            <td><?php echo $data_obt_alumnos['institucion']; ?></td>
                            <td><?php echo $data_obt_alumnos['correo']; ?></td>
                            <td><button onclick="
                            var id_alumn = '<?php echo $data_obt_alumnos['id']; ?>';
                            var dataen = 'id_alumn=' + id_alumn;
                                            $.ajax({
                                                type: 'POST',
                                                url: 'share/admin/mod_alumno_popu.php',
                                                data: dataen,
                                                success: function(resp) {
                                                    $('#result_mod').html(resp);

                                                }
                                            });
                            "><i class="fa-solid fa-m"></i></button></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>

    </div>
</div>