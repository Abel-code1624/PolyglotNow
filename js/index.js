let idiomaActual = "espanol";

function actualizarIdiomaInput() {
  const inputIdioma = document.getElementById('idiomaInput');
  if (inputIdioma) {
    inputIdioma.value = idiomaActual;
  }
}

function cambioIdioma() {
  const elementos = {
    titulo: document.querySelector(".form-tit"),
    usuario: document.querySelector('input[name="user"]'),
    contrasena: document.querySelector('input[name="password"]'),
    boton: document.querySelector('input[type="submit"]'),
    textoInferior: document.querySelector("p"),
    enlaceRegistro: document.querySelector("p a"),
    bandera: document.querySelector(".ban2")
  };

  if (idiomaActual === "espanol") {
    // Cambiar a inglés
    document.documentElement.lang = "en";
    elementos.titulo.textContent = "LOG IN";
    elementos.usuario.placeholder = "Username";
    elementos.contrasena.placeholder = "Password";
    elementos.boton.value = "Enter";
    elementos.textoInferior.innerHTML = `Don't have an account? <a style="color: white;" href="html/sesion/registro.html">Sign up</a>`;
    elementos.bandera.src = "img/banderas/esp.png";
    idiomaActual = "english";
  } else {
    // Cambiar a español
    document.documentElement.lang = "es";
    elementos.titulo.textContent = "INICIAR SESIÓN";
    elementos.usuario.placeholder = "Nombre de usuario";
    elementos.contrasena.placeholder = "Contraseña";
    elementos.boton.value = "Ingresar";
    elementos.textoInferior.innerHTML = '¿No tienes creada una cuenta? <a style="color: white;" href="html/sesion/registro.html">Regístrate</a>';
    elementos.bandera.src = "img/banderas/uk.png";
    idiomaActual = "espanol";
  }

  actualizarIdiomaInput();
  setLanguage(idiomaActual);
}

document.addEventListener('DOMContentLoaded', function() {
  actualizarIdiomaInput();
})

function setLanguage(lang) {
  localStorage.setItem('languageActive', lang);
}

// localStorage.setItem("languageActive", "espanol");