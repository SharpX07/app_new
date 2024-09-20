<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <!-- Incluye Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Registrar</title>
</head>
<body>
    <div class="container">
        <section class="imagen-lateral">
            <img src="{{ asset('imagenes/fondo-registro.png') }}" alt="Imagen decorativa">
        </section>

        <section class="registrarse">
            <div class="formulario-registrar">
                <h1>Registro de Estudiante</h1>
                <form method="POST" action="{{ route('register') }}">
                @csrf
                    <div class="nombres">
                        <label class="nombres">Nombres</label>
                        <input type="text" id= "name" name="name" :value="old('name')" required autofocus>     
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />              
                    </div>
                    <div class="apellidos">
                        <label class="apellidos">Apellidos</label>
                        <div class="completar-apellidos">
                            <input class="paterno" type="text" placeholder="Paterno" name="apellido_paterno" :value="old('apellido_paterno')" required>
                            <x-input-error :messages="$errors->get('apellido_paterno')" class="mt-2" />
                            <input class="materno" type="text" placeholder="Materno" name="apellido_materno" :value="old('apellido_materno')" required>
                            <x-input-error :messages="$errors->get('apellido_materno')" class="mt-2" />
                        </div>  
                    </div>
                    <div class="universidad">
                    <div class="grupo-escuela">
                        <label class="escuela">Escuela</label>
                        <select class="completar-escuela" name="escuela" style="height: 35px;" required>
                            @foreach([
                                'Administración',
                                'Antropología',
                                'Arqueología',
                                'Arquitectura y urbanismo',
                                'Biología pesquera',
                                'Ciencias biológicas',
                                'Ciencias de la comunicación',
                                'Ciencias políticas y gobernabilidad',
                                'Contabilidad y finanzas',
                                'Derecho',
                                'Economía',
                                'Educación inicial',
                                'Educación primaria',
                                'Educación secundaria: Ciencias de la matemática',
                                'Educación secundaria: Ciencias naturales',
                                'Educación secundaria: Filosofía, psicología y ciencias sociales',
                                'Educación secundaria: Historia y geografía',
                                'Educación secundaria: Idiomas',
                                'Educación secundaria: Lengua y literatura',
                                'Enfermería',
                                'Estadística',
                                'Estomatología',
                                'Farmacia y bioquímica',
                                'Física',
                                'Historia',
                                'Ingeniería agrícola',
                                'Ingeniería agroindustrial',
                                'Ingeniería ambiental',
                                'Ingeniería civil',
                                'Ingeniería de materiales',
                                'Ingeniería de minas',
                                'Ingeniería de sistemas',
                                'Ingeniería industrial',
                                'Ingeniería informática',
                                'Ingeniería metalúrgica',
                                'Ingeniería mecánica',
                                'Ingeniería mecatrónica',
                                'Ingeniería química',
                                'Matemáticas',
                                'Medicina',
                                'Microbiología y parasitología',
                                'Trabajo social',
                                'Turismo',
                                'Zootecnia'
                            ] as $escuela)
                                <option value="{{ $escuela }}" {{ old('escuela') == $escuela ? 'selected' : '' }}>
                                    {{ $escuela }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('escuela')" class="mt-2" />
                    </div>

                        <div class="grupo-ciclo">
                            <label class="ciclo">Ciclo</label>
                            <select class="completar-ciclo" name="ciclo" style="height: 35px;" required>
                            @foreach([1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X'] as $number => $roman)
                                <option value="{{ $number }}" {{ old('ciclo') == $number ? 'selected' : '' }}>
                                    {{ $roman }}
                                </option>
                            @endforeach
                    </select>
                        </div>
                    </div> 
                    <div class="nombres">
                        <label class="nombres">Codigo Matricula</label>
                        <input type="text" name="codigo_unt" :value="old('codigo_unt')" required>
                        <x-input-error :messages="$errors->get('codigo_unt')" class="mt-2" />
                    </div>
                    <div class="usuario">
                        <label>Usuario (correo)</label>
                        <input type="text" placeholder="example@unitru.edu.pe" name="email" :value="old('email')" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="password">
                        <div class="grupo-contraseña">
                            <label class="contraseña">Contraseña</label>
                            <input class="escribir-contraseña" placeholder="Escriba su contraseña" type="password" name="password" required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>  
                        <div class="grupo-confirmar">
                            <label class="confirmar">Confirmar contraseña</label>
                            <input class="escribir-confirmar" placeholder="Confirme contraseña" type="password" name="password_confirmation" required> 
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>                
                    </div>
                    <div class="crear-cuenta">
                        <button class="btn-crear">Crear cuenta</button>
                    </div>
                    <div class="tiene-cuenta" style="margin-top: 9px;">
                        ¿Ya tiene una cuenta?
                        <a href="{{ route('login') }}">Iniciar sesión</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
