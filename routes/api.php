<?php

use Illuminate\Http\Request;
use App\Http\Controllers\BloqueEntrenamientoController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\SesionBloqueController;
use App\Http\Controllers\CiclistaController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/*

 # ----- GET -----
  /bloque ✅
  /bloque/{id} ✅
  /plan
  /sesion
  /sesion/{id}
  /resultado/{id}
  /sesionbloque

*/

Route::get('/bloque', [BloqueEntrenamientoController::class, 'listBloques']);
Route::get('/bloque/{id}', [BloqueEntrenamientoController::class, 'listBloque']);

Route::get('/plan', [PlanController::class, 'listPlans']);

Route::get('/sesion', [SesionController::class, 'listSesiones']);
Route::get('/sesion/{id}', [SesionController::class, 'listSesion']);

Route::get('/resultado/{id}', [ResultadoController::class, 'listPlans']);

Route::get('/sesionbloque', [SesionBloqueController::class, 'listSesioneBloques']);

/*

 # ----- POST -----
  /register ✅ (Lo hace laravel solito)
  /login ✅ (Lo hace laravel solito)
  /logout ✅ (Lo hace laravel solito)
  /bloque/crear ✅
  /plan/crear
  /sesion/crear
  /resultado/crear
  /sesionbloque/crear

*/

Route::post('/bloque/crear', [BloqueEntrenamientoController::class, 'createBloque']);

/*
 # ----- PUT -----
  /plan/{id}

 # ----- DELETE -----
  /bloque/{id}/eliminar ✅
  /plan/{id} 
  /sesion/{id}
  /sesionbloque/{id}

*/

Route::delete('/bloque/{id}/eliminar', [BloqueEntrenamientoController::class, 'deleteBloque']);
