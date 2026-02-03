<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BloqueController extends Controller
{
    public function test()
    {
        return response()->json([
            'ok' => 'hello'
        ]);
    }
}
