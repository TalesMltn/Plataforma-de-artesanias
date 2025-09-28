@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Perfil de {{ $user->name }}</h1>

    <div class="mb-4">
        <h3>Información</h3>
        <p><strong>Nombre:</strong> {{ $user->perfil->nombre ?? $user->name }}</p>
        <p><strong>Descripción:</strong> {{ $user->perfil->descripcion ?? 'Sin descripción' }}</p>
        <p><strong>Ubicación:</strong> {{ $user->perfil->ubicacion ?? 'No registrada' }}</p>
        <p><strong>Teléfono:</strong> {{ $user->perfil->telefono ?? 'No disponible' }}</p>
    </div>

    <div class="mb-4">
        <h3>Portafolio</h3>
        @if($user->portafolios->count())
            <div class="row">
                @foreach($user->portafolios as $item)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            @if($item->imagen)
                                <img src="{{ asset('storage/' . $item->imagen) }}" class="card-img-top" alt="{{ $item->titulo }}">
                            @endif
                            <div class="card-body">
                                <h5>{{ $item->titulo }}</h5>
                                <p>{{ $item->descripcion }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Este artesano aún no tiene portafolio publicado.</p>
        @endif
    </div>
</div>
@endsection
