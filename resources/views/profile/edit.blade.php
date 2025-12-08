@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Mi Perfil') }}
            </h2>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-gray-100">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Información del Perfil') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Actualiza tus datos personales y profesionales.") }}
                        </p>
                    </header>
                
                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                
                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="name">Nombre</label>
                            <input class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full" 
                                   id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus />
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                
                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="email">Correo Electrónico</label>
                            <input class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full" 
                                   id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required />
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        @if($user->rol === 'freelancer')
                        <div class="border-t border-gray-200 mt-8 pt-6">
                            <h3 class="text-lg font-bold text-blue-600 mb-4 flex items-center gap-2">
                                🚀 Perfil Profesional
                            </h3>

                            <div class="mb-4">
                                <label class="block font-medium text-sm text-gray-700" for="titulo_profesional">Título Profesional</label>
                                <input class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full" 
                                       id="titulo_profesional" name="titulo_profesional" type="text" 
                                       value="{{ old('titulo_profesional', $user->titulo_profesional) }}" 
                                       placeholder="Ej: Desarrollador Web Senior" />
                            </div>

                            <div class="mb-4">
                                <label class="block font-medium text-sm text-gray-700" for="biografia">Experiencia / Biografía</label>
                                <textarea class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full" 
                                          id="biografia" name="biografia" rows="4" 
                                          placeholder="Cuéntanos sobre tus proyectos anteriores...">{{ old('biografia', $user->biografia) }}</textarea>
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700 mb-2">Mis Habilidades</label>
                                <div class="grid grid-cols-2 gap-2 bg-gray-50 p-4 rounded border border-gray-200 max-h-48 overflow-y-auto">
                                    @foreach(\App\Models\Habilidad::all() as $habilidad)
                                        <div class="flex items-center">
                                            <input type="checkbox" name="habilidades[]" value="{{ $habilidad->id }}" 
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 mr-2"
                                                   {{ in_array($habilidad->id, $user->habilidades->pluck('id')->toArray()) ? 'checked' : '' }}>
                                            <label class="text-sm text-gray-700">{{ $habilidad->nombre }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                
                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Guardar Cambios') }}
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-bold">
                                    {{ __('¡Guardado correctamente!') }}
                                </p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-gray-100">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-gray-100">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection