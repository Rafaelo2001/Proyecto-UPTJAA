<?php
    if($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])){
        header('Location: ./gestion_usuarios.php', true, 303);
        exit;
    }

    require "../php/conexion.php";
    $user = new CodeaDB();

    $id = $_POST['id'];
    $dataUsuario = $user->conexion->query("SELECT `Nombre`,`Rol`,`CIE` FROM `usuario` WHERE `ID_Usuario` = $id;") or die($this->conexion->error);
        $data = $dataUsuario->fetch_all(MYSQLI_ASSOC);
        $datosUsuario = $data[0];

    $cedula = $datosUsuario['CIE'];
        $datosPersona   = $user->buscarSINGLE("persona", "CI='$cedula'");
        $datosTelefono  = $user->buscarONE   ("telefono","CI='$cedula'","Nro_Telf");
        $datosCorreo    = $user->buscarONE   ("correo",  "CI='$cedula'","Correo");

    $its_a_boy = "";
    $its_a_girl = "";

    if ($datosPersona["Sexo"] == "M"){
        $its_a_boy = "checked";
        $its_a_girl = "";
    }
    elseif($datosPersona["Sexo"] == "F"){
        $its_a_boy = "";
        $its_a_girl = "checked";
    }


    $rol_admin = "";
    $rol_analis = "";
    
    if ($datosUsuario["Rol"] == "admin"){
        $rol_admin = "checked";
        $rol_analis = "";
    }
    elseif($datosUsuario["Rol"] == "analista"){
        $rol_admin = "";
        $rol_analis = "checked";
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Edición de Usuario (<?php echo ($_POST["id"]); ?>)</title>
        <script src="../js/jquery-3.7.1.js"></script>
        <link   href='../css/sweetalert2.min.css' rel='stylesheet'/>
        <script src='../js/sweetalert2.all.min.js'></script>
    </head>
    <style>
        .swal2-popup {
            background: rgb(248,255,254);
            background: linear-gradient(135deg, rgba(248,255,254,1) 0%, rgba(171,255,255,1) 100%);
        }

        .boton-cancelar{
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

        .boton-borrar{
            border: none !important;
            outline: none !important;
            padding: 1px 20px !important;
            height: 40px !important;
            margin-top: 10px !important;
            background: linear-gradient(135deg, rgb(255, 33, 0) 0%, rgb(204, 0, 0) 100%) !important;
            color: #ffffff !important;
            font-size: 18px !important;
            border-radius: 20px !important;
            cursor: pointer !important;
            transition: background .2s !important;
            box-shadow: 5px 5px 10px 2px rgba(0, 21, 49, 0.2) !important;
            font-weight: 600 !important;
        }
        .boton-borrar:hover {
            background: #b20000 !important;
        }

        .swal2-actions {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
    <body>
        <h1>Edición de Usuario: <?php echo($datosPersona["PN"]." ".$datosPersona["PA"])." ".$datosPersona["CI"] ?></h1>
        <main>
            <form action="./insert_edit_usuario.php" method="post">

                <h2>Datos Empleado</h2>

                <label for="pn">Primer Nombre:</label>
                    <input id="pn" name="pn" type="text" value="<?php echo($datosPersona["PN"]) ?>" required>

                    <br>

                <label for="sn">Segundo Nombre:</label>
                    <input id="sn" name="sn" type="text" value="<?php echo($datosPersona["SN"]) ?>">

                    <br>

                <label for="tn">Tercer Nombre:</label>
                    <input id="tn" name="tn" type="text" value="<?php echo($datosPersona["TN"]) ?>">

                    <br>

                <label for="pa">Primer Apellido:</label>
                    <input id="pa" name="pa" type="text" value="<?php echo($datosPersona["PA"]) ?>" required>

                    <br>

                <label for="sa">Segundo Apellido:</label>
                    <input id="sa" name="sa" type="text" value="<?php echo($datosPersona["SA"]) ?>">

                    <br><br>

                <label for="f_nac">Fecha de Nacimiento:</label>
                    <input id="f_nac" name="f_nac" type="date" value="<?php echo($datosPersona["F_nac"]) ?>">

                    <br><br>

                <label>Sexo:</label>
                    <br>
                    <label>
                        Masculino:
                        <input name="sexo" type="radio" value="M" <?php echo($its_a_boy) ?> required>
                    </label>
                        <br>
                    <label>
                        Femenino:
                        <input name="sexo" type="radio" value="F" <?php echo($its_a_girl) ?>>
                    </label>

                    <br><br>

                <label for="telf">Telefono:</label>
                    <input id="telf" name="nro_telf" type="tel" value="<?php echo($datosTelefono) ?>">

                    <br><br>

                <label for="correo">Correo:</label>
                    <input id="correo" name="correo" type="email" value="<?php echo($datosCorreo) ?>">

                    <br><br>
                    
                    <hr>

                <h2>Datos de Usuario</h2>

                <label for="usuario">Nombre de Usuario:</label>
                    <input id="usuario" name="usuario" type="text" value="<?php echo($datosUsuario["Nombre"]) ?>" required>

                    <br><br>

                <label>Rol:</label>
                    <br>
                    <label>
                        Administrador:
                        <input name="rol" type="radio" value="admin" <?php echo($rol_admin) ?> required>
                    </label>
                        <br>
                    <label>
                        Analista:
                        <input name="rol" type="radio" value="analista" <?php echo($rol_analis) ?>>
                    </label>

                    <br><br><br>

                    <input type="hidden" name="ci" value="<?php echo $cedula; ?>">
                    <input type="submit" id="enviar" value="Aplicar Cambios" disabled>

                </form>

                    <br>

                <hr>

                <h3>Otras Acciones</h3>

                <form action="." method="post"><button value="<?php echo($id); ?>">Cambiar Contraseña</button></form>
                <button id="borrar" value="<?php echo($id); ?>">Eliminar Usuario</button>
        </main>
    </body>
    <script>
        $(":input").change(function(){
            $("#enviar").prop("disabled", false);
        })
        $(":input").keypress(function(){
            $("#enviar").prop("disabled", false);
        })

        $("#borrar").click(function(){
            Swal.fire({
                title: '¿Éstas seguro?',
                html: '<b>Se eliminará por completo el usuario registrado</b>',
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: true,
                showConfirmButton: false,
                denyButtonText: 'Eliminar Usuario',
                cancelButtonText: 'Cancelar',
                customClass: {
                    denyButton: 'boton-borrar',
                    cancelButton: 'boton-cancelar',
                }
            })
            .then(
                (click) => { 
                    if (click.isDenied){
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = './delete_usuario.php';
                        
                        var campo = document.createElement('input');
                        campo.type = 'hidden';
                        campo.name = 'id';
                        campo.value = "<?php echo($id) ?>";
                        form.appendChild(campo);
                        
                        document.body.appendChild(form);
                        form.submit();
                    }
                }
            );
        })
    </script>
</html>