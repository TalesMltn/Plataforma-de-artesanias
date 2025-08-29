<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @method void authorize(string $ability, mixed $model)
 */
class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::with('perfil')->where('estado', 'abierto')->get();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        return view('proyectos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'presupuesto' => 'nullable|numeric|min:0',
            'estado' => 'in:abierto,en progreso,completado',
        ]);

        $proyecto = new Proyecto($request->all());
        $proyecto->perfil_id = Auth::user()->perfil->id;
        $proyecto->save();

        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado exitosamente.');
    }

    public function show(string $id)
    {
        $proyecto = Proyecto::with('perfil', 'valoraciones', 'mensajes')->findOrFail($id);
        return view('proyectos.show', compact('proyecto'));
    }

    public function edit(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $this->authorize('update', $proyecto);
        return view('proyectos.edit', compact('proyecto'));
    }

    public function update(Request $request, string $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $this->authorize('update', $proyecto);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'presupuesto' => 'nullable|numeric|min:0',
            'estado' => 'in:abierto,en progreso,completado',
        ]);

        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $this->authorize('delete', $proyecto);
        $proyecto->delete();

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado exitosamente.');
    }
}