<?php

use Illuminate\Http\Request;
use App\Http\Controllers\BloqueController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\SesionBloqueController;
use App\Http\Controllers\CiclistaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
// Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

// Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
// Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
// Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
// Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
// Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
// Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

// Route::get('/api/articles', [ArticleController::class, 'listArticlesAPI'])->name('articles.listArticles');
// Route::get('/api/articles/{article}', [ArticleController::class, 'getArticleAPI'])->name('articles.getArticle');
// Route::delete('/api/articles/{article}', [ArticleController::class, 'deleteArticleAPI'])->name('articles.deleteArticle');

/*
Api routes to add

 # ----- GET -----
  /bloque
  /bloque/{id}
  /plan
  /sesion
  /sesion/{id}
  /resultado/{id}
  /sesionbloque

*/

Route::get('/bloque', [BloqueController::class, 'listBloques']);
Route::get('/bloque/{id}', [BloqueController::class, 'listBloque']);

Route::get('/plan', [PlanController::class, 'listPlans']);

Route::get('/sesion', [SesionController::class, 'listSesiones']);
Route::get('/sesion/{id}', [SesionController::class, 'listSesion']);

Route::get('/resultado/{id}', [ResultadoController::class, 'listPlans']);

Route::get('/sesionbloque', [SesionBloqueController::class, 'listSesioneBloques']);

/*

 # ----- POST -----
  /register
  /login
  /logout
  /bloque/crear
  /plan/crear
  /sesion/crear
  /resultado/crear
  /sesionbloque/crear

*/

Route::post('/sesion', [SesionController::class, 'createSesion']);
Route::post('/ciclista', [CiclistaController::class, 'signUp']);

/*
 # ----- PUT -----
  /plan/{id}

 # ----- DELETE -----
  /bloque/{id}/eliminar
  /plan/{id}
  /sesion/{id}
  /sesionbloque/{id}

*/