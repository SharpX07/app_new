<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <title>Aula Virtual</title>
    <!-- Incluye Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
            <header>
                <h1>Perfil</h1>
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

            <!-- Apartado de Información de Perfil -->
            <div class="contenedor-formularios">
                <section class="informacion-perfil">
                    <h2>Información de Perfil</h2>
                    <p> Actualice la información de su cuenta. </p>
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')
                        <label for="nombres" >Nombres:</label>
                        <input id="name" name="name" type="text" value="{{old('name', $user->name) }}" required autofocus autocomplete="name" disabled>
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />

                        <label for="apellido-paterno">Apellido Paterno:</label>
                        <input type="text" id="apellido-paterno" name="apellido_paterno" value="{{old('apellido_paterno', $user->apellido_paterno) }}" required disabled>

                        <label for="apellido-materno">Apellido Materno:</label>
                        <input type="text" id="apellido-materno" name="apellido_materno" value="{{old('apellido_materno', $user->apellido_materno) }}" required disabled>

                        <label for="escuela">Escuela:</label>
                        <input type="text" id="escuela" name="escuela" value="{{old('escuela', $user->escuela) }}" required disabled>

                        <label for="ciclo">Ciclo:</label>
                        <select id="ciclo" name="ciclo" required disabled>
                            @foreach([1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X'] as $number => $roman)
                                <option value="{{ $number }}" {{ old('ciclo', $user->ciclo) == $number ? 'selected' : '' }}>
                                    {{ $roman }}
                                </option>
                            @endforeach
                        </select>



                        <label for="matricula">Número de Matrícula:</label>
                        <input type="text" id="matricula" name="codigo_unt" value="{{old('codigo_unt', $user->codigo_unt) }}" required disabled>

                        <label for="correo">Correo:</label>
                        <input type="email" name="email" id="correo" value="{{ old('email', $user->email) }}"  disabled>
                        <div>
                            <button class="boton-guardar" id="guardar-perfil" style="display:none;">Guardar Cambios (Perfil)</button>
                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    style="color: green;"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </section>

                <!-- Apartado de Actualización de Contraseña -->
                <section class="actualizar-contrasena">
                    <h2>Actualizar Contraseña</h2>
                    <p> Asegúrese que su cuenta esté usando una contraseña larga y aleatoria para mantenerse seguro. </p>
                    <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                        <label for="contrasena-actual">Contraseña Actual:</label>
                        <input type="password" id="contrasena-actual" name="current_password" autocomplete="current-password" placeholder="Escriba su contraseña actual" disabled>
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />

                        <label for="nueva-contrasena">Nueva Contraseña:</label>
                        <input type="password" id="nueva-contrasena" name="password" placeholder="Escriba su nueva contraseña" autocomplete="new-password" disabled>
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />

                        <label for="confirmar-contrasena">Confirmar Nueva Contraseña:</label>
                        <input type="password" id="confirmar-contrasena" name="password_confirmation" placeholder="Confirme su nueva contraseña" autocomplete="new-password" disabled>
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        
                    <div>
                        <button class="boton-guardar" id="guardar-contrasena" style="display:none;">Guardar Cambios (Contraseña)</button>
                        @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                style="color: green;"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div> 
                    </form>             
                </section>
            </div>
            
            <div class="contenedor-botones">
                <button class="boton-cancelar" id="boton-cancelar" style="display:none;">Cancelar</button>
                <button id="boton-editar" class="boton-editar">Editar</button>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('boton-editar').addEventListener('click', function() {
            // Habilitar todos los inputs y selects del formulario, excepto el campo de correo
            document.querySelectorAll('.informacion-perfil input, .informacion-perfil select, .actualizar-contrasena input').forEach(function(elemento) {
                elemento.disabled = false;
            });

            // Mostrar los botones "Guardar" y "Cancelar" y ocultar el botón "Editar"
            document.getElementById('guardar-perfil').style.display = 'inline-block';
            document.getElementById('guardar-contrasena').style.display = 'inline-block';
            document.querySelector('.boton-cancelar').style.display = 'inline-block';
            document.getElementById('boton-editar').style.display = 'none';
        })
        document.getElementById('boton-cancelar').addEventListener('click', function() {
            // Habilitar todos los inputs y selects del formulario, excepto el campo de correo
            document.querySelectorAll('.informacion-perfil input, .informacion-perfil select, .actualizar-contrasena input').forEach(function(elemento) {
                elemento.disabled = true;
            });

            // ocultar los botones "Guardar" y "Cancelar" y mostrar el botón "Editar"
            document.getElementById('guardar-perfil').style.display = 'none';
            document.getElementById('guardar-contrasena').style.display = 'none';
            document.querySelector('.boton-cancelar').style.display = 'none';
            document.getElementById('boton-editar').style.display = 'inline-block';
        });
        
    </script>
</body>
</html>
