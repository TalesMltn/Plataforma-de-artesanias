<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perfil;

class PerfilController extends Controller
{
    /**
     * Display a listing of all artesanos.
     */
    public function index()
    {
        // Solo mostrar usuarios con rol artesano y que tengan seudónimo
        $artesanos = User::where('tipo', 'artesano')
                        ->whereNotNull('seudonimo')
                        ->get();

        return view('perfil.index', compact('artesanos'));
    }

    /**
     * Show the form for creating a new profile.
     */
    public function create()
    {
        return view('perfil.create');
    }

    /**
     * Store a newly created resource in storage.
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

        $perfil = Perfil::create($request->all());

        // 🔑 redirigir usando seudonimo
        return redirect()->route('perfil.show', $perfil->user->seudonimo)
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
        // 👇 Aquí cargamos perfil + portafolios del artesano
        $user = User::with(['perfil', 'portafolios'])
                    ->where('seudonimo', $seudonimo)
                    ->firstOrFail();

        return view('perfil.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perfil = Perfil::where('user_id', $id)->firstOrFail();

        return view('perfil.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
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

        $perfil->update($request->all());

        // 🔑 redirigir usando seudonimo
        return redirect()->route('perfil.show', $perfil->user->seudonimo)
                         ->with('success', 'Perfil actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perfil = Perfil::where('user_id', $id)->firstOrFail();
        $perfil->delete();

        return redirect()->route('perfiles.index')
                         ->with('success', 'Perfil eliminado correctamente');
    }
}
