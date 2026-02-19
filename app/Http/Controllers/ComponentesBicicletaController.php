<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComponentesBicicleta;
use App\Models\Bicicleta;
use App\Models\TipoComponente;

class ComponentesBicicletaController extends Controller
{
    /**
     * Display a listing of all componentes_bicicleta.
     */
    public function listComponentesBicicleta()
    {
        $componentes = ComponentesBicicleta::with(['bicicleta', 'tipoComponente'])->get();
        return response()->json([
            'status' => 'success',
            'data' => $componentes
        ]);
    }

    /**
     * Display the specified componente_bicicleta.
     */
    public function listComponenteBicicleta($id)
    {
        $componente = ComponentesBicicleta::with(['bicicleta', 'tipoComponente'])->find($id);
        
        if (!$componente) {
            return response()->json([
                'status' => 'error',
                'message' => 'Componente de bicicleta no encontrado'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $componente
        ]);
    }

    /**
     * Create a new componente_bicicleta.
     */
    public function createComponenteBicicleta(Request $request)
    {
        $data = $request->validate([
            'id_bicicleta' => 'required|exists:bicicleta,id',
            'id_tipo_componente' => 'required|exists:tipo_componente,id',
            'marca' => 'required|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'especificacion' => 'nullable|string',
            'velocidad' => 'nullable|string|max:50',
            'posicion' => 'nullable|string|max:100',
            'fecha_montaje' => 'required|date',
            'fecha_retiro' => 'nullable|date|after:fecha_montaje',
            'km_actuales' => 'nullable|numeric|min:0',
            'km_max_recomendado' => 'nullable|numeric|min:0',
            'activo' => 'boolean',
            'comentario' => 'nullable|string',
        ]);

        $componente = ComponentesBicicleta::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Componente de bicicleta creado correctamente',
            'data' => $componente->load(['bicicleta', 'tipoComponente'])
        ], 201);
    }

    /**
     * Update the specified componente_bicicleta.
     */
    public function updateComponenteBicicleta(Request $request, $id)
    {
        $componente = ComponentesBicicleta::find($id);
        
        if (!$componente) {
            return response()->json([
                'status' => 'error',
                'message' => 'Componente de bicicleta no encontrado'
            ], 404);
        }

        $data = $request->validate([
            'id_bicicleta' => 'exists:bicicleta,id',
            'id_tipo_componente' => 'exists:tipo_componente,id',
            'marca' => 'string|max:255',
            'modelo' => 'nullable|string|max:255',
            'especificacion' => 'nullable|string',
            'velocidad' => 'nullable|string|max:50',
            'posicion' => 'nullable|string|max:100',
            'fecha_montaje' => 'date',
            'fecha_retiro' => 'nullable|date|after:fecha_montaje',
            'km_actuales' => 'nullable|numeric|min:0',
            'km_max_recomendado' => 'nullable|numeric|min:0',
            'activo' => 'boolean',
            'comentario' => 'nullable|string',
        ]);

        $componente->update($data);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Componente de bicicleta actualizado correctamente',
            'data' => $componente->load(['bicicleta', 'tipoComponente'])
        ]);
    }


    public function deleteComponenteBicicleta($id)
    {
        $componente = ComponentesBicicleta::find($id);
        
        if (!$componente) {
            return response()->json([
                'status' => 'error',
                'message' => 'Componente de bicicleta no encontrado'
            ], 404);
        }

        $componente->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Componente de bicicleta eliminado correctamente'
        ]);
    }
}