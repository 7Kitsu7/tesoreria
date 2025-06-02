<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/adminlte/css/style.css">
    <link rel="stylesheet" href="/adminlte/css/chatbot.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>SISTEMA DE TESORERÍA</title>
</head>

<body class="{{ isset($_COOKIE['modo']) && $_COOKIE['modo'] === 'oscuro' ? 'dark-mode-variables' : '' }}">

    <div class="contenedor">
        <aside class="sidebar">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <span class="material-symbols-outlined">
                            home
                        </span>
                        <h3>Home</h3>
                    </a>
                </li>
                <li>
                    <a href="{{ route('periodo.index') }}"
                        class="{{ in_array(request()->route()->getName(),['periodo.index', 'periodo.create'])? 'active': '' }}">
                        <span class="material-symbols-outlined">
                            calendar_add_on
                        </span>
                        <h3>Periodos Académicos</h3>
                    </a>
                </li>
                <li>
                    <a href="{{ route('escala.index') }}"
                        class="{{ in_array(request()->route()->getName(),['escala.index', 'escala-periodo.edit'])? 'active': '' }}">
                        <span class="material-symbols-outlined">
                            scale
                        </span>
                        <h3>Escalas</h3>
                    </a>
                </li>
                <li>
                    <a href="{{ route('alumno.index') }}"
                        class="{{ in_array(request()->route()->getName(),['alumno.index', 'alumno.create'])? 'active': '' }}">
                        <span class="material-symbols-outlined">
                            group
                        </span>
                        <h3>Alumnos</h3>
                    </a>
                </li>
                <li>
                    <a href="{{ route('matricula.index') }}"
                        class="{{ in_array(request()->route()->getName(),['matricula.index', 'matricula.create'])? 'active': '' }}">
                        <span class="material-symbols-outlined">
                            inventory
                        </span>
                        <h3>Matriculas</h3>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pension.index') }}"
                        class="{{ in_array(request()->route()->getName(),['pension.index', 'pension.create'])? 'active': '' }}">
                        <span class="material-symbols-outlined">
                            report_gmailerrorred
                        </span>
                        <h3>Pension</h3>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('pago.index') }}"
                        class="{{ in_array(request()->route()->getName(),['pago.index', 'pago.create'])? 'active': '' }}">
                        <span class="material-symbols-outlined">
                            settings
                        </span>
                        <h3>Pagos</h3>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="material-icons-sharp">
                            add
                        </span>
                        <h3>New Login</h3>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">
                            <a href="">
                                <span class="material-icons-sharp">
                                    logout
                                </span>
                                <h3>Cerrar Sesión</h3>
                            </a>
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <main class="main">
            <section class="topbar">
                <div class="toggle">
                    <span class="material-symbols-outlined">
                        menu
                    </span>
                </div>

                <div class="dark-mode mt-2">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <div class="user">
                    <img src="/adminlte/images/profile-1.jpg">
                </div>

                <!-- Chat modal -->
                <div id="chatbot-modal">
                    <header>Chat con el Asistente</header>
                    <div id="chatbot-body"></div>
                    <div id="chatbot-input-area">
                        <input type="text" id="chatbot-text" placeholder="Escribe tu mensaje...">
                        <button onclick="enviarMensaje()">➤</button>
                    </div>
                </div>
            </section>

            <section class="contenido">
                @yield('contenido')
            </section>
        </main>
    </div>

    <!-- Script JS del chat -->
    <script>
    const profileImage = document.querySelector('.user img');
    const chatModal = document.getElementById('chatbot-modal');
    const chatInput = document.getElementById('chatbot-text');
    const chatBody = document.getElementById('chatbot-body');

    profileImage.addEventListener('click', () => {
        chatModal.style.display = chatModal.style.display === 'none' ? 'block' : 'none';
    });

    function enviarMensaje() {
        const mensaje = chatInput.value.trim();
        if (!mensaje) return;

        chatBody.innerHTML += `<div class="user-msg">${mensaje}</div>`;
        chatInput.value = "";
        chatBody.scrollTop = chatBody.scrollHeight;

        fetch('/preguntar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ mensaje })
        })
        .then(res => res.json())
        .then(data => {
            const htmlSeguro = DOMPurify.sanitize(marked.parse(data.respuesta));
            chatBody.innerHTML += `<div class="bot-msg">${htmlSeguro}</div>`;
            chatBody.scrollTop = chatBody.scrollHeight;
        })

        .catch(() => {
        chatBody.innerHTML += `<div class="bot-msg">Error: no se pudo contactar con el bot.</div>`;
        });
    }

    chatInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter") enviarMensaje();
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/adminlte/js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/archivos/js/createdoc.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <!--------------------------------------------------------------------->
        <!-- Convertidor Markdown -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <!-- Sanitizador (seguridad) -->
    <script src="https://cdn.jsdelivr.net/npm/dompurify@3.0.3/dist/purify.min.js"></script>


    @yield('script')
</body>

</html>
