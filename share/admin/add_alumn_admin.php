<?php
require "../../bd/database.php";

?>
<span id="upload_alumn"></span>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            files: [],
            color: '#444444',
        },
        methods: {
            handleFileDrop(e) {
                let droppedFiles = e.dataTransfer.files;
                if (!droppedFiles) return;
                // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
                ([...droppedFiles]).forEach(f => {

                    this.files.push(f);
                });
                this.color = "#444444"
            },
            handleFileInput(e) {
                let files = e.target.files;
                files = e.target.files
                if (!files) return;
                // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
                ([...files]).forEach(f => {

                    this.files.push(f);
                });
            },
            removeFile(fileKey) {
                this.files.splice(fileKey, 1)
            },
            fileDragIn() {
                // alert("oof")
                // alert("color")
                this.color = "white"
            },
            fileDragOut() {
                this.color = "#444444"
            }
        }
    })

    function subir_datos_alumno() {


        var nombres = document.getElementById('nombres').value;
        var apellidos = document.getElementById('apellidos').value;
        var id = document.getElementById('id').value;
        var estado = document.getElementById('estado').value;
        var barrio = document.getElementById('barrio').value;
        var ciudad = document.getElementById('ciudad').value;
        var direccion = document.getElementById('direccion').value;
        var telefono = document.getElementById('telefono').value;

        var correo = document.getElementById('correo').value;
        var instituto = document.getElementById('instituto').value;
        var sede = document.getElementById('sede').value;
        var grado = document.getElementById('grado').value;
        var jornada = document.getElementById('jornada').value;
        var cod_estudiante = document.getElementById('cod_estudiante').value;

        var formData = new FormData();
        var files = $('#foto_alumn')[0].files[0];
        formData.append('file', files);
        formData.append('nombres', nombres);
        formData.append('apellidos', apellidos);
        formData.append('id', id);
        formData.append('estado', estado);
        formData.append('barrio', barrio);
        formData.append('direccion', direccion);
        formData.append('ciudad', ciudad);
        formData.append('telefono', telefono);
        formData.append('correo', correo);
        formData.append('instituto', instituto);
        formData.append('sede', sede);
        formData.append('grado', grado);
        formData.append('jornada', jornada);
        formData.append('cod_estudiante', cod_estudiante);




        // var dataen = 'nombres=' + nombres + '&apellidos=' + apellidos + '&id=' + id + '&estado=' + estado + '&barrio=' + barrio + '&direccion=' + direccion + '&telefono=' + telefono + '&correo=' + correo + '&instituto=' + instituto + '&sede=' + sede + '&grado=' + grado + '&jornada=' + jornada + '&cod_estudiante=' + cod_estudiante;


        $.ajax({
            type: 'POST',
            url: 'share/admin/upload_alumn.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#upload_alumn').html(resp);

            }
        });
    }

    function reload_table_data_alumn() {
        var filtro_filas_registros = document.getElementById('filtro_filas_registros').value;
        var filtro_grados = document.getElementById('filtro_grados').value;
        var dataen = 'filtro_filas_registros=' + filtro_filas_registros + '&filtro_grados=' + filtro_grados;
        $.ajax({
            type: 'POST',
            url: 'share/admin/load_tables_updater_almn.php',
            data: dataen,
            success: function(resp) {
                $('#loader_tables_reload').html(resp);

            }
        });
    }

    function load_inputs_uplo() {
        var data = 1;
        var dataen = 'data=' + data;
        $.ajax({
            type: 'POST',
            url: 'share/admin/load_inputs_upl_alumn.php',
            data: dataen,
            success: function(resp) {
                $('#load_inputs').html(resp);

            }
        });
    }
    $(document).ready(function() {
        reload_table_data_alumn();
        load_inputs_uplo();
    });
</script>

<div class="container_card_history_table">
    <div class="table_contenedor_box_3 mar-bot" id="load_inputs">
    </div>

    <div class="table_contenedor_box_2 mar-bot">
        <div class="container_card_history_table">
            
            <div class="table_contenedor_box_2 mar-bot fl_left">

                <!-- <form method="post"> -->
                <form method="post">
                    <p>Filtro de registros</p>
                    <div class="control_rows_filter_2">
                        <div class="select_limiter_cont">
                            <span>numero de filas:</span>
                            <select name="filtro_filas_registros" id="filtro_filas_registros" onchange="load_table_content_limiter()">
                                <option value="25">25 filas</option>
                                <option value="50">50 filas</option>
                                <option value="75">75 filas</option>
                                <option value="100">100 filas</option>
                            </select>
                        </div>
                        <div class="select_limiter_cont">
                            <span>grado:</span>
                            <input type="text"  class="fecha_design alarge" id="filtro_grados" onchange="load_table_content_limiter()">
                        </div>
                        <!-- </form> -->
                </form>
            </div>
            <div class="btn_cont">
                <button onclick="reload_table_data_alumn()" class="btn_filter_history">buscar</button>
            </div><span id="loader_tables_reload"></span>
        </div>
    </div>
</div>