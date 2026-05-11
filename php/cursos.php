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

    $sql = "SELECT idioma, c_ing, c_esp, c_fra, c_ita, c_ale, c_rum, es_admin FROM usuarios WHERE usuario = '$user'";
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
            'titulo' => 'Bienvenid@',
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
            'rem' => 'Borrar cuenta',
            'adm' => '<a href="admin.php" style="color: white;">Modo administrador</a>',
            'titulo_emer' => 'Borrar cuenta',
            'coment_emer' => 'Si borra la cuenta, perderá todo el progreso que haya conseguido, ¿quiere borrar la cuenta?',
            'si_emer' => 'Borrar',
            'no_emer' => 'Cancelar',
            'titulo_conf' => 'La cuenta ha sido borrada exitósamente.',
            'coment_conf' => 'Haz <a href="../index.html">clic aquí</a> para volver al inicio de sesión.'
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
            'rem' => 'Delete account',
            'adm' => '<a href="admin.php" style="color: white;">Administrator mode</a>',
            'titulo_emer' => 'Delete account',
            'coment_emer' => 'If you delete the account, you will lost all the progress that you had earnt, ¿do you want to delete the account?',
            'si_emer' => 'Delete',
            'no_emer' => 'Cancel',
            'titulo_conf' => 'The account was deleted succesfully .',
            'coment_conf' => 'Click <a href="../index.html">here</a> to turn back to log in.'
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
    <link rel="stylesheet" href="../html/emergente/emergente.css">
    <script src="../html/emergente/emergente.js"></script>
</head>
<body>
    <div class="cab">
        <img class="logo" src="../img/logo.png">
    </div>
    <div class="pri">
        <h1><?php echo $traducciones[$idioma_usuario]['titulo'].', '. $user;?></h1>
        <?php
            $cursos_mostrados = false;
            
            // Mostrar inglés solo si no es idioma nativo y está seleccionado
            if ($idioma_usuario != 'english' && $row['c_ing']) {
                echo '<a class="enl" href="../html/idiomas/es/english.php"><div class="lang"><img class="ban" src="../img/banderas/uk.png"><h2 class="let-tit">' . $traducciones[$idioma_usuario]['ing'] . '</h2></div></a><br>';
                $cursos_mostrados = true;
            }
            
            // Mostrar español solo si no es idioma nativo y está seleccionado
            if ($idioma_usuario != 'espanol' && $row['c_esp']) {
                echo '<a class="enl" href="../html/idiomas/en/spanish.php"><div class="lang"><img class="ban" src="../img/banderas/esp.png"><h2 class="let-tit">' . $traducciones[$idioma_usuario]['esp'] . '</h2></div></a><br>';
                $cursos_mostrados = true;
            }
            
            // Mostrar otros idiomas (siempre que estén seleccionados)
            if ($row['c_fra']) {
                if ($idioma_usuario == 'english') {
                    echo '<a class="enl" href="../html/idiomas/en/french-en.php"><div class="lang"><img class="ban" src="../img/banderas/fr.png"><h2 class="let-tit">' . $traducciones[$idioma_usuario]['fra'] . '</h2></div></a><br>';
                    $cursos_mostrados = true;
                } else {
                    echo '<a class="enl" href="../html/idiomas/es/french.php"><div class="lang"><img class="ban" src="../img/banderas/fr.png"><h2 class="let-tit">' . $traducciones[$idioma_usuario]['fra'] . '</h2></div></a><br>';
                    $cursos_mostrados = true;                    
                }
            }
            if ($row['c_ita']) {
                if ($idioma_usuario == 'english') {
                    echo '<a class="enl" href="../html/idiomas/en/italian-en.php"><div class="lang"><img class="ban" src="../img/banderas/it.png"><h2 class="let-tit">' . $traducciones[$idioma_usuario]['ita'] . '</h2></div></a><br>';
                    $cursos_mostrados = true;
                } else {
                    echo '<a class="enl" href="../html/idiomas/es/italian.php"><div class="lang"><img class="ban" src="../img/banderas/it.png"><h2 class="let-tit">' . $traducciones[$idioma_usuario]['ita'] . '</h2></div></a><br>';
                    $cursos_mostrados = true;                    
                }
            }
            if ($row['c_ale']) {
                if ($idioma_usuario == 'english') {
                    echo '<a class="enl" href="../html/idiomas/en/german-en.php"><div class="lang"><img class="ban" src="../img/banderas/de.png"><h2 class="let-tit">' . $traducciones[$idioma_usuario]['ale'] . '</h2></div></a><br>';
                    $cursos_mostrados = true;
                } else {
                    echo '<a class="enl" href="../html/idiomas/es/german.php"><div class="lang"><img class="ban" src="../img/banderas/de.png"><h2 class="let-tit">' . $traducciones[$idioma_usuario]['ale'] . '</h2></div></a><br>';
                    $cursos_mostrados = true;                    
                }
            }
            if ($row['c_rum']) {
                if ($idioma_usuario == 'english') {
                    echo '<a class="enl" href="../html/idiomas/en/romanian-en.php"><div class="lang"><img class="ban" src="../img/banderas/ro.png"><h2 class="let-tit">' . $traducciones[$idioma_usuario]['rum'] . '</h2></div></a><br>';
                    $cursos_mostrados = true;
                } else {
                    echo '<a class="enl" href="../html/idiomas/es/romanian.php"><div class="lang"><img class="ban" src="../img/banderas/ro.png"><h2 class="let-tit">' . $traducciones[$idioma_usuario]['rum'] . '</h2></div></a><br>';
                    $cursos_mostrados = true;                    
                }
            }
            
            // Mensaje si no hay cursos
            if (!$cursos_mostrados) {
                echo '<p>' . $traducciones[$idioma_usuario]['no_cursos'] . '</p>';
            }

            // Agregar idiomas
            if ($idiomas_activos < 5) {
                /*if ($idioma_usuario == 'english') {
                    echo '<a href="../html/idiomas/en/idiomas-en.html"><div class="lang"><img style="margin: 0 auto" src="../img/mas2.png"></div></a>';
                } else {
                    echo '<a href="../html/idiomas/es/idiomas.html"><div class="lang"><img style="margin: 0 auto" src="../img/mas2.png"></div></a>';
                } */
                echo '<a href="../php/idiomas.php"><div class="lang"><img style="margin: 0 auto" src="../img/mas2.png"></div></a>';      
            }
        ?><br>
        <a style="text-decoration: none; color: black;" class="dele" href="../php/idiomas-er.php"><div class="ses" style="margin: 0 auto;"><?php echo $traducciones[$idioma_usuario]['del'] ?></div></a>
    </div>
    <div class="enla">
        <a href="../index.html" class="textot"><p><?php echo $traducciones[$idioma_usuario]['atr'] ?></p></a>&nbsp;&nbsp;
        <?php if (!empty($row['es_admin']) && $row['es_admin'] == 1): ?>
            <a href="admin.php" style="color: white;">
                <p><?php echo $traducciones[$idioma_usuario]['adm']; ?></p>
            </a>
        <?php else: ?>
            <p id="openPopup" style="text-decoration: underline; cursor:pointer;">                    
                <?php echo $traducciones[$idioma_usuario]['rem']; ?>
            </p>
        <?php endif; ?>      
    </div>
    <!-- La ventana emergente -->
    <div id="popup" class="overlay">
        <div class="popup-content">
            <h2 id="popup-title"></h2>
            <p id="popup-text"></p>
            <div class="btns">
                <button id="popup-confirm" class="exit"></button>
                <button id="popup-cancel" class="cont"></button>
            </div>
        </div>
    </div>
</body>
</html>
<script>
const lang = localStorage.getItem("lang") || "ES";

const traducciones = {

    ES: {
        titulo: "Borrar cuenta",
        texto: "Perderá todo el progreso.<br><br>¿Desea continuar?",
        borrar: "Borrar",
        cancelar: "Cancelar"
    },
    EN: {
        titulo: "Delete account",
        texto: "You will lose all your progress.<br><br>Do you want to continue?",
        borrar: "Delete",
        cancelar: "Cancel"
    }
};

const t = traducciones[lang];

document.getElementById("openPopup").addEventListener("click", () => {

    showPopup({

        title: t.titulo,
        text: t.texto,

        confirmText: t.borrar,
        cancelText: t.cancelar,

        onConfirm: () => {
            window.location.href = "eliminar-usuario.php";
        }
    });
});
</script>
<?php mysqli_close($conexion); ?>