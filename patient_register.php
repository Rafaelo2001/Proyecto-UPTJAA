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

<html lang="en">
    <head>
        <title>Registro de Paciente</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="css/styles_nav.css">
        
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    </head>

<body class="login-register">
    
    <div class="sidebar close">
        <div class="logo-details">
            <img class="logo" src="images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
            <img class="logo_name" src="images/Letras.png" alt="HIGEA" width="135" height="40">
        </div>
        <ul class="nav-links">
            <li>
                <a href="home.php">
                    <i class="fi fi-rr-apps"></i>
                    <span class="link_name">Panel Principal</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="home.php">Panel Principal</a></li>
                </ul>
            </li>
            <li class="nav-link active">
                <a href="patient_register.php">
                    <i class="fi fi-rr-procedures"></i>
                    <span class="link_name">Pacientes</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="patient_register.php">Pacientes</a></li>
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
                    <li><a class="link_name" href="#">Muestras</a></li>
                    <li><a href="citology_register.html">Citología</a></li>
                    <li><a href="biopsia_register.html">Biopsia</a></li>
                </ul>
            </li>
            <li>
                <a href="supplies_register.html">
                    <i class="fi fi-rr-box-open-full"></i>
                    <span class="link_name">Insumos</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="supplies_register.html">Insumos</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fi fi-rr-file-circle-info"></i>
                        <span class="link_name">Detalles</span>
                    </a>
                    <i class="fi fi-rr-angle-small-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Detalles</a></li>
                    <li><a href="#">Pacientes</a></li>
                    <li><a href="display-samples.html">Muestras</a></li>
                    <li><a href="display-inventory.html">Insumos</a></li>
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
        </ul>
    </div>

        <main class="home-section">
            <div class="home-content">
                <i class="fi fi-rr-menu-burger bx-menu"></i>
            </div>

            <section class="form-register">
                <h1>REGISTRO DE PACIENTE</h1>
                <form action="#" method="post" class="form" id="form" autocomplete="off">
                    <h2>INFORMACIÓN PRINCIPAL:</h2>
                    <div class="grid">
                        <!--group: ci-->
                        <div class="form-group" id="group_ci_patient">
                            <div class="form-group-input">
                                <label for="ci_patient">Cédula de identidad</label>
                                <input type="text" name="ci_patient" id="ci_patient" placeholder="Ingrese su cédula">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>La cédula debe contener entre 6-8 caracteres, solo puede contener números</p>
                            </span>
                        </div>
    
                        <!--group: name1-->
                        <div class="form-group" id="group_name_patient1">
                            <div class="form-group-input">
                                <label for="name_patient1">Primer Nombre</label>
                                <input   type="text" name="name_patient1" id="name_patient1" placeholder="Ingrese su nombre">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>
                        
                        <!--group: name2-->
                        <div class="form-group" id="group_name_patient2">
                            <div class="form-group-input">
                                <label for="name_patient2">Segundo Nombre <small>(Opcional)</small></label>
                                <input   type="text" name="name_patient2" id="name_patient2" placeholder="Ingrese su nombre">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>
                        
                        <!--group: name3-->
                        <div class="form-group" id="group_name_patient3">
                            <div class="form-group-input">
                                <label for="name_patient3">Tercer Nombre <small>(Opcional)</small></label>
                                <input   type="text" name="name_patient3" id="name_patient3" placeholder="Ingrese su nombre">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>
    
                        <!--group: surname1-->
                        <div class="form-group" id="group_surname_patient1">
                            <div class="form-group-input">
                                <label for="surname_patient1">Primer Apellido</label>
                                <input   type="text" name="surname_patient1" id="surname_patient1" placeholder="Ingrese su apellido">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>
                        
                        <!--group: surname2-->
                        <div class="form-group" id="group_surname_patient2">
                            <div class="form-group-input">
                                <label for="surname_patient2">Segundo Apellido <small>(Opcional)</small></label>
                                <input   type="text" name="surname_patient2" id="surname_patient2" placeholder="Ingrese su apellido">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>
    
                        <!--group: datebirth-->
                        <div class="form-group" id="group_date_birth">
                            <div class="form-group-input">
                                <label for="date_birth">Fecha de nacimiento</label>
                                <input type="date" class="date_birth" name="date_birth" id="date_birth" placeholder="(dd/mm/aaaa)">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                            </div>
                            <p class="form-input-error">Rellene este campo correctamente. Ej: 31/01/2023</p>
                        </div>
                        
                        <div>
                            <label>Sexo</label>
                            <div class="radio" id="sexo">
                                    <input type="radio" name="sexo" id="masculino" value="M">
                                    <label for="masculino">Masculino</label>
                                    <br>
                                    <input type="radio" name="sexo" id="femenino" value="F">
                                    <label for="femenino">Femenino</label>
                            </div>
                        </div>
                    </div>
                    <h2>INFORMACIÓN DE CONTACTO:</h2>
                    <div class="grid">
                        <!--group: cod_area-->
                        <div class="form-group" id="group_cod_area">
                            <div class="form-group-input">
                                <label for="cod_area">Código Telefónico</label>
                                <input   type="tel" name="cod_area" id="cod_area" placeholder="Ingrese el código telefónico">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>El código telefónico debe tener 4 dígitos: 0123</p>
                            </span>
                        </div>
    
                        <!--group: tel-->
                        <div class="form-group" id="group_telf_patient">
                            <div class="form-group-input">
                                <label for="telf_patient">Teléfono</label>
                                <input   type="tel" name="telf_patient" id="telf_patient" placeholder="Ingrese su nro. de teléfono">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>El número telefónico debe tener 7 dígitos: 1234567</p>
                            </span>
                        </div>
    
                        <!--group: e-mail-->
                        <div class="form-group" id="group_email_patient">
                            <div class="form-group-input">
                                <label for="email_patient">Correo electrónico</label>
                                <input   type="email" name="email_patient" id="email_patient" placeholder="Ingrese su e-mail">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Formato incorrecto de e-mail: jhon123@example.com</p>
                            </span>
                        </div>
                    </div>
                    <h2>INFORMACIÓN DE DIRECCIÓN:</h2>
                    <div class="grid">
                        <!--group: state-->
                        <div class="form-group" id="group_state">
                            <div class="form-group-input">
                                <label for="state">Estado</label>
                                <select id="lista_estados" name="state" class="quest-security">
                                    <option value="0">--Seleccione su Estado--</option>
                                    <?php 
                                        $estados=$user->buscar("estado","1");
                                        foreach($estados as $estado): 
                                    ?>
                                    <option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['nombre'] ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>

                        <!--group: city-->
                        <div class="form-group" id="group_city">
                            <div class="form-group-input">
                                <label for="city">Ciudad</label>
                                <select id="lista_ciudades" name="ciudad" class="quest-security">
                                    <option value="0">--Seleccione su Ciudad--</option>
                                </select>
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>

                        <!--group: municipality-->
                        <div class="form-group" id="group_municipality">
                            <div class="form-group-input">
                                <label for="municipality">Municipio</label>
                                <input   type="text" name="municipality" id="municipality" placeholder="Ingrese su municipio">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>

                        <!--group: parish-->
                        <div class="form-group" id="group_parish">
                            <div class="form-group-input">
                                <label for="parish">Parroquia</label>
                                <input   type="text" name="parish" id="parish" placeholder="Ingrese su parroquia">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>

                        <!--group: location-->
                        <div class="form-group" id="group_location">
                            <div class="form-group-input">
                                <label for="location">Localización</label>
                                <input   type="text" name="location" id="location" placeholder="Ingrese su localización">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>

                        <!--group: sector-->
                        <div class="form-group" id="group_sector">
                            <div class="form-group-input">
                                <label for="sector">Sector</label>
                                <input   type="text" name="sector" id="sector" placeholder="Ingrese su sector">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>

                        <!--group: street-->
                        <div class="form-group" id="group_street">
                            <div class="form-group-input">
                                <label for="street">Calle</label>
                                <input   type="text" name="street" id="street" placeholder="Ingrese su calle">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>

                        <!--group: house-->
                        <div class="form-group" id="group_house">
                            <div class="form-group-input">
                                <label for="house">Número de casa</label>
                                <input   type="text" name="house" id="house" placeholder="Ingrese su número de casa">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>
                    </div>
    
                        <div class="form-mess" id="form-mess">
                            <p><i class="fi fi-rr-triangle-warning"></i><b>Error:</b> ¡Revise los campos!</p>
                        </div>
    
                        <div class="button-container">
                            <div class="form__group form__group-btn-submit">
                                <input class="button-submit" type="submit" name="registrar" id="registrar" value="Registrar">
                            </div>
                            <p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
                        </div>
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


            // Seleccionador de Estados/Ciudades/Municipios (editado)

                $("#lista_estados").change(function(){    	
                    $.ajax({
                        data:  "id_estado="+$("#lista_estados").val(),
                        url:   'php/ajax_ciudades.php',
                        type:  'post',
                        dataType: 'json',
                        beforeSend: function () {  },
                        success:  function (response) {            
                            var html = "";
                            $.each(response, function( index, value ) {
                                html+= '<option value="'+value.id+'">'+value.nombre+"</option>";
                            });  
                            $("#lista_ciudades").html(html);
                        },
                        error:function(){
                            alert("error")
                        }
                    });
                })

                $("#lista_estados").change(function(){    	
                    $.ajax({
                        data:  "id_estado="+$("#lista_estados").val(),
                        url:   'php/ajax_municipios.php',
                        type:  'post',
                        dataType: 'json',
                        beforeSend: function () {  },
                        success:  function (response) {            
                            var html = "";
                            $.each(response, function( index, value ) {
                                html+= '<option value="'+value.id+'">'+value.nombre+"</option>";
                            });  
                            $("#lista_municipios").html(html);
                            $("#lista_parroquias").html("");
                        },
                        error:function(){
                            alert("error")
                        }
                    });
                })

                $("#lista_municipios").change(function(){    	
                    $.ajax({
                        data:  "id_municipio="+$("#lista_municipios").val(),
                        url:   'php/ajax_parroquias.php',
                        type:  'post',
                        dataType: 'json',
                        beforeSend: function () {  },
                        success:  function (response) {            
                            var html = "";
                            $.each(response, function( index, value ) {
                                html+= '<option value="'+value.id+'">'+value.nombre+"</option>";
                            });  
                            $("#lista_parroquias").html(html);
                        },
                        error:function(){
                            alert("error")
                        }
                    });
                })
            
        </script>

    <script src="js/form-patient.js"></script>

</body>
</html>