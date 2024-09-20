<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
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
                        <a href="{{ route('crear-documento') }}">
                            <img src="{{ asset('imagenes/cuestionario_icono.png') }}" alt="Icono Cuestionario" class="icono-menu">
                            Añadir Texto
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="slide-contenedor">
                <div class="slider-wrap">
                    <div class="slider">
                        <img id="slide-1" src="{{ asset('imagenes/animacion/anima_1.jpg') }}" alt="imagen1">
                        <img id="slide-2" src="{{ asset('imagenes/animacion/anima_2.jpg') }}" alt="imagen2">
                        <img id="slide-3" src="{{ asset('imagenes/animacion/anima_3.jpg') }}" alt="imagen3">
                    </div>
                    <div class="navegar">
                        <a href="#slide-1"></a>
                        <a href="#slide-2"></a>
                        <a href="#slide-3"></a>
                    </div>
                </div>
            </div>
        </aside>    
        <main class="contenido-principal">
            <header class="cabecera">
                <h1>Textos</h1>
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
                <section class="contenido-documento" style="margin-left:400px; max-width: 700px;">
                @foreach($documentos as $documento)
                    <h2>{{ $documento['titulo'] }}</h2>

                    <!-- Mostrar el contenido formateado -->
                    <div>{!! $documento['contenido'] !!}</div>

                    <!-- Mostrar la imagen asociada, si existe -->
                    @if ($documento['imagen'])
                        <div>
                            <img src="{{ $documento['imagen'] }}" alt="Imagen de {{ $documento['titulo'] }}" style="max-width: 300px;">
                        </div>
                    @else
                        <div>
                            <img src="{{ asset('imagenes/placeholder.jpg') }}" alt="Placeholder">
                        </div>
                    @endif

                    <!-- Formulario para eliminar documento -->
                    @if (Auth::user()->isDocente())
                        <!-- Formulario para eliminar documento -->
                        <form action="{{ route('eliminar', ['titulo' => $documento['titulo']]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    @endif

                    <hr>
                @endforeach
                <hr>
            </section>
        </main>
    </div>
</body>
</html>
