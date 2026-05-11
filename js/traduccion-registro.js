document.addEventListener("DOMContentLoaded", function() {
    const translations = {
        'espanol': {
            'form-tit': 'CREAR UNA CUENTA',
            'usu': 'Ingresa un nombre de usuario *',
            'user-placeholder': 'Nombre de usuario',
            'con': 'Ingresa una contraseña *',
            'con2': '(Mínimo un dígito, una letra mayúscula, una letra minúscula y 8 caracteres.)',
            'password-placeholder': 'Contraseña',
            'lan': 'Selecciona tu lengua nativa:',
            'cur': 'Selecciona los idiomas que quieres aprender:',
            'submit': 'Ingresar',
            'c_ing': 'Inglés',
            'c_esp': 'Español',
            'c_fra': 'Francés',
            'c_ita': 'Italiano',
            'c_ale': 'Alemán',
            'c_rum': 'Rumano',
            'log_enl': '¿Tienes cuenta creada? <a style="color: white;" href="../../index.html">Inicia sesión</a>'
        },
        'english': {
            'form-tit': 'CREATE AN ACCOUNT',
            'usu': 'Enter a username *',
            'user-placeholder': 'Username',
            'con': 'Enter a password *',
            'con2': '(Minimum one digit, one uppercase letter, one lowercase letter and 8 characters.)',
            'password-placeholder': 'Password',
            'lan': 'Select your native language:',
            'cur': 'Select languages you want to learn:',
            'submit': 'Submit',
            'c_ing': 'English',
            'c_esp': 'Spanish',
            'c_fra': 'French',
            'c_ita': 'Italian',
            'c_ale': 'German',
            'c_rum': 'Romanian',
            'log_enl': 'Do you have a created account? <a style="color: white;" href="../../index.html">Log in</a>'
        }
    };

    const langSelect = document.getElementById('lan');

    function updateLanguage() {
        const lang = langSelect.value;

        document.querySelector('.form-tit').textContent = translations[lang]['form-tit'];
        document.querySelector('label[for="usu"]').textContent = translations[lang]['usu'];
        document.querySelector('input[name="user"]').placeholder = translations[lang]['user-placeholder'];
        document.querySelector('label[for="con"]').textContent = translations[lang]['con'];
        document.querySelector('label[for="con2"]').textContent = translations[lang]['con2'];
        document.querySelector('input[name="password"]').placeholder = translations[lang]['password-placeholder'];
        document.querySelector('label[for="lan"]').textContent = translations[lang]['lan'];
        document.querySelector('label[for="cur"]').textContent = translations[lang]['cur'];
        document.querySelector('.envio').value = translations[lang]['submit'];
        document.querySelector('.log_enl').innerHTML = translations[lang]['log_enl'];

        // Actualizar labels de los checkboxes
        document.querySelector('label[for="c_ing"]').textContent = translations[lang]['c_ing'];
        document.querySelector('label[for="c_esp"]').textContent = translations[lang]['c_esp'];
        document.querySelector('label[for="c_fra"]').textContent = translations[lang]['c_fra'];
        document.querySelector('label[for="c_ita"]').textContent = translations[lang]['c_ita'];
        document.querySelector('label[for="c_ale"]').textContent = translations[lang]['c_ale'];
        document.querySelector('label[for="c_rum"]').textContent = translations[lang]['c_rum'];

        
     /* document.getElementById("checkbox-ing").style.display = (lang === "english") ? "none" : "flex";
        document.getElementById("checkbox-esp").style.display = (lang === "espanol") ? "none" : "flex"; */
        
        // Ocultar checkbox del idioma nativo
        const checkboxIng = document.getElementById("checkbox-ing");
        const checkboxEsp = document.getElementById("checkbox-esp");
        const inputIng = checkboxIng.querySelector('input[type="checkbox"]');
        const inputEsp = checkboxEsp.querySelector('input[type="checkbox"]');

        if (lang === "english") {
            checkboxIng.style.display = "none";
            checkboxEsp.style.display = "flex";
            inputIng.checked = false;
        } else {
            checkboxIng.style.display = "flex";
            checkboxEsp.style.display = "none";
            inputEsp.checked = false;
        }

    }

    const langInStorage = localStorage.getItem("languageActive") || "espanol";
    langSelect.value = langInStorage;
    // Cambia idioma al cargar la página
    updateLanguage();

    // Cambia idioma cuando el usuario selecciona otro en el select
    langSelect.addEventListener('change', function() {
        localStorage.setItem("languageActive", langSelect.value);
        updateLanguage();
    });
});

