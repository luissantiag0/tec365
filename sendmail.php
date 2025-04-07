<?php

$destino = "luis.santiago@inslapineda.cat";
$fromName = "TEC365";
$fromEmail = "luis.santiago@inslapineda.cat";


$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if ($name && $surname && $email && $message) {
    
    $subjectToYou = "Nuevo mensaje desde TEC365";
    $bodyToYou = "Has recibido un nuevo mensaje desde tu formulario web:\n\n"
               . "Nombre: $name $surname\n"
               . "Email: $email\n"
               . "Mensaje:\n$message\n";

    $headersToYou = "From: $fromName <$fromEmail>\r\n";
    $headersToYou .= "Reply-To: $email\r\n";

    mail($destino, $subjectToYou, $bodyToYou, $headersToYou);

    
    $subjectToUser = "Gracias por contactar con TEC365";
    $bodyToUser = "Hola $name,\n\nGracias por contactarnos. Hemos recibido tu mensaje y te responderemos lo antes posible.\n\n"
                . "Copia de tu mensaje:\n$message\n\n"
                . "Saludos,\nEquipo TEC365\nhttps://tec365.shop";

    $headersToUser = "From: $fromName <$fromEmail>\r\n";

    mail($email, $subjectToUser, $bodyToUser, $headersToUser);

    
    header("Location: https://tec365.shop?mensaje=enviado");
    exit();
} else {
    
    header("Location: https://tec365.shop?mensaje=error");
    exit();
}
?>
