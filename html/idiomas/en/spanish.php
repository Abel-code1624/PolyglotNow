<?php
    session_start();

    if(!isset($_SESSION['user'])) {
      die("Error: User not authenticated. <a href='../../../../index.html'>Back to login</a>");
    }

    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "polyglotnow";
    $conexion = mysqli_connect($host, $usuario, $contrasena, $base_datos) or die("Error de conexión: " . mysqli_connect_error());

    $user = $_SESSION['user'];

    $sql_resul = "SELECT num_test,MAX(puntuacion) AS 'mejor_puntuacion' FROM puntuacion WHERE usuario='$user' AND num_test LIKE '%_ES' GROUP BY num_test;";

    $res = mysqli_query($conexion,$sql_resul);

    $puntuaciones = [];

     while($row = mysqli_fetch_assoc($res)) {
        $puntuaciones[$row["num_test"]] = $row["mejor_puntuacion"];
        // $nota_usuario = $puntuaciones["T1_E1_EN"] ?? 0;
    }
        $nota_usuario = $row["mejor_puntuacion"] ?? 0;
        $nota_usuario2 = $puntuaciones["T1-E2-ES"] ?? 0;
        $nota_usuario3 = $puntuaciones["T1-E3-ES"] ?? 0;
        $nota_usuario4 = $puntuaciones["T1-E4-ES"] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spanish</title>
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
            <img class="ban" src="../../../img/banderas/esp.png">
        </a>
    </div>
    <div class="pri">
        <h2>GLOSSARY</h2>
        <details class="lec">
            <summary class="summary-h3">Introduction</summary>
            <div class="content">
                <h4>What is Spanish?</h4>
                <p>Spanish is a Romance language that originated in the Iberian Peninsula and is now spoken by more than 500 million people worldwide. It is the official language in Spain and most countries in Latin America, and is also widely spoken in the United States and other parts of the world. Learning Spanish opens up opportunities for travel, study, work, and access to a rich cultural heritage in literature, music, and art.</p>
                <h4>Alphabet</h4>
                <p>The Spanish alphabet consists of 27 letters. It is similar to the English alphabet but includes the letter ñ. The pronunciation of Spanish is generally regular, but it is important to learn the sounds of each letter to read and speak correctly from the start.</p>
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
                            <td class="td">F</td><td>[efe]</td>                     
                        </tr>
                        <tr>
                            <td class="td">G</td><td>[ge]</td>
                            <td class="td">H</td><td>[hache]</td>
                            <td class="td">I</td><td>[i]</td>

                        </tr>
                            <td class="td">J</td><td>[je]</td>
                            <td class="td">K</td><td>[ka]</td>
                            <td class="td">L</td><td>[ele]</td>                    
                        </tr>
                        <tr>
                            <td class="td">M</td><td>[eme]</td>
                            <td class="td">N</td><td>[ene]</td>
                            <td class="td">Ñ</td><td>[enye]</td>
                        </tr>
                        <tr>
                            <td class="td">O</td><td>[o]</td>
                            <td class="td">P</td><td>[pe]</td>
                            <td class="td">Q</td><td>[ku]</td>                   
                        </tr>
                        <tr>
                            <td class="td">R</td><td>[erre]</td> 
                            <td class="td">S</td><td>[ese]</td>
                            <td class="td">T</td><td>[te]</td>
                        </tr>
                        <tr>
                            <td class="td">U</td><td>[u]</td>
                            <td class="td">V</td><td>[uve]</td>
                            <td class="td">W</td><td>[uve doble]</td>
                        </tr>
                        <tr>
                            <td class="td">X</td><td>[ekis]</td>
                            <td class="td">Y</td><td>[i griega]</td>
                            <td class="td">Z</td><td>[zeta]</td>
                        </tr>
                    </table>
                    <br>
            </div>
        </details>
        <a class="apar" href="ejercicios/T1-E1-ES.php"><div class="lec">
            <h3>¡Hola y Adiós!</h3>
        </div></a>
        <div><?php
            if(isset($puntuaciones["T1-E1-ES"])) {
                $nota_usuario = $puntuaciones["T1-E1-ES"];
            } else {
                $nota_usuario = 0;
            }
            echo $nota_usuario;
        ?></div>
        <!-- EJERCICIO 2 -->
        <?php if($nota_usuario >=50): ?>
            <a class="apar" href="ejercicios/T1-E1-ES.php"><div class="lec">
                <h3>Palabras Simples</h3>
            </div></a>
        <?php else: ?>
            <a class="apar bloqueado" href="#"><div class="lec">
                <h3>Palabras Simples</h3>
            </div></a>
        <?php endif; ?>
        <div><?php
            if(isset($puntuaciones["T1-E2-ES"])) {
                $nota_usuario2 = $puntuaciones["T1-E2-ES"];
            } else {
                $nota_usuario2 = 0;
            }
            echo $nota_usuario2;
        ?></div>            
        <!-- EJERCICIO 3 -->
        <?php if($nota_usuario2 >=50): ?>
            <a class="apar" href="ejercicios/T1-E2-ES.php"><div class="lec">
                <h3>Adjetivos y Adverbios</h3>
            </div></a>
        <?php else: ?>
            <a class="apar bloqueado" href="#"><div class="lec">
                <h3>Adjetivos y Adverbios</h3>
            </div></a>
        <?php endif; ?>
        <div><?php
            if(isset($puntuaciones["T1-E3-ES"])) {
                $nota_usuario3 = $puntuaciones["T1-E3-ES"];
            } else {
                $nota_usuario3 = 0;
            }
            echo $nota_usuario3;
        ?></div>
        <!-- EJERCICIO 4 --> 
        <?php if($nota_usuario3 >=50): ?>
            <a class="apar" href="ejercicios/T1-E4-ES.php"><div class="lec">
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
const lang = localStorage.getItem("lang") || "EN";

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