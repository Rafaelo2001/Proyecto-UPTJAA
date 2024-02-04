<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href='css/sweetalert2.min.css' rel='stylesheet'/>
        <link href='css/styles_higea.css' rel='stylesheet'/>
        <script src='js/sweetalert2.all.min.js'></script>
        <script src="js/jquery-3.7.1.js"></script>

        <style>
                .swal2-popup {
                        background: rgb(248,255,254);
                        background: linear-gradient(135deg, rgba(248,255,254,1) 0%, rgba(171,255,255,1) 100%);
                }
                .boton2{
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
                    transition: background .005s !important;
                    box-shadow: 5px 5px 10px 2px rgba(0, 21, 49, 0.2) !important;
                    font-weight: 600 !important;
                }
                .boton2:hover {
                    background: #fe6500 !important;
                }
        </style>
    </head>
        
    <body style='background: rgb(248,255,254);background: linear-gradient(132deg, rgb(248, 255, 254) 0%, rgba(171,255,255,1) 100%);'>
    </body>

    
    <script>
        Swal.fire({
            title: "Los datos del paciente se han insertado correctamente",
            icon: "success",
            confirmButtonText: "Regresar",
            customClass: {
                confirmButton: 'boton2',
            }
        })
        .then(
            (click) => {
                Swal.fire({
                    title: "HUMUNGO SAURIO",
                    imageUrl: "https://th.bing.com/th/id/OIP.7JLJou7fjvCFbtUnQbf3BQHaLr?rs=1&pid=ImgDetMain",
                    imageHeight: 500,
                    imageAlt: "HUMUNGOSAURIO",
                    text: "btw, paciente registrado correctamente.",
                    confirmButtonText: "Regresar",
                    customClass: {
                        confirmButton: 'boton2',
                    }
                    // icon: "success"

                //     imageUrl: "https://placeholder.pics/svg/300x1500",
                // imageHeight: 1500,
                // imageAlt: "A tall image"
                })
                //  window.location.href = '../registro-paciente.php';
        });

    </script>

<!-- echo(

'<template id="my-template">
<swal-title>
  Save changes to "Untitled 1" before closing?
</swal-title>
<swal-icon type="warning" color="red"></swal-icon>
<swal-button type="confirm">
  Save As
</swal-button>
<swal-button type="cancel" color="green">
  Cancel
</swal-button>
<swal-button type="deny">
  Close without Saving
</swal-button>
<swal-param name="allowEscapeKey" value="false" />
<swal-param
  name="customClass"
  value='."'".'{ "popup": "my-popup" }'."'".' />
<swal-function-param
  name="didOpen"
  value="popup => console.log(popup)" />
</template>') -->
</html>
