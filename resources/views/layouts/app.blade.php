<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Proyecto de Artesanías')</title>

    <!-- Tailwind CSS CDN (si no lo tienes instalado) -->
    <script src="https://cdn.tailwindcss.com"></script>

    @yield('head')
</head>
<body class="flex flex-col min-h-screen bg-gradient-to-br from-[#f5f5dc] to-[#e6d5b8] text-gray-800">

    <!-- Barra de navegación -->
    <nav class="flex items-center justify-between px-6 py-4 bg-[#5a2d0c]">
        <!-- Enlaces a la izquierda -->
        <div class="flex gap-6">
            <a href="{{ url('/') }}" class="text-white font-bold hover:text-yellow-400">Inicio</a>
            <a href="{{ route('productos.index') }}" class="text-white font-bold hover:text-yellow-400">Artesanías</a>
            <a href="{{ route('contacto') }}" class="text-white font-bold hover:text-yellow-400">Contacto</a>
        </div>

        <!-- Botones de usuario + logo -->
        <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="bg-white text-[#5a2d0c] font-bold px-4 py-2 rounded-xl hover:bg-gray-100 transition">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}" class="bg-[#ffd700] text-[#5a2d0c] font-bold px-4 py-2 rounded-xl hover:bg-yellow-400 transition">
                    Registrarse
                </a>
            @else
                <span class="text-white font-semibold">Hola, {{ Auth::user()->name }}</span>

                <!-- Menú solo para admin -->
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Usuarios</a>
                    <a href="{{ route('admin.clientes.index') }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Clientes</a>
                    <a href="{{ route('admin.artesanos.index') }}" class="bg-yellow-600 text-white px-3 py-1 rounded hover:bg-yellow-700">Artesanos</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white font-bold px-4 py-2 rounded-xl hover:bg-red-700 transition">
                        Cerrar sesión
                    </button>
                </form>
            @endguest

            <!-- Logo -->
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/NRG.png') }}" alt="Logo Artesanías" class="h-10">
            </a>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="flex-grow container mx-auto px-6 py-8 bg-[#fff8f0] rounded-xl shadow-md mt-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#5a2d0c] text-white text-center py-4 mt-6">
        &copy; {{ date('Y') }} Artesanías - Todos los derechos reservados.
    </footer>

    @yield('scripts')
</body>
</html>
