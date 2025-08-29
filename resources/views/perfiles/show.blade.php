@extends('layouts.app')

@section('title', $user->name . ' - Perfil')

@section('content')
<div class="container mx-auto px-6 py-12 max-w-3xl">
    <div class="bg-white p-8 rounded-2xl shadow-md">
        <h1 class="text-3xl font-bold mb-4 text-[#5a2d0c]">{{ $user->name }}</h1>

        @if($user->seudonimo)
            <p><strong>Seudónimo:</strong> {{ $user->seudonimo }}</p>
        @endif

        @if($user->telefono)
            <p><strong>Teléfono:</strong> {{ $user->telefono }}</p>
        @endif

        <p><strong>Tipo de Usuario:</strong> {{ ucfirst($user->role) }}</p>

        @if($user->perfil)
            @if($user->perfil->descripcion)
                <p class="mt-4"><strong>Descripción:</strong> {{ $user->perfil->descripcion }}</p>
            @endif

            @if($user->perfil->ubicacion)
                <p><strong>Ubicación:</strong> {{ $user->perfil->ubicacion }}</p>
            @endif
        @endif
    </div>
</div>
@endsection
