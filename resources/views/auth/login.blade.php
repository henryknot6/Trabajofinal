<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Bienvenido de nuevo</h2>
        <p class="text-sm text-gray-500 mt-2">Ingresa tus credenciales para acceder</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
            <input id="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5 px-3 bg-gray-50" 
                   type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                   placeholder="ejemplo@correo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-blue-600 hover:text-blue-800 font-semibold" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
            <input id="password" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5 px-3 bg-gray-50" 
                   type="password" name="password" required autocomplete="current-password" 
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Mantener sesión iniciada</span>
            </label>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                Iniciar Sesión
            </button>
        </div>
    </form>
    
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            ¿Aún no tienes cuenta? 
            <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-500">Regístrate gratis</a>
        </p>
    </div>
</x-guest-layout>