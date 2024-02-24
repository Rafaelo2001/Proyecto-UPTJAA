<?php
    $conex = mysqli_connect("localhost", "root", "", "higea_db");

    session_start();

    require "../php/conexion.php";
    require "../php/sweet.php";

    $user = new CodeaDB();

    $alert = new SweetForInsert();
    echo ($alert->sweetHead("Envío de Token Maestro"));

    // Solicita la libreria PHPMailer para enviar emails
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require '../PHPMailer/src/Exception.php';
        require '../PHPMailer/src/PHPMailer.php';
        require '../PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';

    $email = $user->buscarONE("correo","CI = 'V-123456'","Correo");

    try {        
        // Configuración del servidor de correo
        // $mail->SMTPDebug = 2; // Esto imprime el contenido del correo en pantalla
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';  // Servidor SMTP de Outlook
        $mail->SMTPAuth = true;
        $mail->Username = 'ferjpp20@outlook.com';  // Tu dirección de correo electrónico de Outlook
        $mail->Password = 'uzskblbihmhaoail';  // Tu contraseña de Outlook
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Destinatarios
        $mail->setFrom('ferjpp20@outlook.com', 'higea_support');  // Tu dirección de correo electrónico y tu nombre
        // $mail->addAddress('rrbastardom2011@hotmail.com', 'Administrador Maestro');  // Correo electrónico y nombre del usuario
        // $mail->addAddress('blancot30@gmail.com', 'Administrador Maestro');  // Correo electrónico y nombre del usuario
        $mail->addAddress($email, 'Administrador Maestro');  // Correo electrónico y nombre del usuario

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña maestra de HIGEA';
        $token = bin2hex(random_bytes(4)); // Genera un token seguro de 8 caracteres

        // Almacena el token y su fecha de expiración en la variable de sesión
        $_SESSION['token'] = [
            'value' => $token,
            'expiry' => time() + 1800  // El token expira después de 30 minutos
        ];

        $mail->Body = "Estimado Administrador, su código de seguridad para la recuperación del Administrador Maestro de HIGEA es: <br><br> <h1><b>$token</b></h1> <br><br> Por favor, ingrese este token en la página de recuperación de contraseña para cambiar la contraseña maestra. Este codigo tiene una validez de 30 minutos. <br><br> Si usted no solicitó este código de recuperación, póngase en contacto con el Administrador del Laboratorio Dr. Miguel Blanco inmediatamente. <br><br> <h3><i>HIGEA</i></h3>";

        $mail->send();

        // Muestra una alerta y redirige al usuario al siguiente paso
        die ("<script>
                Swal.fire({
                    title: 'Se ha enviado el código de recuperación al correo <b><i>$email</i></b>',
                    html: 'Si no aparece en la bandeja de entrada de su correo, revise en los correos no deseados.',
                    icon: 'success',
                    timer: 10000,
                    confirmButtonText: 'Continuar',
                    customClass: {
                        confirmButton: 'boton-higea',
                    }
                })
                .then(
                    (click) => { window.location.href = '../recuperacion_admin/pagina_verificacion.php'; }
                );
            </script>");
    
    } catch (Exception $e) {
        die($alert->sweetError("../index.php","El mensaje no pudo ser enviado","Mailer Error: $mail->ErrorInfo"));
    }
