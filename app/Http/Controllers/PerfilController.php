<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PerfilController extends Controller
{
    /**
     * Display a listing of all artesanos.
     */
    public function index()
    {
        // Obtener todos los usuarios tipo artesano
        $artesanos = User::where('role', 'artesano')->get();

        return view('perfil.index', compact('artesanos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Formulario de creación de perfil (opcional, si los artesanos editan su perfil)
        return view('perfil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Guardar perfil nuevo o actualización
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ubicacion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $perfil = \App\Models\Perfil::create($request->all());

        return redirect()->route('perfil.show', $perfil->user_id)
                         ->with('success', 'Perfil creado correctamente');
    }

    /**
     * Display the specified resource by ID.
     */
    public function show(string $id)
    {
        $user = User::with('perfil')->findOrFail($id);

        return view('perfil.show', compact('user'));
    }

    /**
     * Display the specified resource by seudónimo.
     */
    public function seudonimo(string $seudonimo)
    {
        $user = User::with('perfil')->where('seudonimo', $seudonimo)->firstOrFail();

        return view('perfil.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perfil = \App\Models\Perfil::where('user_id', $id)->firstOrFail();

        return view('perfil.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perfil = \App\Models\Perfil::where('user_id', $id)->firstOrFail();

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ubicacion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $perfil->update($request->all());

        return redirect()->route('perfil.show', $id)
                         ->with('success', 'Perfil actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perfil = \App\Models\Perfil::where('user_id', $id)->firstOrFail();
        $perfil->delete();

        return redirect()->route('perfil.index')->with('success', 'Perfil eliminado correctamente');
    }
}
