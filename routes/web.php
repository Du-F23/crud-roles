<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

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

Route::get('/dashboard', [PostsController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts/{id}', [PostsController::class, 'show'])->name('posts.show');
    Route::post('/posts/store', [PostsController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{id}/delete', [PostsController::class, 'destroy'])->name('posts.destroy');
    Route::put('/posts/{id}/updated', [PostsController::class, 'update'])->name('posts.updated');
});

require __DIR__.'/auth.php';
