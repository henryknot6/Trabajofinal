<?php

namespace App\Http\Controllers;

use App\Models\Empleo;
use App\Models\Categoria;
use App\Models\Habilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpleoController extends Controller
{
   
    public function index(Request $request)
    {
        $query = Empleo::with(['categoria', 'publicador', 'habilidades'])
                       ->where('estado', 'abierto');

        if ($request->has('categoria_id') && $request->categoria_id != null) {
            $query->where('categoria_id', $request->categoria_id);
        }

        $empleos = $query->latest()->get();

        $categorias = Categoria::all();

        return view('empleos.index', compact('empleos', 'categorias'));
    }

   
    public function create()
    {
        $categorias = Categoria::all();
        $habilidades = Habilidad::all();

        return view('empleos.create', compact('categorias', 'habilidades'));
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|min:20', 
            'categoria_id' => 'required|exists:categorias,id',
            'presupuesto' => 'nullable|numeric|min:0',
            'ubicacion' => 'nullable|string|max:100',
            'habilidades' => 'array' 
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'descripcion.min' => 'La descripción debe ser más detallada (mínimo 20 caracteres).',
            'categoria_id.required' => 'Selecciona una categoría válida.'
        ]);

        $empleo = Auth::user()->empleos()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'presupuesto' => $request->presupuesto,
            'ubicacion' => $request->ubicacion ?? 'Remoto',
            'estado' => 'abierto'
        ]);

        if ($request->has('habilidades')) {
            $empleo->habilidades()->sync($request->habilidades);
        }

        return redirect()->route('empleos.index')
                         ->with('success', '¡Tu vacante ha sido publicada correctamente!');
    }

    
    public function show(Empleo $empleo)
    {
        $empleo->load(['habilidades', 'publicador', 'categoria']);
        
        return view('empleos.show', compact('empleo'));
    }

    
    public function destroy(Empleo $empleo)
    {
        if (Auth::id() !== $empleo->user_id) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $empleo->delete();

        return redirect()->route('empleos.index')
                         ->with('success', 'La vacante fue eliminada exitosamente.');
    }
    
    public function edit(Empleo $empleo) {
        if (Auth::id() !== $empleo->user_id) abort(403);
        $categorias = Categoria::all();
        $habilidades = Habilidad::all();
        return view('empleos.edit', compact('empleo', 'categorias', 'habilidades'));
    }

    public function update(Request $request, Empleo $empleo) {
        if (Auth::id() !== $empleo->user_id) abort(403);
        
        $request->validate(['titulo' => 'required', 'categoria_id' => 'required']);
        $empleo->update($request->all());
        
        if ($request->has('habilidades')) {
            $empleo->habilidades()->sync($request->habilidades);
        }

        return redirect()->route('empleos.index')->with('success', 'Empleo actualizado');
    }
    public function postular(Empleo $empleo)
{
    if (Auth::user()->rol !== 'freelancer') {
        return back()->with('error', 'Solo los freelancers pueden postularse.');
    }

    if ($empleo->candidatos->contains(Auth::id())) {
        return back()->with('error', 'Ya te has postulado a esta vacante anteriormente.');
    }

    $empleo->candidatos()->attach(Auth::id());

    return back()->with('success', '¡Te has postulado correctamente! El reclutador revisará tu perfil.');
}
}