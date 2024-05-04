<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
</head>
<body>
    <div class="container mt-5">
        <h1>holaa</h1> <!-- Incrustar PHP para mostrar texto dinámico -->
        <p>holaa</p> <!-- Mostrar un valor dinámico -->

    </div>
</body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Verifica la salida no deseada
ob_start(); // Iniciar el buffer para evitar salidas accidentales

require 'PHPMailer.php';
require 'Exception.php';
require 'SMTP.php';

// Muestra errores en pantalla para diagnóstico
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Contenido del correo
    $asunto = $_POST["name"];
    $contenido = $_POST["message"];
    $de = $_POST["email"];
    
    $para = 'paginapausings@gmail.com';
    
    if (!filter_var($para, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Dirección de correo electrónico no válida.');
    }

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Para SSL
    $mail->SMTPAuth = true;
    $mail->Username = $para;
    $mail->Password = 'acth mzeb wdhq ntwv';
    $mail->setFrom($para, $asunto);
    $mail->addAddress($de, 'Paulina Paguina');
    $mail->Subject = $asunto;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Body = sprintf('<h3>El mensaje es:</h3><p>%s</p>', $contenido);

    if (!$mail->send()) {
        throw new Exception($mail->ErrorInfo);
    } else {
        // Redireccionar después del envío exitoso
        header("Location: index.html");
        exit(); // Detener la ejecución después de la redirección
    }

} catch (Exception $e) {
    echo $e->getMessage(); // Mostrar el mensaje de error
}

// Limpiar el buffer para evitar salidas indeseadas
ob_end_flush(); 
?>

