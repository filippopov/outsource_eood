<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/profile/{user}/edit', [\App\Http\Controllers\ProfileController::class, 'edit']);
Route::put('/profile/{user}', [\App\Http\Controllers\ProfileController::class, 'update']);
Route::get('/profile/{user}/show-supervisor', [\App\Http\Controllers\ProfileController::class, 'showSupervisor']);
Route::get('/profile/{user}/show-employee', [\App\Http\Controllers\ProfileController::class, 'showEmployee']);

//Route::get('/articles', [\App\Http\Controllers\ArticlesController::class, 'index']);
//Route::post('/articles', [\App\Http\Controllers\ArticlesController::class, 'store']);
//Route::get('/articles/create', [\App\Http\Controllers\ArticlesController::class, 'create']);
//Route::get('/articles/{article}', [\App\Http\Controllers\ArticlesController::class, 'show'])->name('article.show');
//Route::get('/articles/{article}/edit', [\App\Http\Controllers\ArticlesController::class, 'edit']);
//Route::put('/articles/{article}', [\App\Http\Controllers\ArticlesController::class, 'update']);


// GET /videos
// GET /videos/create
// POST /videos
// GET /videos/2
// GET /videos/2/edit
// PUT /videos/2
// DELETE /videos/2