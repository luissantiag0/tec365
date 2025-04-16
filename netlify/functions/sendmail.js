const nodemailer = require('nodemailer');

exports.handler = async (event, context) => {

  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, body: 'Método no permitido' };
  }

  try {
    // Primero validamos los datos obligatorios
    const data = JSON.parse(event.body);

    // Validar campos obligatorios
    if (!data.email || !data.name || !data.surname || !data.message) {
      return {
        statusCode: 400,
        body: JSON.stringify({ error: 'Faltan datos obligatorios en el cuerpo de la solicitud.' })
      };
    }

    // Configuración de Nodemailer
    let transporter = nodemailer.createTransport({
      host: 'smtp.zoho.com',
      port: 465,
      secure: true, // Usar SSL
      auth: {
        user: 'info@tec365.shop',
        pass: process.env.ZOHO_PASS // Asegúrate de tener el valor correcto en las variables de entorno
      }
    });

    // Opciones de correo
    const mailOptions = {
      from: data.email,  // Correo del remitente
      to: 'info@tec365.shop',  // Correo de destino
      subject: `Nuevo mensaje de ${data.name} ${data.surname}`,
      text: data.message,
      html: `<p>${data.message}</p>`
    };

    // Enviar el correo
    await transporter.sendMail(mailOptions);

    return {
      statusCode: 200,
      body: JSON.stringify({ message: 'El correo se ha enviado exitosamente.' })
    };
  } catch (error) {
    console.error(error);
    return {
      statusCode: 500,
      body: JSON.stringify({ error: 'Error al enviar el correo.' })
    };
  }
};
