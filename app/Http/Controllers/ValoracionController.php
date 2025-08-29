<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use App\Models\Perfil;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @method void authorize(string $ability, mixed $model)
 */
class ValoracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $valoraciones = Valoracion::with('perfil', 'proyecto', 'emisor')
                                 ->where('perfil_id', Auth::user()->perfil->id)
                                 ->orWhere('emisor_id', Auth::user()->perfil->id)
                                 ->get();
        return view('valoraciones.index', compact('valoraciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perfiles = Perfil::all(); // Para seleccionar el perfil a evaluar
        $proyectos = Proyecto::all(); // Para asociar la valoración a un proyecto
        return view('valoraciones.create', compact('perfiles', 'proyectos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'perfil_id' => 'required|exists:perfiles,id',
            'proyecto_id' => 'nullable|exists:proyectos,id',
            'puntaje' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:1000',
        ]);

        $valoracion = new Valoracion($request->all());
        $valoracion->emisor_id = Auth::user()->perfil->id;
        $valoracion->save();

        return redirect()->route('valoraciones.index')->with('success', 'Valoración creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $valoracion = Valoracion::with('perfil', 'proyecto', 'emisor')->findOrFail($id);
        $this->authorize('view', $valoracion);
        return view('valoraciones.show', compact('valoracion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $valoracion = Valoracion::findOrFail($id);
        $this->authorize('update', $valoracion);
        $perfiles = Perfil::all();
        $proyectos = Proyecto::all();
        return view('valoraciones.edit', compact('valoracion', 'perfiles', 'proyectos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $valoracion = Valoracion::findOrFail($id);
        $this->authorize('update', $valoracion);

        $request->validate([
            'perfil_id' => 'required|exists:perfiles,id',
            'proyecto_id' => 'nullable|exists:proyectos,id',
            'puntaje' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:1000',
        ]);

        $valoracion->update($request->all());

        return redirect()->route('valoraciones.index')->with('success', 'Valoración actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $valoracion = Valoracion::findOrFail($id);
        $this->authorize('delete', $valoracion);
        $valoracion->delete();

        return redirect()->route('valoraciones.index')->with('success', 'Valoración eliminada exitosamente.');
    }
}