<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionBloqueController extends Controller
{
    public function listSesioneBloques()
    {
        //
        return response()->json([
            'ok' => 'It works'
        ]);
    }

    public function listSesioneBloque($id)
    {
        //
        return response()->json([
            'ok' => 'It works ID: ' . $id
        ]);
    }
}
