@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="h-32 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
            
            <div class="px-6 pb-6">
                <div class="flex justify-between items-end -mt-12 mb-6">
                    <div class="h-24 w-24 rounded-full border-4 border-white bg-gray-800 flex items-center justify-center text-4xl font-bold text-white shadow-md">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    
                    @auth
                        @if(Auth::user()->rol === 'cliente')
                            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full shadow transition">
                                Enviar Mensaje
                            </button>
                        @endif
                        
                        @if(Auth::id() === $user->id)
                            <a href="{{ route('profile.edit') }}" class="text-sm text-gray-500 hover:text-blue-600 underline">Editar mi perfil</a>
                        @endif
                    @endauth
                </div>
                
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-xl text-blue-600 font-medium">{{ $user->titulo_profesional ?? 'Freelancer' }}</p>
                    <p class="text-sm text-gray-500 flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        {{ $user->email }}
                    </p>
                </div>

                <hr class="my-6 border-gray-200">

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Sobre mí / Experiencia</h3>
                    <div class="text-gray-700 whitespace-pre-line leading-relaxed">
                        {{ $user->biografia ?? 'Este usuario no ha agregado información aún.' }}
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Habilidades</h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse($user->habilidades as $habilidad)
                            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium border border-blue-100">
                                {{ $habilidad->nombre }}
                            </span>
                        @empty
                            <span class="text-gray-400 text-sm italic">No hay habilidades registradas.</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection