const toggle = document.querySelector('.toggle');
const navegacion = document.querySelector('.sidebar');
const main = document.querySelector('.main');

const darkMode = document.querySelector('.dark-mode');
const iconoModoClaro = darkMode.querySelector('span:nth-child(1)');
const iconoModoOscuro = darkMode.querySelector('span:nth-child(2)');

toggle.onclick = function () {
    navegacion.classList.toggle('active');
    main.classList.toggle('active');
}


// Obtener el valor de la cookie "modo" al cargar la página
const cookieModo = getCookie("modo");
if (cookieModo === "oscuro") {
    document.body.classList.add('dark-mode-variables');
    iconoModoClaro.classList.remove('active');
    iconoModoOscuro.classList.add('active');
} else {
    document.body.classList.remove('dark-mode-variables');
    iconoModoClaro.classList.add('active');
    iconoModoOscuro.classList.remove('active');
}

darkMode.addEventListener('click', () => {
    // Cambiar la clase del body
    document.body.classList.toggle('dark-mode-variables');

    // Cambiar la clase "active" del icono según el modo actual
    iconoModoClaro.classList.toggle('active');
    iconoModoOscuro.classList.toggle('active');

    // Establecer la cookie
    const modoActual = document.body.classList.contains('dark-mode-variables') ? 'oscuro' : 'claro';
    document.cookie = "modo=" + modoActual + "; path=/";
});

// Función para obtener el valor de una cookie específica
function getCookie(nombre) {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if (cookie.startsWith(nombre + "=")) {
            return cookie.substring(nombre.length + 1, cookie.length);
        }
    }
    return "";
}