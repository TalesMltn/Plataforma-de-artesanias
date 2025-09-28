@extends('layouts.app')

@section('title', 'Crear Perfil')

@section('content')
<div class="container mx-auto px-6 py-12 max-w-3xl">
    <div class="bg-white p-8 rounded-2xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-[#5a2d0c]">Crear Perfil</h1>

        <form action="{{ route('perfiles.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="user_id" class="block text-gray-700">Usuario</label>
                <select name="user_id" id="user_id" class="w-full border rounded p-2">
                    @foreach(\App\Models\User::all() as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="w-full border rounded p-2" value="{{ old('nombre') }}">
                @error('nombre')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="w-full border rounded p-2">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="ubicacion" class="block text-gray-700">Ubicación</label>
                <input type="text" name="ubicacion" id="ubicacion" class="w-full border rounded p-2" value="{{ old('ubicacion') }}">
                @error('ubicacion')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="telefono" class="block text-gray-700">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="w-full border rounded p-2" value="{{ old('telefono') }}">
                @error('telefono')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-[#5a2d0c] text-white px-4 py-2 rounded hover:bg-[#7b3f14]">
                Guardar Perfil
            </button>
        </form>
    </div>
</div>
@endsection
