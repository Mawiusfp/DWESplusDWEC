<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BloqueController extends Controller
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
}
