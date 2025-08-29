@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-md mt-8">

    <h2 class="text-2xl font-bold text-center mb-6">Iniciar Sesión</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 mb-3">
        @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 mb-6">
        @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

        <!-- Botones lado a lado -->
        <div class="flex gap-4">
            <a href="{{ url('/') }}"
               class="flex-1 bg-[#5a2d0c] text-white font-bold px-6 py-2 rounded-xl hover:bg-[#8b4513] transition">
                Volver
            </a>

            <button type="submit"
                class="flex-1 bg-[#5a2d0c] text-white font-bold px-6 py-2 rounded-xl hover:bg-[#8b4513] transition">
                Iniciar Sesión
            </button>
        </div>

    </form>

    <!-- Enlace para registrarse si no tiene cuenta -->
    <p class="mt-4 text-center text-gray-600">
        ¿No tienes cuenta? 
        <a href="{{ route('register') }}" class="text-yellow-500 font-semibold hover:underline">
            Regístrate aquí
        </a>
    </p>

</div>
@endsection
