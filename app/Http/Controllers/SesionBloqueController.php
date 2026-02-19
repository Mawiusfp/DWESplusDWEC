<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesionBloque;
use App\Models\SesionEntrenamiento;
use App\Models\BloqueEntrenamiento;

class SesionBloqueController extends Controller
{

    public function listSesioneBloques()
    {
        try {
            $sesionBloques = SesionBloque::with(['sesion', 'bloque'])
                ->orderBy('id_sesion_entrenamiento')
                ->get();
                
            return response()->json([
                'success' => true,
                'data' => $sesionBloques,
                'count' => $sesionBloques->count()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving sesion-bloque relationships',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function listSesioneBloque($id)
    {
        try {
            $sesionBloque = SesionBloque::with(['sesion', 'bloque'])
                ->find($id);
                
            if ($sesionBloque) {
                return response()->json([
                    'success' => true,
                    'data' => $sesionBloque
                ], 200);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'SesionBloque not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving sesion-bloque relationship',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createSesionBloque(Request $request)
    {
        try {
            $validated_data = $request->validate([
                'id_sesion_entrenamiento' => 'required|exists:sesion_entrenamiento,id',
                'id_bloque_entrenamiento' => 'required|exists:bloque_entrenamiento,id',
                'orden' => 'nullable|integer|min:0',
                'repeticiones' => 'nullable|integer|min:0'
            ]);

            $sesionBloque = SesionBloque::create($validated_data);

            return response()->json([
                'success' => true,
                'message' => 'SesionBloque created successfully',
                'data' => $sesionBloque
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating sesion-bloque relationship',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateSesionBloque(Request $request, $id)
    {
        try {
            $sesionBloque = SesionBloque::findOrFail($id);
            
            $validated_data = $request->validate([
                'id_sesion_entrenamiento' => 'sometimes|required|exists:sesion_entrenamiento,id',
                'id_bloque_entrenamiento' => 'sometimes|required|exists:bloque_entrenamiento,id',
                'orden' => 'nullable|integer|min:0',
                'repeticiones' => 'nullable|integer|min:0'
            ]);

            $sesionBloque->update($validated_data);

            return response()->json([
                'success' => true,
                'message' => 'SesionBloque updated successfully',
                'data' => $sesionBloque
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating sesion-bloque relationship',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteSesionBloque($id)
    {
        try {
            $sesionBloque = SesionBloque::findOrFail($id);
            
            $sesionBloque->delete();

            return response()->json([
                'success' => true,
                'message' => 'SesionBloque deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting sesion-bloque relationship',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}