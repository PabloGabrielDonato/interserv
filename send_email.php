<?php
$to = "iphone.pablo2002@gmail.com";

$subject = "Prueba";
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$cuerpo =  "De:" . $name . " " . $email . " " . $phone . " " . $message;


if (mail($to, $subject, $cuerpo)) {
    echo "Email enviado";
} else {
    echo "Error al enviar el email";
}
?>
