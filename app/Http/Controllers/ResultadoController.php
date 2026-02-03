<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultadoController extends Controller
{
    public function listResultados()
    {
        //
        return response()->json([
            'ok' => 'It works'
        ]);
    }

    public function listResultado($id)
    {
        //
        return response()->json([
            'ok' => 'It works ID: ' . $id
        ]);
    }
}
