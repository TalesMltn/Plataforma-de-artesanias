<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perfil;

class PerfilController extends Controller
{
    /**
     * Mostrar todos los artesanos con perfil.
     */
    public function index()
    {
        // Solo usuarios con tipo 'artesano' y que tengan seudónimo
        $artesanos = User::with('perfil')
        ->where('tipo', 'artesano')
        ->whereNotNull('seudonimo')
        ->get();

        return view('perfil.index', compact('artesanos'));
    }

    /**
     * Formulario para crear un perfil.
     */
    public function create()
    {
        return view('perfil.create');
    }

    /**
     * Guardar un perfil nuevo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ubicacion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        // Crear perfil correctamente vinculado al usuario
        $perfil = Perfil::create([
            'user_id' => $request->user_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'ubicacion' => $request->ubicacion,
            'telefono' => $request->telefono,
        ]);

        $user = $perfil->user; // relación user()
        return redirect()->route('perfil.seudonimo', $user->seudonimo ?? $user->id)
                         ->with('success', 'Perfil creado correctamente');
    }

    /**
     * Mostrar perfil por ID de usuario.
     */
    public function show(string $id)
    {
        $user = User::with('perfil')->findOrFail($id);
        return view('perfil.show', compact('user'));
    }

    /**
     * Mostrar perfil por seudónimo.
     */
    public function seudonimo(string $seudonimo)
    {
        $user = User::with(['perfil', 'portafolios'])
                    ->where('seudonimo', $seudonimo)
                    ->firstOrFail();

        return view('perfil.show', compact('user'));
    }

    /**
     * Formulario para editar perfil.
     */
    public function edit(string $id)
    {
        $perfil = Perfil::where('user_id', $id)->firstOrFail();
        return view('perfil.edit', compact('perfil'));
    }

    /**
     * Actualizar perfil existente.
     */
    public function update(Request $request, string $id)
    {
        $perfil = Perfil::where('user_id', $id)->firstOrFail();

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ubicacion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $perfil->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'ubicacion' => $request->ubicacion,
            'telefono' => $request->telefono,
        ]);

        $user = $perfil->user;
        return redirect()->route('perfil.seudonimo', $user->seudonimo ?? $user->id)
                         ->with('success', 'Perfil actualizado correctamente');
    }

    /**
     * Eliminar perfil.
     */
    public function destroy(string $id)
    {
        $perfil = Perfil::where('user_id', $id)->firstOrFail();
        $perfil->delete();

        return redirect()->route('perfiles.index')
                         ->with('success', 'Perfil eliminado correctamente');
    }
}
