<?php
header('Content-Type: application/json');

// Configuración del destinatario
$destinatario = 'donato.pablo2002@gmail.com';
$asunto = 'Nuevo mensaje de contacto';

// Validar si se recibieron los datos esperados
if (!isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message'])) {
    echo json_encode(['success' => false, 'error' => 'Faltan datos en el formulario']);
    exit;
}

// Sanitización de datos
$nombre = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
$telefono = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
$mensaje = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

// Verificar que los datos sean válidos
if (!$nombre || !$email || !$telefono || !$mensaje) {
    echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
    exit;
}

// Construcción del mensaje
$contenido = "<html><body>";
$contenido .= "<h2>Nuevo mensaje de contacto</h2>";
$contenido .= "<p><strong>Nombre:</strong> $nombre</p>";
$contenido .= "<p><strong>Email:</strong> $email</p>";
$contenido .= "<p><strong>Teléfono:</strong> $telefono</p>";
$contenido .= "<p><strong>Mensaje:</strong><br>$mensaje</p>";
$contenido .= "</body></html>";

// Encabezados del correo
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

// Enviar correo
if (mail($destinatario, $asunto, $contenido, $headers)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Error al enviar el correo']);
}
