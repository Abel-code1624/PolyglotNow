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

// Consulta CORRECTA para obtener los idiomas del usuario
$sql = "SELECT idioma, c_ing, c_esp, c_fra, c_ita, c_ale, c_rum FROM usuarios WHERE usuario = '$user'";
$result = mysqli_query($conexion, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    die("Error: Usuario no encontrado en la base de datos.");
}

$row = mysqli_fetch_assoc($result);

// Procesar idioma nativo
$idioma_usuario = strtolower(trim($row['idioma']));
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
        'titulo' => 'Elimina un idioma',
        'ing' => 'Inglés',
        'esp' => 'Español',
        'fra' => 'Francés',
        'ita' => 'Italiano',
        'ale' => 'Alemán',
        'rum' => 'Rumano',
        'max_idiomas' => 'Has alcanzado el máximo de idiomas (5)',
        'min_idiomas' => 'No tienes ningún idioma agregado',
        'atr' => 'Volver'
    ],
    'english' => [
        'titulo' => 'Delete a language',
        'ing' => 'English',
        'esp' => 'Spanish',
        'fra' => 'French',
        'ita' => 'Italian',
        'ale' => 'German',
        'rum' => 'Romanian',
        'max_idiomas' => 'You have reached the maximum languages (5)',
        'min_idiomas' => 'You don\'t have any languages added',
        'atr' => 'Return'
    ]
];

// Contar idiomas activos (excluyendo nativo)
$idiomas_activos = 0;
if ($idioma_usuario != 'english' && $row['c_ing']) $idiomas_activos++;
if ($idioma_usuario != 'espanol' && $row['c_esp']) $idiomas_activos++;
if ($row['c_fra']) $idiomas_activos++;
if ($row['c_ita']) $idiomas_activos++;
if ($row['c_ale']) $idiomas_activos++;
if ($row['c_rum']) $idiomas_activos++;

// Procesar agregar idioma
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idioma'])) {
    $idioma = $_POST['idioma'];
    $permitidos = ['c_ing', 'c_esp', 'c_fra', 'c_ita', 'c_ale', 'c_rum'];
    
    if (in_array($idioma, $permitidos) && $idiomas_activos < 5) {
        $sql = "UPDATE usuarios SET $idioma = 1 WHERE usuario = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        // Actualizar $row después de la actualización
        $result = mysqli_query($conexion, "SELECT c_ing, c_esp, c_fra, c_ita, c_ale, c_rum FROM usuarios WHERE usuario = '$user'");
        $row = mysqli_fetch_assoc($result);
        
        // Recalcular idiomas activos
        $idiomas_activos = 0;
        if ($idioma_usuario != 'english' && $row['c_ing']) $idiomas_activos++;
        if ($idioma_usuario != 'espanol' && $row['c_esp']) $idiomas_activos++;
        if ($row['c_fra']) $idiomas_activos++;
        if ($row['c_ita']) $idiomas_activos++;
        if ($row['c_ale']) $idiomas_activos++;
        if ($row['c_rum']) $idiomas_activos++;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $traducciones[$idioma_usuario]['titulo'] ?></title>
    <link rel="stylesheet" href="../css/sesion.css">
    <link rel="stylesheet" href="../css/idiomas.css">
    <link rel="icon" href="../img/icon.png">
    <style>
        .lang-form {
            /* display: inline-block; */
            margin: 10px;
        }
        .lang-button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="cab">
        <img class="logo" src="../img/logo.png">
    </div>
    <div class="pri">
        <h1><?php echo $traducciones[$idioma_usuario]['titulo'];?></h1>
        
        <?php if ($idiomas_activos > 0): ?>
            <div class="idiomas-container">
                <?php if ($idioma_usuario != 'english' && $row['c_ing']): ?>
                    <form method="POST" class="lang-form" action="eliminar-idioma.php">
                        <input type="hidden" name="idioma" value="c_ing">
                        <button type="submit" class="lang-button">
                            <div class="ses">
                                <img class="ban" src="../img/banderas/uk.png">
                                <h2 class="let-tit"><?php echo $traducciones[$idioma_usuario]['ing']; ?></h2>
                            </div>
                        </button>
                    </form>
                <?php endif; ?>
                
                <?php if ($idioma_usuario != 'espanol' && $row['c_esp']): ?>
                    <form method="POST" class="lang-form" action="eliminar-idioma.php">
                        <input type="hidden" name="idioma" value="c_esp">
                        <button type="submit" class="lang-button">
                            <div class="ses">
                                <img class="ban" src="../img/banderas/esp.png">
                                <h2 class="let-tit"><?php echo $traducciones[$idioma_usuario]['esp']; ?></h2>
                            </div>
                        </button>
                    </form>
                <?php endif; ?>
                
                <?php if ($row['c_fra']): ?>
                    <form method="POST" class="lang-form" action="eliminar-idioma.php">
                        <input type="hidden" name="idioma" value="c_fra">
                        <button type="submit" class="lang-button">
                            <div class="ses">
                                <img class="ban" src="../img/banderas/fr.png">
                                <h2 class="let-tit"><?php echo $traducciones[$idioma_usuario]['fra']; ?></h2>
                            </div>
                        </button>
                    </form>
                <?php endif; ?>
                
                <?php if ($row['c_ita']): ?>
                    <form method="POST" class="lang-form" action="eliminar-idioma.php">
                        <input type="hidden" name="idioma" value="c_ita">
                        <button type="submit" class="lang-button">
                            <div class="ses">
                                <img class="ban" src="../img/banderas/it.png">
                                <h2 class="let-tit"><?php echo $traducciones[$idioma_usuario]['ita']; ?></h2>
                            </div>
                        </button>
                    </form>
                <?php endif; ?>
                
                <?php if ($row['c_ale']): ?>
                    <form method="POST" class="lang-form" action="eliminar-idioma.php">
                        <input type="hidden" name="idioma" value="c_ale">
                        <button type="submit" class="lang-button">
                            <div class="ses">
                                <img class="ban" src="../img/banderas/de.png">
                                <h2 class="let-tit"><?php echo $traducciones[$idioma_usuario]['ale']; ?></h2>
                            </div>
                        </button>
                    </form>
                <?php endif; ?>
                
                <?php if ($row['c_rum']): ?>
                    <form method="POST" class="lang-form" action="eliminar-idioma.php">
                        <input type="hidden" name="idioma" value="c_rum">
                        <button type="submit" class="lang-button">
                            <div class="ses">
                                <img class="ban" src="../img/banderas/ro.png">
                                <h2 class="let-tit"><?php echo $traducciones[$idioma_usuario]['rum']; ?></h2>
                            </div>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p style="color: black"><?php echo $traducciones[$idioma_usuario]['max_idiomas']; ?></p>
        <?php endif; ?>
    </div>
    <a href="cursos.php"><p><?php echo $traducciones[$idioma_usuario]['atr']; ?></p></a>
</body>
</html>
<?php mysqli_close($conexion); ?>