<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CasteController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TheatresController;
use App\Http\Controllers\BookMovieController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
//Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Route::prefix('api')->group(function (){
//    Route::get('getMovies',[MovieController::class,'getMovies']);
//});
Route::get('all_movie',[MovieController::class,'allMovie']);
Route::post('save_movie',[MovieController::class,'saveMovie']);
Route::get('edit_movie/{id}',[MovieController::class,'editMovie']);
Route::put('update_movie',[MovieController::class,'update']);
Route::delete('delete_movie/{id}',[MovieController::class,'deleteMovie']);

Route::get('all_cast',[CasteController::class,'allCast']);
Route::post('save_cast',[CasteController::class,'saveCast']);
Route::get('edit_cast/{id}',[CasteController::class,'editCast']);
Route::put('update_cast',[CasteController::class,'update']);
Route::delete('delete_cast/{id}',[CasteController::class,'deleteCast']);

Route::get('all_theatre',[TheatresController::class,'allTheatre']);
Route::post('save_theatre',[TheatresController::class,'saveTheatre']);
Route::get('edit_theatre/{id}',[TheatresController::class,'editTheatre']);
Route::put('update_theatre',[TheatresController::class,'update']);
Route::delete('delete_theatre/{id}',[TheatresController::class,'deleteTheatre']);

Route::get('all_book',[BookMovieController::class,'bookmovie']);
Route::post('save_book',[BookMovieController::class,'savebook']);
