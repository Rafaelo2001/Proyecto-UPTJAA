<?php

    if($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])){
        header('Location: ./gestion_usuarios.php', true, 303);
        exit;
    }
    
    require "../php/conexion.php";
    require "../php/sweet.php";

    $user  = new CodeaDB();
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Eliminar Usuario"));

    // Conectando con la base de datos Higea
        $conex = $user->conexion;

    // Declarando las variables a utilizar
        $id = $_POST['id'];
        $cedula = $user->buscarONE("usuario", "ID_Usuario='$id'", "CIE");
        $ci = "'$cedula'";
        $direccion = $user->buscarONE("persona", "`CI` = $ci", "ID_Direccion");

    // Orden de Eliminacion
    /**
        * 1. recup_password
        * 2. usuario
        * 3. empleado
        * 4. correo/telefono
        * 5. persona
        * 6. direccion
    */

    // Declara las funciones para eliminar el usuario
        $DelSqlPass = "DELETE FROM `recup_password` WHERE `ID_Usuario` = $id";
        $DelSqlUser = "DELETE FROM `usuario` WHERE `ID_Usuario` = $id";
        $DelSqlEmpl = "DELETE FROM `empleado` WHERE `CIE` = $ci";
        $DelSqlMail = "DELETE FROM `correo` WHERE `CI` = $ci";
        $DelSqlTlfn = "DELETE FROM `telefono` WHERE `CI` = $ci";
        $DelSqlPers = "DELETE FROM `persona` WHERE `CI` = $ci";
        $DelSqlDirr = "DELETE FROM `direccion` WHERE `ID_Direccion` = $direccion";


    // Ejecuta la eliminacion de Usuario
        try {
            if (!(mysqli_query($conex,$DelSqlPass))) {
                throw new Exception("Error al eliminar tabla 'recup_password': " . mysqli_error($conex));
            }

            if (!(mysqli_query($conex,$DelSqlUser))) {
                throw new Exception("Error al eliminar tabla 'usuario': " . mysqli_error($conex));
            }

            if (!(mysqli_query($conex,$DelSqlEmpl))) {
                throw new Exception("Error al eliminar tabla 'empleado': " . mysqli_error($conex));
            }

            if (!(mysqli_query($conex,$DelSqlMail))) {
                throw new Exception("Error al eliminar tabla 'correo': " . mysqli_error($conex));
            }

            if (!(mysqli_query($conex,$DelSqlTlfn))) {
                throw new Exception("Error al eliminar tabla 'telefono': " . mysqli_error($conex));
            }

            if (!(mysqli_query($conex,$DelSqlPers))) {
                throw new Exception("Error al eliminar tabla 'persona': " . mysqli_error($conex));
            }

            if (!(mysqli_query($conex,$DelSqlDirr))) {
                throw new Exception("Error al eliminar tabla 'direccion': " . mysqli_error($conex));
            }
        }
        catch (Exception $e){
            die($alert->sweetError("./gestion_usuarios.php","Error al eliminar tablas",$e->getMessage()));
        }

        die ($alert->sweetOK("./gestion_usuarios.php", "Los datos del usuario se han eliminado correctamente"));
