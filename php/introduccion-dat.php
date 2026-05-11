<?php
/* CONEXIÓN A LA BASE DE DATOS */

   $host = "localhost";
   $usuario = "root";
   $contrasena = "";
   $base_datos = "polyglotnow";

   $conexion = mysqli_connect($host, $usuario, $contrasena, $base_datos) or die("Error de conexión: " . mysqli_connect_error());

   /* CAPTAR LOS DATOS DEL FORMULARIO */

   $user = mysqli_real_escape_string($conexion,$_POST["user"]);
   $contra = mysqli_real_escape_string($conexion,$_POST["password"]);
   $lan = mysqli_real_escape_string($conexion,$_POST["lan"]);
   $c_ing = isset($_POST["c_ing"]) ? 1 : 0;
   $c_esp = isset($_POST["c_esp"]) ? 1 : 0;
   $c_fra = isset($_POST["c_fra"]) ? 1 : 0;
   $c_ita = isset($_POST["c_ita"]) ? 1 : 0;
   $c_ale = isset($_POST["c_ale"]) ? 1 : 0;
   $c_rum = isset($_POST["c_rum"]) ? 1 : 0;
   
   $sql = "INSERT INTO usuarios(usuario,contra,idioma,c_ing,c_esp,c_fra,c_ita,c_ale,c_rum) 
   VALUES ('$user','$contra','$lan',$c_ing,$c_esp,$c_fra,$c_ita,$c_ale,$c_rum)";

   $duplicado = false;

   $idioma_usuario = strtolower(trim($lan));
   $idioma_usuario = str_replace(['ñ', 'á', 'é', 'í', 'ó', 'ú'], ['n', 'a', 'e', 'i', 'o', 'u'], $idioma_usuario);      

   if (strpos($idioma_usuario, 'english') !== false || strpos($idioma_usuario, 'ingles') !== false) {
      $idioma_usuario = 'english';
   } elseif (strpos($idioma_usuario, 'espanol') !== false || strpos($idioma_usuario, 'español') !== false) {
      $idioma_usuario = 'espanol';
   } else {
      $idioma_usuario = 'espanol';
   }

    $traducciones = [
      'espanol' => [
         'titulo' => 'La cuenta ha sido creada exitósamente.',
         'coment' => 'Haz <a href="../index.html">clic aquí</a> para volver al inicio de sesión.',
         'tit_er' => 'Ese nombre de usuario ya existe.',
         'com_er' => 'Intente crear un usuario con otro nombre, vuelva a la página haciendo clic <a href="../html/sesion/registro.html">aquí</a>.'
      ],
      'english' => [
         'titulo' => 'The account has been created succesfully',
         'coment' => 'Click <a href="../index.html">here</a> to return to log in.',
         'tit_er' => 'That account name already exists.',
         'com_er' => 'Try to make the user with another name, return to the webpage doing click <a href="../html/sesion/registro.html">here</a>.'
      ]
    ];

   // Verificar si el usuario ya existe
   $check_user_query = "SELECT * FROM usuarios WHERE usuario = '$user'";
   $result = mysqli_query($conexion, $check_user_query);

   if (mysqli_num_rows($result) > 0) {
      $duplicado = true;
   } else {
      if (!mysqli_query($conexion,$sql)) {
         die("Error al insertar los datos: ".mysqli_error($conexion));
      }
   }

   mysqli_close($conexion);
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
   <div class="pri" style="margin: 0 auto">
   <?php
      if ($duplicado) {
         echo '<h4>'. $traducciones[$idioma_usuario]['tit_er'] .'</h4>';
         echo '<h5>'. $traducciones[$idioma_usuario]['com_er'] .'</h5>';
      } else {
         echo '<h4>'. $traducciones[$idioma_usuario]['titulo'] .'</h4>';
         echo '<h5>'. $traducciones[$idioma_usuario]['coment'] .'</h5>';
      }
   ?>
   </div>
   </div>
</body>
</html>