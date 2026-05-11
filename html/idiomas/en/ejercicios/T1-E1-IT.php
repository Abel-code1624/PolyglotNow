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
    <title>Italian T1: Ciao e Arrivederci!</title>
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
localStorage.setItem("idioma", "ita");

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
    pregunta: "How do you say 'Hello' in Italian?",
    respuestas: ["Ciao", "Buonasera", "Thank you", "Please"],
    correcta: "Ciao"
  },
  {
    pregunta: "Which of these phrases is used to say goodbye in Italian?",
    respuestas: ["Ciao", "Thank you", "Arrivederci", "Good morning"],
    correcta: "Arrivederci"
  },
  {
    pregunta: "What does 'Buongiorno' mean?",
    respuestas: ["Good afternoon", "Good night", "Good morning", "Hello"],
    correcta: "Good morning"
  },
  {
    pregunta: "What is a polite way to get someone's attention in Italian?",
    respuestas: ["Per favore", "Ciao", "Thank you", "Good morning"],
    correcta: "Per favore"
  },
  {
    pregunta: "What does 'Piacere' mean?",
    respuestas: ["Nice to meet you", "Thank you", "Hello", "Goodbye"],
    correcta: "Nice to meet you"
  },
  {
    pregunta: "How do you say 'Thank you' in Italian?",
    respuestas: ["Grazie", "You're welcome", "Please", "Good evening"],
    correcta: "Grazie"
  },
  {
    pregunta: "What is a response to 'Grazie'?",
    respuestas: ["You're welcome", "Ciao", "Nice to meet you", "Arrivederci"],
    correcta: "You're welcome"
  },
  {
    pregunta: "Which phrase would you use to introduce yourself in Italian?",
    respuestas: ["Mi chiamo...", "Good evening", "Nice to meet you", "Ciao"],
    correcta: "Mi chiamo..."
  },
  {
    pregunta: "What does 'Come stai?' mean?",
    respuestas: ["What's up?", "How are you?", "Who are you?", "What's your name?"],
    correcta: "How are you?"
  },
  {
    pregunta: "Which of these is an informal greeting in Italian?",
    respuestas: ["Ciao", "Nice to meet you", "Goodbye", "Thank you"],
    correcta: "Ciao"
  },
  {
    pregunta: "Which phrase is a nighttime greeting in Italian?",
    respuestas: ["Buona notte", "Good morning", "Goodbye", "Ciao"],
    correcta: "Buona notte"
  },
  {
    pregunta: "Which is a way to say 'See you later' in Italian?",
    respuestas: ["A dopo", "Ciao", "Thank you", "Nice to meet you"],
    correcta: "A dopo"
  },
  {
    pregunta: "What does 'Addio' mean?",
    respuestas: ["Hello", "Thank you", "Goodbye (formal)", "See you later"],
    correcta: "Goodbye (formal)"
  },
  {
    pregunta: "Which of these phrases would you use to say 'See you next time' in Italian?",
    respuestas: ["Alla prossima", "Good evening", "Thank you", "Ciao"],
    correcta: "Alla prossima"
  },
  {
    pregunta: "What does 'Benvenuto' mean?",
    respuestas: ["Thank you", "You're welcome", "Welcome", "Goodbye"],
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
                window.location.href = "/polyglotnow/html/idiomas/en/italian-en.php";
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
                window.location.href = "../italian-en.php";
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