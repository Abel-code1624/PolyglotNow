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

    $sql_resul = "SELECT num_test,MAX(puntuacion) AS 'mejor_puntuacion' FROM puntuacion WHERE usuario='$user' AND num_test LIKE '%_IT' GROUP BY num_test;";

    $res = mysqli_query($conexion,$sql_resul);

    $puntuaciones = [];

     while($row = mysqli_fetch_assoc($res)) {
        $puntuaciones[$row["num_test"]] = $row["mejor_puntuacion"];
        // $nota_usuario = $puntuaciones["T1_E1_EN"] ?? 0;
    }
        $nota_usuario = $row["mejor_puntuacion"] ?? 0;
        $nota_usuario2 = $puntuaciones["T1-E2-IT"] ?? 0;
        $nota_usuario3 = $puntuaciones["T1-E3-IT"] ?? 0;
        $nota_usuario4 = $puntuaciones["T1-E4-IT"] ?? 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Italiano</title>
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
        <a href="../../../php/cursos.php"><img class="ban" src="../../../img/banderas/it.png"></a>
    </div>
    <div class="pri">
        <h2>GLOSARIO</h2>
        <details class="lec">
            <summary class="summary-h3">Introducción</summary>
            <div class="content">
                <h4>¿Qué es el italiano?</h4>
                <p>El italiano es un idioma originario de Italia y es hablado también en Suiza y en comunidades de todo el mundo. Es conocido por su musicalidad y belleza, y es fundamental para quienes aman el arte, la música, la gastronomía y la historia. Aprender italiano facilita viajar y conocer la cultura italiana en profundidad.</p>
                <h4>Alfabeto</h4>
                <p>El alfabeto italiano tiene 21 letras. No incluye las letras j, k, w, x, y, excepto en palabras extranjeras. La pronunciación es bastante regular, pero hay sonidos y combinaciones que debes aprender para hablar correctamente desde el principio.</p>
                <br>
                <table>
                    <tr>
                        <td class="td">A</td><td>[a]</td>
                        <td class="td">B</td><td>[bi]</td>
                        <td class="td">C</td><td>[ci]</td>
                    </tr>
                    <tr>
                        <td class="td">D</td><td>[di]</td>   
                        <td class="td">E</td><td>[e]</td>
                        <td class="td">F</td><td>[effe]</td>                     
                    </tr>
                    <tr>
                        <td class="td">G</td><td>[gi]</td>
                        <td class="td">H</td><td>[acca]</td>
                        <td class="td">I</td><td>[i]</td>

                    </tr>
                        <td class="td">L</td><td>[elle]</td> 
                        <td class="td">M</td><td>[emme]</td>
                        <td class="td">N</td><td>[enne]</td>                   
                    </tr>
                    <tr>
                        <td class="td">O</td><td>[o]</td>
                        <td class="td">P</td><td>[pi]</td>
                        <td class="td">Q</td><td>[cu]</td>
                    </tr>
                    <tr>
                        <td class="td">R</td><td>[erre]</td> 
                        <td class="td">S</td><td>[esse]</td>
                        <td class="td">T</td><td>[ti]</td>                   
                    </tr>
                    <tr>
                        <td class="td">U</td><td>[u]</td>
                        <td class="td">V</td><td>[vi/vu]</td>
                        <td class="td">Z</td><td>[zetz]</td>
                    </tr>
                </table>
                <br>     
            </div>
        </details>
        <a class="apar" href="../es/ejercicios/T1-E1-IT.php"><div class="lec">
            <h3>Ciao e Arrivederci!</h3>
        </div></a>
        <div><?php
                if(isset($puntuaciones["T1-E1-IT"])) {
                    $nota_usuario = $puntuaciones["T1-E1-IT"];
                } else {
                    $nota_usuario = 0;
                }
                echo $nota_usuario;
            ?></div>
        <!-- EJERCICIO 2 -->
        <?php if($nota_usuario >=50): ?>
            <a class="apar" href="ejercicios/T1-E2-IT.php"><div class="lec">
                <h3>Mondi Semplici</h3>
            </div></a>
        <?php else: ?>
            <a class="apar bloqueado" href="#"><div class="lec">
                <h3>Mondi Semplici</h3>
            </div></a>
        <?php endif; ?>
        <div><?php
            if(isset($puntuaciones["T1-E2-IT"])) {
                $nota_usuario2 = $puntuaciones["T1-E2-IT"];
            } else {
                $nota_usuario2 = 0;
            }
            echo $nota_usuario2;
        ?></div>                    
        <!-- EJERCICIO 3 -->
        <?php if($nota_usuario2 >=50): ?>
            <a class="apar" href="ejercicios/T1-E3-IT.php"><div class="lec">
                <h3>Aggettivi e Avverbi</h3>
            </div></a>
        <?php else: ?>
            <a class="apar bloqueado" href="#"><div class="lec">
                <h3>Aggettivi e Avverbi</h3>
            </div></a>
        <?php endif; ?>
        <div><?php
            if(isset($puntuaciones["T1-E3-IT"])) {
                $nota_usuario3 = $puntuaciones["T1-E3-IT"];
            } else {
                $nota_usuario3 = 0;
            }
            echo $nota_usuario3;
        ?></div>            
        <!-- EJERCICIO 4 -->
        <?php if($nota_usuario3 >=50): ?> 
            <a class="apar" href="ejercicios/T1-E4-IT.php"><div class="lec">
                <h3>Esame</h3>
            </div></a>
        <?php else: ?>
            <a class="apar bloqueado" href="#"><div class="lec">
                <h3>Esame</h3>
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