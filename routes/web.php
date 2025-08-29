<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\ProductoController;

// Home
Route::get('/', fn () => view('home'))->name('home');

// Registro y login
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::resource('perfiles', PerfilController::class)->except(['show']);
    Route::resource('proyectos', ProyectoController::class)->middleware('role:cliente');
    Route::resource('mensajes', MensajeController::class);
    Route::resource('valoraciones', ValoracionController::class);
});

// Perfil público por seudónimo
Route::get('perfil/{seudonimo}', [PerfilController::class, 'showBySeudonimo'])->name('perfil.show');

// Productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/categoria/{slug}', [ProductoController::class, 'categoria'])->name('productos.categoria');

// Contacto
Route::get('/contacto', function () {
    return view('contacto'); // Debes crear resources/views/contacto.blade.php
})->name('contacto');
