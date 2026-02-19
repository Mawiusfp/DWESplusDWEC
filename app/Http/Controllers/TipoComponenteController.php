<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoComponente;

class TipoComponenteController extends Controller
{

    public function listTipoComponente()
    {
        $tipos = TipoComponente::all();
        return response()->json([
            'status' => 'success',
            'data' => $tipos
        ]);
    }

    public function listTipoComponenteById($id)
    {
        $tipo = TipoComponente::find($id);
        
        if (!$tipo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tipo de componente no encontrado'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $tipo
        ]);
    }

    public function createTipoComponente(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $tipo = TipoComponente::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Tipo de componente creado correctamente',
            'data' => $tipo
        ], 201);
    }

    public function updateTipoComponente(Request $request, $id)
    {
        $tipo = TipoComponente::find($id);
        
        if (!$tipo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tipo de componente no encontrado'
            ], 404);
        }

        $data = $request->validate([
            'nombre' => 'string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $tipo->update($data);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Tipo de componente actualizado correctamente',
            'data' => $tipo
        ]);
    }

    public function deleteTipoComponente($id)
    {
        $tipo = TipoComponente::find($id);
        
        if (!$tipo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tipo de componente no encontrado'
            ], 404);
        }

        $tipo->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Tipo de componente eliminado correctamente'
        ]);
    }
}