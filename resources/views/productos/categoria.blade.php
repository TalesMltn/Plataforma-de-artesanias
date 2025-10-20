@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Botón Volver arriba -->
    <a href="{{ url('/productos') }}" 
       class="btn text-white mb-4" 
       style="background-color: #8B4513; border-radius: 12px; padding: 8px 20px; font-size: 1rem; font-weight: bold; transition: 0.3s;"
       onmouseover="this.style.backgroundColor='#A0522D'"
       onmouseout="this.style.backgroundColor='#8B4513'">
       ← Volver a Categorías
    </a>

    <!-- Título y descripción -->
    <h1 class="mb-4" style="font-family: 'Times New Roman', serif; font-size: 3rem; font-weight: bold;">
        {{ $categoria->nombre }}
    </h1>
    <p style="font-size: 1.2rem;">{{ $categoria->descripcion }}</p>

    <!-- Productos en columnas de texto -->
    <div style="column-count: 4; column-gap: 40px;">
        @foreach($productos as $producto)
            <div style="break-inside: avoid; margin-bottom: 20px;">
                <h5 style="font-weight: bold;">{{ $producto->nombre }}</h5>
                <p class="text-muted">{{ $producto->descripcion }}</p>
                <p><strong>Precio: S/{{ $producto->precio }}</strong></p>
                <a href="#" class="btn btn-sm text-white" 
                   style="background-color: #A0522D; border-radius: 8px; padding: 4px 10px; font-weight: bold;">
                    Comprar
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
