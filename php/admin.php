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
    $sql = "SELECT idioma, c_ing, c_esp, c_fra, c_ita, c_ale, c_rum FROM usuarios WHERE usuario = '$user'";
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

    /* $idioma_usuario = $row['idioma']; */

    $traducciones = [
        'espanol' => [
            'titulo' => 'Bienvenido',
            'cursos' => 'Mis cursos',
            'ing' => 'Inglés',
            'esp' => 'Español',
            'fra' => 'Francés',
            'ita' => 'Italiano',
            'ale' => 'Alemán',
            'rum' => 'Rumano',
            'no_cursos' => 'No estás inscrito en ningún curso',
            'atr' => 'Cerrar sesión',
            'del' => 'Eliminar idioma',
            'cam' => 'Modo usuario'
        ],
        'english' => [
            'titulo' => 'Welcome',
            'cursos' => 'My courses',
            'ing' => 'English',
            'esp' => 'Spanish',
            'fra' => 'French',
            'ita' => 'Italian',
            'ale' => 'German',
            'rum' => 'Romanian',
            'no_cursos' => 'You are not enrolled in any courses',
            'atr' => 'Log out',
            'del' => 'Delete language',
            'cam' => 'User mode'
        ]
    ];

    $idiomas_activos = 0;
    if ($idioma_usuario != 'english' && $row['c_ing']) $idiomas_activos++;
    if ($idioma_usuario != 'espanol' && $row['c_esp']) $idiomas_activos++;
    if ($row['c_fra']) $idiomas_activos++;
    if ($row['c_ita']) $idiomas_activos++;
    if ($row['c_ale']) $idiomas_activos++;
    if ($row['c_rum']) $idiomas_activos++;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $traducciones[$idioma_usuario]['titulo'].', '. $user; ?></title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/idiomas.css">
    <link rel="stylesheet" href="../css/sesion.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div style="display:flex; gap:10px;">
        <div class="pri flexible">
            <p style="text-align: center; color: black;">Filtros</p>
            <form id="filtroForm" method="GET">
                <select name="filtros" id="filtros">
                    <option value="0">Seleccione un filtro</option>
                    <option value="1">Idioma</option>
                    <option value="2">Usuario</option>
                    <option value="3">Fechas</option>
                </select><br><br>

                <div id="opciones"></div>
                <br>
                <button type="submit"">Aplicar filtro</button>
            </form>
        </div> 
        <div class="pri flexible">
            <!-- <p style="text-align: center; color: black;">Datos</p> -->
            <?php
                $fil=$_GET['filtros'] ?? "";
                $tipo = $_GET['tipo'] ?? "";
                if($conexion){
                    mysqli_select_db($conexion,"polyglotnow") or die("ERROR EN LA CONEXIÓN DE LA BASE DE DATOS");
                    if($fil=="0") {
                        echo "<p style='text-align: center; color: black;'>Seleccione un filtro para mostrar datos</p>";
                    }
                    if($fil=="1") { // Filtro por idioma
                        if($tipo==01) {
                            $sql="SELECT 'Inglés' AS idioma, SUM(c_ing) AS usuarios FROM usuarios
                                UNION ALL
                                SELECT 'Español', SUM(c_esp) FROM usuarios
                                UNION ALL
                                SELECT 'Francés', SUM(c_fra) FROM usuarios
                                UNION ALL
                                SELECT 'Italiano', SUM(c_ita) FROM usuarios
                                UNION ALL
                                SELECT 'Alemán', SUM(c_ale) FROM usuarios
                                UNION ALL
                                SELECT 'Rumano', SUM(c_rum) FROM usuarios;";

                            $rescon=mysqli_query($conexion,$sql);
                            $nfilas=mysqli_num_rows($rescon);
                            if($nfilas > 0) {
                                echo "<p style='text-align: center; color: black;'>Usuarios por idioma<p>";
                                echo "<table border='1' style='margin:0 auto'>";
                                echo "<tr>";
                                echo "<th>Idiomas</th>";
                                echo "<th>Nº de usuarios</th>";
                                echo "</tr>";
                                }

                            for ($i=0;$i<$nfilas;$i++) {
                                $res=mysqli_fetch_array($rescon);
                                echo "<tr>";
                                echo "<td>".$res["idioma"]."</td>";
                                echo "<td>".$res["usuarios"]."</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        if($tipo==02) {
                            $sql="SELECT 
                                CASE 
                                    WHEN RIGHT(num_test, 2) = 'EN' THEN 'Inglés'
                                    WHEN RIGHT(num_test, 2) = 'FR' THEN 'Francés'
                                    WHEN RIGHT(num_test, 2) = 'DE' THEN 'Alemán'
                                    WHEN RIGHT(num_test, 2) = 'IT' THEN 'Italiano'
                                    WHEN RIGHT(num_test, 2) = 'RO' THEN 'Rumano'
                                    ELSE RIGHT(num_test, 2)
                                END AS idioma,
                                COUNT(*) AS total_tests,
                                AVG(puntuacion) AS puntuacion_media
                            FROM puntuacion 
                            GROUP BY RIGHT(num_test, 2)
                            ORDER BY puntuacion_media DESC;";

                            $rescon=mysqli_query($conexion,$sql);
                            $nfilas=mysqli_num_rows($rescon);
                            if($nfilas > 0) {
                                echo "<p style='text-align: center; color: black;'>Puntuación media por idioma<p>";
                                echo "<table border='1' style='margin:0 auto'>";
                                echo "<tr>";
                                echo "<th>Nombre de usuario</th>";
                                echo "<th>Ejercicio y tema</th>";
                                echo "<th>Puntuación</th>";
                                echo "</tr>";
                                }

                            for ($i=0;$i<$nfilas;$i++) {
                                $res=mysqli_fetch_array($rescon);
                                echo "<tr>";
                                echo "<td>".$res["idioma"]."</td>";
                                echo "<td>".$res["total_tests"]."</td>";
                                echo "<td>".round($res["puntuacion_media"])."</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        if($tipo==03) {
                            $sql="SELECT 'Inglés' AS idioma, COUNT(*) AS 'No Tests' FROM puntuacion WHERE num_test LIKE '%_EN'
                                UNION ALL
                                SELECT 'Español', COUNT(*) FROM puntuacion WHERE num_test LIKE '%_ES'
                                UNION ALL
                                SELECT 'Francés', COUNT(*) FROM puntuacion WHERE num_test LIKE '%_FR'
                                UNION ALL
                                SELECT 'Alemán', COUNT(*) FROM puntuacion WHERE num_test LIKE '%_DE'
                                UNION ALL
                                SELECT 'Italiano', COUNT(*) FROM puntuacion WHERE num_test LIKE '%_IT'
                                UNION ALL
                                SELECT 'Rumano', COUNT(*) FROM puntuacion WHERE num_test LIKE '%_RO';";

                                $rescon=mysqli_query($conexion,$sql);
                                $nfilas=mysqli_num_rows($rescon);
                                if($nfilas > 0) {
                                    echo "<table border='1' style='margin:0 auto'>";
                                    echo "<tr>";
                                    echo "<th>Idioma</th>";
                                    echo "<th>Nº Tests</th>";
                                    echo "</tr>";
                                }

                                for($i=0;$i<$nfilas;$i++) {
                                    $res=mysqli_fetch_array($rescon);
                                    echo "<tr>";
                                    echo "<td>".$res["idioma"]."</td>";
                                    echo "<td>".$res["No Tests"]."</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                        }
                    }
                    if($fil=="2") { // Filtro por usuario
                        $user_sele = $_GET['usuario_bd'] ?? "";

                        if($user_sele) {
                            $res="SELECT usuario,idioma,c_ing,c_esp,c_fra,c_ale,c_ita,c_rum 
                              FROM usuarios
                              WHERE usuario = '".mysqli_real_escape_string($conexion,$user_sele)."';";
                            $rescon=mysqli_query($conexion,$res);
                            if($rescon && mysqli_num_rows($rescon) > 0){
                                $row_user = mysqli_fetch_assoc($rescon);
                                echo "<table border='1' style='margin:0 auto'>";
                                echo "<tr>";
                                echo "<th colspan=7 style='text-align:center'>Idiomas seleccionados por ".$user_sele."</th>";
                                echo "</tr><tr>";
                                echo "<th>Idioma</th><th>Inglés</th><th>Español</th><th>Francés</th><th>Italiano</th><th>Alemán</th><th>Rumano</th>";
                                echo "<tr>";
                                echo "<td>".$row_user["idioma"]."</td>";
                                echo "<td>".($row_user["c_ing"] ? 'Sí' : 'No')."</td>";
                                echo "<td>".($row_user["c_esp"] ? 'Sí' : 'No')."</td>";
                                echo "<td>".($row_user["c_fra"] ? 'Sí' : 'No')."</td>";
                                echo "<td>".($row_user["c_ita"] ? 'Sí' : 'No')."</td>";
                                echo "<td>".($row_user["c_ale"] ? 'Sí' : 'No')."</td>";
                                echo "<td>".($row_user["c_rum"] ? 'Sí' : 'No')."</td>";
                                echo "</tr>";
                                echo "</table>";
                            }
                            $res2="SELECT num_test,usuario,puntuacion,fecha_hora
                                  FROM puntuacion
                                  WHERE usuario = '".mysqli_real_escape_string($conexion,$user_sele)."';";
                            $rescon2=mysqli_query($conexion,$res2);
                            if($rescon2 && mysqli_num_rows($rescon2) > 0){
                                echo "<br><table border='1' style='margin:0 auto'>";
                                echo "<tr>";
                                echo "<th colspan=4 style='text-align: center'>Tests realizados por ".$user_sele."</th>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>No Test</th>";
                                echo "<th>Puntuación</th>";
                                echo "<th>Fecha y hora</th>";
                                echo "</tr>";
                                while ($row_user2 = mysqli_fetch_assoc($rescon2)) {
                                    echo "<tr>";
                                    echo "<td>".$row_user2["num_test"]."</td>";
                                    echo "<td>".$row_user2["puntuacion"]."</td>";
                                    echo "<td>".$row_user2["fecha_hora"]."</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "<p>No hay tests realizados por el usuario seleccionado.</p>";
                            }
                        }
                    }
                    if($fil=="3") { // Filtro por fechas
                        $inicio = $_GET["inicio_date"] ?? "";
                        $final = $_GET["final_date"] ?? "";

                        if($inicio && $final) {
                            $sql="SELECT num_test,usuario,puntuacion,fecha_hora
                            FROM puntuacion 
                            WHERE fecha_hora BETWEEN '".mysqli_real_escape_string($conexion,$inicio)."' AND '".mysqli_real_escape_string($conexion,$final)."'";

                            $rescon=mysqli_query($conexion,$sql);
                            if($rescon && mysqli_num_rows($rescon) > 0){
                                echo "<table border='1' style='margin:0 auto'>";
                                echo "<tr>";
                                echo "<th colspan=4 style='text-align: center'>Datos entre ".$inicio." y ".$final."</th>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>No Test</th>";
                                echo "<th>Usuario</th>";
                                echo "<th>Puntuación</th>";
                                echo "<th>Fecha y hora</th>";
                                echo "</tr>";

                                while($row = mysqli_fetch_array($rescon)){
                                    echo "<tr>";
                                    echo "<td>".$row["num_test"]."</td>";
                                    echo "<td>".$row["usuario"]."</td>";
                                    echo "<td>".$row["puntuacion"]."</td>";
                                    echo "<td>".$row["fecha_hora"]."</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "<p>No hay datos en el rango seleccionado.</p>";
                            }
                        } else {
                            echo "<p>Seleccione fechas de inicio y fin.</p>";
                        }
                    }
                }
            ?>
        </div>
    </div>

    <div class="enla">
        <a href="../index.html" class="textot"><p><?php echo $traducciones[$idioma_usuario]['atr'] ?></p></a>&nbsp;&nbsp;
        <a href="cursos.php" class="textot"><p><?php echo $traducciones[$idioma_usuario]['cam'] ?></p></a>        
    </div>
</body>
<script>
    document.getElementById("filtros").addEventListener("change", function() {

        const cont = document.getElementById("opciones");
        cont.innerHTML = ""; // Limpiar radios previos
        const val = this.value;

        if(val == "1") { 
            // --- Radios para filtro por idioma ---
            cont.innerHTML = `
                <label><input type="radio" name="tipo" value="01" selected> Usuarios por idioma</label><br>
                <label><input type="radio" name="tipo" value="02"> Puntuación media por idioma</label><br>
                <label><input type="radio" name="tipo" value="03"> Tests realizados por idioma</label>
            `;
        }

        if(val == "2") { 
            // --- Radios para filtro por usuario ---
            fetch('get_usuarios.php')
            .then(response => response.text())
            .then(html => {
                cont.innerHTML = html;
            });
        }

        if(val == "3") {
            // --- Radios para filtro por fechas ---
            cont.innerHTML = `
                <label>Introduce un periodo entre dos fechas</label><br><br>
                <input type="date" id="inicio-date" name="inicio_date"><br><br>
                <input type="date" id="final-date" name="final_date">`;
        }
    });     
</script>
</html>