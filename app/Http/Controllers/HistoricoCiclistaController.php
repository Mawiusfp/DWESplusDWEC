<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoricoCiclista;
use App\Models\Ciclista;

class HistoricoCiclistaController extends Controller
{

    public function listHistoricoCiclista()
    {
        $historicos = HistoricoCiclista::with('ciclista')->get();
        return response()->json([
            'status' => 'success',
            'data' => $historicos
        ]);
    }

    public function listHistoricoCiclistaById($id)
    {
        $historico = HistoricoCiclista::with('ciclista')->find($id);
        
        if (!$historico) {
            return response()->json([
                'status' => 'error',
                'message' => 'Registro histórico de ciclista no encontrado'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $historico
        ]);
    }

    public function createHistoricoCiclista(Request $request)
    {
        $data = $request->validate([
            'id_ciclista' => 'required|exists:ciclista,id',
            'fecha' => 'required|date',
            'peso' => 'nullable|numeric|min:0',
            'ftp' => 'nullable|integer|min:0',
            'pulso_max' => 'nullable|integer|min:0',
            'pulso_reposo' => 'nullable|integer|min:0',
            'potencia_max' => 'nullable|integer|min:0',
            'grasa_corporal' => 'nullable|numeric|min:0',
            'vo2max' => 'nullable|numeric|min:0',
            'comentario' => 'nullable|string',
        ]);

        $historico = HistoricoCiclista::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Registro histórico de ciclista creado correctamente',
            'data' => $historico->load('ciclista')
        ], 201);
    }

    public function updateHistoricoCiclista(Request $request, $id)
    {
        $historico = HistoricoCiclista::find($id);
        
        if (!$historico) {
            return response()->json([
                'status' => 'error',
                'message' => 'Registro histórico de ciclista no encontrado'
            ], 404);
        }

        $data = $request->validate([
            'id_ciclista' => 'exists:ciclista,id',
            'fecha' => 'date',
            'peso' => 'nullable|numeric|min:0',
            'ftp' => 'nullable|integer|min:0',
            'pulso_max' => 'nullable|integer|min:0',
            'pulso_reposo' => 'nullable|integer|min:0',
            'potencia_max' => 'nullable|integer|min:0',
            'grasa_corporal' => 'nullable|numeric|min:0',
            'vo2max' => 'nullable|numeric|min:0',
            'comentario' => 'nullable|string',
        ]);

        $historico->update($data);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Registro histórico de ciclista actualizado correctamente',
            'data' => $historico->load('ciclista')
        ]);
    }

    public function deleteHistoricoCiclista($id)
    {
        $historico = HistoricoCiclista::find($id);
        
        if (!$historico) {
            return response()->json([
                'status' => 'error',
                'message' => 'Registro histórico de ciclista no encontrado'
            ], 404);
        }

        $historico->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Registro histórico de ciclista eliminado correctamente'
        ]);
    }
}