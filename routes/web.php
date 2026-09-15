<?php


use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
use App\Http\Controllers\loginController;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;

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
    return view('home');
});
/* this is a Route pattern, it manages all request eg route::POST(a,b), you fill the aguments
--the 1st argument is the url pattern you defined in the blade file -method
--the 2nd is a function you wanna run at an appropriate time */
/*
Route::post('/login', function () {         // you can add anonymous function like this.
    return 'you have logged in successfully!';
});
// NOTE: inorder to send a post request to laravel you need to include a @csrf token
// this token prevents the visitors of our site fron having 3rd party sites
*/


/* Route (routes/web.php): Acts as the entry router, directing HTTP requests 
to specific methods on your controller. */
Route::post('/login', [loginController::class, 'login']);       // class name must match corresponding public function name in controller.php 
Route::post('/logout', [loginController::class, 'logout']);
Route::post('/connection', [loginController::class, 'connection']);

// blog post related routes
Route::post('/createPost', [postController::class, 'createPost']);



Route::get('/', function () {
    $posts = [];

    if (auth()->check()) {
        // User IS logged in: fetch only their posts
        $posts = auth()->user()->usersPosts()->latest()->get();
    } else {
        // Guest user: either show all posts or leave $posts empty
        $posts = Post::latest()->get();
    }

    return view('home', ['posts' => $posts]);
});
// the condition says (Show User Posts if Logged In, Otherwise Show Nothing or All if any) instead of $posts = Post::all(); 
Route::get('/post_edit/{post}', [postController::class, 'post_edit_screen']);
Route::put('/edit_post/{post}', [postController::class, 'actual_post_update']);
Route::delete('/delete_post/{post}', [postController::class, 'deletePost']);
