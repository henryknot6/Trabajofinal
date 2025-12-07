<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Acceso - CHAYMBA APP</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-100">
        <div class="mb-6">
            <a href="/" class="flex flex-col items-center">
                <span class="text-4xl font-extrabold text-blue-700 tracking-tighter">CHAYMBA</span>
                <span class="text-xs text-gray-500 uppercase tracking-widest mt-1">Portal de Empleo</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white shadow-xl overflow-hidden sm:rounded-xl border border-gray-100">
            {{ $slot }}
        </div>
        
        <div class="mt-8 text-center text-xs text-gray-400">
            &copy; 2025 CHAYMBA APP. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>