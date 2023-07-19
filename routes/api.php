<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// route d'enregistrement
Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);

// route de connexion
Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// middeware de laravel/passport
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);


    // creation  d'un post
    Route::post('post', [App\Http\Controllers\PostController::class, 'store']);

     // creation  d'un beat
     Route::post('beat', [App\Http\Controllers\BeatController::class, 'store']);

    // liker un post
    Route::post('LikePost/{slug}', [App\Http\Controllers\LikeController::class, 'likePost']);
    
    // liker un beat
    Route::post('LikeBeat/{slug}', [App\Http\Controllers\LikeController::class, 'likeBeat']);
});
