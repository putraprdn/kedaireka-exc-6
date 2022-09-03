<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// MOVIE
Route::get('/', [MovieController::class, 'index'])->name('movie_index');
Route::get('/movie/create', [MovieController::class, 'create'])->name('movie_create');
Route::post('/movie/store', [MovieController::class, "store"])->name('movie_store');
Route::get('movie/{id}', [MovieController::class, 'edit'])->name('movie_edit');
Route::post('movie/update/{id}', [MovieController::class, 'update'])->name('movie_update');
Route::delete('movies/delete/{id}', [MovieController::class, 'destroy'])->name('movie_destroy');

// GENRE
Route::get('/genre', [GenreController::class, 'create'])->name('genre_create');
Route::post('/genre/create', [GenreController::class, 'store'])->name('genre_store');
