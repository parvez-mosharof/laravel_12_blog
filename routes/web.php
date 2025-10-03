<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

// ================== PUBLIC ROUTES ==================

// Home page
Route::get('/', function () {
    $posts = Post::latest()->get();
    return view('home', compact('posts'));
})->name('home');

// ================== USER ROUTES ==================

//to see user dashboard with post

Route::get('/dashboard', function () {
    $posts = Post::whereHas('user',function($query){
        $query->where('usertype','admin');
    })->latest()->paginate(10);

    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');



// Full post view
Route::get('/fullpost/{id}', [UserController::class, 'showFullPost'])->name('fullpost');

// Post comments
Route::post('/posts/{id}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');



// ================== ADMIN ROUTES ==================
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // Admin main dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // All posts
    Route::get('/dashboard/allpost', [AdminController::class, 'allPosts'])->name('admin.allpost');

    // Create post form
    Route::get('/posts/create', [AdminController::class, 'createPost'])->name('admin.posts.create');

    // Store post
    Route::post('/posts/store', [AdminController::class, 'storePost'])->name('admin.posts.store');

    // Edit post form
    Route::get('/posts/{id}/edit', [AdminController::class, 'editPost'])->name('posts.edit');

    // Update post
    Route::put('/posts/{id}', [AdminController::class, 'updatePost'])->name('posts.update');

    // Delete post
    Route::delete('/posts/{id}', [AdminController::class, 'deletePost'])->name('posts.destroy');
});



// ================== PROFILE ROUTES ==================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================== AUTH ROUTES ==================
require __DIR__.'/auth.php';

