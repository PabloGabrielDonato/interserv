<?php
$to = "iphone.pablo2002@gmail.com";


$subject = "Consulta en página interserv";
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$cuerpo = "De:\n";
$cuerpo .= "Nombre: " . $name . "\n";
$cuerpo .= "Email: " . $email . "\n";
$cuerpo .= "Teléfono: " . $phone . "\n";
$cuerpo .= "Mensaje: " . $message . "\n";


if (mail($to, $subject, $cuerpo)) {
    echo "Email enviado";
} else {
    echo "Error al enviar el email";
}
?>
