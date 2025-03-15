<?php
header("Content-Type: application/json"); // Responde en JSON

$enviaPara = 'interservseguridadconsultas@gmail.com'; // Email de destino
$subject = 'Contacto desde la web'; 

$mensaje = '';
$primero = true;
$from = 'no-reply@interservseguridad.com.ar'; // Email por defecto

if (empty($_POST)) {
    echo json_encode(["success" => false, "error" => "No data received"]);
    exit;
}

foreach($_POST as $indice => $valor){
    if(is_array($valor)){
        $mensaje .= '<strong>'.$indice.': </strong><ul>';
        foreach($valor as $item){
            $mensaje .= '<li>'.$item .'</li>';
        }				
        $mensaje .= '</ul><br>'; 
    } else {
        if($primero){
            $from = filter_var($valor, FILTER_SANITIZE_EMAIL); // Filtra email
            if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(["success" => false, "error" => "Invalid email address"]);
                exit;
            }
            $primero = false;
        }
        $mensaje .= '<strong>'.$indice.': </strong>';
        $mensaje .= htmlspecialchars($valor) . '<br>'; // Evita inyección de código
    }
}

// Encabezados para el correo
$mail_headers  = "MIME-Version: 1.0\r\n";
$mail_headers .= "Content-type: text/html; charset=UTF-8\r\n";
$mail_headers .= "From: " . $from . "\r\n";

// Enviar correo
if (@mail($enviaPara, $subject, $mensaje, $mail_headers)) {
    echo json_encode(["success" => true]); // Responde éxito
} else {
    echo json_encode(["success" => false, "error" => "Failed to send email"]); // Responde error
}
?>