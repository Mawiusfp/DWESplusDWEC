<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanEntrenamiento;

class PlanController extends Controller
{
    public function listPlans()
    {
        try {
            $plans = PlanEntrenamiento::with(['ciclista'])
                ->orderBy('id', 'asc')
                ->get();
                
            return response()->json([
                'success' => true,
                'data' => $plans,
                'count' => $plans->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching plans',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function insertPlan(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_ciclista' => 'required|exists:ciclista,id',
                'nombre' => 'required|string|max:100',
                'descripcion' => 'nullable|string|max:255',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date',
                'objetivo' => 'nullable|string|max:100',
                'activo' => 'boolean'
            ]);

            $plan = PlanEntrenamiento::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Plan created successfully',
                'data' => $plan
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating plan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updatePlan(Request $request, $id)
    {
        try {
            $plan = PlanEntrenamiento::findOrFail($id);
            
            $validated = $request->validate([
                'nombre' => 'sometimes|string|max:100',
                'descripcion' => 'nullable|string|max:255',
                'fecha_inicio' => 'nullable|date',
                'fecha_fin' => 'nullable|date',
                'objetivo' => 'nullable|string|max:100',
                'activo' => 'boolean'
            ]);
            
            $plan->update($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Plan updated successfully',
                'data' => $plan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating plan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deletePlan($id)
    {
        try {
            $plan = PlanEntrenamiento::findOrFail($id);
            $plan->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Plan deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting plan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}