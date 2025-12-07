@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Editar Vacante</h1>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-100">
        <form action="{{ route('empleos.update', $empleo) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT') <div>
                <label class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="titulo" value="{{ old('titulo', $empleo->titulo) }}" 
                       class="block w-full rounded-md border-gray-300 shadow-sm p-2.5 border">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Categoría</label>
                <select name="categoria_id" class="block w-full rounded-md border-gray-300 shadow-sm p-2.5 border">
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ $empleo->categoria_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" rows="5" class="block w-full rounded-md border-gray-300 shadow-sm p-2.5 border">{{ old('descripcion', $empleo->descripcion) }}</textarea>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('empleos.index') }}" class="py-2 px-4 border rounded text-gray-700">Cancelar</a>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                    Actualizar Empleo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection