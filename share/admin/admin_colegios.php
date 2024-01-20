<!--    Datatables  -->

<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function load_tables_colegios() {
        var filtro_filas = document.getElementById('filtro_filas_registros').value;
        var colegio = document.getElementById('colegio').value;

        var dataen = 'filtro_filas=' + filtro_filas + '&colegio=' + colegio;
        $.ajax({
            type: 'POST',
            url: 'share/admin/tables_colegios.php',
            data: dataen,
            success: function(resp) {
                $('#table_colegio').html(resp);

            }
        });
    }

    $(document).ready(function() {
        load_tables_colegios();
    });
</script>

<?php
session_start();
require "../../bd/database.php";
$id_usuario = $_SESSION['id'];

$consult_colegio_sql_all = "SELECT * FROM colegios";
$res_consult_colegio_sql_all = mysqli_query($conn, $consult_colegio_sql_all);

$consult_check_admin_p = "SELECT * FROM usuarios WHERE id = '" . $id_usuario . "'";
$res_check_admin_p = mysqli_query($conn, $consult_check_admin_p);
$data_check_admin_p = mysqli_fetch_array($res_check_admin_p);

$id_admin_p = $data_check_admin_p['admin_p'];
if ($id_admin_p == 1) {

?>

    <button onclick="insert_colegios()" class="btn_add_almn" style="margin-bottom: 10px;">Agregar Colegio +</button>

    <div class="container_card_history_table">
        <div class="table_contenedor_box mar-bot">

            <div class="table_contenedor_box_2 mar-bot fl_left">

                <!-- <form method="post"> -->
                <form method="post">
                    <p>Filtro de registros</p>
                    <div class="control_rows_filter_2">
                        <div class="select_limiter_cont" style="padding:10px;">
                            <span>numero de filas:</span>
                            <select name="filtro_filas_registros" id="filtro_filas_registros" onchange="load_tables_colegios();">
                                <option value="25">25 filas</option>
                                <option value="50">50 filas</option>
                                <option value="75">75 filas</option>
                                <option value="100">100 filas</option>
                            </select>
                        </div>
                        <div class="select_limiter_cont" style="padding:10px;">
                            <select name="colegio" id="colegio" onchange="load_tables_colegios();" style="width:300px;">
                                <option value="">all</option>

                                <?php
                                while ($data_colegios_op = mysqli_fetch_array($res_consult_colegio_sql_all)) {
                                ?>

                                    <option value="<?php echo $data_colegios_op['nombre_colegio']; ?>"><?php echo $data_colegios_op['nombre_colegio']; ?></option>

                                <?php } ?>
                            </select>

                        </div>
                        <!-- </form> -->
                </form>
            </div>
            <div class="btn_cont">
                <!-- <button onclick="load_tables_colegios()" class="btn_filter_history">buscar</button> -->
            </div><span id="table_colegio"></span>


        </div>
    </div>
<?php
} else {
?>
    <script>
        Swal.fire(
            'No eres el administrador principal',
            'No tienes acceso a esta seccion de administradores',
            'question'
        )
    </script>
<?php
} ?>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<!--    Datatables-->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $("#tablaUsuarios").DataTable({
            "processing": true,
            "serverSide": true,
            "sAjaxSource": "share/ServerSide/serversideUsuarios.php",
            "columnDefs": [{
                "data": null
            }]
        });

    });
</script>