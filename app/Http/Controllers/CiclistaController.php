<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciclista;
use Illuminate\Support\Facades\Auth;


class CiclistaController extends Controller
{
    public function listBloques()
    {
        return response()->json([
            'ok' => 'Tamos listando los blukis'
        ]);
    }

    public function listBloque($id)
    {
        return response()->json([
            'ok' => 'Tamos listando el bluki ' . $id
        ]);
    }

    
    public function signUp(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required|date',
            'peso_base' => 'required|numeric',
            'altura_base' => 'required|numeric',
            'email' => 'required|email|unique:ciclistas,email',
            'password' => 'required|min:8',
        ]);

        $data['password'] = bcrypt($data['password']);

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
