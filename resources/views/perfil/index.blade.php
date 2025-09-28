@extends('layouts.app')

@section('content')
<div class="flex-grow container mx-auto px-6 py-8 bg-[#fff8f0] rounded-xl shadow-md mt-6">
    <h1 class="mb-6 text-center text-3xl font-extrabold text-[#d97706]">🏺 Nuestros Artesanos 🧶</h1>

    @if($artesanos->isEmpty())
        <p class="text-center text-gray-600">No hay artesanos registrados todavía.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($artesanos as $artesano)
                <div class="bg-white rounded-xl shadow-lg p-5 text-center">
                    {{-- Seudónimo --}}
                    <h4 class="font-bold text-xl mb-3 text-gray-800">{{ $artesano->seudonimo ?? $artesano->name }}</h4>

                    {{-- Botón Ver Perfil --}}
                    <a href="{{ route('perfil.seudonimo', $artesano->seudonimo) }}"
                       class="inline-block px-6 py-2 mb-3 rounded-full font-semibold text-white bg-[#f97316] hover:bg-[#ea580c] transition-colors shadow-md">
                        Ver Perfil
                    </a>

                    {{-- Info resumida --}}
                    <p class="text-gray-600 text-sm">
                        {{ Str::limit($artesano->perfil->descripcion ?? 'Este artesano aún no ha agregado una descripción.', 90) }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
