@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-gray-800 p-6 rounded-2xl shadow-lg">
    <h1 class="text-2xl font-bold text-white mb-6">📚 Lista de Cursos</h1>

    <a href="{{ route('cursos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mb-4 inline-block">
        ➕ Agregar Curso
    </a>

    @if(session('success'))
        <div class="bg-green-600 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-700 text-gray-200">
                <th class="p-3">ID</th>
                <th class="p-3">Título</th>
                <th class="p-3">Descripción</th>
                <th class="p-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
                <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                    <td class="p-3">{{ $curso->id }}</td>
                    <td class="p-3 font-semibold">{{ $curso->titulo }}</td>
                    <td class="p-3">{{ $curso->descripcion }}</td>
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('cursos.edit', $curso) }}" class="text-yellow-400 hover:text-yellow-300">✏️</a>
                        <form action="{{ route('cursos.destroy', $curso) }}" method="POST" onsubmit="return confirm('¿Eliminar curso?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:text-red-300">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
