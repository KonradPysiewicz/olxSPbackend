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

Route::get('/git', [UserController::class, 'git']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/post/{id}', [PostController::class, 'findPostById']);
Route::put('/edit_post', [PostController::class, 'editPost']);

Route::get('/get_posts', [PostController::class, 'getPosts']);
Route::get('/get_all_posts', [PostController::class, 'getAllPostsUnfiltered']);

Route::post('/create_post', [PostController::class, 'createPost']);

Route::get('/user_posts/{id}', [PostController::class, 'userPosts']);
Route::delete('/delete_post/{id}', [PostController::class, 'deletePost']);
Route::middleware('auth:api')->post('/logout', [UserController::class, 'logout']);

