<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

   $host = "localhost";
   $usuario = "root";
   $contrasena = "";
   $base_datos = "polyglotnow";

   $conexion = mysqli_connect($host, $usuario, $contrasena, $base_datos) or die("Error de conexión: " . mysqli_connect_error());
   
   /*$titulo = $_POST['titulo'];
   $sql_id_ejercicio = "SELECT num_test FROM tests WHERE nom_test = $titulo";*/
   
   $user = mysqli_real_escape_string($conexion,$_POST["user"]);
   $titulo = mysqli_real_escape_string($conexion,trim($_POST['titulo']));
   $nota = mysqli_real_escape_string($conexion,$_POST['percentText']);

   $query = "SELECT num_test FROM tests WHERE nom_test = '$titulo'";
   $resultado = mysqli_query($conexion,$query);

   if (!$resultado) {
    die("Error en la consulta: ". mysqli_error($conexion));
   }

   if (mysqli_num_rows($resultado) == 0) {
        die("No se encontró el test con ese título");
   }

   $fila = mysqli_fetch_assoc($resultado);
   $id_ejercicio = $fila['num_test'];

   $sql_envio = "INSERT INTO puntuacion(usuario,num_test,puntuacion) VALUES('$user','$id_ejercicio','$nota')";

   //mysqli_query($conexion,$sql_envio) or die("Ocurrió un error en la inserción".mysqli_error($conexion));

   if (mysqli_query($conexion, $sql_envio)) {
      echo "OK"; // <-- respuesta simple para el fetch
   } else {
      echo "Error en la inserción: " . mysqli_error($conexion);
   }

   mysqli_close($conexion);
?>