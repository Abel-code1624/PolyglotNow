<?php
  session_start();

  if(!isset($_SESSION['user'])) {
      die("Error: Usuario no autenticado. <a href='../../../../index.html'>Volver al inicio de sesión</a>");
  }

  $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Francés T1: Mots Simples</title>
    <link rel="icon" href="../../../../img/icon.png">
    <link rel="stylesheet" href="../../../../css/idiomas.css">
    <link rel="stylesheet" href="../../../../css/menulec.css">
    <link rel="stylesheet" href="../../../../css/preguntas.css">
    <link rel="stylesheet" href="../../../emergente/emergente.css">
    <link rel="stylesheet" href="../../../../css/circulo-punt.css">
    <script src="../../../emergente/emergente.js"></script>
  </head>
  <style>
    .correcta {
      background-color: #4CAF50; /* verde */
      color: white;
    }

    .incorrecta {
      background-color: #f44336; /* rojo */
      color: white;
    }
  </style>
<body>

<div id="pregunta-container" class="pri">
  <form id="formulario">
    <h1 id="titulo">Mots Simples</h1>
  <div id="pregunta"></div>
  <div id="respuestas">
    <div id="respuesta1" class="lec"></div>
    <div id="respuesta2" class="lec"></div>
    <div id="respuesta3" class="lec"></div>
    <div id="respuesta4" class="lec"></div>
  </div>
  <!-- Círculo de puntuación -->
  <div class="circle-container">
  <svg width="200" height="200" viewBox="0 0 120 120">
    <circle class="circle-background" cx="60" cy="60" r="50" />
    <circle class="circle-progress" cx="60" cy="60" r="50" />
  </svg>
  <div class="circle-text" id="percentText">0%</div>
  </div>
  </form>
</div>
<div id="openPopup" class="next">X</div>
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
<script>
localStorage.setItem("lang", "ES");
localStorage.setItem("idioma", "fra");

const lang = localStorage.getItem("lang") || "ES";

const traducciones = {

    ES: {

        salirTitulo: "Salir de la actividad",
        salirTexto: "Si sale tendrá que empezar de nuevo.<br><br>¿Quiere salir?",
        salirBtn: "Salir",
        continuarBtn: "Continuar"

    },

    EN: {

        salirTitulo: "Leave activity",
        salirTexto: "If you leave, you will have to start again.<br><br>Do you want to leave?",
        salirBtn: "Leave",
        continuarBtn: "Continue"

    }
};

const t = traducciones[lang];

let testFinalizado = false;

const preguntas = [
  {
    "pregunta": "¿Qué pronombre es 'Yo'?",
    "respuestas": ["Ils", "Je", "Tu", "Il"],
    "correcta": "Je"
  },
  {
    "pregunta": "¿Qué pronombre es 'Tú'?",
    "respuestas": ["Elle", "Ils", "Nous", "Tu"],
    "correcta": "Tu"
  },
  {
    "pregunta": "¿Qué pronombre es 'Él'?",
    "respuestas": ["Il", "Nous", "Je", "Elle"],
    "correcta": "Il"
  },
  {
    "pregunta": "¿Qué pronombre es 'Ella'?",
    "respuestas": ["Je", "Elle", "Ils", "Nous"],
    "correcta": "Elle"
  },
  {
    "pregunta": "¿Qué pronombre es 'Nosotros'?",
    "respuestas": ["Je", "Ils", "Tu", "Nous"],
    "correcta": "Nous"
  },
  {
    "pregunta": "¿Qué pronombre es 'Vosotros'?",
    "respuestas": ["Nous", "Vous", "Il", "Ils"],
    "correcta": "Vous"
  },
  {
    "pregunta": "¿Qué pronombre es 'Ellos'?",
    "respuestas": ["Tu", "Nous", "Ils", "Elle"],
    "correcta": "Ils"
  },
  {
    "pregunta": "¿Qué significa 'Grande maison'?",
    "respuestas": ["Mansión grande", "Casa grande", "Apartamento pequeño", "Casa enorme"],
    "correcta": "Casa grande"
  },
  {
    "pregunta": "¿Qué significa 'Pomme verte'?",
    "respuestas": ["Manzana roja", "Pera verde", "Manzana verde", "Manzana gris"],
    "correcta": "Manzana verde"
  },
  {
    "pregunta": "¿Qué significa 'Chaise de l'école'?",
    "respuestas": ["Silla de la escuela", "Sillón de la escuela", "Mesa de la escuela", "Cuadro de la escuela"],
    "correcta": "Silla de la escuela"
  },
  {
    "pregunta": "J'ai une voiture rouge",
    "respuestas": ["Tengo un camión amarillo", "Mi coche es rojo", "Tengo un coche rojo", "Ella tiene un coche verde"],
    "correcta": "Tengo un coche rojo"
  },
  {
    "pregunta": "Elle écrit avec un stylo bleu",
    "respuestas": ["Ella escribe con un bolígrafo azul", "Él escribe con un lápiz azul", "Ella dibuja con un bolígrafo blanco", "Ella escribe con un pincel azul"],
    "correcta": "Ella escribe con un bolígrafo azul"
  },
  {
    "pregunta": "Où est le chien?",
    "respuestas": ["¿Dónde está el gato?", "¿Dónde está el perro?", "¿Dónde está la cafetería?", "¿Donde está el canguro?"],
    "correcta": "¿Dónde está el perro?"
  },
  {
    "pregunta": "Aime-t-il les pommes?",
    "respuestas": ["¿Le gustan los manzanos?", "¿Le gustan las peras?", "¿Le gustan las naranjas?", "¿Le gustan las manzanas?"],
    "correcta": "¿Le gustan las manzanas?"
  },
  {
    "pregunta": "Sommes-nous vos amis?",
    "respuestas": ["¿Son tus amigos?", "¿Somos sus amigos?", "¿Somos los amigos?", "¿Somos tus amigos?"],
    "correcta": "¿Somos tus amigos?"
  }
]

var num_pre = preguntas.length;

let preguntasRestantes = [...preguntas];
let preguntaActual = null;
let respuestasCorrectas = 0;

function mostrarPregunta() {
  if (preguntasRestantes.length === 0) {
    testFinalizado = true;
    var punt = Math.round(100*respuestasCorrectas/num_pre);

    document.getElementById("pregunta").textContent = "¡Has completado todas las preguntas!";
    document.getElementById("respuestas").innerHTML = `<p>Respuestas correctas: ${respuestasCorrectas} de ${num_pre}</p>`;
    document.querySelector('.circle-container').style.display = 'flex';

    const porcentaje = punt; // 🔢 Cambia esto por el valor real de puntuación
    const circle = document.querySelector('.circle-progress');
    const text = document.getElementById('percentText');
    const circumference = 2 * Math.PI * 50;

    let current = 0;

    let strokeColor = "#4caf50";

    if (punt < 30) {
      strokeColor = "#f44336";
    } else if (punt < 50) {
      strokeColor = "#ff9800";
    } else if (punt < 70) {
      strokeColor = "#ffeb3b";
    }
    circle.style.stroke = strokeColor;

    function animate() {
      if (current <= punt) {
        const offset = circumference - (current / 100) * circumference;
        circle.style.strokeDashoffset = offset;
        text.textContent = current + "%";
        current++;
        requestAnimationFrame(animate);
      }
    }

    // Iniciar animación
    animate();

    return;
  }
  const indice = Math.floor(Math.random() * preguntasRestantes.length);
  preguntaActual = preguntasRestantes[indice];

  document.getElementById("pregunta").textContent = preguntaActual.pregunta;
  const respuestasDiv = document.getElementById("respuestas");
  const botones = respuestasDiv.getElementsByTagName("div");

  for (let i = 0; i < botones.length; i++) {
    botones[i].className = "lec";
    botones[i].textContent = preguntaActual.respuestas[i];
    botones[i].onclick = function() {
      verificarRespuesta(this);
    };
  }
  preguntasRestantes.splice(indice,1);
}

document.getElementById("openPopup").addEventListener("click", function(event) {

    event.stopImmediatePropagation();

    if (testFinalizado) {

        const user = '<?php echo $user; ?>';
        const titulo = document.getElementById('titulo').textContent;
        const percentText = document.getElementById('percentText').textContent.replace('%','');

        const bodyData = new URLSearchParams();

        bodyData.append('user', user);
        bodyData.append('titulo', titulo);
        bodyData.append('percentText', percentText);

        fetch('../../../../php/enviar_resultados.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: bodyData.toString()
        })

        .then(response => response.text())

        .then(data => {

            console.log("Respuesta del servidor:", data);

            if (data.trim() === "OK") {
                window.location.href = "/polyglotnow/html/idiomas/es/french.php";
            } else {
                alert("Error en la inserción: " + data);
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    } else {
        showPopup({

            title: t.salirTitulo,
            text: t.salirTexto,
            confirmText: t.salirBtn,
            cancelText: t.continuarBtn,

            onConfirm: () => {
                window.location.href = "../french.php";
            }
        });
    }
});

function verificarRespuesta(botonSeleccionado) {
  const respuestasDiv = document.getElementById("respuestas");
  const botones = respuestasDiv.getElementsByTagName("div");

  // desactivar más clics
  for (let i = 0; i < botones.length; i++) {
    botones[i].onclick = null;
    botones[i].classList.add("disabled");
  }

  if (botonSeleccionado.textContent === preguntaActual.correcta) {
    botonSeleccionado.classList.add("correcta");
    respuestasCorrectas++;
  } else {
    botonSeleccionado.classList.add("incorrecta");
    // resaltar la correcta
    for (let i = 0; i < botones.length; i++) {
      if (botones[i].textContent === preguntaActual.correcta) {
        botones[i].classList.add("correcta");
      }
    }
  }

  // mostrar siguiente después de un tiempo
  setTimeout(mostrarPregunta, 1500);
}

mostrarPregunta(); // Llama a la función para mostrar la primera pregunta
</script>
</html>