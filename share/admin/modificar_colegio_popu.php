<?php
require "../../bd/database.php";
$id_col = $_POST['id_col'];
// echo $id_col;
$consult_colegios = "SELECT * FROM colegios WHERE id = '".$id_col."'";
$res_consult_colegio = mysqli_query($conn, $consult_colegios);
$data_res_consult_colegio = mysqli_fetch_array($res_consult_colegio);


?>
<span id="popus_m"></span>
<style>
    @media screen and (max-width: 860px) {
    
        .popup_alumnos i{
            display:None;
        }
        
        .swal2-input{
            margin-left: 0px;
            margin-right: 0px;
        }
    }
</style>
<script>
    var id_col_<?php echo $id_col; ?> = document.getElementById('id_col_<?php echo $id_col ?>').value;


    Swal.fire({
        title: 'Modifica el nombre del colegio',
        input: 'text',
        inputValue: '<?php echo $data_res_consult_colegio['nombre_colegio']; ?>',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Modificar',
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            var colegio = result.value;
            var dataen = 'colegio=' + colegio + '&id_col_m=' + id_col_<?php echo $id_col; ?>;
            $.ajax({
                type: 'POST',
                url: 'share/admin/modificar_colegio_res.php',
                data: dataen,
                success: function(resp) {
                    $('#popus_m').html(resp);

                }
            });
            // alert(colegio);
        }
    })
</script>

