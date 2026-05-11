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
    <title>French T1: Mots Simples</title>
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
    "pregunta": "What pronoun is 'I'?",
    "respuestas": ["Ils", "Je", "Tu", "Il"],
    "correcta": "Je"
  },
  {
    "pregunta": "What pronoun is 'You'?",
    "respuestas": ["Elle", "Ils", "Nous", "Tu"],
    "correcta": "Tu"
  },
  {
    "pregunta": "What pronoun is 'He'?",
    "respuestas": ["Il", "Nous", "Je", "Elle"],
    "correcta": "Il"
  },
  {
    "pregunta": "What pronoun is 'She'?",
    "respuestas": ["Je", "Elle", "Ils", "Nous"],
    "correcta": "Elle"
  },
  {
    "pregunta": "What pronoun is 'We'?",
    "respuestas": ["Je", "Ils", "Tu", "Nous"],
    "correcta": "Nous"
  },
  {
    "pregunta": "What pronoun is 'You (plural)'?",
    "respuestas": ["Nous", "Vous", "Il", "Ils"],
    "correcta": "Vous"
  },
  {
    "pregunta": "What pronoun is 'They'?",
    "respuestas": ["Tu", "Nous", "Ils", "Elle"],
    "correcta": "Ils"
  },
  {
    "pregunta": "What does 'Grande maison' mean?",
    "respuestas": ["Big mansion", "Big house", "Small apartment", "Huge house"],
    "correcta": "Big house"
  },
  {
    "pregunta": "What does 'Pomme verte' mean?",
    "respuestas": ["Red apple", "Green pear", "Green apple", "Gray apple"],
    "correcta": "Green apple"
  },
  {
    "pregunta": "What does 'Chaise de l'école' mean?",
    "respuestas": ["School chair", "Goodbye", "Nice to meet you", "Excuse me"],
    "correcta": "School chair"
  },
  {
    "pregunta": "I have a red car",
    "respuestas": ["I have a yellow truck", "My car is red", "I have a red car", "She has a green car"],
    "correcta": "I have a red car"
  },
  {
    "pregunta": "She writes with a blue pen",
    "respuestas": ["She writes with a blue pen", "He writes with a blue pencil", "She draws with a white pen", "She writes with a blue brush"],
    "correcta": "She writes with a blue pen"
  },
  {
    "pregunta": "Where is the dog?",
    "respuestas": ["Where is the cat?", "Where is the dog?", "Where is the cafeteria?", "Where is the kangaroo?"],
    "correcta": "Where is the dog?"
  },
  {
    "pregunta": "Does he like apples?",
    "respuestas": ["Does he like apple trees?", "Does he like pears?", "Does he like oranges?", "Does he like apples?"],
    "correcta": "Does he like apples?"
  },
  {
    "pregunta": "Are we your friends?",
    "respuestas": ["Are they your friends?", "Are we your friends?", "Are we friends?", "Are we your friends?"],
    "correcta": "Are we your friends?"
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

    document.getElementById("pregunta").textContent = "You have completed all the questions!";
    document.getElementById("respuestas").innerHTML = `<p>Correct answers: ${respuestasCorrectas} of ${num_pre}</p>`;
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
</html>