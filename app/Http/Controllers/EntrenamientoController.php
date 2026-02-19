<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrenamiento;
use App\Models\Ciclista;
use App\Models\SesionEntrenamiento;
use App\Models\Bicicleta;

class EntrenamientoController extends Controller
{

    public function listEntrenamientos()
    {
        $entrenamientos = Entrenamiento::with(['ciclista', 'sesion', 'bicicleta'])->get();
        return response()->json([
            'status' => 'success',
            'data' => $entrenamientos
        ]);
    }

    public function listEntrenamiento($id)
    {
        $entrenamiento = Entrenamiento::with(['ciclista', 'sesion', 'bicicleta'])->find($id);
        
        if (!$entrenamiento) {
            return response()->json([
                'status' => 'error',
                'message' => 'Entrenamiento no encontrado'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $entrenamiento
        ]);
    }

    public function createEntrenamiento(Request $request)
    {
        $data = $request->validate([
            'id_ciclista' => 'required|exists:ciclista,id',
            'id_bicicleta' => 'nullable|exists:bicicleta,id',
            'id_sesion' => 'required|exists:sesion_entrenamiento,id',
            'fecha' => 'required|date',
            'duracion' => 'required|integer|min:0',
            'kilometros' => 'required|numeric|min:0',
            'recorrido' => 'nullable|string',
            'pulso_medio' => 'nullable|integer|min:0',
            'pulso_max' => 'nullable|integer|min:0',
            'potencia_media' => 'nullable|integer|min:0',
            'potencia_normalizada' => 'nullable|integer|min:0',
            'velocidad_media' => 'nullable|numeric|min:0',
            'puntos_estres_tss' => 'nullable|numeric|min:0',
            'factor_intensidad_if' => 'nullable|numeric|min:0',
            'ascenso_metros' => 'nullable|integer|min:0',
            'comentario' => 'nullable|string',
        ]);

        $entrenamiento = Entrenamiento::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Entrenamiento creado correctamente',
            'data' => $entrenamiento->load(['ciclista', 'sesion', 'bicicleta'])
        ], 201);
    }

    public function updateEntrenamiento(Request $request, $id)
    {
        $entrenamiento = Entrenamiento::find($id);
        
        if (!$entrenamiento) {
            return response()->json([
                'status' => 'error',
                'message' => 'Entrenamiento no encontrado'
            ], 404);
        }

        $data = $request->validate([
            'id_ciclista' => 'exists:ciclista,id',
            'id_bicicleta' => 'nullable|exists:bicicleta,id',
            'id_sesion' => 'exists:sesion_entrenamiento,id',
            'fecha' => 'date',
            'duracion' => 'integer|min:0',
            'kilometros' => 'numeric|min:0',
            'recorrido' => 'nullable|string',
            'pulso_medio' => 'nullable|integer|min:0',
            'pulso_max' => 'nullable|integer|min:0',
            'potencia_media' => 'nullable|integer|min:0',
            'potencia_normalizada' => 'nullable|integer|min:0',
            'velocidad_media' => 'nullable|numeric|min:0',
            'puntos_estres_tss' => 'nullable|numeric|min:0',
            'factor_intensidad_if' => 'nullable|numeric|min:0',
            'ascenso_metros' => 'nullable|integer|min:0',
            'comentario' => 'nullable|string',
        ]);

        $entrenamiento->update($data);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Entrenamiento actualizado correctamente',
            'data' => $entrenamiento->load(['ciclista', 'sesion', 'bicicleta'])
        ]);
    }

    public function deleteEntrenamiento($id)
    {
        $entrenamiento = Entrenamiento::find($id);
        
        if (!$entrenamiento) {
            return response()->json([
                'status' => 'error',
                'message' => 'Entrenamiento no encontrado'
            ], 404);
        }

        $entrenamiento->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Entrenamiento eliminado correctamente'
        ]);
    }
}