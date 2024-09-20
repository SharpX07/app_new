<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_cuestionario.css') }}">
    <title>Aula Virtual</title>
</head>
<body>
    <div class="contenedor">
        <aside class="barra-lateral">
            <h2>Aula Virtual</h2>
            <nav>
            <ul>
                    <li>
                        <a href="{{ route('textos') }}" class="{{ Route::currentRouteName() == 'textos' ? 'enlace-activo' : '' }}">
                            <img src="{{ asset('imagenes/texto_icono.png') }}" alt="Icono Textos" class="icono-menu">
                            Textos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cuestionario') }}" class="{{ Route::currentRouteName() == 'cuestionario' ? 'enlace-activo' : '' }}">
                            <img src="{{ asset('imagenes/cuestionario_icono.png') }}" alt="Icono Cuestionario" class="icono-menu">
                            Cuestionario
                        </a>
                    </li>
                    <li>
                        @if (Auth::user()->isDocente())
                            <a href="{{ route('crear-documento') }}">
                                <img src="{{ asset('imagenes/cuestionario_icono.png') }}" alt="Icono Cuestionario" class="icono-menu">
                                Añadir Texto
                            </a>
                        @endif
                    </li>
                </ul>
            </nav>
            <div class="deslizar-box">
                <ul>
                    <li>
                        <img src="{{ asset('imagenes/portada_1.jpg') }}" alt="">
                    </li>
                    <li>
                        <img src="{{ asset('imagenes/portada_2.jpg') }}" alt="">
                    </li>
                    <li>
                        <img src="{{ asset('imagenes/portada_3.jpg') }}" alt="">
                    </li>
                </ul>
            </div>
        </aside>    
        <main class="contenido-principal">
            <header class="cabecera">
                <h1>Cuestionarios</h1>
                <div class="menu-container">
                    <div class="menu-trigger">
                        <button class="menu-button">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="arrow-icon">
                                <!-- Reemplaza con la ruta de tu imagen -->
                                <img src="{{ asset('imagenes/perfil_default.jpg') }}" alt="Icono" class="icon"/>
                            </div>
                        </button>
                    </div>
                    <div class="menu-content">
                        <a href="{{ route('profile.edit') }}" class="menu-link">{{ __('Profile') }}</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="menu-link" href="#"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Cerrar Sesión
                            </a> 
                        </form>
                    </div>
                </div>
            </header>
            <hr class="separador">
            <section class="galeria-cuestionario">   
                <div class="cuestionario">
                    <a href="enlace_texto50.html">
                        <img src="{{ asset('imagenes/portada_3.jpg') }}" alt="Cuestionario_1">
                    </a>
                    <p>Cuestionario 1 'Lab 3.5'</p>
                </div> 
                <div class="cuestionario">
                    <a href="enlace_texto50.html">
                        <img src="{{ asset('imagenes/portada_3.jpg') }}" alt="Cuestionario_2">
                    </a>
                    <p>Cuestionario 2 'Lab 3.5'</p>
                </div> 
                <div class="cuestionario">
                    <a href="enlace_texto50.html">
                        <img src="{{ asset('imagenes/portada_3.jpg') }}" alt="Cuestionario_3">
                    </a>
                    <p>Cuestionario 3 'Lab 3.5'</p>
                </div> 
            </section>
        </main>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>