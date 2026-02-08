<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciclista;


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
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'peso_base' => 'required|numeric',
            'altura_base' => 'required|numeric',
            'email' => 'required|email|unique:ciclistas,email',
            'password' => 'required|string|min:6',
        ]);

        $ciclista = Ciclista::create($data);

        return response()->json([
            'message' => 'Ciclista creado',
            'data' => $ciclista
        ], 201);
    }


}
