<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciclista;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CiclistaController extends Controller
{
    
    public function signUp(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'peso_base' => 'required|numeric|min:0',
            'altura_base' => 'required|numeric|min:0',
            'email' => 'required|email|unique:ciclista,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);

        $ciclista = Ciclista::create($data);

        return response()->json($ciclista, 201);
    }
    
    public function login(Request $request)
    {
        // Validate the input first (optional but recommended)
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Auth::attempt will automatically hash the supplied password
        if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            // Regenerate the session to avoid fixation attacks
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}