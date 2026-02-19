<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanEntrenamiento;

class PlanEntrenamientoController extends Controller
{
    public function listPlans()
    {
        try {
            $plans = PlanEntrenamiento::with(['ciclista', 'sesiones'])
                ->orderBy('nombre', 'asc')
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

    public function listPlan($id)
    {
        try {
            $plan = PlanEntrenamiento::with(['ciclista', 'sesiones'])
                ->findOrFail($id);
                
            return response()->json([
                'success' => true,
                'data' => $plan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Plan not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function createPlan(Request $request)
    {
        try {
            $validated_data = $request->validate([
                'id_ciclista' => 'required|exists:ciclista,id',
                'nombre' => 'required|string|max:100',
                'descripcion' => 'nullable|string|max:500',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after:fecha_inicio',
                'objetivo' => 'nullable|string|max:200',
                'activo' => 'boolean',
            ]);

            $plan = PlanEntrenamiento::create($validated_data);

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

            $validated_data = $request->validate([
                'id_ciclista' => 'sometimes|exists:ciclista,id',
                'nombre' => 'sometimes|string|max:100',
                'descripcion' => 'nullable|string|max:500',
                'fecha_inicio' => 'sometimes|date',
                'fecha_fin' => 'sometimes|date|after:fecha_inicio',
                'objetivo' => 'nullable|string|max:200',
                'activo' => 'boolean',
            ]);

            $plan->update($validated_data);

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