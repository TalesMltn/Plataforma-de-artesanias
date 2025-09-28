@extends('layouts.app')

@section('title', 'Registro de Usuario')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-md mt-8">
    <h2 class="text-2xl font-bold text-center mb-6">Registrarse</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Nombre</label>
        <input type="text" name="name" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 mb-1"
               value="{{ old('name') }}">
        @error('name')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror

        <label>Email</label>
        <input type="email" name="email" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 mb-1"
               value="{{ old('email') }}">
        @error('email')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror

        <label>Teléfono</label>
        <input type="text" name="telefono"
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 mb-1"
               value="{{ old('telefono') }}">
        @error('telefono')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror

        <label>Contraseña</label>
        <input type="password" name="password" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 mb-1">
        @error('password')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror

        <label>Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 mb-1">

        <label>Tipo de Usuario</label>
        <select name="tipo" id="tipo" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 mb-1">
            <option value="cliente" {{ old('tipo') == 'cliente' ? 'selected' : '' }}>Cliente</option>
            <option value="artesano" {{ old('tipo') == 'artesano' ? 'selected' : '' }}>Artesano</option>
        </select>
        @error('tipo')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror

        <!-- Seudónimo: solo visible si es artesano -->
        <div id="seudonimo-container" class="mb-3 {{ old('tipo') === 'artesano' ? '' : 'hidden' }}">
            <label>Seudónimo</label>
            <input type="text" name="seudonimo" id="seudonimo"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                   placeholder="Ingresa tu seudónimo" value="{{ old('seudonimo') }}">
            @error('seudonimo')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones lado a lado -->
        <div class="flex gap-4 mt-4">
            <a href="{{ url('/') }}"
            class="flex-1 bg-[#5a2d0c] text-white py-2 rounded-xl hover:bg-[#8b4513] transition text-center">
                Volver
            </a>

            <button type="submit"
                    class="flex-1 bg-[#5a2d0c] text-white py-2 rounded-xl hover:bg-[#8b4513] transition">
                Registrarse
            </button>
        </div>
    </form>
</div>

<script>
    const tipoSelect = document.getElementById('tipo');
    const seudonimoContainer = document.getElementById('seudonimo-container');

    tipoSelect.addEventListener('change', function() {
        if (this.value === 'artesano') {
            seudonimoContainer.classList.remove('hidden');
        } else {
            seudonimoContainer.classList.add('hidden');
        }
    });
</script>
@endsection
