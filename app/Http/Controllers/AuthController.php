<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register'); // tu Blade de registro
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'telefono'   => 'nullable|string|max:20',
            'direccion'  => 'nullable|string|max:255',
            'tipo'       => 'required|in:cliente,artesano',
            'seudonimo'  => 'nullable|string|max:100',
            'password'   => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'telefono'   => $request->telefono,
            'direccion'  => $request->direccion,
            'tipo'       => $request->tipo, // ✅ guardamos tipo correcto
            'seudonimo'  => $request->tipo === 'artesano' ? $request->seudonimo : null,
            'password'   => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registro exitoso');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
