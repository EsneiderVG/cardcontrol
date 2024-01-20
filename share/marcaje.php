<?php 
session_start();
$id_usuario = $_SESSION['id'];

?>

<!-- bloque de la mitad -->
<script>
    document.getElementById('cod_estudiante').style.display = "block";
    document.getElementById('cod_estudiante_h').style.display = "none";
    document.getElementById('cod_estudiante_buscar').style.display = "none";

</script>

<?php

require "../bd/database.php";
// $id_usuario = $_SESSION['id'];

$usuario_verific_all_sql_2 = "SELECT * FROM usuarios WHERE id = '".$id_usuario."'";

$res_verific_all_sql_2 = mysqli_query($conn, $usuario_verific_all_sql_2);
$data_verific_all_sql_2 = mysqli_fetch_array($res_verific_all_sql_2);

// retificador de usuarios tipo invitado
$verific_user_inv_2 = $data_verific_all_sql_2['type_user_inv'];
// echo $verific_user_inv_2;
if ($verific_user_inv_2 == 1) {
?>
    <script>
        Swal.fire(
            'Usuario de invitado',
            'actualmente señor padre de familia, solo tiene acceso a historial',
            'question'
        )
        var historial_border_btn = document.getElementById('hst');
        var marcaje_border_btn = document.getElementById('marcaje');

        historial_border_btn.className = "nav__link";
        marcaje_border_btn.className = "nav__link";

        marcaje_border_btn.classList.remove('active');
        historial_border_btn.classList.add('active');
        load_historial();

    </script>
<?php
} elseif ($verific_user_inv_2 == 0) {
}

// limitar a el colegio
$usuario_verific_all_sql = "SELECT * FROM usuarios WHERE id = '" . $id_usuario . "'";
$res_verific_all_sql = mysqli_query($conn, $usuario_verific_all_sql);
$data_verific_all_sql = mysqli_fetch_array($res_verific_all_sql);

$colegio_sec_n = $data_verific_all_sql['colegio_sec'];

$verifi_coleg_section_sql = "SELECT * FROM colegios WHERE id = '".$colegio_sec_n."'";
$res_verifi_section = mysqli_query($conn, $verifi_coleg_section_sql);
$data_obt_res_verifi_section = mysqli_fetch_array($res_verifi_section);

$colegio_sec = $data_obt_res_verifi_section['nombre_colegio'];
// echo $colegio_sec;

$cod_estudiante = $_POST['cod_estudiante'];

$consult_sql_marcaje = "SELECT * FROM alumnos_info WHERE cod_estudiante = '" . $cod_estudiante . "' and institucion = '".$colegio_sec."'";
$res_consult_sql_marcaje = mysqli_query($conn, $consult_sql_marcaje);
$data_consult_sql_marcaje = mysqli_fetch_array($res_consult_sql_marcaje);

?>



<div class="pas_card_left animation-up">
    <div class="container_card_1 plas-up-movile">
        <div class="container_text_up">
            <span>Datos personales del estudiante</span>
        </div>
        <div class="inputs_cont">

            <form method="post">

                <div class="box_input">
                    <input class="text_inp" disabled value="<?php echo $data_consult_sql_marcaje['nombres']; ?>" type="text" name="1" id="1" placeholder="Nombres">
                </div>
                <div class="box_input">
                    <input class="text_inp" disabled value="<?php echo $data_consult_sql_marcaje['apellidos']; ?>" type="text" name="1" id="1" placeholder="Apellidos">
                </div>
                <div class="box_input">
                    <input class="text_inp" disabled value="<?php echo $data_consult_sql_marcaje['numero_id']; ?>" type="text" name="1" id="1" placeholder="Numero de identificacion">
                </div>
                <div class="box_input">
                    <input class="text_inp" disabled value="<?php
                                                            $estado = $data_consult_sql_marcaje['estado'];
                                                            if ($estado == 1) {
                                                                echo "Activo";
                                                            } elseif ($estado == 0) {
                                                                echo "No activo";
                                                            } else {
                                                                echo "no se mlp";
                                                            }
                                                            ?>" type="text" name="1" id="1" placeholder="Estado acutal estudiante">
                </div>
            </form>
        </div>
    </div>
    <div class="container_card_2">
        <div class="container_text_up">
            <span>Informacion de contacto estudiante</span>
        </div>
        <div class="inputs_cont">
            <form method="post">
                <div class="box_input">
                    <input class="text_inp" disabled value="<?php echo $data_consult_sql_marcaje['ciudad']; ?>" type="text" name="1" id="1" placeholder="Cuidad o municipio">
                </div>
                <div class="box_input">
                    <input class="text_inp" disabled value="<?php echo $data_consult_sql_marcaje['barrio']; ?>" type="text" name="1" id="1" placeholder="Barrio">
                </div>
                <div class="box_input">
                    <input class="text_inp" disabled value="<?php echo $data_consult_sql_marcaje['direccion']; ?>" type="text" name="1" id="1" placeholder="Direccion Residencial">
                </div>
                <div class="box_input">
                    <input class="text_inp" disabled value="<?php echo $data_consult_sql_marcaje['telefono']; ?>" type="text" name="1" id="1" placeholder="Numeros telefonicos">
                </div>
                <div class="box_input">
                    <input class="text_inp" disabled value="<?php echo $data_consult_sql_marcaje['correo']; ?>" type="text" name="1" id="1" placeholder="Correo electronico">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="pas_card_left cord_left">
    <div class="container_card_1">
        <div class="container_text_up">
            <span>Institucion Educativa</span>
        </div>
        <div class="inputs_cont">
            <form method="post">
                <div class="box_input">
                    <input class="text_inp" disabled value="<?php echo $data_consult_sql_marcaje['institucion']; ?>" type="text" name="1" id="1" placeholder="Institucion">
                </div>
                <div class="box_input">
                    <input class="text_inp" disabled value="<?php echo $data_consult_sql_marcaje['sede']; ?>" type="text" name="1" id="1" placeholder="Sede">
                </div>
                <div class="box_input">
                    <input class="text_inp" disabled value="<?php echo $data_consult_sql_marcaje['grado']; ?>" type="text" name="1" id="1" placeholder="Grado o cargo">
                </div>
                <div class="box_input">
                    <input class="text_inp" disabled value="<?php echo $data_consult_sql_marcaje['jornada']; ?>" type="text" name="1" id="1" placeholder="Jornada">
                </div>
            </form>
        </div>
    </div>
    <div class="container_card_1 cord_top">
        <div class="container_text_up">
            <span>Observaciones del estudiante</span>
        </div>
        <div class="inputs_cont">
            <form method="post">
                <div class="box_input">
                    <textarea name="observaciones" disabled id="observaciones" class="textarea_observaciones" placeholder="Dijita una observacion"><?php echo $data_consult_sql_marcaje['observacion']; ?> 
                    </textarea>
                </div>
            </form>
        </div>
    </div>

</div>