<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CHAYMBA') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">
    
    <nav class="bg-white border-b border-gray-200 fixed w-full z-30 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-extrabold text-blue-700 tracking-tighter">
                            CHAYMBA
                        </a>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('empleos.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 transition duration-150 ease-in-out">
                            Empleos
                        </a>
                        @auth
                            @if(Auth::user()->rol === 'cliente')
                            <a href="{{ route('empleos.create') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-blue-600 hover:border-blue-600 transition duration-150 ease-in-out">
                                Publicar Oferta
                            </a>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="flex items-center">
                    @auth
                        <div class="ml-3 relative flex items-center space-x-4">
                            <span class="text-sm text-gray-500">Hola, {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->rol) }})</span>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-semibold">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="space-x-4">
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-blue-600 font-medium">Iniciar Sesión</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">Registrarse</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-24 pb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-screen">
        
        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm leading-5 font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm">
                <div class="flex">
                    <div class="ml-3">
                        <p class="text-sm leading-5 font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')

    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto py-6">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; 2025 CHAYMBA. Todos los derechos reservados.
        </div>
    </footer>
</body>
</html>