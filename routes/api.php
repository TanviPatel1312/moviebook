<?php

use App\Http\Controllers\MovieCastsController;
use App\Http\Controllers\MoviePostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::resource('movie', 'MovieController');
    Route::resource('cast', 'CasteController');
    Route::resource('theatres', 'TheatresController');

Route::get('/moviecast/{id}',[MovieCastsController::class,'getAllMovieCast']);
Route::get('getmovie', [MovieCastsController::class,'getmovie']);
Route::get('getcast', [MovieCastsController::class,'getcast']);

Route::get('/movieposts/{id}',[MoviePostController::class,'getAllMoviePost']);
Route::get('getMovie',[MoviePostController::class,'getMovie']);
Route::get('getTheatre',[MoviePostController::class,'getTheatre']);





