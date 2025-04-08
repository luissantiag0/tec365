<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = htmlspecialchars($_POST['name']);
    $apellido = htmlspecialchars($_POST['surname']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mensaje = htmlspecialchars($_POST['message']);

    
    $to = "info@tec365.shop";
    $subject = "Nuevo mensaje de contacto de " . $nombre . " " . $apellido;
    
    
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n"; 

    
    $body = "<html><body>";
    $body .= "<h2>Nuevo mensaje de contacto de: " . $nombre . " " . $apellido . "</h2>";
    $body .= "<p><strong>Email:</strong> " . $email . "</p>";
    $body .= "<p><strong>Mensaje:</strong><br>" . nl2br($mensaje) . "</p>";
    $body .= "</body></html>";

    
    if (mail($to, $subject, $body, $headers)) {
        echo "Gracias por ponerte en contacto con nosotros. Te responderemos pronto.";
    } else {
        echo "Hubo un error al enviar el mensaje. Por favor, intenta de nuevo.";
    }
}
?>
