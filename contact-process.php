<?php

include 'includes/db.php';
include 'includes/email.php';
include 'includes/form-validation.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = validateFormData($_POST['name']);
    $apellido = validateFormData($_POST['surname']);
    $email = validateFormData($_POST['email']);
    $mensaje = validateFormData($_POST['message']);

    
    if (empty($nombre) || empty($apellido) || empty($email) || empty($mensaje)) {
        die("Por favor, rellene todos los campos.");
    }

    
    if (!validateEmail($email)) {
        die("El correo electrónico no es válido.");
    }

    /
    $stmt = $pdo->prepare("INSERT INTO mensajes_contacto (nombre, apellido, email, mensaje) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $apellido, $email, $mensaje]);

    
    $to = "tu-correo@dominio.com";
    $subject = "Nuevo mensaje desde el formulario de contacto";
    $body = "<h2>Nuevo mensaje de contacto</h2>
             <p><strong>Nombre:</strong> $nombre $apellido</p>
             <p><strong>Correo:</strong> $email</p>
             <p><strong>Mensaje:</strong><br> $mensaje</p>";

    if (sendEmail($to, $subject, $body, $email)) {
        
        header("Location: thank-you.php");
        exit;
    } else {
        echo "Hubo un error al enviar el correo. Inténtalo de nuevo más tarde.";
    }
}
?>
