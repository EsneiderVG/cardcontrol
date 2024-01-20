<?php

require 'PHPMailer/class.phpmailer.php';

session_start();


?>
<?php

function Redirect_to($New_Location)
{header("Location:" . $New_Location);
    exit;
}

// call the contact() function if contact_btn is clicked
if (isset($_POST['contact_btn'])) {
    contact();
}

function contact()
{
    if (isset($_POST["contact_btn"])) {

        $name = $_POST["nombres_popu"];
        $email = $_POST["correo_popu"];
        $phone = $_POST["telefono_popu"];
        $message = $_POST["mensaje_popu"];

        // Email Functionality

        date_default_timezone_set('Etc/UTC');

        $mail = new PHPMailer();

        $mail->setFrom($_POST['correo_popu']);
        $mail->addAddress('soportecardcontrol@gmail.com');

        // The subject of the message.
        $mail->Subject = 'Received Message From Client ' . $name;

        $message = '<html><body>';

        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';

        $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['nombres_popu']) . "</td></tr>";

        $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['nombres_popu']) . "</td></tr>";

        $message .= "<tr><td><strong>Phone:</strong> </td><td>" . strip_tags($_POST['telefono_popu']) . "</td></tr>";

        $message .= "<tr><td><strong>Message</strong> </td><td>" . strip_tags($_POST['mensaje_popu']) . "</td></tr>";

        $message .= "</table>";
        $message .= "</body></html>";

        $mail->Body = $message;

        $mail->isHTML(true);

        if ($mail->send()) {
            Redirect_to("thanks.html");
        } else {
            Redirect_to("index.php");
        }

    } //Ending of Submit Button If-Condition

}



if (!empty($_SESSION['id'])) {
  header("location: inicio.php");
} else {
}
require 'bd/database.php';


if (isset($_POST['submit_1'])) {

  $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  

  $query = mysqli_query($conn, "SELECT * from usuarios where usuario = '$usuario'");
  while ($datos = mysqli_fetch_array($query)) {

    // echo $datos['email'];  
    $hash = $datos['contraseña'];

    if (password_verify($password, $hash)) {
      $_SESSION['active'] = true;
      $_SESSION['id'] = $datos['id'];
      $_SESSION['usuario'] = $datos['usuario'];
      $_SESSION['nombres'] = $datos['nombres'];
      $_SESSION['email'] = $datos['email'];
      
      header('location: ../../inicio.php');
    } else {
      echo '
    <script>
    console.log("el usuario o la contraseña son erroneos");
    </script>
    ';
    }
  }
}


?>
<?php
// extract files img
if (isset($_POST["submit_2"])) {
  if (isset($_FILES['imagen']['name'])) {
      
    $tipoArchivo = $_FILES['imagen']['type'];
    $nombreArchivo = uniqid();
    $tamañanoarchivo = $_FILES['imagen']['size'];
    $imagenSubida = fopen($_FILES['imagen']['tmp_name'], 'r');
    // binario also is tmp_data
    $binariosImagen = fread($imagenSubida, $tamañanoarchivo);
    require "bd/database.php";
    $binariosImagen = mysqli_escape_string($conn, $binariosImagen);

    $colegio_sec = $_POST['colegio_sec'];
    $nombres = $_POST['nombres_completos'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['password'];
    $contraseña_1 = password_hash($contraseña, PASSWORD_BCRYPT);
    $checK_password = $_POST['confirm_password'];
    $admin = 0;
    $cero = 0;
    $user_inv = 1;
    $sc_google = 0;

    // include "validacion.php";

    $query_1 = "INSERT INTO usuarios (usuario, nombres, email, contraseña, avatar, tipo_de_archivo, nombre_archivo, confirm_correo, reset_contraseña, cod_confirm, colegio_sec, admin, admin_p, sc_google, type_user_inv) values (
        '" . $usuario . "', '" . $nombres . "', '" . $email . "','" . $contraseña_1 . "', '" .  $binariosImagen . "',  '" . $tipoArchivo . "', '" . $nombreArchivo . "', '" . $cero . "', '" . $cero . "', '', '".$colegio_sec."', '" . $admin . "', '" . $admin . "', '" . $sc_google . "', '" . $user_inv . "') ";
    // echo $query_1;

    $verificar_email = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '$email'");

    if (mysqli_num_rows($verificar_email) > 0) {
      echo '
        <script>
        alert("este usuario ya existe prueba con otro");
        window.location="index.php";
        </script>
    
        ';
      exit();
    }

    $res_1 = mysqli_query($conn, $query_1);
    
    if ($res_1) {
      ?>
      <script>
        window.location="index.php";
      </script>
      <?php
    } else {
      echo mysqli_error($conn);
    };
  }
}

$selected_all_colegios_sql = "SELECT * FROM colegios";
$res_selected_all_colegios = mysqli_query($conn,$selected_all_colegios_sql);

?>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://kit.fontawesome.com/15c45fe034.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="assets/css/popus_gmail.css">
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles_login.css">
  
  <title>Login</title>
  <style>
        .disclaimer{
            display:none;
        }
        .footer{
            margin: 0px;
        }
    </style>
</head>

<body id="home">

  <?php require "requires/header.php" ?>

  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <!--<img src="images/frontImg.jpg" alt="">-->
        <div class="text">
          <span class="text-1">Sistema<br>Control de Asistencia</span>
          <span class="text-2">GoodMax</span>
        </div>
      </div>
      <div class="back">
        <!--<img class="backImg" src="images/backImg.jpg" alt="">-->
        <div class="text">
          <span class="text-1"></span>
          <span class="text-2"></span>
        </div>
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Ingresa</div>
          <form method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" name="usuario" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Enter your password" required>
              </div>
              
              <div class="text"><a href="#">Olvidaste tu contraseña?</a></div>
              <!-- <div class="button input-box"> -->
              <button class="button_form" name="submit_1">Ingresar</button>
              <!-- </div> -->
              <div class="text sign-up-text">No tienes cuenta? <label class="change" for="flip">Registrate</label>
              </div>
              <center>
              <div class="text sign-up-text">
                    <a href="https://apk.e-droid.net/apk/app2063388-5yh27r.apk?v=3"><img src="assets/img/dowload.png" alt="" srcset=""></a>
                    <span class="soporte" id="btn-abrir-popup" style="color: blue; cursor:pointer;">Ayuda Sporte Tecnico</span>
              </div>        
              
                  
              </center>
              
            </div>
          </form>
        </div>
        <div class="signup-form">
          <div class="title">Registrate</div>
          <form method="POST" enctype="multipart/form-data">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input name="nombres_completos" type="text" placeholder="digita tu nombre completo" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input name="email" type="text" placeholder="digita tu gmail" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input name="usuario" type="text" placeholder="digita tu usuario" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input name="password" type="password" placeholder="digita tu contraseña" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input name="confirm_password" type="password" placeholder="confirma tu contraseña" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input name="imagen" type="file" required multiple>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <select name="colegio_sec" id="colegio_sec">
                  <option disabled value="0">elije tu colegio</option>
                  <?php 
                  while($data_obt_selected = mysqli_fetch_array($res_selected_all_colegios)){
                  ?>
                  <option value="<?php echo $data_obt_selected['nombre_colegio'] ?>"><?php echo $data_obt_selected['nombre_colegio'] ?></option>
                  <?php } ?> 
                </select>
              </div>
              <div class="button input-box">
                <input type="submit" name="submit_2" value="Sumbit">
              </div>
              <div class="text sign-up-text">Ya tienes una cuenta? <label for="flip">Ingresa ahora</label></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<span id="sendmail"></span>

  <div class="overlay" id="overlay">
    <div class="popup" id="popup">
      <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
      <div class="content_popu_row">
        <div class="info">
          <div class="info_contact">
            <i class="fa-solid fa-circle-user"></i>
            INFORMACION DE CONTACTO
          </div>
          <div class="content_contact_gt">
            <div class="contact_op_po">
              <i class="fa-solid fa-envelope"></i>
              cardcontrol@gmail.com
            </div>
            <br>
            <div class="contact_op_po">
              <i class="fa-solid fa-mobile-screen"></i>
              3023408260
            </div>
          </div>
        </div>
        <div class="formu_po">
          <!--<form method="post" name="Contact Form">-->
              <!-- <span style="text-align:center; color:black;">Envia un mensaje (soporte)</span> -->
              <div class="input-container">
                <input id="nombres_popu" required name="nombres_popu" class="input" type="text" pattern=".+" required />
                <label class="label" for="nombres_popu">Nombres</label>
              </div>
              <br>
              <div class="input-container">
                <input id="telefono_popu" required name="telefono_popu" class="input" type="text" pattern=".+" required />
                <label class="label" for="telefono_popu">Telefono/Celular</label>
              </div>
              <br>
              <div class="input-container">
                <input id="correo_popu" required name="correo_popu" class="input" type="text" pattern=".+" required />
                <label class="label" for="correo_popu">Correo Electronico</label>
              </div>
              <br>
              <div class="input-container">
                <input id="mensaje_popu" required name="mensaje_popu" class="input" type="text" pattern=".+" required />
                <label class="label" for="mensaje_popu">Mensaje</label>
              </div>
              <button class="button_form2" onclick="
              var nombres_popu = document.getElementById('nombres_popu').value;
              var telefono_popu = document.getElementById('telefono_popu').value;
              var correo_popu = document.getElementById('correo_popu').value;
              var mensaje_popu = document.getElementById('mensaje_popu').value;
              
              
              if(nombres_popu == '' || telefono_popu == '' || correo_popu == '' || mensaje_popu == ''){
                  Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'debes llenar todos los parametros'
                })
              }else{
              var dataen = 'nombres_popu=' + nombres_popu + '&telefono_popu=' + telefono_popu + '&correo_popu=' + correo_popu + '&mensaje_popu=' + mensaje_popu;
                $.ajax({
                  type: 'POST',
                  url: 'sendmail/send_gmail.php',
                  data: dataen,
                    success: function(resp) {
                      $('#sendmail').html(resp);
                  }
                });
              }
              
              
            ">Subir</button>
          <!--</form>-->
          <!-- <input type="text" placeholder="nombres">
          <input type="text" placeholder="telefono/celular">
          <input type="text" placeholder="Correo Electronico">
          <input type="text" placeholder="mensaje"> -->
        </div>
      </div>
    </div>
  </div>

  <?php require "requires/footer.php"; ?>

  <script src="assets/js/main.js"></script>
  <script>
      var btnAbrirPopup = document.getElementById('btn-abrir-popup'),
	overlay = document.getElementById('overlay'),
	popup = document.getElementById('popup'),
	btnCerrarPopup = document.getElementById('btn-cerrar-popup');

btnAbrirPopup.addEventListener('click', function(){
	overlay.classList.add('active');
	popup.classList.add('active');
});

btnCerrarPopup.addEventListener('click', function(e){
	e.preventDefault();
	overlay.classList.remove('active');
	popup.classList.remove('active');
});
  </script>
  
</body>

</html>