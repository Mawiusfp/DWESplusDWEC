<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function listPlans()
    {
        return response()->json([
            'ok' => 'It works'
        ]);
    }

    public function insertPlan(Request $request) {
        
    }

    public function index()
    {
        return view('nav.landing_page');
    }
}
