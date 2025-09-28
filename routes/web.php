<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\PortafolioController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\ProductoController;

// Home
Route::get('/', fn () => view('home'))->name('home');

// Registro y login
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Perfil público por seudónimo (sin autenticación)
Route::get('perfil/{seudonimo}', [PerfilController::class, 'seudonimo'])->name('perfil.seudonimo');

// Productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/categoria/{slug}', [ProductoController::class, 'categoria'])->name('productos.categoria');
Route::get('/productos/{slug}', [ProductoController::class, 'show'])->name('productos.show');

// Contacto
Route::get('/contacto', fn () => view('contacto'))->name('contacto');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {

    // Perfiles (solo administrables)
    Route::resource('perfiles', PerfilController::class)->except(['show']);

    // Proyectos
    // -------------------
    // Cliente: solo ver proyectos
    Route::get('proyectos', [ProyectoController::class, 'index'])
        ->name('proyectos.index')
        ->middleware('role:cliente');

    Route::get('proyectos/{proyecto}', [ProyectoController::class, 'show'])
        ->name('proyectos.show')
        ->middleware('role:cliente');

    // Artesano: solo crear, editar y eliminar sus proyectos
    Route::middleware('role:artesano')->group(function () {
        Route::get('proyectos/crear', [ProyectoController::class, 'create'])->name('proyectos.create');
        Route::post('proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
        Route::get('proyectos/{proyecto}/edit', [ProyectoController::class, 'edit'])->name('proyectos.edit');
        Route::put('proyectos/{proyecto}', [ProyectoController::class, 'update'])->name('proyectos.update');
        Route::delete('proyectos/{proyecto}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');
    });

    // Portafolios: solo artesanos
    Route::resource('portafolios', PortafolioController::class)->middleware('role:artesano');

    // Mensajes y valoraciones (cualquier usuario autenticado)
    Route::resource('mensajes', MensajeController::class);
    Route::resource('valoraciones', ValoracionController::class);
});
