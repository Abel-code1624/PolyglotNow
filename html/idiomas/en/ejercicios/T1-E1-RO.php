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
    <title>Romanian T1: Salut și La revedere!</title>
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
localStorage.setItem("idioma", "rum");

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
    pregunta: "¿Cómo se dice 'Hola' en rumano?",
    respuestas: ["Bună", "La revedere", "Mulțumesc", "Te rog"],
    correcta: "Bună"
  },
  {
    pregunta: "¿Cuál de estas frases se usa para despedirse en rumano?",
    respuestas: ["Salut", "Mulțumesc", "La revedere", "Bună"],
    correcta: "La revedere"
  },
  {
    pregunta: "¿Qué significa 'Bună dimineața'?",
    respuestas: ["Buenas tardes", "Buenas noches", "Buenos días", "Hola"],
    correcta: "Buenos días"
  },
  {
    pregunta: "¿Cuál es una forma cortés de llamar la atención en rumano?",
    respuestas: ["Te rog", "Bună", "Mulțumesc", "Salut"],
    correcta: "Te rog"
  },
  {
    pregunta: "¿Qué significa 'Încântat de cunoștință'?",
    respuestas: ["Encantado de conocerte", "Gracias", "Hola", "Adiós"],
    correcta: "Encantado de conocerte"
  },
  {
    pregunta: "¿Cómo dices 'Gracias' en rumano?",
    respuestas: ["Mulțumesc", "Cu plăcere", "Te rog", "Bună seara"],
    correcta: "Mulțumesc"
  },
  {
    pregunta: "¿Cuál es una respuesta a 'Mulțumesc'?",
    respuestas: ["Cu plăcere", "Salut", "Încântat", "La revedere"],
    correcta: "Cu plăcere"
  },
  {
    pregunta: "¿Qué frase usarías para presentarte en rumano?",
    respuestas: ["Mă numesc...", "Bună seara", "Încântat", "Salut"],
    correcta: "Mă numesc..."
  },
  {
    pregunta: "¿Qué significa 'Ce mai faci?'",
    respuestas: ["¿Qué pasa?", "¿Cómo estás?", "¿Quién eres?", "¿Cómo te llamas?"],
    correcta: "¿Cómo estás?"
  },
  {
    pregunta: "¿Cuál es una forma informal de saludo en rumano?",
    respuestas: ["Salut", "Încântat", "La revedere", "Mulțumesc"],
    correcta: "Salut"
  },
  {
    pregunta: "¿Qué frase es un saludo nocturno en rumano?",
    respuestas: ["Noapte bună", "Bună dimineața", "La revedere", "Salut"],
    correcta: "Noapte bună"
  },
  {
    pregunta: "¿Cuál es una forma de decir 'Hasta luego' en rumano?",
    respuestas: ["Pe curând", "Salut", "Mulțumesc", "Încântat"],
    correcta: "Pe curând"
  },
  {
    pregunta: "¿Qué significa 'Adio'?",
    respuestas: ["Hola", "Gracias", "Adiós (formal)", "Hasta luego"],
    correcta: "Adiós (formal)"
  },
  {
    pregunta: "¿Cuál de estas frases usarías para decir 'Hasta la próxima' en rumano?",
    respuestas: ["Până data viitoare", "Bună seara", "Mulțumesc", "Salut"],
    correcta: "Până data viitoare"
  },
  {
    pregunta: "¿Qué significa 'Bun venit'?",
    respuestas: ["Gracias", "De nada", "Bienvenido", "Adiós"],
    correcta: "Bienvenido"
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
                window.location.href = "/polyglotnow/html/idiomas/en/romanian-en.php";
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
                window.location.href = "../romanian-en.php";
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