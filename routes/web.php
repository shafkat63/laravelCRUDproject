<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    $currentUserPosts = [];
    $posts = []; 
    if (auth()->check()) {

        $currentUserPosts = Post::where('user_id', auth()->id())->latest()->get();
        $posts = Post::all();
    }

    // $currentUserPosts =auth()->user()->usersCoolposts()->latest()->get();
    return view('home', ['posts' => $posts, 'currentUserPost' => $currentUserPosts]);
});
Route::post('/register', [UserController::class, "register"]);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/createPosts', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}',[PostController::class, 'edit']);
Route::put('/edit-post/{post}',[PostController::class, 'update']);
Route::delete('/delete-post/{post}',[PostController::class, 'deletePost']);
