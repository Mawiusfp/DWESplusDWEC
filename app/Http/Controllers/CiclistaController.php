<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciclista;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CiclistaController extends Controller
{

    public function listCiclistas()
    {
        $ciclistas = Ciclista::all();
        return response()->json([
            'status' => 'success',
            'data' => $ciclistas
        ]);
    }

    public function listCiclista($id)
    {
        $ciclista = Ciclista::find($id);
        
        if (!$ciclista) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ciclista no encontrado'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $ciclista
        ]);
    }

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

        return response()->json([
            'status' => 'success',
            'message' => 'Ciclista creado correctamente',
            'data' => $ciclista
        ], 201);
    }

    public function updateCiclista(Request $request, $id)
    {
        $ciclista = Ciclista::find($id);
        
        if (!$ciclista) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ciclista no encontrado'
            ], 404);
        }

        $validatedData = $request->validate([
            'nombre' => 'string|max:255',
            'apellidos' => 'string|max:255',
            'fecha_nacimiento' => 'date',
            'peso_base' => 'numeric|min:0',
            'altura_base' => 'numeric|min:0',
            'email' => 'email|unique:ciclista,email,' . $id,
            'password' => 'min:8|confirmed',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $ciclista->update($validatedData);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Ciclista actualizado correctamente',
            'data' => $ciclista
        ]);
    }

    /**
     * Remove the specified ciclista.
     */
    public function deleteCiclista($id)
    {
        $ciclista = Ciclista::find($id);
        
        if (!$ciclista) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ciclista no encontrado'
            ], 404);
        }

        $ciclista->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Ciclista eliminado correctamente'
        ]);
    }
    
    /**
     * Login a ciclista.
     */
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
    
    /**
     * Get the authenticated ciclista.
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}