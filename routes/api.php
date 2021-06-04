<?php

use App\Http\Controllers\MovieCastsController;
use App\Http\Controllers\MoviePostController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ShowTimeController;
use App\Http\Controllers\BookMovieController;
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
Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return json_encode([
            "status"=>"error",
            'message' => 'These credentials do not match our records.'
        ]);
    }

    $token = $user->createToken('my-app-token')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);
});

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user) {
        return json_encode([
            'error' => 'user is exists', 'status' => 'error'
        ]);
    } else {

        $token = Str::random(60);
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => hash('sha256', $token),
        ]);
        if($user){
            return json_encode([
                'message' => 'Register Successfully', 'status' => 'success'
            ]);
        }else{
            return json_encode([
                'error' => 'something is wrong', 'status' => 'error'
            ]);
        }

    }
});

    Route::resource('movie', 'MovieController');
    Route::resource('cast', 'CasteController');
    Route::resource('theatres', 'TheatresController');

Route::get('/moviecast/{id}',[MovieCastsController::class,'getAllMovieCast']);
Route::get('/allmovie/{id}', [MovieCastsController::class, 'getAllMovieIds']);
Route::get('/movies/{id}', [MovieCastsController::class, 'getAllCastIds']);
Route::get('getmovie', [MovieCastsController::class,'getmovie']);
Route::get('getmovie/{id}', [MovieCastsController::class,'getmoviebyid']);
Route::get('getcast', [MovieCastsController::class,'getcast']);
Route::get('getcast/{id}', [MovieCastsController::class,'getcastbyid']);

Route::get('/movieposts/{id}',[MoviePostController::class,'getAllMoviePost']);
Route::get('getMovie',[MoviePostController::class,'getMovie']);
Route::get('getTheatre',[MoviePostController::class,'getTheatre']);
Route::get('getTheatre/{id}', [MoviePostController::class,'getTheatrebyid']);
Route::get("/movieShow/{cid}/{tid}/{mid}", [MoviePostController::class, 'getCityAndTheaterIds']);
Route::get('getCity',[MoviePostController::class,'getCity']);
Route::get('getCity/{id}', [MoviePostController::class,'getCitybyid']);

Route::get('getshowtime', [ShowTimeController::class,'getshowtime']);
Route::any("/getSeats", [BookMovieController::class, 'getSeats']);
Route::post('save_book',[BookMovieController::class,'savebook']);
Route::get('getMovie', [BookMovieController::class,'getMovie']);

Route::get('getMovie/{id}', [BookMovieController::class,'getMoviebyid']);


Route::get("/search/{str}", [MovieController::class, "getSearchMovie"]);
Route::get("/getMovieHome", [MoviePostController::class, 'getMovieHome']);



