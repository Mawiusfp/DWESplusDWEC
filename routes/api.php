<?php

use Illuminate\Http\Request;

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

