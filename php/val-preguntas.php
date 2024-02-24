<?php
    // Crea la conexión
    $conex = mysqli_connect("localhost", "root", "", "higea_db");

    // Verifica la conexión
    if ($conex->connect_error) {
        die("Conexión fallida: " . $conex->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])) {
        echo "<script>alert('Error en datos recibidos.');</script>";
        header('Location: ./gestion/gestion_usuarios.php', true, 303);
        exit;
    }
    $id = $_POST['id'];

    require "./sweet.php";
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Preguntas de Seguridad"));

    session_start();

    // Guarda los datos recibidos por el método POST en dos variables
    $r1 = $_POST['r1'];
    $r2 = $_POST['r2'];
    $r3 = $_POST['r3'];

    // Escapa los caracteres especiales en las variables para evitar inyecciones SQL
    $r1 = $conex->real_escape_string($r1);
    $r2 = $conex->real_escape_string($r2);
    $r3 = $conex->real_escape_string($r3);

    // Ejecuta la consulta SQL para verificar si los datos ingresados coinciden con alguno de los datos almacenados en la tabla recup_password
    $resultado = $conex->query("SELECT id_usuario FROM recup_password WHERE r1 = '$r1' AND r2 = '$r2' AND r3 = '$r3' AND ID_Usuario = '$id'");

    if (mysqli_num_rows($resultado) > 0) {
        // Si hay una coincidencia, guarda el ID  del usuario en una variable y redirige a una página
        $row = mysqli_fetch_assoc($resultado); //se usa para obtener una fila de resultados como una matriz asociativa
        //luego se puede acceder a los campos individuales de la fila por su nombre
        $_SESSION['id_user'] = $row['id_usuario'];
        header('Location: ../nueva-contrasena.php');
    } else {
        die (
            "   <script>
                    Swal.fire({
                        title: 'Error: Una o mas respuestas incorrectas',
                        icon: 'warning',
                        timer: 15000,
                        confirmButtonText: 'Regresar',
                        customClass: {
                            confirmButton: 'boton-higea',
                        }
                    })
                    .then(
                        (click) => {
                            var form = document.createElement('form');
                            form.method = 'POST';
                            form.action = '../preguntas-seguridad.php';
                            
                            var campo = document.createElement('input');
                            campo.type = 'hidden';
                            campo.name = 'id';
                            campo.value = '$id';
                            form.appendChild(campo);
                            
                            document.body.appendChild(form);
                            form.submit();
                        }
                    );
                </script>
            </html>"
        );
    }

    $conex->close();
