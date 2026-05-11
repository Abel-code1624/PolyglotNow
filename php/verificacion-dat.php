<?php
/* CONEXIÓN A LA BASE DE DATOS */
    session_start();

   $host = "localhost";
   $usuario = "root";
   $contrasena = "";
   $base_datos = "polyglotnow";

   $conexion = mysqli_connect($host, $usuario, $contrasena, $base_datos) or die("Error de conexión: " . mysqli_connect_error());

/* CAPTAR LOS DATOS DEL FORMULARIO */

    $user = mysqli_real_escape_string($conexion,$_POST["user"]);
    $contra = mysqli_real_escape_string($conexion,$_POST["password"]);
    $idioma = $_POST['idioma'] ?? 'es';

    $sql = "SELECT * FROM usuarios WHERE usuario = '$user'";

    $result = mysqli_query($conexion,$sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['contra'] === $contra) {
            if ((int)$row['es_admin'] === 1) {
                $_SESSION['user'] = $user;
                header("Location: admin.php");
                exit;
            } else {
                $_SESSION['user'] = $user;
                header("Location: cursos.php");
                exit;
            }
        } else {
            $mensaje = ($idioma == "es") ? "<h4 style='text-align: center;'>El usuario o la contraseña no son correctos</h4>":
            "<h4 style='text-align: center;'>The username or password is not correct</h4>";

            $mensaje_enl = ($idioma == "es") ? "<p>Haz <a href='../index.html'>clic aquí</a> para volver al inicio de sesión.</p>" :
            "<p>Click <a href='../index.html'>here </a> to turn back to log in.</p>";
        }
    } else {
        $mensaje = ($idioma == "es") ? "<h4 style='text-align: center;'>El usuario o la contraseña no son correctos</h4>":
        "<h4 style='text-align: center;'>The username or password is not correct</h4>";

        $mensaje_enl = ($idioma == "es") ? "<p>Haz <a href='../index.html'>clic aquí</a> para volver al inicio de sesión.</p>" :
        "<p>Click <a href='../index.html'>here </a> to turn back to log in.</p>";
    }
    //echo "Idioma recibido '".$idioma."'";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar cuenta</title>
    <link rel="stylesheet" href="../css/sesion.css">
    <link rel="icon" href="../img/icon.png">
</head>
<body>
    <div class="cab">
        <img class="logo" src="../img/logo.png">        
    </div>
    <div class="pri" style="margin: 0 auto">
        <?php echo $mensaje ?>
    </div>
    <?php echo $mensaje_enl ?>
</body>
<script src="js/index.js"></script>
</html>