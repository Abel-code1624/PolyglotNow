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

    $sql_resul = "SELECT num_test,MAX(puntuacion) AS 'mejor_puntuacion' FROM puntuacion WHERE usuario='$user' AND num_test LIKE '%_RO' GROUP BY num_test;";

    $res = mysqli_query($conexion,$sql_resul);

    $puntuaciones = [];

     while($row = mysqli_fetch_assoc($res)) {
        $puntuaciones[$row["num_test"]] = $row["mejor_puntuacion"];
        // $nota_usuario = $puntuaciones["T1_E1_EN"] ?? 0;
    }
        $nota_usuario = $row["mejor_puntuacion"] ?? 0;
        $nota_usuario2 = $puntuaciones["T1-E2-RO"] ?? 0;
        $nota_usuario3 = $puntuaciones["T1-E3-RO"] ?? 0;
        $nota_usuario4 = $puntuaciones["T1-E4-RO"] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumano</title>
    <link rel="icon" href="../../../img/icon.png">
    <link rel="stylesheet" href="../../../css/menulec.css">
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
        <a href="../../../php/cursos.php"><img class="ban" src="../../../img/banderas/ro.png"></a>
    </div>
    <div class="pri">
        <h2>GLOSSARY</h2>
        <details class="lec">
            <summary class="summary-h3">Introduction</summary>
            <div class="content">
                <h4>What is Romanian?</h4>
                <p>Romanian is a Romance language mainly spoken in Romania and Moldova. It is the only Romance language spoken in Eastern Europe. By learning Romanian, you can discover a unique culture and communicate with millions of people in that region.</p>
                <h4>Alphabet</h4>
                <p>The Romanian alphabet has 31 letters, including five special ones: ă, â, î, ș, and ț. Pronunciation is generally regular, but it’s important to become familiar with these special letters to read and speak Romanian accurately from the start.</p>
                <br>
                <table>
                    <tr>
                        <td class="td">A</td><td>[a]</td>
                        <td class="td">Ă</td><td>[ə]</td>
                        <td class="td">Â</td><td>[ɨ]</td>
                        <td class="td">B</td><td>[be]</td>
                    </tr>
                    <tr>
                        <td class="td">C</td><td>[ke/che]</td>
                        <td class="td">D</td><td>[de]</td>
                        <td class="td">E</td><td>[e]</td>
                        <td class="td">F</td><td>[ef]</td>
                    </tr>
                        <td class="td">G</td><td>[ge/ghe]</td>
                        <td class="td">H</td><td>[h]</td>
                        <td class="td">I</td><td>[i/j]</td>
                        <td class="td">Î</td><td>[ɨ]</td>                    
                    </tr>
                    <tr>
                        <td class="td">J</td><td>[je]</td>
                        <td class="td">K</td><td>[k]</td>
                        <td class="td">L</td><td>[el]</td>
                        <td class="td">M</td><td>[em]</td>                    
                    </tr>
                    <tr>
                        <td class="td">N</td><td>[en]</td>
                        <td class="td">O</td><td>[o]</td>
                        <td class="td">P</td><td>[pe]</td>
                        <td class="td">Q</td><td>[k]</td>
                    </tr>
                    <tr>
                        <td class="td">R</td><td>[er]</td>
                        <td class="td">S</td><td>[es]</td>
                        <td class="td">Ș</td><td>[she]</td>
                        <td class="td">T</td><td>[te]</td>
                    </tr>
                    <tr>
                        <td class="td">Ț</td><td>[ts]</td>
                        <td class="td">U</td><td>[u]</td>
                        <td class="td">V</td><td>[ve]</td>
                        <td class="td">W</td><td>[w]</td>                    
                    </tr>
                    <tr>
                        <td class="td">X</td><td>[ics]</td>
                        <td class="td">Y</td><td>[i]</td>
                        <td class="td">Z</td><td>[zet]</td>
                    </tr>
                </table>
                <br>
            </div>
        </details>
        <a class="apar" href="../es/ejercicios/T1-E1-RO.php"><div class="lec">
            <h3>Salut și La revedere!</h3>
        </div></a>
        <div><?php
                if(isset($puntuaciones["T1-E1-RO"])) {
                    $nota_usuario = $puntuaciones["T1-E1-RO"];
                } else {
                    $nota_usuario = 0;
                }
                echo $nota_usuario;
            ?></div>
        <!-- EJERCICIO 2 -->
        <?php if($nota_usuario >=50): ?>
            <a class="apar" href="ejercicios/T1-E2-RO.php"><div class="lec">
                <h3>Cuvinte Simple</h3>
            </div></a>
        <?php else: ?>
            <a class="apar bloqueado" href="#"><div class="lec">
                <h3>Cuvinte Simple</h3>
            </div></a>
        <?php endif; ?>
        <div><?php
            if(isset($puntuaciones["T1-E2-RO"])) {
                $nota_usuario2 = $puntuaciones["T1-E2-RO"];
            } else {
                $nota_usuario2 = 0;
            }
            echo $nota_usuario2;
        ?></div>            
        <!-- EJERCICIO 3 -->
        <?php if($nota_usuario2 >=50): ?>
            <a class="apar" href="ejercicios/T1-E3-RO.php"><div class="lec">
                <h3>Adjective și Adverbe</h3>
            </div></a>
        <?php else: ?>
            <a class="apar bloqueado" href="#"><div class="lec">
                <h3>Adjective și Adverbe</h3>
            </div></a>
        <?php endif; ?>
        <div><?php
            if(isset($puntuaciones["T1-E3-RO"])) {
                $nota_usuario3 = $puntuaciones["T1-E3-RO"];
            } else {
                $nota_usuario3 = 0;
            }
            echo $nota_usuario3;
        ?></div>            
        <!-- EJERCICIO 4 -->
        <?php if($nota_usuario3 >=50): ?> 
            <a class="apar" href="ejercicios/T1-E4-RO.php"><div class="lec">
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