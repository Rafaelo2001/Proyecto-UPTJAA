<?php
$conex = mysqli_connect("localhost", "root", "", "higea_db");

session_start();

// Utiliza el ID de usuario de la sesión
$id_usuario = $_POST['id'];
$_SESSION['id_user'] = $id_usuario;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';


try {
    $stmt = $conex->prepare('SELECT Nombre, CIE FROM usuario WHERE ID_Usuario = ?');
    $stmt->bind_param('s', $id_usuario); // 's' indica que $id_usuario es una cadena (string)
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();

    // Almacenar los resultados en variables
    $nombre_usuario = $resultado['Nombre'];
    $cie = $resultado['CIE'];

    // Realiza una consulta a la base de datos para obtener el correo electrónico del usuario
    $stmt = $conex->prepare("SELECT Correo FROM correo WHERE CI = ?");
    $stmt->bind_param('s', $cie); // 's' indica que $cie es una cadena (string)
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();
    $email = $resultado['Correo'];

    if ($email) {
        // Configuración del servidor de correo
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';  // Servidor SMTP de Outlook
        $mail->SMTPAuth = true;
        $mail->Username = 'ferjpp20@outlook.com';  // Tu dirección de correo electrónico de Outlook
        $mail->Password = 'uzskblbihmhaoail';  // Tu contraseña de Outlook
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Destinatarios
        $mail->setFrom('ferjpp20@outlook.com', 'higea_support');  // Tu dirección de correo electrónico y tu nombre
        $mail->addAddress($email, $nombre_usuario);  // Correo electrónico y nombre del usuario

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña de HIGEA';
        $token = bin2hex(random_bytes(4)); // Genera un token seguro de 8 caracteres

        // Almacena el token y su fecha de expiración en la variable de sesión
        $_SESSION['token'] = [
            'value' => $token,
            'expiry' => time() + 1800  // El token expira después de 30 minutos
        ];

        $mail->Body    = "Estimado <b>$nombre_usuario</b>, su código de seguridad para recuperación de usuario de HIGEA es: <br><br> <h1><b>$token</b></h1> <br><br> Por favor, ingrese este token en la página de recuperación de contraseña para cambiar su contraseña, tiene una validez de 30 minutos. <br><br> Si usted no solicitó este código de recuperación, haga caso omiso de este mensaje. <br><br> <h3><i>HIGEA</i></h3>";

        $mail->send();

        // Muestra una alerta y redirige al usuario
        echo '<script type="text/javascript">';
        echo 'alert("Se ha enviado el código de recuperación a su correo: ' . $email . '");';
        echo 'window.location.href = "../verificacion_token.php";';
        echo '</script>';
    } else {
        echo 'No se encontró un usuario con ese nombre';
    }
} catch (Exception $e) {
    echo 'El mensaje no pudo ser enviado. Mailer Error: ', $mail->ErrorInfo;
}
?>