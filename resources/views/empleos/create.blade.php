@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Publicar nueva oportunidad</h1>
        <p class="mt-2 text-sm text-gray-600">Completa la información para encontrar al mejor talento.</p>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-100">
        <form action="{{ route('empleos.store') }}" method="POST" class="p-8 space-y-6">
            @csrf

            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título del Puesto <span class="text-red-500">*</span></label>
                <div class="mt-1">
                    <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5 border" 
                           placeholder="Ej: Desarrollador Full Stack Jr.">
                </div>
                @error('titulo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría <span class="text-red-500">*</span></label>
                    <select id="categoria_id" name="categoria_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5 border">
                        <option value="" disabled selected>Selecciona un rubro...</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="presupuesto" class="block text-sm font-medium text-gray-700">Presupuesto / Salario (Opcional)</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number" name="presupuesto" id="presupuesto" value="{{ old('presupuesto') }}" 
                               class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5 border" 
                               placeholder="0.00">
                    </div>
                    @error('presupuesto') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                <input type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion') }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5 border" 
                       placeholder="Ej: Remoto, Ciudad de México, Híbrido">
            </div>

            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción del trabajo <span class="text-red-500">*</span></label>
                <div class="mt-1">
                    <textarea id="descripcion" name="descripcion" rows="5" 
                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5 border" 
                              placeholder="Detalla las responsabilidades y requisitos...">{{ old('descripcion') }}</textarea>
                </div>
                @error('descripcion') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Habilidades Requeridas</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 bg-gray-50 p-4 rounded-lg border border-gray-200 max-h-60 overflow-y-auto">
                    @foreach($habilidades as $habilidad)
                        <div class="flex items-start">
                            <div class="flex h-5 items-center">
                                <input id="skill-{{ $habilidad->id }}" name="habilidades[]" value="{{ $habilidad->id }}" type="checkbox" 
                                       class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                       {{ is_array(old('habilidades')) && in_array($habilidad->id, old('habilidades')) ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="skill-{{ $habilidad->id }}" class="font-medium text-gray-700">{{ $habilidad->nombre }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pt-5 flex justify-end gap-3">
                <a href="{{ route('empleos.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                    Cancelar
                </a>
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Publicar Empleo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection