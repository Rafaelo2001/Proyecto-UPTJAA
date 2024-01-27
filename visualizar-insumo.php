<?php
    session_start();
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    if(!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit;
    }

    include "php/conexion.php";
    $user = new CodeaDB();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Visualización de Insumos</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles_higea.css">
        <link rel="stylesheet" type="text/css" href="css/styles_higea.css?v=1.1">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>

        <link href="css/select2.min.css" rel="stylesheet" />
        <script src="js/jquery-3.7.1.js"></script>
        <script src="js/select2.min.js"></script>
    </head>

    <body class="login-register" style="text-align: center;">
    <div class="sidebar close">
                <div class="logo-details">
                <img class="logo" src="images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
                <img class="logo_name" src="images/Letras.png" alt="HIGEA" width="135" height="40">
                </div>
                <ul class="nav-links">
                <li>
                        <a href="registro-paciente.php">
                        <i class="fi fi-sr-hospital-user"></i>
                        <span class="link_name">Pacientes</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="registro-paciente.php">Pacientes</a></li>
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
                        <li><a class="link_name" href="#">Muestras y Exámenes</a></li>
                        <li><a href="registro-citologia.php">Citología</a></li>
                        <li><a href="registro-biopsia.php">Biopsia</a></li>
                        <li><a href="registro-examen.php">Examen</a></li>
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
                        <li><a href="registro-insumo.php">Registrar</a></li>
                        <li><a href="visualizar-insumo.php">Visualizar</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-sr-document-signed"></i>
                                <span class="link_name">Informes médicos</span>
                        </a>
                        <i class="fi fi-sr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Informes médicos</a></li>
                        <li><a href="registro-informes.php">Registrar</a></li>
                        <li><a href="visualizar-informe.php">Visualizar</a></li>
                        </ul>
                </li>
                <li>
                        <a href="registro-pagos.php">
                        <i class="fi fi-sr-file-invoice-dollar"></i>
                        <span class="link_name">Facturación</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="registro-pagos.php">Facturación</a></li>
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
                        <li><a href="#">Pacientes</a></li>
                        <li><a href="#">Muestras</a></li>
                        <li><a href="#">Insumos</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-sr-database"></i>
                                <span class="link_name">Mantenimiento</span>
                        </a>
                        <i class="fi fi-sr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Mantenimiento</a></li>
                        <li><a href="#">Backup</a></li>
                        <li><a href="#">Restore</a></li>
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
                        <li><a href="#">Sobre HIGEA</a></li>
                        <li><a href="developers.php">Developers</a></li>
                        <li><a href="#">Ayuda</a></li>
                        </ul>
                </li>
                <li>
                        <a href="#">
                        <i class="fi fi-sr-users-alt"></i>
                        <span class="link_name">Gestión de usuarios</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Gestión de usuarios</a></li>
                        </ul>
                </li>
                <li>
                        <div class="profile-details">
                        <a href="php/exit.php">
                                <i class="fi fi-sr-exit"></i>
                                <span class="link_name">Salir</span>
                        </a>
                        <ul class="sub-menu blank">
                                <li><a class="link_name" href="php/exit.php">Salir</a></li>
                        </ul>
                        </div>
                </li>
                </ul>
        </div>

        <main class="home-section">
                <div class="home-content">
                        <i class="fi fi-rr-menu-burger bx-menu"></i>
                </div>

                <section class="form-register">
                        <h1>VISUALIZADOR DE INSUMOS</h1>
                        <form action="php/actu_insumo.php" method="post" class="form" id="form" autocomplete="off">

                            <select id="insumo" name="id_insumo" required>
                                <option disabled selected></option>
                                <?php
                                    $listaInsumo = $user->buscar("insumo","1");

                                    foreach($listaInsumo as $insumo):
                                ?>
                                <option value="<?php echo($insumo["ID_Insumo"]); ?>">
                                    <?php echo($insumo["Material"]); ?>
                                </option>
                                <?php
                                    endforeach;
                                ?>
                            </select>

                                    <br>

                            <label for="existencia">Existencia actual:</label>
                            <input type="text" id="existencia" readonly style="text-align: right;">
                            <label for="existencia" id="unidades_existencia"></label>

                                    

                            <label for="cant_minima">Cantidad minima:</label>
                            <input type="text" id="cant_minima" readonly style="text-align: right;">
                            <label for="cant_minima" id="unidades_cant_minima"></label>

                                

                            <div>
                                <label>Agregar insumos por:</label>
                                <div class="radio" id="tipo_act">
                                    <input type="radio" name="tipo_act" id="directo" value="directo" required>
                                    <label for="directo">Directo</label>
                                            
                                    <input type="radio" name="tipo_act" id="lote" value="lote">
                                    <label for="lote">Lote</label>
                                </div>
                            </div>


                            <section id="sec_directo" style="display: none;">
                                <h3>Directo:</h3>
                                <label for="cant">Cantidad a añadir:</label>
                                <input type="number" name="cant" min="0" disabled>
                                <label for="cant" id="unidades_cant"></label>
                            </section>

                            <section id="sec_lote" style="display: none;">
                                <h3>Por Lote:</h3>
                                <label for="cant">Cantidad a añadir:</label>
                                <input type="number" name="cant" min="0" placeholder="Ingrese la cantidad" disabled>
                                <label for="cant" id="unidades_cant"></label>


                                <label>ID Lote:</label>
                                <input type="text" name="id_lote" placeholder="Ingrese el ID del lote" disabled>

                                    <br>

                                <label>Fecha de Elaboracion:</label>
                                <input type="date" name="f_elab" disabled>

                                    <br>

                                <label>Fecha de Expiracion:</label>
                                <input type="date" name="f_exp" disabled>

                                    <br>

                                <label>Proveedor:</label>
                                <input type="text" name="proveedor" placeholder="Indique el proveedor" disabled>
                            </section>

                                    <br>

                            <input class="button-submit" type="submit" name="guardar" id="guardar" value="Guardar">
                               
                        </form>
                </section>
        </main>
        
        <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
          arrow[i].addEventListener("click", (e)=>{
         let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
         arrowParent.classList.toggle("showMenu");
          });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", ()=>{
          sidebar.classList.toggle("close");
        });
        </script>

    </body>

    <script>
        $("[name='tipo_act']").change(
            function(){
                let tipo_ingreso = $("[name='tipo_act']:checked").val();

                if(tipo_ingreso == "directo"){
                    $("#sec_lote").css("display","none");
                    $("#sec_lote *").prop("required", false);  
                    $("#sec_lote *").prop("disabled", true);

                    $("#sec_directo").css("display","block");
                    $("#sec_directo *").prop("required", true);
                    $("#sec_directo *").prop("disabled", false);
                }
                else if(tipo_ingreso == "lote"){
                    $("#sec_directo").css("display","none");
                    $("#sec_directo *").prop("required", false);  
                    $("#sec_directo *").prop("disabled", true);

                    $("#sec_lote").css("display","block");
                    $("#sec_lote *").prop("required", true);
                    $("#sec_lote *").prop("disabled", false);
                }
        });

        let insumo = $("#insumo");

        insumo.change(function(){
            $.ajax({
                data:   "id_insumo="+insumo.val(),
                url:    "php/ajax_insumo.php",
                type:   "post",
                dataType:   "json",
                success: function(response) {
                    $("#existencia").val(response[0]["existencia"]);
                    $("#unidades_existencia").html(response[0]["unidades"]);

                    $("#cant_minima").val(response[0]["cant_minima"]);
                    $("#unidades_cant_minima").html(response[0]["unidades"]);

                    $("#unidades_cant").html(response[0]["unidades"]);
                },
                error: function(file, status) {
                    alert("Error en Ajax");
                    console.log(file);
                    console.log(status);
                }
            });
        });
    </script>
</html>