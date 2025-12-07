@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold leading-6 text-gray-900">{{ $empleo->titulo }}</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Publicado por {{ $empleo->publicador->name }} en {{ $empleo->categoria->nombre }}</p>
        </div>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
            {{ $empleo->estado }}
        </span>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Presupuesto</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-bold">{{ $empleo->presupuesto ? '$'.number_format($empleo->presupuesto) : 'No especificado' }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Ubicación</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $empleo->ubicacion }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Descripción</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-line">{{ $empleo->descripcion }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Habilidades Requeridas</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <div class="flex flex-wrap gap-2">
                        @foreach($empleo->habilidades as $skill)
                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-md text-xs border border-gray-300">{{ $skill->nombre }}</span>
                        @endforeach
                    </div>
                </dd>
            </div>
        </dl>
    </div>
    
   <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-end gap-3">
        <a href="{{ route('empleos.index') }}" class="text-gray-600 hover:text-gray-900 font-medium text-sm py-2 px-4 flex items-center">
            Volver
        </a>
        
        @auth
    @if(Auth::user()->rol === 'freelancer')
        
        @if($empleo->candidatos->contains(Auth::user()->id))
            
            <button disabled class="bg-gray-400 text-white font-bold py-2 px-4 rounded cursor-not-allowed flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Ya te has postulado
            </button>
        
        @else
            
            <form action="{{ route('empleos.postular', $empleo) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Postularme ahora
                </button>
            </form>
            
        @endif

    @endif
            
            @if(Auth::id() === $empleo->user_id)
                
                <a href="{{ route('empleos.edit', $empleo) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition">
                    Editar
                </a>

                <form action="{{ route('empleos.destroy', $empleo) }}" method="POST" onsubmit="return confirm('¿Estás seguro de borrar este empleo?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">
                        Eliminar
                    </button>
                </form>
            @endif
        @endauth
    </div>
</div>
@endsection