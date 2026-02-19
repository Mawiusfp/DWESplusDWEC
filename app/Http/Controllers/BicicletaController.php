<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bicicleta;

class BicicletaController extends Controller
{
    /**
     * Display a listing of all bicicletas.
     */
    public function listBicicletas()
    {
        $bicicletas = Bicicleta::with(['componentes', 'entrenamientos'])->get();
        return response()->json([
            'status' => 'success',
            'data' => $bicicletas
        ]);
    }

    /**
     * Display the specified bicicleta.
     */
    public function listBicicleta($id)
    {
        $bicicleta = Bicicleta::with(['componentes', 'entrenamientos'])->find($id);
        
        if (!$bicicleta) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bicicleta no encontrada'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $bicicleta
        ]);
    }

    /**
     * Create a new bicicleta.
     */
    public function createBicicleta(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'comentario' => 'nullable|string',
        ]);

        $bicicleta = Bicicleta::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Bicicleta creada correctamente',
            'data' => $bicicleta->load(['componentes', 'entrenamientos'])
        ], 201);
    }

    /**
     * Update the specified bicicleta.
     */
    public function updateBicicleta(Request $request, $id)
    {
        $bicicleta = Bicicleta::find($id);
        
        if (!$bicicleta) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bicicleta no encontrada'
            ], 404);
        }

        $data = $request->validate([
            'nombre' => 'string|max:255',
            'tipo' => 'string|max:255',
            'comentario' => 'nullable|string',
        ]);

        $bicicleta->update($data);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Bicicleta actualizada correctamente',
            'data' => $bicicleta->load(['componentes', 'entrenamientos'])
        ]);
    }

    /**
     * Remove the specified bicicleta.
     */
    public function deleteBicicleta($id)
    {
        $bicicleta = Bicicleta::find($id);
        
        if (!$bicicleta) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bicicleta no encontrada'
            ], 404);
        }

        $bicicleta->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Bicicleta eliminada correctamente'
        ]);
    }
}