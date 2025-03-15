<?php
// Verifica que la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos del formulario
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Dirección de correo a donde se enviará el mensaje
    $to = "iphone.pablo2002@gmail.com"; // Cambia esto por tu dirección de correo
    $subject = "Nuevo mensaje de contacto desde el formulario";
    
    // Construir el cuerpo del mensaje
    $body = "Nombre: $name\n";
    $body .= "Correo: $email\n";
    $body .= "Teléfono: $phone\n\n";
    $body .= "Mensaje:\n$message";

    // Cabeceras del correo
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Enviar el correo
    if (mail($to, $subject, $body, $headers)) {
        // Respuesta si el correo fue enviado correctamente
        echo json_encode(["success" => true]);
    } else {
        // Respuesta si hubo un error al enviar el correo
        echo json_encode(["success" => false]);
    }
} else {
    // Si no es una solicitud POST, retorna un error
    echo json_encode(["success" => false]);
}
?>
