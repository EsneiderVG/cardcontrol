
<?php
require '../PHPMailer/class.phpmailer.php';


// call the contact() function if contact_btn is clicked



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

        $message = '<!DOCTYPE html>
        <html lang="es">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link href ="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap"rel ="stylesheet">
          <link href ="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap"rel ="stylesheet">
          <title>Mensaje</title> 
          </head>
        <body>
          ';
    
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';

        $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['nombres_popu']) . "</td></tr>";

        $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['correo_popu']) . "</td></tr>";

        $message .= "<tr><td><strong>Phone:</strong> </td><td>" . strip_tags($_POST['telefono_popu']) . "</td></tr>";

        $message .= "<tr><td><strong>Message</strong> </td><td>" . strip_tags($_POST['mensaje_popu']) . "</td></tr>";

        $message .= "</table>";
        $message .= "</body></html>";

        $mail->Body = $message;

        $mail->isHTML(true);

        if ($mail->send()) {
            ?>
            <script>
                Swal.fire({
                  icon: 'success',
                  title: 'Se envio tu mensaje a nuestro soporte',
                  showConfirmButton: false,
                  timer: 1500
                })
                var overlay = document.getElementById('overlay');
	            var popup = document.getElementById('popup');
            	overlay.classList.remove('active');
            	popup.classList.remove('active');
            </script>
            <?php
        } else {
            Redirect_to("index.php");
        }

?>

</body>
</html>