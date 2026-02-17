<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloqueEntrenamiento;

class BloqueEntrenamientoController extends Controller
{
    public function listBloques()
    {
        try {

            $blukis = BloqueEntrenamiento::with(['sesiones'])
                ->orderBy('nombre', 'asc') 
                ->get();
                
            return response()->json([
                'success' => true,
                'data' => $blukis,
                'count' => $blukis->count()
            ], 200);
        } catch (Exception $e) {
            return response(["message" => $e], 500);
        }
    }

    public function listBloque($id)
    {
        $bluki = BloqueEntrenamiento::with(['sesiones'])->find($id);
        if($bluki) {
            return response()->json($bluki);
        }
        return response()->json(['message' => 'Not found'], 404);
    }
}
