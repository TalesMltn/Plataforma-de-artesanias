<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validaciones
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:6|confirmed',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'tipo' => 'required|in:cliente,artesano',
            'seudonimo' => 'nullable|string|max:255|unique:users,seudonimo',
        ]);

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'tipo'=> $request->tipo,
            'seudonimo'=> $request->tipo === 'artesano' ? $request->seudonimo : null,
        ]);

        // Auto login después de registro (opcional)
        Auth::login($user);

        return redirect()->route('home')->with('success','Registro exitoso.');
    }
}
