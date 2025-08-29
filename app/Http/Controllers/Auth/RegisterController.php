<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'tipo' => 'required|in:cliente,artesano',
            'seudonimo' => 'required_if:tipo,artesano|string|max:255|unique:users,seudonimo'
        ]);

        // Crear usuario
        User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'telefono' => $request->telefono ?? null,
            'tipo'=> $request->tipo,
            'seudonimo'=> $request->tipo === 'artesano' ? $request->seudonimo : null,
        ]);

        return redirect()->route('login')->with('success','Registro exitoso. Por favor inicia sesión.');
    }
}
