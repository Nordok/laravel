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


// Users

Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
    Route::get('/{id}', [UserController::class, 'getUserProfile']);
    Route::get('/{id}/posts', [UserController::class, 'getUserPosts']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

// Posts

Route::post('/posts', [PostController::class, 'getPosts']);

Route::group(['prefix' => 'post', 'namespace' => 'Post'], function () {
    Route::post('/like', [PostController::class, 'likePost']);
    Route::get('/{id}', [PostController::class, 'getPostById']);
    Route::post('/create', [PostController::class, 'createPost']);
});







