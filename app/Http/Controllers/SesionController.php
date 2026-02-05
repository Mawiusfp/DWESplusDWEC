<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionController extends Controller
{
    public function listSesiones()
    {
        //
        return response()->json([
            'ok' => 'It works'
        ]);
    }

    public function listSesion($id)
    {
        //
        return response()->json([
            'ok' => 'It works ID: ' . $id
        ]);
    }

    public function createSesion(Request $request)
    {
        return response()->json($request->all());
    }


}
