const nodemailer = require('nodemailer');

exports.handler = async (event) => {
  if (event.httpMethod !== 'POST') {
    return {
      statusCode: 405,
      body: JSON.stringify({ error: 'Method Not Allowed' }),
    };
  }

  try {
    // Parsear los datos enviados desde el formulario
    const { name, surname, email, message } = JSON.parse(event.body);

    // Validación de los campos
    if (!name || !surname || !email || !message) {
      return {
        statusCode: 400,
        body: JSON.stringify({ error: 'Todos los campos son obligatorios.' }),
      };
    }

    // Configuración de Nodemailer para enviar el correo
    const transporter = nodemailer.createTransport({
      host: 'smtp.zoho.com',
      port: 465,
      secure: true, // Usar SSL
      auth: {
        user: 'info@tec365.shop',  // Tu correo en Zoho
        pass: process.env.ZOHO_PASS, // Contraseña de Zoho (deberías usar una variable de entorno)
      },
    });

    // Configuración del correo a enviar
    const mailOptions = {
      from: `"${name} ${surname}" <${email}>`,
      to: 'info@tec365.shop',
      subject: 'Nuevo mensaje desde el formulario de contacto',
      text: `Nombre: ${name} ${surname}\nCorreo: ${email}\nMensaje:\n${message}`,
    };

    // Enviar el correo
    await transporter.sendMail(mailOptions);

    return {
      statusCode: 200,
      body: JSON.stringify({ message: 'Correo enviado correctamente.' }),
    };
  } catch (error) {
    console.error('Error al enviar el correo:', error);
    return {
      statusCode: 500,
      body: JSON.stringify({ error: 'Hubo un problema al enviar el correo.' }),
    };
  }
};
