<script>
    var btnAbrirPopup = document.getElementById('btn-abrir-popup'),
        overlay = document.getElementById('overlay'),
        popup = document.getElementById('popup'),
        btnCerrarPopup = document.getElementById('btn-cerrar-popup');

    btnAbrirPopup.addEventListener('click', function() {
        overlay.classList.add('active');
        popup.classList.add('active');
    });

    btnCerrarPopup.addEventListener('click', function(e) {
        e.preventDefault();
        overlay.classList.remove('active');
        popup.classList.remove('active');
    });
</script>
<span id="insert_lol"></span>
<script>
    
    function insert_colegios() {
        Swal.fire({
            title: 'Agrega el nombre del colegio',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Subir',
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                var colegio = result.value;
                var dataen = 'colegio=' + colegio;
                $.ajax({
                    type: 'POST',
                    url: 'share/admin/insert_colegios.php',
                    data: dataen,
                    success: function(resp) {
                        $('#insert_lol').html(resp);

                    }
                });
                // alert(colegio);
            }
        })

    }
    
</script>

<?php

require "../../bd/database.php";

$colegio = $_POST['colegio'];
$filtro_filas = $_POST['filtro_filas'];

if (empty($colegio)) {
    $consult_colegios = "SELECT * FROM colegios LIMIT $filtro_filas";
    $res_consult_colegios = mysqli_query($conn, $consult_colegios);
}
if (!empty($colegio)) {
    $consult_colegios = "SELECT * FROM colegios WHERE nombre_colegio = '" . $colegio . "' LIMIT $filtro_filas";
    $res_consult_colegios = mysqli_query($conn, $consult_colegios);
}

// $consult_colegios = "SELECT * FROM colegios WHERE nombre_colegio = '" . $colegio . "' LIMIT $filtro_filas";
// $res_consult_colegios = mysqli_query($conn, $consult_colegios);


?>



<span id="controll"></span>
<table class="styled-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Colegios</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($data_obt_colegios = mysqli_fetch_array($res_consult_colegios)) {
            $id_col = $data_obt_colegios['id'];
        ?>

            <tr class="active-row">
                <td><?php echo $data_obt_colegios['id'] ?></td>
                <td><?php echo $data_obt_colegios['nombre_colegio'] ?></td>
                <td style="width: 50%">
                    <input type="text" style="display:none;" name="" id="id_col_<?php echo $id_col ?>" value="<?php echo $id_col; ?>">
                    <button class="btn_add_almn" onclick="
                    var id_col_<?php echo $id_col; ?> = document.getElementById('id_col_<?php echo $id_col ?>').value;
                    
                    // var data = 1;
                    var dataen = 'id_col=' + id_col_<?php echo $id_col; ?>;
                    $.ajax({
                        type: 'POST',
                        url: 'share/admin/eliminar_colegio.php',
                        data: dataen,
                        success: function(resp) {
                            $('#controll').html(resp);

                        }
                    });
                    ">eliminar</button>
                    
                    <button class="btn_add_almn" onclick="
                    var id_col_<?php echo $id_col; ?> = document.getElementById('id_col_<?php echo $id_col ?>').value;
                    
                    // var data = 1;
                    var dataen = 'id_col=' + id_col_<?php echo $id_col; ?>;
                    $.ajax({
                        type: 'POST',
                        url: 'share/admin/modificar_colegio_popu.php',
                        data: dataen,
                        success: function(resp) {
                            $('#controll').html(resp);

                        }
                    });
                    ">modificar</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>