<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Perfil;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @method void authorize(string $ability, mixed $model)
 */
class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mensajes = Mensaje::where('receptor_id', Auth::user()->perfil->id)
                           ->orWhere('emisor_id', Auth::user()->perfil->id)
                           ->with('emisor', 'receptor', 'proyecto')
                           ->get();
        return view('mensajes.index', compact('mensajes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perfiles = Perfil::all(); // Para seleccionar receptor
        $proyectos = Proyecto::where('perfil_id', Auth::user()->perfil->id)->get(); // Proyectos del usuario
        return view('mensajes.create', compact('perfiles', 'proyectos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receptor_id' => 'required|exists:perfiles,id',
            'proyecto_id' => 'nullable|exists:proyectos,id',
            'contenido' => 'required|string',
        ]);

        $mensaje = new Mensaje($request->all());
        $mensaje->emisor_id = Auth::user()->perfil->id;
        $mensaje->leido = false;
        $mensaje->save();

        return redirect()->route('mensajes.index')->with('success', 'Mensaje enviado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mensaje = Mensaje::with('emisor', 'receptor', 'proyecto')->findOrFail($id);
        $this->authorize('view', $mensaje);
        if ($mensaje->receptor_id === Auth::user()->perfil->id && !$mensaje->leido) {
            $mensaje->update(['leido' => true]);
        }
        return view('mensajes.show', compact('mensaje'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mensaje = Mensaje::findOrFail($id);
        $this->authorize('update', $mensaje);
        $perfiles = Perfil::all();
        $proyectos = Proyecto::where('perfil_id', Auth::user()->perfil->id)->get();
        return view('mensajes.edit', compact('mensaje', 'perfiles', 'proyectos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mensaje = Mensaje::findOrFail($id);
        $this->authorize('update', $mensaje);

        $request->validate([
            'receptor_id' => 'required|exists:perfiles,id',
            'proyecto_id' => 'nullable|exists:proyectos,id',
            'contenido' => 'required|string',
        ]);

        $mensaje->update($request->all());

        return redirect()->route('mensajes.index')->with('success', 'Mensaje actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mensaje = Mensaje::findOrFail($id);
        $this->authorize('delete', $mensaje);
        $mensaje->delete();

        return redirect()->route('mensajes.index')->with('success', 'Mensaje eliminado exitosamente.');
    }
}