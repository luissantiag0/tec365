<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos enviados
    $nombre = htmlspecialchars($_POST['name']);
    $apellido = htmlspecialchars($_POST['surname']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mensaje = htmlspecialchars($_POST['message']);

    // Correo destino
    $destino = "info@tec365.shop";
    $asunto = "Mensaje de contacto de " . $nombre . " " . $apellido;
    
    // Cuerpo del mensaje (texto plano)
    $cuerpo = "Nombre: " . $nombre . "\n";
    $cuerpo .= "Apellido: " . $apellido . "\n";
    $cuerpo .= "Email: " . $email . "\n";
    $cuerpo .= "Mensaje: " . $mensaje . "\n";

    // Cabeceras
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Enviar el email
    if (mail($destino, $asunto, $cuerpo, $headers)) {
        echo "Gracias por ponerte en contacto con nosotros.";
    } else {
        echo "Error al enviar el mensaje. Por favor, inténtalo de nuevo.";
    }
} else {
    echo "No se han recibido datos.";
}
?>
