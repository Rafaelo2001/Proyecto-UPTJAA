<?php
    session_start();
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    if(!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Home</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css?v=1.1">

        <link rel="stylesheet" href="css/styles_home.css">
        <link rel="stylesheet" type="text/css" href="css/styles_home.css?v=1.2">

        <link href="css/sweetalert2.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css?v=1.1">

        <script src="js/sweetalert2.all.min.js?v=1.2"></script>

        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>

        <style>
                .swal2-popup {
                        background: rgb(248,255,254);
                        background: linear-gradient(135deg, rgba(248,255,254,1) 0%, rgba(171,255,255,1) 100%);
                }
        </style>

    </head>
<body class="login-register">
        <div class="sidebar close">
                <div class="logo-details">
                <img class="logo" src="images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
                <img class="logo_name" src="images/Letras.png" alt="HIGEA" width="135" height="40">
                </div>
                <ul class="nav-links">
                <li>
                        <a href="registro-paciente.php">
                        <i class="fi fi-rr-procedures"></i>
                        <span class="link_name">Pacientes</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="registro-paciente.php">Pacientes</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-rr-microscope"></i>
                                <span class="link_name">Muestras</span>
                        </a>
                        <i class="fi fi-rr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Muestras y Exámenes</a></li>
                        <li><a href="registro-citologia.php">Citología</a></li>
                        <li><a href="registro-biopsia.php">Biopsia</a></li>
                        <li><a href="registro-examen.php">Examen</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-rr-box-open-full"></i>
                                <span class="link_name">Insumos</span>
                        </a>
                        <i class="fi fi-rr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Insumos</a></li>
                        <li><a href="registro-insumo.php">Registrar</a></li>
                        <li><a href="visualizar-insumo.php">Visualizar</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-rr-document-signed"></i>
                                <span class="link_name">Informes médicos</span>
                        </a>
                        <i class="fi fi-rr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Informes médicos</a></li>
                        <li><a href="registro-informes.php">Registrar</a></li>
                        <li><a href="visualizar-informe.php">Visualizar</a></li>
                        </ul>
                </li>
                <li>
                        <a href="registro-pagos.php">
                        <i class="fi fi-rr-file-invoice-dollar"></i>
                        <span class="link_name">Facturación</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="registro-pagos.php">Facturación</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-rr-eye"></i>
                                <span class="link_name">Detalles</span>
                        </a>
                        <i class="fi fi-rr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Detalles</a></li>
                        <li><a href="#">Pacientes</a></li>
                        <li><a href="#">Muestras</a></li>
                        <li><a href="#">Insumos</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-rr-database"></i>
                                <span class="link_name">Mantenimiento</span>
                        </a>
                        <i class="fi fi-rr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Mantenimiento</a></li>
                        <li><a href="mantenimiento/php/Backup.php">Backup</a></li>
                        <li><a href="mantenimiento/php/Restore.php">Restore</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-rr-info"></i>
                                <span class="link_name">Acerca de</span>
                        </a>
                        <i class="fi fi-rr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Acerca de</a></li>
                        <li><a href="#">Sobre HIGEA</a></li>
                        <li><a href="developers.php">Developers</a></li>
                        <li><a href="#">Ayuda</a></li>
                        </ul>
                </li>
                <li>
                        <a href="#">
                        <i class="fi fi-rr-users-alt"></i>
                        <span class="link_name">Gestión de usuarios</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Gestión de usuarios</a></li>
                        </ul>
                </li>
                <li>
                        <div class="profile-details">
                        <a href="php/exit.php">
                                <i class="fi fi-rr-exit"></i>
                                <span class="link_name">Salir</span>
                        </a>
                        <ul class="sub-menu blank">
                                <li><a class="link_name" href="php/exit.php">Salir</a></li>
                        </ul>
                        </div>
                </li>

<body class="body-home">

        <header>
            <nav>
                <a href="#" class="title">
                    <img src="images/Logo con contorno.png" alt="Logo de Higea" width="115" height="115">
                    <img src="images/Letras.png" alt="Higea" width="180px" height="45px">
                </a>

                <ul class="items">
                    <button class="buttom"><a href="php/exit.php" class="buttom-item"><i class="fi fi-sr-exit"></i>Salir</a></button>
                </ul>
            </nav>
        </header>

        <div class="grid">
                <div class="imagen-hover">
                        <figure>
                                <img src="images/image_hover.png" alt="imagen1">
                                <div class="capa">
                                        <h3>Imagen Hover</h3>
                                </div>
                        </figure>
                </div>

                <div class="imagen-hover">
                        <figure>
                                <img src="images/image_hover.png" alt="imagen1">
                                <div class="capa">
                                        <h3>Imagen Hover</h3>
                                </div>
                        </figure>
                </div>

                <div class="imagen-hover">
                        <figure>
                                <img src="images/image_hover.png" alt="imagen1">
                                <div class="capa">
                                        <h3>Imagen Hover</h3>
                                </div>
                        </figure>
                </div>

                <div class="imagen-hover">
                        <figure>
                                <img src="images/image_hover.png" alt="imagen1">
                                <div class="capa">
                                        <h3>Imagen Hover</h3>
                                </div>
                        </figure>
                </div>

                <div class="imagen-hover">
                        <figure>
                                <img src="images/image_hover.png" alt="imagen1">
                                <div class="capa">
                                        <h3>Imagen Hover</h3>
                                </div>
                        </figure>
                </div>

                <div class="imagen-hover">
                        <figure>
                                <img src="images/image_hover.png" alt="imagen1">
                                <div class="capa">
                                        <h3>Imagen Hover</h3>
                                </div>
                        </figure>
                </div>

        </div>

        <footer>
            <div class="div-footer">
                <img src="images/Logo.png" alt="Logo de Higea" width="70" height="70">
                <img src="images/higea_color.png" alt="Logo de Higea" width="70" height="70">
                <span class="copyright">&copy; 2024 HIGEA - Laboratorio Dr. Miguel Blanco. Todos los derechos reservados.</span>
            </div>
        </footer>

        <script>
                Swal.fire({
                position: 'center',
                html: '<img src="images/higea_color.png" style="width:150px;height:150px;"><p>¡Inicio de sesión exitoso, le damos la bienvenida a HIGEA!</p>',
                title: '¡Bienvenido usuario!',
                showConfirmButton: false,
                timer: 15000,
                showCloseButton: true
                });
        </script>


 
</body>
</html>