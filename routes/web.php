<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PostController,
    CommentController
};

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

Route::get('/', function () {
    return view('welcome');
});

route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts/store', [PostController::class, 'store']);
route::get('/posts/edit/{id}', [PostController::class, 'edit']); 
route::put('/posts/update/{id}', [PostController::class, 'update']);
route::get('posts/show/{id}', [PostController::class, 'show']);
route::get('/posts/delete/{id}', [PostController::class, 'delete']);

route::post('/posts/comment/store', [commentController::class, 'store']);