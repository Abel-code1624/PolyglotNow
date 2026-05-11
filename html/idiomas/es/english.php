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

    $sql_resul = "SELECT num_test,MAX(puntuacion) AS 'mejor_puntuacion' FROM puntuacion WHERE usuario='$user' AND num_test LIKE '%_EN' GROUP BY num_test;";

    $res = mysqli_query($conexion,$sql_resul);

    $puntuaciones = [];

     while($row = mysqli_fetch_assoc($res)) {
        $puntuaciones[$row["num_test"]] = $row["mejor_puntuacion"];
        // $nota_usuario = $puntuaciones["T1_E1_EN"] ?? 0;
    }
        $nota_usuario = $row["mejor_puntuacion"] ?? 0;
        $nota_usuario2 = $puntuaciones["T1-E2-EN"] ?? 0;
        $nota_usuario3 = $puntuaciones["T1-E3-EN"] ?? 0;
        $nota_usuario4 = $puntuaciones["T1-E4-EN"] ?? 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inglés</title>
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
        <a href="../../../php/cursos.php">
            <img class="ban" src="../../../img/banderas/uk.png">
        </a>
    </div>
    <div class="pri">
        <h2>GLOSARIO</h2>
        <details class="lec">
            <summary class="summary-h3">Introducción</summary>
            <div class="content">
                <h4>¿Qué es el inglés?</h4>
                <p>El inglés es un idioma originario de Inglaterra y actualmente es uno de los más hablados en el mundo. Se utiliza para viajar, estudiar, trabajar, acceder a información global y comunicarte con personas de diferentes países. Aprender inglés te abre muchas puertas en la vida personal y profesional.</p>
                <h4>Alfabeto</h4>
                <p>El alfabeto inglés tiene 26 letras. Es importante aprender cómo se pronuncian, ya que algunas letras suenan diferente al español. Esto te ayudará a leer y pronunciar palabras correctamente desde el principio.</p>
                <br>
                <table>
                    <tr>
                        <td class="td">A</td><td>[ei]</td>
                        <td class="td">B</td><td>[bi]</td>
                        <td class="td">C</td><td>[si]</td>
                    </tr>
                    <tr>
                        <td class="td">D</td><td>[di]</td>   
                        <td class="td">E</td><td>[i]</td>
                        <td class="td">F</td><td>[ef]</td>                     
                    </tr>
                    <tr>
                        <td class="td">G</td><td>[yi]</td>
                        <td class="td">H</td><td>[eich]</td>
                        <td class="td">I</td><td>[ai]</td>

                    </tr>
                        <td class="td">J</td><td>[jei]</td>
                        <td class="td">K</td><td>[kei]</td>
                        <td class="td">L</td><td>[el]</td>                    
                    </tr>
                    <tr>
                        <td class="td">M</td><td>[em]</td>
                        <td class="td">N</td><td>[en]</td>
                        <td class="td">O</td><td>[ou]</td>
                    </tr>
                    <tr>
                        <td class="td">P</td><td>[pi]</td>
                        <td class="td">Q</td><td>[kiu]</td>
                        <td class="td">R</td><td>[ar]</td>                    
                    </tr>
                    <tr>
                        <td class="td">S</td><td>[es]</td>
                        <td class="td">T</td><td>[ti]</td>
                        <td class="td">U</td><td>[iu]</td>
                    </tr>
                    <tr>
                        <td class="td">V</td><td>[uvi]</td>
                        <td class="td">W</td><td>[dabliu]</td>
                        <td class="td">X</td><td>[ex]</td>
                    </tr>
                    <tr>
                        <td class="td">Y</td><td>[uai]</td>
                        <td class="td">Z</td><td>[set]</td>
                    </tr>
                </table>
                <br>
            </div>
        </details>
        <a class="apar" href="ejercicios/T1-E1-EN.php"><div class="lec">
            <h3>Hello and Goodbye!</h3>
        </div></a>
        <div><?php
            if(isset($puntuaciones["T1-E1-EN"])) {
                $nota_usuario = $puntuaciones["T1-E1-EN"];
            } else {
                $nota_usuario = 0;
            }
            echo $nota_usuario; 
        ?></div>
        <!-- EJERCICIO 2 -->
        <?php if($nota_usuario >=50): ?>
                <a class="apar" href="ejercicios/T1-E2-EN.php"><div class="lec">
                    <h3>Simple Worlds</h3>
                </div></a>
        <?php else: ?>
                <a class="apar bloqueado" href="#"><div class="lec">
                    <h3>Simple Worlds</h3>
                </div></a>
        <?php endif; ?>
        <div><?php
            if(isset($puntuaciones["T1-E2-EN"])) {
                $nota_usuario2 = $puntuaciones["T1-E2-EN"];
            } else {
                $nota_usuario2 = 0;
            }
            echo $nota_usuario2;
        ?></div>
        <!-- EJERCICIO 3 -->
        <?php if($nota_usuario2 >=50): ?>
        <a class="apar" href="ejercicios/T1-E3-EN.php"><div class="lec">
            <h3>Adjectives & Adverbs</h3>
        </div></a>
        <?php else: ?>
        <a class="apar bloqueado" href="#"><div class="lec">
            <h3>Adjectives & Adverbs</h3>
        </div></a>
        <?php endif; ?>
        <div><?php
            if(isset($puntuaciones["T1-E3-EN"])) {
                $nota_usuario3 = $puntuaciones["T1-E3-EN"];
            } else {
                $nota_usuario3 = 0;
            }
            echo $nota_usuario3;
        ?></div>
        <!-- EJERCICIO 4 -->  
        <?php if($nota_usuario3 >=50): ?>    
            <a class="apar" href="ejercicios/T1-E4-EN.php"><div class="lec">
                <h3>Exam</h3>
            </div></a>
        <?php else: ?>
            <a class="apar bloqueado" href="#"><div class="lec">
                <h3>Exam</h3>
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