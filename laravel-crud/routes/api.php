<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::resource('client', App\Http\Controllers\ClientController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

Route::middleware('api')->group(function() {
    Route::resource('client', ClientController::class);
});

//Route::post('register', 'RegisterController@register');
//Route::post('login', 'LoginController@login');

//Route::post('login', 'LoginController@login');
//Route::post('/login', [LoginController::class, 'login']);
//Route::post('register', 'RegisterController@register');
//Route::post('login', 'LoginController@login');
//Route::post('logout', 'LoginController@logout');