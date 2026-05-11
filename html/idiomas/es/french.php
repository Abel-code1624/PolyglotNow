<?php
    session_start();

    if(!isset($_SESSION['user'])) {
      die("Error: Usuario no autenticado. <a href='../../../../index.html'>Volver al inicio de sesión</a>");
    }

    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "polyglotnow";
    $conexion = mysqli_connect($host, $usuario, $contrasena, $base_datos) or die("Error de conexión: " . mysqli_connect_error());

    $user = $_SESSION['user'];

    $sql_resul = "SELECT num_test,MAX(puntuacion) AS 'mejor_puntuacion' FROM puntuacion WHERE usuario='$user' AND num_test LIKE '%_FR' GROUP BY num_test;";

    $res = mysqli_query($conexion,$sql_resul);

    $puntuaciones = [];

     while($row = mysqli_fetch_assoc($res)) {
        $puntuaciones[$row["num_test"]] = $row["mejor_puntuacion"];
        // $nota_usuario = $puntuaciones["T1_E1_EN"] ?? 0;
    }
        $nota_usuario = $row["mejor_puntuacion"] ?? 0;
        $nota_usuario2 = $puntuaciones["T1-E2-FR"] ?? 0;
        $nota_usuario3 = $puntuaciones["T1-E3-FR"] ?? 0;
        $nota_usuario4 = $puntuaciones["T1-E4-FR"] ?? 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Francés</title>
    <link rel="stylesheet" href="../../../css/menulec.css">
    <link rel="icon" href="../../../img/icon.png">
    <link rel="stylesheet" href="../../emergente/emergente.css">
    <script src="../../emergente/emergente.js"></script>
</head>
<style>
    .apar {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        color: black;
    }
</style>
<body>
    <div class="cab">
        <a href="../../../php/cursos.php"><img class="ban" src="../../../img/banderas/fr.png"></a>
    </div>
    <div class="pri">
        <h2>GLOSARIO</h2>
        <details class="lec">
            <summary class="summary-h3">Introducción</summary>
            <div class="content">
                <h4>¿Qué es el francés?</h4>
                <p>El francés es un idioma originario de Francia y es hablado en muchos países de Europa, África, América y Oceanía. Es uno de los idiomas oficiales de organizaciones internacionales como la ONU y la Unión Europea. Aprender francés te permite acceder a una rica cultura, viajar, estudiar y trabajar en muchos lugares del mundo.</p>
                <h4>Alfabeto</h4>
                <p>El alfabeto francés tiene 26 letras, igual que el español, pero incluye acentos y caracteres especiales (é, è, ê, ç, etc.). Es importante aprender la pronunciación, ya que algunas letras y combinaciones suenan diferente al español. Esto te ayudará a leer y pronunciar palabras correctamente desde el principio.</p>
                <br>
                <table>
                    <tr>
                        <td class="td">A</td><td>[a]</td>
                        <td class="td">B</td><td>[be]</td>
                        <td class="td">C</td><td>[ce]</td>
                    </tr>
                    <tr>
                        <td class="td">D</td><td>[de]</td>   
                        <td class="td">E</td><td>[e]</td>
                        <td class="td">F</td><td>[ef]</td>                     
                    </tr>
                    <tr>
                        <td class="td">G</td><td>[she]</td>
                        <td class="td">H</td><td>[ash]</td>
                        <td class="td">I</td><td>[i]</td>

                    </tr>
                        <td class="td">J</td><td>[shi]</td>
                        <td class="td">K</td><td>[k]</td>
                        <td class="td">L</td><td>[el]</td>                    
                    </tr>
                    <tr>
                        <td class="td">M</td><td>[em]</td>
                        <td class="td">N</td><td>[en]</td>
                        <td class="td">O</td><td>[o]</td>
                    </tr>
                    <tr>
                        <td class="td">P</td><td>[pe]</td>
                        <td class="td">Q</td><td>[ku]</td>
                        <td class="td">R</td><td>[er]</td>                    
                    </tr>
                    <tr>
                        <td class="td">S</td><td>[es]</td>
                        <td class="td">T</td><td>[te]</td>
                        <td class="td">U</td><td>[i]</td>
                    </tr>
                    <tr>
                        <td class="td">V</td><td>[ve]</td>
                        <td class="td">W</td><td>[duble v]</td>
                        <td class="td">X</td><td>[iks]</td>
                    </tr>
                    <tr>
                        <td class="td">Y</td><td>[i grek]</td>
                        <td class="td">Z</td><td>[zed]</td>
                    </tr>
                </table>
                <br>
            </div>
        </details>
        <a class="apar" href="ejercicios/T1-E1-FR.php"><div class="lec">
            <h3>Bonjour et Au revoir!</h3>
        </div></a>
            <div><?php
                if(isset($puntuaciones["T1-E1-FR"])) {
                    $nota_usuario = $puntuaciones["T1-E1-FR"];
                } else {
                    $nota_usuario = 0;
                }
                echo $nota_usuario;
            ?></div>
        <!-- EJERCICIO 2 -->
        <?php if($nota_usuario >=50): ?>
            <a class="apar" href="ejercicios/T1-E2-FR.php"><div class="lec">
                <h3>Mots Simples</h3>
            </div></a>
        <?php else: ?>
            <a class="apar bloqueado" href="#"><div class="lec">
                <h3>Mots Simples</h3>
            </div></a>
        <?php endif; ?>
        <div><?php
            if(isset($puntuaciones["T1-E2-FR"])) {
                $nota_usuario2 = $puntuaciones["T1-E2-FR"];
            } else {
                $nota_usuario2 = 0;
            }
            echo $nota_usuario2;
        ?>
        </div>
        <!-- EJERCICIO 3 -->
        <?php if($nota_usuario2 >=50): ?>
            <a class="apar" href="ejercicios/T1-E3-FR.php"><div class="lec">
                <h3>Adjectifs et Adverbes</h3>
            </div></a>
        <?php else: ?>
            <a class="apar bloqueado" href="#"><div class="lec">
                <h3>Adjectifs et Adverbes</h3>
            </div></a>
        <?php endif; ?>
        <div><?php
            if(isset($puntuaciones["T1-E3-FR"])) {
                $nota_usuario3 = $puntuaciones["T1-E3-FR"];
            } else {
                $nota_usuario3 = 0;
            }
            echo $nota_usuario3;
        ?></div>
        <!-- EJERCICIO 4 -->
        <?php if($nota_usuario3 >=50): ?> 
            <a class="apar" href="ejercicios/T1-E4-FR.php"><div class="lec">
                <h3>Examen</h3>
            </div></a>
        <?php else: ?>
            <a class="apar bloqueado" href="#"><div class="lec">
                <h3>Examen</h3>
            </div></a>            
        <?php endif; ?>
        <?php echo $nota_usuario4; ?>
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
<script>
const lang = localStorage.getItem("lang") || "ES";

const traducciones = {

    ES: {
        titulo: "Acceso bloqueado",
        texto: "Necesita mínimo un 50% para desbloquear esta actividad.",
        boton: "Entendido"
    },
    EN: {
        titulo: "Access blocked",
        texto: "You need at least 50% to unlock this activity.",
        boton: "Understood"
    }
};

const t = traducciones[lang];

const bloqueados = document.querySelectorAll(".bloqueado");
bloqueados.forEach(item => {
    item.addEventListener("click", (e) => {
        e.preventDefault();
        showPopup({
            title: t.titulo,
            text: t.texto,
            confirmText: t.boton,
            hideCancel: true
        });
    });
});
</script>
</body>
</html>