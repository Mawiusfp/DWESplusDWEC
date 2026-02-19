<?php

use Illuminate\Http\Request;
use App\Http\Controllers\BloqueEntrenamientoController;
use App\Http\Controllers\PlanEntrenamientoController;
use App\Http\Controllers\SesionEntrenamientoController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\EntrenamientoController;
use App\Http\Controllers\SesionBloqueController;
use App\Http\Controllers\CiclistaController;
use App\Http\Controllers\BicicletaController;
use App\Http\Controllers\ComponentesBicicletaController;
use App\Http\Controllers\TipoComponenteController;
use App\Http\Controllers\HistoricoCiclistaController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* bloque_entrenamiento */
Route::get('/bloque', [BloqueEntrenamientoController::class, 'listBloques']);
Route::get('/bloque/{id}', [BloqueEntrenamientoController::class, 'listBloque']);
Route::post('/bloque', [BloqueEntrenamientoController::class, 'createBloque']); 
Route::put('/bloque/{id}', [BloqueEntrenamientoController::class, 'updateBloque']);
Route::delete('/bloque/{id}', [BloqueEntrenamientoController::class, 'deleteBloque']);

/* sesion_bloque */
Route::get('/sesionbloque', [SesionBloqueController::class, 'listSesioneBloques']);
Route::get('/sesionbloque/{id}', [SesionBloqueController::class, 'listSesioneBloque']);
Route::post('/sesionbloque', [SesionBloqueController::class, 'createSesionBloque']);
Route::put('/sesionbloque/{id}', [SesionBloqueController::class, 'updateSesionBloque']);
Route::delete('/sesionbloque/{id}', [SesionBloqueController::class, 'deleteSesionBloque']);

/* plan_entrenamiento */
Route::get('/plan', [PlanEntrenamientoController::class, 'listPlans']);
Route::get('/plan/{id}', [PlanEntrenamientoController::class, 'listPlan']);
Route::post('/plan/crear', [PlanEntrenamientoController::class, 'createPlan']);
Route::put('/plan/{id}', [PlanEntrenamientoController::class, 'updatePlan']);
Route::delete('/plan/{id}', [PlanEntrenamientoController::class, 'deletePlan']);

/* sesion_entrenamiento */
Route::get('/sesion', [SesionEntrenamientoController::class, 'listSesiones']);
Route::get('/sesion/{id}', [SesionEntrenamientoController::class, 'listSesion']);
Route::post('/sesion', [SesionEntrenamientoController::class, 'createSesion']);
Route::put('/sesion/{id}', [SesionEntrenamientoController::class, 'updateSesion']);
Route::delete('/sesion/{id}', [SesionEntrenamientoController::class, 'deleteSesion']);

/* ciclista */
Route::get('/ciclista', [CiclistaController::class, 'listCiclistas']);
Route::get('/ciclista/{id}', [CiclistaController::class, 'listCiclista']);
Route::put('/ciclista/{id}', [CiclistaController::class, 'updateCiclista']);    // Protegido por auth?
Route::delete('/ciclista/{id}', [CiclistaController::class, 'deleteCiclista']); // Protegido por auth?

/* entrenamiento */
Route::get('/entrenamiento', [EntrenamientoController::class, 'listEntrenamientos']);
Route::get('/entrenamiento/{id}', [EntrenamientoController::class, 'listEntrenamiento']);
Route::post('/entrenamiento', [EntrenamientoController::class, 'createEntrenamiento']);
Route::put('/entrenamiento/{id}', [EntrenamientoController::class, 'updateEntrenamiento']);
Route::delete('/entrenamiento/{id}', [EntrenamientoController::class, 'deleteEntrenamiento']);

/* bicicleta */
Route::get('/bicicleta', [BicicletaController::class, 'listBicicletas']);
Route::get('/bicicleta/{id}', [BicicletaController::class, 'listBicicleta']);
Route::post('/bicicleta', [BicicletaController::class, 'createBicicleta']);
Route::put('/bicicleta/{id}', [BicicletaController::class, 'updateBicicleta']);
Route::delete('/bicicleta/{id}', [BicicletaController::class, 'deleteBicicleta']);

/* componentes_bicicleta */
Route::get('/componente', [ComponentesBicicletaController::class, 'listComponentesBicicleta']);
Route::get('/componente/{id}', [ComponentesBicicletaController::class, 'listComponenteBicicleta']);
Route::post('/componente', [ComponentesBicicletaController::class, 'createComponenteBicicleta']);
Route::put('/componente/{id}', [ComponentesBicicletaController::class, 'updateComponenteBicicleta']);
Route::delete('/componente/{id}', [ComponentesBicicletaController::class, 'deleteComponenteBicicleta']);

/* historico_ciclista */
Route::get('/historico', [HistoricoCiclistaController::class, 'listHistoricoCiclista']);
Route::get('/historico/{id}', [HistoricoCiclistaController::class, 'listHistoricoCiclistaById']);
Route::post('/historico', [HistoricoCiclistaController::class, 'createHistoricoCiclista']);
Route::put('/historico/{id}', [HistoricoCiclistaController::class, 'updateHistoricoCiclista']);
Route::delete('/historico/{id}', [HistoricoCiclistaController::class, 'deleteHistoricoCiclista']);

/* tipo_componente */
Route::get('/tipocomponente', [TipoComponenteController::class, 'listTipoComponente']);
Route::get('/tipocomponente/{id}', [TipoComponenteController::class, 'listTipoComponenteById']);
Route::post('/tipocomponente', [TipoComponenteController::class, 'createTipoComponente']);
Route::put('/tipocomponente/{id}', [TipoComponenteController::class, 'updateTipoComponente']);
Route::delete('/tipocomponente/{id}', [TipoComponenteController::class, 'deleteTipoComponente']);