<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth

Route::group(['prefix' => 'auth','namespace' => 'Admin'], function() {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logOut']);
    Route::post('/register', [UserController::class, 'register']);
});

Route::get('/profile/{id}', [UserController::class, 'getUserProfile']);


// Users

Route::get('/user/{id}/posts', [UserController::class, 'getUserPosts']);

// Posts

Route::get('/posts', [PostController::class, 'getPosts']);
Route::get('/post/{id}', [PostController::class, 'getUserPost']);



