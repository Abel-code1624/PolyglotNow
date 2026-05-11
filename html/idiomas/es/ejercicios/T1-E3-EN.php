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
    <title>Inglés T3: Adjectives & Adverbs</title>
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
  <h1 id="titulo">Adjectives & Adverbs</h1>  
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
localStorage.setItem("idioma", "ing");

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
    pregunta: "¿Cómo se dice 'rápido' en inglés?",
    respuestas: ["Fast","Slow","Early","Late"],
    correcta: "Fast"
  },
  { 
    pregunta: "¿Cómo se dice 'lentamente' en inglés?",
    respuestas: ["Quickly","Slowly","Softly","Hardly"],
    correcta: "Slowly"
  },
  {
    pregunta: "¿Cómo se dice 'feliz' en inglés?",
    respuestas:["Sad","Happy","Angry","Tired"],
    correcta:"Happy"
  },
  {
    pregunta: "¿Cómo se dice 'triste' en inglés?",
    respuestas: ["Happy","Sad","Late","Near"],
    correcta: "Sad"
  },
  {
    pregunta: "¿Cómo se dice 'alto' en inglés?",
    respuestas: ["Tall","Short","Low","Big"],
    correcta: "Tall"
  },
  {
    pregunta: "¿Cómo se dice 'bajo' en inglés?",
    respuestas: ["Tall","High","Low","Large"],
    correcta: "Low"
  },
  {
    pregunta: "¿Cómo se dice 'siempre' en inglés?",
    respuestas: ["Never","Sometimes","Always","Often"],
    correcta: "Always"
  },
  {
    pregunta: "¿Cómo se dice 'nunca' en inglés?",
    respuestas: ["Always","Often","Never","Soon"],
    correcta: "Never"
  },
  {
    pregunta: "¿Cómo se dice 'cerca' en inglés?",
    respuestas: ["Far","Near","Close","Soon"],
    correcta: "Near"
  },
  {
    pregunta: "¿Cómo se dice 'lejos' en inglés?",
    respuestas: ["Near","Soon","Far","Late"],
    correcta: "Far"
  },
  {
    pregunta: "¿Cómo se dice 'temprano' en inglés?",
    respuestas: ["Late","Soon","Early","Fast"],
    correcta: "Early"
  },
  {
    pregunta: "¿Cómo se dice 'tarde' en inglés?",
    respuestas: ["Soon","Late","Early","Quick"],
    correcta: "Late",
  },
  {
    pregunta: "¿Cómo se dice 'bien' en inglés?",
    respuestas: ["Bad","Well","Wrong","Hard"],
    correcta: "Well"
  },
  {
    pregunta: "¿Cómo se dice 'mal' en inglés?",
    respuestas: ["Well","Badly","Good","Nice"],
    correcta: "Badly"
  },
  {
    pregunta: "¿Cómo se dice 'mucho' en inglés?",
    respuestas: ["Few","Little","Much","Less"],
    correcta: "Much"
  }
];

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
                window.location.href = "/polyglotnow/html/idiomas/es/english.php";
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
                window.location.href = "../english.php";
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

/* function verificarRespuesta(respuestaUsuario) {
  if (respuestaUsuario === preguntaActual.correcta) {
    alert("¡Correcto!");
  } else {
    alert("Incorrecto. La respuesta correcta es: " + preguntaActual.correcta);
  }
  mostrarPregunta(); // Muestra la siguiente pregunta
} */

mostrarPregunta(); // Llama a la función para mostrar la primera pregunta
</script>
</html>