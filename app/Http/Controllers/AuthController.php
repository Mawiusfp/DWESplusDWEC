<?php

namespace App\Http\Controllers;

use App\Models\Ciclista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/')
                ->with('success', 'Logged in successfully.');
        }

        $ciclista = Ciclista::where('email', $request->email)->first();

        if (!$ciclista) {
            $ciclista = Ciclista::create([
                'nombre' => 'Ciclista',
                'apellidos' => 'Nuevo',
                'fecha_nacimiento' => now()->subYears(18)->toDateString(),
                'peso_base' => 70,
                'altura_base' => 170,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($ciclista);
            $request->session()->regenerate();

            redirect('/')
                ->with('success', 'User created and logged in.');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
