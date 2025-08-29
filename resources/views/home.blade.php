@extends('layouts.app')

@section('title', 'ArtesanosJunín')

@section('content')

<!-- Hero principal -->
<section class="hero text-center py-16 bg-cover bg-center" 
         style="background-image: url('{{ asset('images/inti.png') }}');">
    <div class="container mx-auto px-6">
        <div class="p-8 bg-white/90 rounded-2xl border shadow-md hover:shadow-lg transition max-w-3xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900">
                Plataforma de Conexión de Empleo para Artesanos
            </h2>
            <p class="text-lg md:text-xl mb-8 leading-relaxed text-gray-700">
                Conecta con artesanos locales de la región Junín y encuentra proyectos únicos que impulsan la cultura y la economía regional.
            </p>
        </div>
    </div>
</section>

<!-- SEPARADOR CURVO -->
<div class="relative">
    <svg class="absolute top-0 w-full h-16 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path fill="currentColor" d="M0,64L48,80C96,96,192,128,288,154.7C384,181,480,203,576,213.3C672,224,768,224,864,202.7C960,181,1056,139,1152,128C1248,117,1344,139,1392,149.3L1440,160V0H0Z"></path>
    </svg>
</div>

<!-- Ventajas principales -->
<section class="py-16 bg-cover bg-center" 
         style="background-image: url('{{ asset('images/jarron.png') }}');">
    <div class="container mx-auto px-6">
        <h3 class="text-3xl font-semibold text-center mb-12 text-white drop-shadow-lg">
            Ventajas de nuestra plataforma
        </h3>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Ventaja 1 -->
            <div class="flex flex-col justify-between p-6 bg-white/90 rounded-2xl border shadow-md hover:shadow-lg transition">
                <div>
                    <h4 class="text-xl font-bold mb-3">Perfiles verificados</h4>
                    <p class="text-gray-700 mb-4">
                        Portafolios con evidencia real de habilidades, técnicas y obras, con protección básica de propiedad intelectual.
                    </p>
                </div>
                <a href="{{ route('perfiles.index') }}" 
                   class="bg-[#5a2d0c] text-white font-bold py-2 px-4 rounded-xl hover:bg-[#8b4513] text-center mt-4">
                    Explorar perfiles
                </a>
            </div>

            <!-- Ventaja 2 -->
            <div class="flex flex-col justify-between p-6 bg-white/90 rounded-2xl border shadow-md hover:shadow-lg transition">
                <div>
                    <h4 class="text-xl font-bold mb-3">Proyectos rápidos</h4>
                    <p class="text-gray-700 mb-4">
                        Publica tus necesidades, recibe propuestas y administra contrataciones de manera sencilla y segura.
                    </p>
                </div>
                <a href="{{ route('proyectos.index') }}" 
                   class="bg-[#5a2d0c] text-white font-bold py-2 px-4 rounded-xl hover:bg-[#8b4513] text-center mt-4">
                    Ver proyectos
                </a>
            </div>

            <!-- Ventaja 3 -->
            <div class="flex flex-col justify-between p-6 bg-white/90 rounded-2xl border shadow-md hover:shadow-lg transition">
                <div>
                    <h4 class="text-xl font-bold mb-3">Valoraciones transparentes</h4>
                    <p class="text-gray-700 mb-4">
                        Califica trabajos completados y construye una reputación sólida en la comunidad de artesanos.
                    </p>
                </div>
                <a href="{{ route('valoraciones.index') }}" 
                   class="bg-[#5a2d0c] text-white font-bold py-2 px-4 rounded-xl hover:bg-[#8b4513] text-center mt-4">
                    Valoraciones
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
