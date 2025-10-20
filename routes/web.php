<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\PortafolioController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArtesanoController;
use App\Http\Controllers\Admin\ClienteController;

// -----------------------------
// Home público
// -----------------------------
Route::get('/', fn() => view('home'))->name('home');

// -----------------------------
// Registro y login
// -----------------------------
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'showRegisterForm')->name('register.form');
    Route::post('register', 'register')->name('register');
    Route::get('login', 'showLoginForm')->name('login.form');
    Route::post('login', 'login')->name('login');
    Route::post('logout', 'logout')->name('logout');
});

// -----------------------------
// Perfil público por seudónimo
// -----------------------------
Route::get('perfil/{seudonimo}', [PerfilController::class, 'seudonimo'])->name('perfil.seudonimo');

// -----------------------------
// Productos públicos
// -----------------------------
Route::controller(ProductoController::class)->group(function () {
    Route::get('/productos', 'index')->name('productos.index');
    Route::get('/productos/categoria/{slug}', 'categoria')->name('productos.categoria');
    Route::get('/productos/{slug}', 'show')->name('productos.show');
});

// -----------------------------
// Contacto
// -----------------------------
Route::view('/contacto', 'contacto')->name('contacto');

// -----------------------------
// Rutas protegidas
// -----------------------------
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Perfiles (CRUD completo menos show)
    Route::resource('perfiles', PerfilController::class)->except(['show']);

    // -----------------------------
    // Proyectos por rol
    // -----------------------------
    Route::middleware('check.role:cliente')->group(function () {
        Route::get('proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
        Route::get('proyectos/{proyecto}', [ProyectoController::class, 'show'])->name('proyectos.show');
    });

    Route::middleware('check.role:artesano')->group(function () {
        Route::get('proyectos/crear', [ProyectoController::class, 'create'])->name('proyectos.create');
        Route::post('proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
        Route::get('proyectos/{proyecto}/edit', [ProyectoController::class, 'edit'])->name('proyectos.edit');
        Route::put('proyectos/{proyecto}', [ProyectoController::class, 'update'])->name('proyectos.update');
        Route::delete('proyectos/{proyecto}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');

        // Portafolios (solo artesanos)
        Route::resource('portafolios', PortafolioController::class);
    });

    // Mensajes y valoraciones (todos los usuarios autenticados)
    Route::resource('mensajes', MensajeController::class);
    Route::resource('valoraciones', ValoracionController::class);

    // -----------------------------
    // Panel de Administración
    // -----------------------------
    Route::prefix('admin')->name('admin.')->middleware('check.role:admin')->group(function () {
        Route::resource('users', UserController::class)->except(['create','store','show']);
        Route::resource('clientes', ClienteController::class);
        Route::resource('artesanos', ArtesanoController::class);
    });

});
