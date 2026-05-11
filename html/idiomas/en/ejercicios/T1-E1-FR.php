<?php
  session_start();

  if(!isset($_SESSION['user'])) {
      die("Error: User not autentified. <a href='../../../../index.html'>Come back to login</a>");
  }

  $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>French T1: Bonjour et Au revoir!</title>
    <link rel="icon" href="../../../../img/icon.png">
    <link rel="stylesheet" href="../../../../css/idiomas.css">
    <link rel="stylesheet" href="../../../../css/menulec.css">
    <link rel="stylesheet" href="../../../../css/preguntas.css">
    <link rel="stylesheet" href="../../../emergente/emergente.css">
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
  <div id="pregunta"></div>
  <div id="respuestas">
    <div id="respuesta1" class="lec"></div>
    <div id="respuesta2" class="lec"></div>
    <div id="respuesta3" class="lec"></div>
    <div id="respuesta4" class="lec"></div>
  </div>
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


<script>
localStorage.setItem("lang", "EN");
localStorage.setItem("idioma", "fra");

const lang = localStorage.getItem("lang") || "EN";

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
    pregunta: "How do you say 'Hello' in French?",
    respuestas: ["Bonsoir", "Bonjour", "Merci", "S'il vous plaît"],
    correcta: "Bonjour"
  },
  {
    pregunta: "Which of these phrases is used to say goodbye in French?",
    respuestas: ["Salut", "Merci", "Au revoir", "Bonjour"],
    correcta: "Au revoir"
  },
  {
    pregunta: "What does 'Bon matin' mean?",
    respuestas: ["Good afternoon", "Good evening", "Good morning", "Hello"],
    correcta: "Good morning"
  },
  {
    pregunta: "What is a polite way to get someone's attention in French?",
    respuestas: ["S'il vous plaît", "Bonjour", "Merci", "Salut"],
    correcta: "S'il vous plaît"
  },
  {
    pregunta: "What does 'Enchanté' mean?",
    respuestas: ["Nice to meet you", "Goodbye", "Thanks", "Hello"],
    correcta: "Nice to meet you"
  },
  {
    pregunta: "How do you say 'Thank you' in French?",
    respuestas: ["Merci", "Bonjour", "Bienvenue", "Salut"],
    correcta: "Merci"
  },
  {
    pregunta: "What is a response to 'Merci'?",
    respuestas: ["De rien", "Bonjour", "Enchanté", "Au revoir"],
    correcta: "De rien"
  },
  {
    pregunta: "Which phrase would you use to introduce yourself in French?",
    respuestas: ["Je m'appelle...", "Bonsoir", "Enchanté", "Salut"],
    correcta: "Je m'appelle..."
  },
  {
    pregunta: "What does 'Comment ça va?' mean?",
    respuestas: ["How’s it going?", "How are you?", "Who are you?", "What's your name?"],
    correcta: "How are you?"
  },
  {
    pregunta: "Which of these is an informal greeting in French?",
    respuestas: ["Salut", "Enchanté", "Au revoir", "Merci"],
    correcta: "Salut"
  },
  {
    pregunta: "Which phrase is a nighttime greeting in French?",
    respuestas: ["Bonne nuit", "Bonjour", "Au revoir", "Salut"],
    correcta: "Bonne nuit"
  },
  {
    pregunta: "Which is a way to say 'See you later' in French?",
    respuestas: ["À plus tard", "Bonjour", "Merci", "Enchanté"],
    correcta: "À plus tard"
  },
  {
    pregunta: "What does 'Adieu' mean?",
    respuestas: ["Hello", "Thanks", "Goodbye", "See you next time"],
    correcta: "Goodbye"
  },
  {
    pregunta: "Which of these phrases would you use to say 'See you next time' in French?",
    respuestas: ["À la prochaine", "Bonsoir", "Merci", "Salut"],
    correcta: "À la prochaine"
  },
  {
    pregunta: "What does 'Bienvenue' mean?",
    respuestas: ["Thanks", "You're welcome", "Welcome", "Goodbye"],
    correcta: "Welcome"
  }
];

var num_pre = preguntas.length;

let preguntasRestantes = [...preguntas];
let preguntaActual = null;
let respuestasCorrectas = 0;

function mostrarPregunta() {
  if (preguntasRestantes.length === 0) {
    testFinalizado = true;
    document.getElementById("pregunta").textContent = "You have completed all the questions!";
    document.getElementById("respuestas").innerHTML = `<p>Correct answers: ${respuestasCorrectas} of ${num_pre}</p>`;
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
                window.location.href = "/polyglotnow/html/idiomas/en/french-en.php";
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
                window.location.href = "../french-en.php";
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
</body>
</html>