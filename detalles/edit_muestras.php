<?php
session_start();
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['id_m'] == "" || $_POST['tipo_m'] == "") {
    header('Location: ./detalles_muestras.php', true, 303);
    exit;
}

require "../php/conexion.php";
$user = new CodeaDB();

$datosMuestra = $user->buscarSINGLE("m_remitido", "ID_M_Remitido='" . $_POST['id_m'] . "'");

if ($_POST['tipo_m'] == "Biopsia") {
    $datosBiop = $user->buscarSINGLE("m_biopsia", "ID_M_Remitido=" . $_POST['id_m']);
} elseif ($_POST['tipo_m'] == "Citología") {
    $datosCito = $user->buscarSINGLE("m_citologia", "ID_M_Remitido=" . $_POST['id_m']);
}

$examen_si = "";
$examen_no = "";

if ($datosMuestra["Examinado"]) {
    $examen_si = "checked";
    $examen_no = "";
} else {
    $examen_si = "";
    $examen_no = "checked";
}

$fecha = new DateTime($datosMuestra["F_Entrada"]);

// Incluye el archivo de permisos
require '../php/permisos.php';

// Obtiene el rol del usuario de la variable de sesión
$rol = $_SESSION['Rol'];

// Obtiene el nombre de la página actual
$paginaActual = basename($_SERVER['PHP_SELF']);

// Verifica si el usuario tiene permiso para acceder a la página actual
if (!in_array($paginaActual, $permisos[$rol])) {
    // Si el usuario no tiene permiso, muestra una alerta y redirige al usuario
    echo "<script>
                            alert('No tienes permiso para acceder a esta página.');
                            window.location.href = '../home.php';
                    </script>";

    exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Edición de Muestra <?php echo ($_POST["tipo_m"]); ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/styles_higea.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_higea.css?v=1.2">
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link href="../css/select2.min.css" rel="stylesheet" />
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/select2.min.js"></script>

    <link href="../css/sweetalert2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css?v=1.2">
</head>

<body class="login-register">
    <div class="sidebar close">
        <div class="logo-details">
            <img class="logo" src="../images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
            <img class="logo_name" src="../images/Letras.png" alt="HIGEA" width="135" height="40">
        </div>
        <ul class="nav-links">
            <li>
                <a href="../registro-paciente.php">
                    <i class="fi fi-sr-hospital-user"></i>
                    <span class="link_name">Pacientes</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../registro-paciente.php">Pacientes</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fi fi-sr-microscope"></i>
                        <span class="link_name">Muestras</span>
                    </a>
                    <i class="fi fi-sr-angle-small-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Muestras</a></li>
                    <li><a href="../registro-citologia.php">Citología</a></li>
                    <li><a href="../registro-biopsia.php">Biopsia</a></li>
                </ul>
            </li>
            <li>
                <a href="../registro-pagos.php">
                    <i class="fi fi-sr-file-invoice-dollar"></i>
                    <span class="link_name">Facturación</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../registro-pagos.php">Facturación</a></li>
                </ul>
            </li>
            <li>
                <a href="../registro-examen.php">
                    <i class="fi fi-sr-flask"></i>
                    <span class="link_name">Exámenes</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../registro-examen.php">Exámenes</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fi fi-sr-file-medical-alt"></i>
                        <span class="link_name">Informes médicos</span>
                    </a>
                    <i class="fi fi-sr-angle-small-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Informes médicos</a></li>
                    <li><a href="../registro-informes.php">Registrar</a></li>
                    <li><a href="../visualizar-informe.php">Visualizar</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fi fi-sr-box-open-full"></i>
                        <span class="link_name">Insumos</span>
                    </a>
                    <i class="fi fi-sr-angle-small-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Insumos</a></li>
                    <li><a href="../registro-insumo.php">Registrar</a></li>
                    <li><a href="../visualizar-insumo.php">Visualizar</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fi fi-sr-eye"></i>
                        <span class="link_name">Detalles</span>
                    </a>
                    <i class="fi fi-sr-angle-small-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Detalles</a></li>
                    <li><a href="detalles_paciente.php">Pacientes</a></li>
                    <li><a href="detalles_muestras.php">Muestras</a></li>
                    <li><a href="detalles_insumo.php">Insumos</a></li>
                </ul>
            </li>
            <li>
                <a href="../gestion/gestion_usuarios.php">
                    <i class="fi fi-sr-users-alt"></i>
                    <span class="link_name">Gestión de usuarios</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../gestion/gestion_usuarios.php">Gestión de usuarios</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fi fi-sr-info"></i>
                        <span class="link_name">Acerca de</span>
                    </a>
                    <i class="fi fi-sr-angle-small-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Acerca de</a></li>
                    <li><a href="../info_lab.php">Sobre el Lab.</a></li>
                    <li><a href="../info_higea.php">Sobre HIGEA</a></li>
                    <li><a href="../developers.php">Developers</a></li>
                    <li><a href="#">Ayuda</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <a href="../php/exit.php">
                        <i class="fi fi-sr-exit"></i>
                        <span class="link_name">Salir</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="../php/exit.php">Salir</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>


    <main class="home-section">

        <div class="home-content">
            <i class="fi fi-sr-menu-burger bx-menu"></i>
            <a href="../mantenimiento/php/Gestion-BDD.php"><i class="fi fi-sr-settings bx-menu"></i></a>
        </div>

        <section class="form-register">
            <h1>Edición de Muestra de <?php echo ($_POST['tipo_m']) ?></h1>
            <h4>Obligatorio (*).</h4>


            <form action="./insert_edit_muestras.php" method="post" class="form" id="form" autocomplete="off">

                <label for="des_m">Descripcion Material Remitido (*)</label>
                <textarea type="text" name="des_m" id="des_m" cols="40" rows="3" placeholder="Escriba una descripcion del material" required><?php echo ($datosMuestra['Descripcion_material']) ?></textarea>

                <label for="diag">Diagnóstico Clínico (*)</label>
                <textarea type="text" name="diag" id="diag" cols="40" rows="3" placeholder="Escriba el diágnostico clínico" required><?php echo ($datosMuestra["Diagnostico"]) ?></textarea>

                <label for="resumen">Resumen de Historia Clínica (*)</label>
                <textarea type="text" name="resumen" id="resumen" cols="40" rows="3" placeholder="Escriba el Resumen de Historia Clínica" required><?php echo ($datosMuestra["Resumen"]) ?></textarea>

                <div>
                    <label>Examinado (*)</label>
                    <div class="radio" id="examinado">
                        <input type="radio" name="examinado" id="E_si" value="1" <?php echo ($examen_si) ?> required>
                        <label for="E_si">Si</label>

                        <input type="radio" name="examinado" id="E_no" value="0" <?php echo ($examen_no) ?> required>
                        <label for="E_no">No</label>
                    </div>
                </div>

                <!--group: datebirth-->
                <div class="form-group" id="group_date_birth">
                    <div class="form-group-input">
                        <label for="f_ent">Fecha de Entrada (*)</label>
                        <input type="datetime-local" placeholder="dd/mm/aaaa" name="f_ent" id="f_ent" class="f_ent" value="<?php echo $fecha->format('Y-m-d H:i') ?>" required>
                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                    </div>
                    <p class="form-input-error">Rellene este campo correctamente. Ej: 31/01/2023</p>
                </div>

                <script>
                    var hoy = new Date(new Date().getTime() + new Date().getTimezoneOffset() * 60 * 1000 - 4 * 60 * 60 *
                        1000);
                    hoy.setSeconds(0); // Ajusta los segundos a 0
                    var fechaMaxima = hoy.toISOString().split('.')[0];
                    document.getElementById("f_ent").max = fechaMaxima;

                    var haceUnMes = new Date(hoy.getTime());
                    haceUnMes.setMonth(hoy.getMonth() - 2);
                    haceUnMes.setSeconds(0); // Ajusta los segundos a 0
                    var fechaMinima = haceUnMes.toISOString().split('.')[0];
                    document.getElementById("f_ent").min = fechaMinima;
                </script>


                <?php if ($_POST['tipo_m'] == "Biopsia") : ?>

                    <label for="sitio">Sitio de Lesión (*)</label>
                    <textarea type="text" name="sitio" id="sitio" cols="40" rows="3" placeholder="Indique el sitio de lesión" required><?php echo ($datosBiop["Sitio_lesion"]) ?></textarea>

                <?php elseif ($_POST['tipo_m'] == "Citología") : ?>

                    <!--group: name3-->
                    <div class="form-group" id="group_name_patient3">
                        <div class="form-group-input">
                            <label for="FUR">Fecha de la Última Regla (*)</label>
                            <input type="date" name="FUR" id="FUR" min="1900-01-01" value="<?php echo ($datosCito["FUR"]) ?>" required>
                        </div>
                        <span class="form-input-error">
                            <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                            <p>Rellene este campo correctamente</p>
                        </span>
                    </div>

                    <script>
                        var hoy = new Date(new Date().getTime() + new Date().getTimezoneOffset() * 60 * 1000 - 4 * 60 * 60 *
                            1000);
                        var fechaMaxima = hoy.toISOString().split('T')[0];
                        document.getElementById("FUR").max = fechaMaxima;
                    </script>

                    <div class="checkbox" id="frotis">
                        <h2>Frotis de: (*)</h2>
                        <input type="checkbox" name="endocervix" id="endocervix" value="1" <?php echo ($datosCito['Endocervix']) ? "checked" : "" ?>>
                        <label for="endocervix">Endocervix</label>

                        <input type="checkbox" name="exocervix" id="exocervix" value="1" <?php echo ($datosCito['Exocervix']) ? "checked" : "" ?>>
                        <label for="exocervix">Exocervix</label>

                        <input type="checkbox" name="vagina" id="vagina" value="1" <?php echo ($datosCito['Vagina']) ? "checked" : "" ?>>
                        <label for="vagina">Vagina</label>

                        <br>

                        <input type="checkbox" name="otro_check" id="otro_check" value="1" <?php echo ($datosCito['Otros']) ? "checked" : "" ?>>
                        <label for="otro_check">Otro:</label>
                        <input type="text" name="otro" id="otro" placeholder="Especifique" value="<?php echo ($datosCito['Otros']) ? $datosCito['Otros'] : "" ?>" disabled>
                    </div>

                    <script>
                        document.getElementById('form').addEventListener('submit', function(event) {
                            var checkboxes = document.querySelectorAll('#frotis input[type="checkbox"]');
                            var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
                            if (!checkedOne) {
                                alert('Por favor, selecciona al menos una opción de Frotis.');
                                event.preventDefault();
                            }
                        });
                    </script>

                <?php endif; ?>

                <div class="button-container">
                    <div class="form__group form__group-btn-submit">
                        <input type="hidden" name="id_m" value="<?php echo $_POST['id_m']; ?>">
                        <input type="hidden" name="tipo_m" value="<?php echo $_POST['tipo_m']; ?>">
                        <input class="button-submit" type="submit" name="enviar" id="enviar" value="Aplicar cambios" disabled>
                    </div>
                    <p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
                </div>
            </form>
        </section>
    </main>

    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>

</body>
<script>
    $(":input").change(function() {
        $("#enviar").prop("disabled", false);
    })
    $(":input").keypress(function() {
        $("#enviar").prop("disabled", false);
    })
</script>

</html>