<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $mensaje = $_POST["mensaje"];

    $destinatario = "iphone.pablo2002@gmail.com"; // Reemplázalo con tu email de Hostinger
    $asunto = "Nuevo mensaje de contacto";

    $cuerpo = "Nombre: $name\n";
    $cuerpo .= "Email: $email\n\n";
    $cuerpo .= "Mensaje:\n$message\n";

    $cabeceras = "From: $email" . "\r\n" .
                 "Reply-To: $email" . "\r\n" .
                 "X-Mailer: PHP/" . phpversion();

    if (mail($destinatario, $asunto, $cuerpo, $cabeceras)) {
        echo "El mensaje se envió correctamente.";
    } else {
        echo "Error al enviar el mensaje.";
    }
}
?>
