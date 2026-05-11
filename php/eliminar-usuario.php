<?php

    session_start();

    if(!isset($_SESSION['user'])) {
        die("Error: Usuario no autenticado. <a href='../html/sesion/sesion.html'>Volver al inicio de sesión</a>");
    }

    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "polyglotnow";
    $conexion = mysqli_connect($host, $usuario, $contrasena, $base_datos) or die("Error de conexión: " . mysqli_connect_error());

    $user = $_SESSION['user'];

    $sql = "SELECT usuario, idioma FROM usuarios WHERE usuario = '$user'";
    $result = mysqli_query($conexion, $sql);

    if (!$result || mysqli_num_rows($result) === 0) {
        die("Error: Usuario no encontrado en la base de datos.");
    }

    $row = mysqli_fetch_assoc($result);

        // Normalizar el valor del idioma
    $idioma_usuario = strtolower(trim($row['idioma']));
    $idioma_usuario = str_replace(['ñ', 'á', 'é', 'í', 'ó', 'ú'], ['n', 'a', 'e', 'i', 'o', 'u'], $idioma_usuario);

    // Mapeo de valores posibles a 'english' o 'espanol'
    if (strpos($idioma_usuario, 'english') !== false || strpos($idioma_usuario, 'ingles') !== false) {
        $idioma_usuario = 'english';
    } elseif (strpos($idioma_usuario, 'espanol') !== false || strpos($idioma_usuario, 'español') !== false) {
        $idioma_usuario = 'espanol';
    } else {
        $idioma_usuario = 'espanol'; // Valor por defecto
    }

    $traducciones = [
        'espanol' => [
            'titulo_emer' => 'Borrar cuenta',
            'coment_emer' => 'Si borra la cuenta, perderá todo el progreso que haya conseguido, ¿quiere borrar la cuenta?',
            'si_emer' => 'Borrar',
            'no_emer' => 'Cancelar',
            'titulo_conf' => 'La cuenta ha sido borrada exitósamente.',
            'coment_conf' => 'Haz <a href="../index.html">clic aquí</a> para volver al inicio de sesión.'
        ],
        'english' => [
            'titulo_emer' => 'Delete account',
            'coment_emer' => 'If you delete the account, you will lost all the progress that you had earnt, ¿do you want to delete the account?',
            'si_emer' => 'Delete',
            'no_emer' => 'Cancelar',
            'titulo_conf' => 'The account was deleted succesfully .',
            'coment_conf' => 'Click <a href="../index.html">here</a> to turn back to log in.'
        ]
    ];

    $sql2 = "DELETE FROM usuarios WHERE usuario = '$user'";
    $result2 = mysqli_query($conexion,$sql2);

   mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Eliminar cuenta</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../img/icon.png">
        <link rel="stylesheet" href="../css/sesion.css">
        <link rel="stylesheet" href="../html/emergente/emergente.css">
        <script src="../html/emergente/emergente.js"></script>
    </head>
    <body>
        <div class="cab">
            <img class="logo" src="../img/logo.png">
        <div class="pri" style="margin: 0 auto">
            <?php echo '<h4>'.$traducciones[$idioma_usuario]['titulo_conf'].'</h4>'; ?>
            <?php echo '<h5>'.$traducciones[$idioma_usuario]['coment_conf'].'</h5>'; ?>
        </div>
        </div>
    </body>
</html>