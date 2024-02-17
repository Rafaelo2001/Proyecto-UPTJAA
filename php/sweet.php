<?php
    class SweetForInsert {

        // SweetAlert (Same Folder)
        // Esta funcion toma como argumento el titulo de la pagina y devuelve un header de la pagina para usar sweetAlert2

        public function sweetHead($pagTitle = "Higea", $carpetasPorSalir = "../") {
            $header =
                "<html>
                    <head>
                        <title>$pagTitle</title>
                        <link   href='".$carpetasPorSalir."css/styles_higea.css'    rel='stylesheet'/>
                        <link   href='".$carpetasPorSalir."css/sweetalert2.min.css' rel='stylesheet'/>
                        <script src='".$carpetasPorSalir."js/sweetalert2.all.min.js'></script>
                        <script src='".$carpetasPorSalir."js/jquery-3.7.1.js'></script>
                    </head>
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
                    </style>
                    <body></body>";
            
            return $header;
        }

        public function sweetOK($retorno, $mensaje = "Datos insertados correctamente", $detalle = "") {
            $html = ($detalle != "") ? 'html: "'.str_replace('"',"'",$detalle).'",' : "";
            $alert =
                "   <script>
                        Swal.fire({
                            title: '$mensaje',
                            $html
                            icon: 'success',
                            timer: 10000,
                            confirmButtonText: 'Regresar',
                            customClass: {
                                confirmButton: 'boton-higea',
                            }
                        })
                        .then(
                            (click) => { window.location.href = '$retorno'; }
                        );
                    </script>
                </html>";
            
            return $alert;
        }

        public function sweetWar($retorno, $mensaje = "Datos ya insertados", $detalle = "") {
            $html = ($detalle != "") ? 'html: "'.str_replace('"',"'",$detalle).'",' : "";
            $alert =
            "   <script>
                    Swal.fire({
                        title: '$mensaje',
                        $html
                        icon: 'warning',
                        timer: 15000,
                        confirmButtonText: 'Regresar',
                        customClass: {
                            confirmButton: 'boton-higea',
                        }
                    })
                    .then(
                        (click) => { window.location.href = '$retorno'; }
                    );
                </script>
            </html>";
            
            return $alert;
        }

        public function sweetError($retorno, $mensaje = "Error al guardar datos", $detalle = "") {
            $html = ($detalle != "") ? 'html: "'.str_replace('"',"'",$detalle).'",' : "";
            $alert =
            "   <script>
                    Swal.fire({
                        title: '$mensaje',
                        $html
                        icon: 'error',
                        timer: 20000,
                        confirmButtonText: 'Regresar',
                        customClass: {
                            confirmButton: 'boton-higea',
                        }
                    })
                    .then(
                        (click) => { window.location.href = '$retorno'; }
                    );
                </script>
            </html>";
            
            return $alert;
        }
    }
