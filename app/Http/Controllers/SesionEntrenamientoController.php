<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesionEntrenamiento;
use App\Models\PlanEntrenamiento;

class SesionEntrenamientoController extends Controller
{

    public function listSesiones()
    {
        $sesiones = SesionEntrenamiento::all();
        return response()->json([
            'status' => 'success',
            'data' => $sesiones
        ]);
    }

    public function listSesion($id)
    {
        $sesion = SesionEntrenamiento::find($id);
        
        if (!$sesion) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sesión no encontrada'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $sesion
        ]);
    }

    public function createSesion(Request $request)
    {
        $validatedData = $request->validate([
            'id_plan' => 'required|exists:plan_entrenamiento,id',
            'fecha' => 'required|date',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'completada' => 'boolean'
        ]);

        $sesion = SesionEntrenamiento::create($validatedData);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Sesión creada correctamente',
            'data' => $sesion
        ], 201);
    }

    public function updateSesion(Request $request, $id)
    {
        $sesion = SesionEntrenamiento::find($id);
        
        if (!$sesion) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sesión no encontrada'
            ], 404);
        }

        $validatedData = $request->validate([
            'id_plan' => 'exists:plan_entrenamiento,id',
            'fecha' => 'date',
            'nombre' => 'string|max:255',
            'descripcion' => 'nullable|string',
            'completada' => 'boolean'
        ]);

        $sesion->update($validatedData);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Sesión actualizada correctamente',
            'data' => $sesion
        ]);
    }

    public function deleteSesion($id)
    {
        $sesion = SesionEntrenamiento::find($id);
        
        if (!$sesion) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sesión no encontrada'
            ], 404);
        }

        $sesion->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Sesión eliminada correctamente'
        ]);
    }
}