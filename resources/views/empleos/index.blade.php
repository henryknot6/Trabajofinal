@extends('layouts.app')

@section('content')
@auth
    @if(Auth::user()->rol === 'freelancer' && empty(Auth::user()->titulo_profesional))
        <div class="bg-indigo-600 rounded-lg shadow-xl p-6 mb-8 text-white flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold">¡Hola, {{ Auth::user()->name }}! 👋</h2>
                <p class="mt-1 opacity-90">Tu perfil profesional está incompleto. Complétalo para que las empresas te encuentren.</p>
            </div>
            <a href="{{ route('profile.edit') }}" class="bg-white text-indigo-600 px-6 py-2 rounded-full font-bold shadow hover:bg-gray-100 transition">
                Completar Perfil Ahora
            </a>
        </div>
    @endif
@endauth
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    
    <div class="lg:col-span-1">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-24">
            <div class="p-6 border-b border-gray-100">
                <h3 class="font-bold text-gray-900 text-lg mb-4">Categorías</h3>
                <nav class="space-y-2">
                    <a href="{{ route('empleos.index') }}" class="block px-3 py-2 rounded-md text-sm font-medium {{ request('categoria_id') ? 'text-gray-600 hover:bg-gray-50' : 'bg-blue-50 text-blue-700' }}">
                        Todas las vacantes
                    </a>
                    @foreach($categorias as $cat)
                        <a href="{{ route('empleos.index', ['categoria_id' => $cat->id]) }}" 
                           class="block px-3 py-2 rounded-md text-sm font-medium transition {{ request('categoria_id') == $cat->id ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            {{ $cat->nombre }}
                        </a>
                    @endforeach
                </nav>
            </div>
            
            <div class="p-6 bg-gray-50">
                <p class="text-xs text-gray-500 text-center">Publicidad</p>
                <div class="h-32 bg-gray-200 rounded mt-2 flex items-center justify-center text-gray-400 text-xs">
                    Espacio para Anuncios
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-3 space-y-5">
        
        <div class="flex justify-between items-end mb-2">
            <h2 class="text-2xl font-bold text-gray-800">Empleos recomendados</h2>
            <span class="text-sm text-gray-500">{{ $empleos->count() }} resultados encontrados</span>
        </div>

        @forelse($empleos as $empleo)
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div class="flex gap-4">
                            <div class="h-12 w-12 rounded bg-indigo-600 flex items-center justify-center text-white font-bold text-xl shrink-0">
                                {{ substr($empleo->publicador->name ?? 'A', 0, 1) }}
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-bold text-blue-600 hover:underline">
                                    <a href="{{ route('empleos.show', $empleo) }}">{{ $empleo->titulo }}</a>
                                </h3>
                                <p class="text-sm text-gray-900 font-medium">{{ $empleo->publicador->name ?? 'Empresa Confidencial' }}</p>
                                <p class="text-sm text-gray-500 flex items-center gap-1 mt-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $empleo->ubicacion }} • {{ $empleo->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $empleo->categoria->nombre }}
                        </span>
                    </div>

                    <div class="mt-4 text-gray-600 text-sm line-clamp-2">
                        {{ $empleo->descripcion }}
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach($empleo->habilidades->take(4) as $skill)
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-600">
                                {{ $skill->nombre }}
                            </span>
                        @endforeach
                        @if($empleo->habilidades->count() > 4)
                            <span class="text-xs text-gray-500 flex items-center">+{{ $empleo->habilidades->count() - 4 }} más</span>
                        @endif
                    </div>
                </div>
                
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-sm font-bold text-gray-700">
                        {{ $empleo->presupuesto > 0 ? '$' . number_format($empleo->presupuesto) : 'Salario a convenir' }}
                    </span>
                    <a href="{{ route('empleos.show', $empleo) }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        Ver detalles &rarr;
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-white p-12 text-center rounded-lg border border-gray-200 shadow-sm">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay empleos aún</h3>
                <p class="mt-1 text-sm text-gray-500">Sé el primero en publicar una oportunidad.</p>
                @auth
                    @if(Auth::user()->rol === 'cliente')
                    <div class="mt-6">
                        <a href="{{ route('empleos.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Publicar Empleo
                        </a>
                    </div>
                    @endif
                @endauth
            </div>
        @endforelse
    </div>
</div>
@endsection