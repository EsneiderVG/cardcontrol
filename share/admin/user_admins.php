<?php
require "../../bd/database.php";



$usuario = $_POST['usuario'];
$filtro_filas_registros = $_POST['filtro_filas_registros'];



if (empty($usuario)) {
    $select_filter_sql = "SELECT * FROM usuarios LIMIT $filtro_filas_registros";
    $res_select_filter_sql = mysqli_query($conn, $select_filter_sql);
} elseif (!empty($usuario)) {
    $select_filter_sql = "SELECT * FROM usuarios WHERE usuario LIKE '%" . $usuario . "%' LIMIT $filtro_filas_registros";
    $res_select_filter_sql = mysqli_query($conn, $select_filter_sql);
} else {
    $select_filter_sql = "SELECT * FROM usuarios WHERE LIMIT $filtro_filas_registros";
    $res_select_filter_sql = mysqli_query($conn, $select_filter_sql);
}

?>
<span id="controll_users"></span>
<div class="container_card_history_table change_pc_set">
    <div class="table_contenedor_box_2 mar-bot">



        <?php
        if (!empty($usuario)) {
        ?>

            <table class="styled-table">
                <thead>
                    <tr>
                    <th class="border_tables">id</th>
                        <th class="border_tables">Usuario</th>
                        <th class="border_tables">nombres</th>
                        <th class="border_tables">email</th>
                        <th class="border_tables">Estado A</th>
                        <th class="border_tables">Estado Inv</th>
                        <th class="border_tables">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data_obt_users = mysqli_fetch_array($res_select_filter_sql)) {
                        $id_user = $data_obt_users['id'];
                    ?>
                        <tr class="active-row">
                            <td><?php echo $data_obt_users['id']; ?></td>
                            <td><?php echo $data_obt_users['usuario']; ?></td>
                            <td><?php echo $data_obt_users['nombres']; ?></td>
                            <td><?php echo $data_obt_users['email']; ?></td>
                            <td style="text-align:center;">
                            <?php
                            $estado_admnin = $data_obt_users['admin'];
                            if ($estado_admnin == 1) {
                            ?>
                                <span><i class="fa-solid fa-circle active_status"></i></span>
                            <?php
                            } elseif ($estado_admnin == 0) {
                            ?>
                                <span><i class="fa-solid fa-circle no_active_status"></i></span>
                            <?php
                            } else {
                            ?>
                                <span>Error</span>
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align:center;">
                            <?php
                            $estado_inv = $data_obt_users['type_user_inv'];
                            if ($estado_inv == 1) {
                            ?>
                                <span><i class="fa-solid fa-circle active_status"></i></span>
                            <?php
                            } elseif ($estado_inv == 0) {
                            ?>
                                <span><i class="fa-solid fa-circle no_active_status"></i></span>
                            <?php
                            } else {
                            ?>
                                <span>Error</span>
                            <?php
                            }
                            ?>
                        </td>
                        <td style="width: 50%;">

                            <input type="text" style="display:none;" name="" id="id_user_<?php echo $id_user ?>" value="<?php echo $id_user; ?>">
                            <?php
                            if ($estado_admnin == 0) {
                            ?>
                                <button class="btn_add_almn" style="width:150px;" onclick="
                                var id_user_<?php echo $id_user; ?> = document.getElementById('id_user_<?php echo $id_user ?>').value;
                                // alert(id_user_<?php echo $id_user; ?>);
                                var data = 1;
                                var dataen = 'id_user=' + id_user_<?php echo $id_user; ?>;
                                $.ajax({
                                    type: 'POST',
                                    url: 'share/admin/actions_admin_users/convertir_admin.php',
                                    data: dataen,
                                    success: function(resp) {
                                        $('#controll_users').html(resp);

                                    }
                                });
                                ">Hacer admin</button>
                                
                                
                            <?php
                            }elseif($estado_admnin == 1){
                                ?>
                                <button class="btn_add_almn" style="width:150px;" onclick="
                                var id_user_<?php echo $id_user; ?> = document.getElementById('id_user_<?php echo $id_user ?>').value;
                                // alert(id_user_<?php echo $id_user; ?>);
                                var data = 1;
                                var dataen = 'id_user=' + id_user_<?php echo $id_user; ?>;
                                $.ajax({
                                    type: 'POST',
                                    url: 'share/admin/actions_admin_users/quitar_admin.php',
                                    data: dataen,
                                    success: function(resp) {
                                        $('#controll_users').html(resp);

                                    }
                                });
                                ">Quitar Admin</button>
                                <?php
                            }
                            ?>

                        <?php
                            if ($estado_inv == 0) {
                            ?>
                                <button class="btn_add_almn" style="width:150px;" onclick="
                                var id_user_<?php echo $id_user; ?> = document.getElementById('id_user_<?php echo $id_user ?>').value;
                                // alert(id_user_<?php echo $id_user; ?>);
                                var data = 1;
                                var dataen = 'id_user=' + id_user_<?php echo $id_user; ?>;
                                $.ajax({
                                    type: 'POST',
                                    url: 'share/admin/actions_admin_users/convertir_inv.php',
                                    data: dataen,
                                    success: function(resp) {
                                        $('#controll_users').html(resp);

                                    }
                                });
                                ">Hacer invitado</button>
                                
                                
                            <?php
                            }elseif($estado_inv == 1){
                                ?>
                                <button class="btn_add_almn" style="width:150px;" onclick="
                                var id_user_<?php echo $id_user; ?> = document.getElementById('id_user_<?php echo $id_user ?>').value;
                                // alert(id_user_<?php echo $id_user; ?>);
                                var data = 1;
                                var dataen = 'id_user=' + id_user_<?php echo $id_user; ?>;
                                $.ajax({
                                    type: 'POST',
                                    url: 'share/admin/actions_admin_users/quitar_inv.php',
                                    data: dataen,
                                    success: function(resp) {
                                        $('#controll_users').html(resp);

                                    }
                                });
                                ">quitar invitado</button>
                                <?php
                            }


                            
                           ?>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        <?php
        } else {
        ?>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th class="border_tables">id</th>
                        <th class="border_tables">Usuario</th>
                        <th class="border_tables">nombres</th>
                        <th class="border_tables">email</th>
                        <th class="border_tables">Estado A</th>
                        <th class="border_tables">Estado Inv</th>
                        <th class="border_tables">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="active-row">
                        <?php
                        while ($data_obt_users = mysqli_fetch_array($res_select_filter_sql)) {
                            $id_user = $data_obt_users['id'];
                        ?>
                    <tr class="active-row">
                        <td><?php echo $data_obt_users['id']; ?></td>
                        <td><?php echo $data_obt_users['usuario']; ?></td>
                        <td><?php echo $data_obt_users['nombres']; ?></td>
                        <td><?php echo $data_obt_users['email']; ?></td>
                        <td style="text-align:center;">
                            <?php
                            $estado_admnin = $data_obt_users['admin'];
                            if ($estado_admnin == 1) {
                            ?>
                                <span><i class="fa-solid fa-circle active_status"></i></span>
                            <?php
                            } elseif ($estado_admnin == 0) {
                            ?>
                                <span><i class="fa-solid fa-circle no_active_status"></i></span>
                            <?php
                            } else {
                            ?>
                                <span>Error</span>
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align:center;">
                            <?php
                            $estado_inv = $data_obt_users['type_user_inv'];
                            if ($estado_inv == 1) {
                            ?>
                                <span><i class="fa-solid fa-circle active_status"></i></span>
                            <?php
                            } elseif ($estado_inv == 0) {
                            ?>
                                <span><i class="fa-solid fa-circle no_active_status"></i></span>
                            <?php
                            } else {
                            ?>
                                <span>Error</span>
                            <?php
                            }
                            ?>
                        </td>
                        <td style="width: 50%;">

                            <input type="text" style="display:none;" name="" id="id_user_<?php echo $id_user ?>" value="<?php echo $id_user; ?>">
                            <?php
                            if ($estado_admnin == 0) {
                            ?>
                                <button class="btn_add_almn" style="width:150px;" onclick="
                                var id_user_<?php echo $id_user; ?> = document.getElementById('id_user_<?php echo $id_user ?>').value;
                                // alert(id_user_<?php echo $id_user; ?>);
                                var data = 1;
                                var dataen = 'id_user=' + id_user_<?php echo $id_user; ?>;
                                $.ajax({
                                    type: 'POST',
                                    url: 'share/admin/actions_admin_users/convertir_admin.php',
                                    data: dataen,
                                    success: function(resp) {
                                        $('#controll_users').html(resp);

                                    }
                                });
                                ">Hacer admin</button>
                                
                                
                            <?php
                            }elseif($estado_admnin == 1){
                                ?>
                                <button class="btn_add_almn" style="width:150px;" onclick="
                                var id_user_<?php echo $id_user; ?> = document.getElementById('id_user_<?php echo $id_user ?>').value;
                                // alert(id_user_<?php echo $id_user; ?>);
                                var data = 1;
                                var dataen = 'id_user=' + id_user_<?php echo $id_user; ?>;
                                $.ajax({
                                    type: 'POST',
                                    url: 'share/admin/actions_admin_users/quitar_admin.php',
                                    data: dataen,
                                    success: function(resp) {
                                        $('#controll_users').html(resp);

                                    }
                                });
                                ">Quitar Admin</button>
                                <?php
                            }
                            ?>

                        <?php
                            if ($estado_inv == 0) {
                            ?>
                                <button class="btn_add_almn" style="width:150px;" onclick="
                                var id_user_<?php echo $id_user; ?> = document.getElementById('id_user_<?php echo $id_user ?>').value;
                                // alert(id_user_<?php echo $id_user; ?>);
                                var data = 1;
                                var dataen = 'id_user=' + id_user_<?php echo $id_user; ?>;
                                $.ajax({
                                    type: 'POST',
                                    url: 'share/admin/actions_admin_users/convertir_inv.php',
                                    data: dataen,
                                    success: function(resp) {
                                        $('#controll_users').html(resp);

                                    }
                                });
                                ">Hacer invitado</button>
                                
                                
                            <?php
                            }elseif($estado_inv == 1){
                                ?>
                                <button class="btn_add_almn" style="width:150px;" onclick="
                                var id_user_<?php echo $id_user; ?> = document.getElementById('id_user_<?php echo $id_user ?>').value;
                                // alert(id_user_<?php echo $id_user; ?>);
                                var data = 1;
                                var dataen = 'id_user=' + id_user_<?php echo $id_user; ?>;
                                $.ajax({
                                    type: 'POST',
                                    url: 'share/admin/actions_admin_users/quitar_inv.php',
                                    data: dataen,
                                    success: function(resp) {
                                        $('#controll_users').html(resp);

                                    }
                                });
                                ">quitar invitado</button>
                                <?php
                            }


                            
                           ?>

                        </td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>

        <?php
        }
        ?>
    </div>
</div>


<!-- <div class="container_card_history_table change_pc_set">
    <div class="table_contenedor_box mar-bot">

    <div class="container_content_alumn_boxy">

    </div>

    </div>
</div> -->