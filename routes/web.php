<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentoController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/elegir_registro', function () {
    return view('auth.elegir-cuenta');
})->name('elegir_registro');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

route::get('prueba', function () {
    return view('agregar-preguntas');
})->name('prueba');


Route::get('/crear-documento', function () {
    return view('agregar-texto'); // Vista con el formulario para crear el contenido
})->name('crear-documento');

Route::post('/guardar-contenido', [DocumentoController::class, 'guardarContenido'])->name('guardar-contenido');
Route::post('/guardar-preguntas', [DocumentoController::class, 'guardarPreguntas'])->name('guardar-preguntas');
Route::get('/mostrar-contenido', [DocumentoController::class, 'mostrarContenido'])->name('mostrar-contenido');
Route::delete('/documento/{titulo}', [DocumentoController::class, 'eliminar'])->name('eliminar');

Route::get('/textos', [DocumentoController::class, 'verTextos'])->name('textos');

// En tu archivo de rutas (web.php)
Route::get('/texto/{id}', [DocumentoController::class, 'mostrarTexto'])->name('mostrar-texto');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/cuestionario', function () {
        return view('menu.menu_cuestionario');
    })->name('cuestionario');
});

require __DIR__.'/auth.php';
