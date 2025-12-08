<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Información del Perfil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Actualiza tu información personal y profesional.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="border-t border-gray-200 mt-8 pt-6">
            <h3 class="text-lg font-bold text-blue-600 mb-4">🚀 Perfil Profesional</h3>

            <div class="mb-4">
                <x-input-label for="titulo_profesional" :value="__('Título Profesional')" />
                <x-text-input id="titulo_profesional" name="titulo_profesional" type="text" class="mt-1 block w-full" 
                              :value="old('titulo_profesional', $user->titulo_profesional)" 
                              placeholder="Ej: Desarrollador Web Senior" />
                <x-input-error class="mt-2" :messages="$errors->get('titulo_profesional')" />
            </div>

            <div class="mb-4">
                <x-input-label for="biografia" :value="__('Experiencia / Biografía')" />
                <textarea id="biografia" name="biografia" rows="4" 
                          class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                          placeholder="Cuéntanos sobre tu experiencia...">{{ old('biografia', $user->biografia) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('biografia')" />
            </div>

            <div>
                <x-input-label :value="__('Mis Habilidades')" class="mb-2" />
                <div class="grid grid-cols-2 gap-2 bg-gray-50 dark:bg-gray-700 p-4 rounded border dark:border-gray-600 max-h-48 overflow-y-auto">
                    @foreach(\App\Models\Habilidad::all() as $habilidad)
                        <div class="flex items-center">
                            <input type="checkbox" name="habilidades[]" value="{{ $habilidad->id }}" 
                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                   {{ in_array($habilidad->id, $user->habilidades->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $habilidad->nombre }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 mt-6">
            <x-primary-button>{{ __('Guardar Cambios') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>