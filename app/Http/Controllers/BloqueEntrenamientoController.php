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
            return response(["message" => $e->getMessage()], 500);
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

    public function createBloque(Request $request) {

        try {

            $validated_data = $request->validate([
                'nombre'            => 'required|string|max:100',
                'descripcion'       => 'nullable|string|max:500',
                'tipo'              => 'required|in:rodaje,intervalos,fuerza,recuperacion,test',
                'duracion_estimada' => 'nullable|date_format:H:i:s',
                'potencia_pct_min'  => 'nullable|numeric',
                'potencia_pct_max'  => 'nullable|numeric',
                'pulso_pct_max'     => 'nullable|numeric',
                'pulso_reserva_pct' => 'nullable|numeric',
                'comentario'        => 'nullable|string|max:255',
            ]);

            $bluki = BloqueEntrenamiento::create($validated_data);

            return response()->json([
                'success' => true, 
                'message' => "OK", 
                "data" => $bluki
                ], 201);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error creating bloque', 'error' => $e->getMessage()], 500);
        }

    }

    public function deleteBloque($id)
    {
        try {
            $bloque = BloqueEntrenamiento::findOrFail($id);

            $bloque->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bloque deleted successfully'
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting bloque',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
