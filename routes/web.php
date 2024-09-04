<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostReplyController;
use App\Http\Controllers\Notification\PostClearNotificationController;
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

Route::get('/', function () {
    return view('welcome');
});

// Post
Route::get('/posts/index', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::prefix('users')->group(function () {

    // Posts
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::delete('posts/{id}',[PostController::class,'destroy'])->name('posts.destroy');

    // Post Comment
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'delete'])->name('comments.delete');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');

    // Clear Post Notification
    Route::delete('/clear', [PostClearNotificationController::class, 'delete'])->name('clear.notification');

    // Reply Controller
    Route::post('/replies', [PostReplyController::class, 'store'])->name('replies.store');
    Route::delete('/replies/{id}', [PostReplyController::class, 'destroy'])->name('replies.destroy');
    Route::get('/replies/{id}/edit', [PostReplyController::class, 'edit'])->name('replies.edit');
    Route::put('/replies/{id}', [PostReplyController::class, 'update'])->name('replies.update');
});

Auth::routes(
    [
        'register' => false,
    ]
);

Route::get('password/reset', function () {
    abort(404);
});

// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
