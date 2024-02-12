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
    <?php
    require "vendor/autoload.php";

    $faker = Faker\Factory::create('es_VE');

    for($i = 0; $i < 100; $i++){
        echo($faker->numberBetween(0,10)."<br>");
    }
    
    ?>
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
                    html: 'Dirijase a <b>Detalles→Paciente</b> si necesita modificar datos.',
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

</html>
