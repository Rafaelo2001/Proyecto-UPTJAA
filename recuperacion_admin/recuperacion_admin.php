<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recuperación de ADMIN</title>
        <link   href='../css/styles_higea.css'    rel='stylesheet'/>
        <link   href='../css/sweetalert2.min.css' rel='stylesheet'/>
        <script src='../js/sweetalert2.all.min.js'></script>
        <script src='../js/jquery-3.7.1.js'></script>
        <style>
            body {
                background: linear-gradient(132deg, rgb(248, 255, 254) 0%, rgba(171,255,255,1) 100%);
            }

            .swal2-popup {
                background: rgb(248,255,254);
                background: linear-gradient(135deg, rgba(248,255,254,1) 0%, rgba(171,255,255,1) 100%);
            }

            .boton-higea{
                border: none !important;
                outline: none !important;
                padding: 1px 20px !important;
                height: 40px !important;
                margin-top: 10px !important;
                background: linear-gradient(135deg, rgba(254,153,0,1) 0%, rgba(254,101,0,1) 100%) !important;
                color: #ffffff !important;
                font-size: 18px !important;
                border-radius: 20px !important;
                cursor: pointer !important;
                transition: background .2s !important;
                box-shadow: 5px 5px 10px 2px rgba(0, 21, 49, 0.2) !important;
                font-weight: 600 !important;
            }
            .boton-higea:hover {
                background: #fe6500 !important;
            }

            .boton-cancelar {
                border: none !important;
                outline: none !important;
                padding: 1px 20px !important;
                height: 40px !important;
                margin-top: 10px !important;
                background: linear-gradient(135deg, rgb(166, 166, 166) 0%, rgb(128, 128, 128) 100%) !important;
                color: #ffffff !important;
                font-size: 18px !important;
                border-radius: 20px !important;
                cursor: pointer !important;
                transition: background .2s !important;
                box-shadow: 5px 5px 10px 2px rgba(0, 21, 49, 0.2) !important;
                font-weight: 600 !important;
            }
            .boton-cancelar:hover {
                background: #4d4d4d !important;
            }

            .swal2-actions {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        </style>
    </head>
    <body>
        <h1>Recuperación de Contraseña Maestra</h1>
        <p>Si continua activará el proceso de recuperación de contraseña maestra.</p>
        <p>Use este apartado solamente si olvido la contraseña del ADMINISTRADOR MAESTRO.</p>
        <p>Un correo electrónico será enviado a la dirección <b><i>blancot30@gmail.com</i></b> con el tóken de validación.</p>
        <button type="button" id="continuar">Continuar</button>
        <button type="button" id="index">Regresar</button>
    </body>
    <script>
        // Boton de Regreso
        $('#index').click(function(){
            window.location.href = "../index.php";
        });

        // SweetAlert2 para el envio del correo de verificacion
        $('#continuar').click(function () {
            Swal.fire({
                title: '¿Continuar?',
                html: 'Se enviará un correo electrónico a <b><i>blancot30@gmail.com</i></b>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Enviar correo de verificación',
                cancelButtonText: 'Cancelar',
                customClass: {
                    confirmButton: 'boton-higea',
                    cancelButton: 'boton-cancelar',
                }
            })
            .then(
                (click) => {
                    if(click.isConfirmed){
                        window.location.href = './token_maestro.php';
                    }
                }
            ); 
        });
    </script>
</html>