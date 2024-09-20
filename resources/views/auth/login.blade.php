<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Incluye Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Iniciar sesión</title>
</head>
<body>
    <section class="inicio">
        <div class="formulario">
            <h1>Iniciar sesión</h1> 
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div class="usuario">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" style="margin-top: 2 px;" />
                </div>
                <!-- Password -->
                <div class="password">
                    <label>Contraseña</label>
                    <input type="password" name="password" required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" style="margin-top: 2 px;"/>
                </div>
                <!--Registrar-->
                <div class="recordar">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
                    @endif
                </div>
                <div class="botones">
                        <a href="{{ route('elegir_registro') }}" class="btn-registrar">
                            Registrarme
                        </a>                    
                    <button type="submit" class="btn-iniciar">Iniciar sesión</button>
                </div>  
            </form>
        </div>
    </section>

</body>
</html>