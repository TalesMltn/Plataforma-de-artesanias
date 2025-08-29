@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<section class="container mx-auto px-6 py-16">
    <h1 class="text-4xl font-bold text-center mb-6 text-[#5a2d0c]">Contáctanos</h1>
    <p class="text-center text-lg mb-12">
        Puedes escribirnos a: <strong class="text-[#5a2d0c]">contacto@artesanosjunin.com</strong>
    </p>

    <div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-md">
        <form method="POST" action="#">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nombre</label>
                <input type="text" name="nombre" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#5a2d0c]"
                    placeholder="Tu nombre">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
                <input type="email" name="email" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#5a2d0c]"
                    placeholder="Tu correo">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Teléfono</label>
                <input type="text" name="telefono"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#5a2d0c]"
                    placeholder="Tu teléfono (opcional)">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Mensaje</label>
                <textarea name="mensaje" rows="5" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#5a2d0c]"
                    placeholder="Escribe tu mensaje aquí"></textarea>
            </div>

            <!-- Botones juntos -->
            <div class="flex justify-between gap-4">
                <a href="{{ url('/') }}" class="flex-1 bg-[#5a2d0c] text-white font-bold py-2 px-4 rounded-xl hover:bg-[#8b4513] text-center transition">
                    Volver
                </a>

                <button type="submit" class="flex-1 bg-[#5a2d0c] text-white font-bold py-2 px-4 rounded-xl hover:bg-[#8b4513] transition">
                    Enviar mensaje
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
