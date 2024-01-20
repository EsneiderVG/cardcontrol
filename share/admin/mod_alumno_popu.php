<?php
require "../../bd/database.php";
$id_alumn = $_POST['id_alumn'];
echo $id_alumn;
$consult_alumn = "SELECT * FROM alumnos_info WHERE id = '" . $id_alumn . "'";
$res_consult_alumn = mysqli_query($conn, $consult_alumn);
$data_res_consult_colegio = mysqli_fetch_array($res_consult_alumn);
?>
<span id="result_result_popu"></span>
<script>
        (async () => {

            const {
                value: formValues
            } = await Swal.fire({
                title: 'Modifica alumno',
                html: 
                    '<div class="popup_alumnos" style="height: 400px; overflow-y: scroll;">' +
                        
                        '<i class="fa-solid fa-code-commit"></i>'+
                        '<input id="cod_estudiante" class="swal2-input" placeholder="dijita el codigo de el estudiante" value="<?php echo $data_res_consult_colegio['cod_estudiante']; ?>">' +

                        '<div>' + 
                        '<i class="fa-solid fa-user-pen"></i>'+
                        '<input id="nombres" class="swal2-input" placeholder="dijita los nombres" value="<?php echo $data_res_consult_colegio['nombres']; ?>">' +
                        '</div>' + 

                        '<div>' + 
                        '<i class="fa-solid fa-user-pen"></i>'+
                        '<input id="apellidos" class="swal2-input" placeholder="dijita los apellidos" value="<?php echo $data_res_consult_colegio['apellidos']; ?>">' +
                        '</div>' + 
                        
                        '<div>' + 
                        '<i class="fa-solid fa-id-card"></i>' +
                        '<input id="ti" class="swal2-input" placeholder="dijita la ti" value="<?php echo $data_res_consult_colegio['numero_id']; ?>">' +
                        '</div>' + 

                        '<div>' + 
                        '<i class="fa-solid fa-city"></i>' +
                        '<input id="ciudad" class="swal2-input" placeholder="dijita la ciudad" value="<?php echo $data_res_consult_colegio['ciudad']; ?>">' +
                        '</div>' + 

                        '<div>' + 
                        '<i class="fa-solid fa-city"></i>' +
                        '<input id="barrio" class="swal2-input" placeholder="dijita la barrio" value="<?php echo $data_res_consult_colegio['barrio']; ?>">' +
                        '</div>' + 
                        
                        '<div>' + 
                        '<i class="fa-solid fa-location-dot"></i>'+
                        '<input id="direccion" class="swal2-input" placeholder="dijita la direccion" value="<?php echo $data_res_consult_colegio['direccion']; ?>">' +
                        '</div>' + 

                        '<div>' + 
                        '<i class="fa-solid fa-phone"></i>' +
                        '<input id="telefono" class="swal2-input" placeholder="dijita la telefono" type="tel" value="<?php echo $data_res_consult_colegio['telefono']; ?>">' +
                        '</div>' + 

                        '<div>' + 
                        '<i class="fa-solid fa-school"></i>' +
                        '<input id="sede" class="swal2-input" placeholder="dijita la sede" value="<?php echo $data_res_consult_colegio['sede']; ?>">' +
                        '</div>' + 

                        '<div>' + 
                        '<i class="fa-solid fa-graduation-cap"></i>' +
                        '<input id="grado" class="swal2-input" placeholder="dijita la grado o cargo" value="<?php echo $data_res_consult_colegio['grado']; ?>">' +

                        '<div>' + 
                        '<i class="fa-solid fa-clock"></i>' +
                        '<input id="jornada" class="swal2-input" placeholder="dijita la jornada" value="<?php echo $data_res_consult_colegio['jornada']; ?>">' +
                        '</div>' + 

                        '<div>' + 
                        '<i class="fa-solid fa-clock"></i>' +
                        '<select class="swal2-input" id="estado"><option <?php if ($data_res_consult_colegio['estado'] == 1) {echo "selected"; } ?> class="swal2-input" value="1">activo</option><option <?php if ($data_res_consult_colegio['estado'] == 0) {echo "selected";} ?> class="swal2-input" value="0">no-activo</option></select>' +
                        '</div>' + 

                        '<div>' + 
                        '<i class="fa-solid fa-school-circle-check"></i>' +                                                                                                                                                                                
                        <?php
                        $consult_colegios_sql = "SELECT * FROM colegios";
                        $res_consult_colegios_res = mysqli_query($conn, $consult_colegios_sql);

                        ?> 
                        
                        '<select class="swal2-input" id="institucion"><?php while ($data_consult_col_res = mysqli_fetch_array($res_consult_colegios_res)) { ?><option class="swal2-input" value="<?php echo $data_consult_col_res['nombre_colegio']; ?>"><?php echo $data_consult_col_res['nombre_colegio'] ?></option> <?php } ?></select>' +
                        '</div>' + 
                        '<div>' +
                        '<i class="fa-solid fa-envelope"></i>' +
                        '<input id="correo" class="swal2-input" placeholder="dijita el correo" value="<?php echo $data_res_consult_colegio['correo']; ?>">' +
                        '</div>' +
                    '</div>',
                showCancelButton: true,
                confirmButtonText: 'modificar',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    var colegio = document.getElementById('institucion').value;
                    var nombres = document.getElementById('nombres').value;
                    var apellidos = document.getElementById('apellidos').value;
                    var ti = document.getElementById('ti').value;
                    var correo = document.getElementById('correo').value;
                    var estado = document.getElementById('estado').value;
                    
                    var cod_estudiante = document.getElementById('cod_estudiante').value;
                    var ciudad = document.getElementById('ciudad').value;
                    var barrio = document.getElementById('barrio').value;
                    var direccion = document.getElementById('direccion').value;
                    var telefono = document.getElementById('telefono').value;
                    var sede = document.getElementById('sede').value;
                    var grado = document.getElementById('grado').value;
                    var jornada = document.getElementById('jornada').value;

                    var id_alumno = '<?php echo $id_alumn; ?>';
                    var dataen223 = 'colegio=' + colegio + '&id_alm=' + id_alumno + '&nombres=' + nombres + '&apellidos=' + apellidos + '&ti=' + ti + '&correo=' + correo + '&estado=' + estado + '&cod_estudiante=' + cod_estudiante + '&ciudad=' + ciudad + '&barrio=' + barrio + '&direccion=' + direccion + '&telefono=' + telefono + '&sede=' + sede + '&grado=' + grado + '&jornada=' + jornada;
                    $.ajax({
                        type: 'POST',
                        url: 'share/admin/mod_alumno_pro.php',
                        data: dataen223,
                        success: function(resp) {
                            $('#result_result_popu').html(resp);

                        }
                    });
                }
            })

            if (formValues) {
                Swal.fire(JSON.stringify(formValues))
            }

        })()
    // sub();
</script>