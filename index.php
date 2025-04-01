<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>

</head>
<body>
    <h2>Contáctanos</h2>
    <form id="contact" action="contact-process.php" method="post">
        <input type="text" name="name" id="name" placeholder="Nombre" required>
        <input type="text" name="surname" id="surname" placeholder="Apellido" required>
        <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
        <textarea name="message" id="message" placeholder="Tu mensaje" required></textarea>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
