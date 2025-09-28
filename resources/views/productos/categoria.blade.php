@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Título de categoría grande y elegante -->
    <h1 class="mb-4" style="font-family: 'Times New Roman', serif; font-size: 3rem; font-weight: bold;">
        {{ $categoria->nombre }}
    </h1>
    <p style="font-size: 1.2rem;">{{ $categoria->descripcion }}</p>

    <!-- Productos en tarjetas -->
    <div class="row">
        @foreach($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top rounded-top-4" alt="{{ $producto->nombre }}">
                    @else
                        <img src="https://via.placeholder.com/150" class="card-img-top rounded-top-4" alt="{{ $producto->nombre }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title" style="font-family: 'Times New Roman', serif; font-weight: bold;">
                            {{ $producto->nombre }}
                        </h5>
                        <p class="card-text text-muted">{{ $producto->descripcion }}</p>
                        <p class="mt-auto fw-bold">Precio: S/{{ $producto->precio }}</p>
                        <a href="#" class="btn text-white mt-2" 
                           style="background-color: #A0522D; border-radius: 10px; padding: 6px 12px; font-weight: bold; font-size: 0.9rem;">
                            Comprar
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Botón Volver a Categorías más estético y proporcional -->
    <a href="{{ url('/productos') }}" 
       class="btn text-white mt-4" 
       style="background-color: #8B4513; border-radius: 12px; padding: 8px 20px; font-size: 1rem; font-weight: bold; transition: 0.3s;"
       onmouseover="this.style.backgroundColor='#A0522D'"
       onmouseout="this.style.backgroundColor='#8B4513'">
       ← Volver a Categorías
    </a>
</div>
@endsection
