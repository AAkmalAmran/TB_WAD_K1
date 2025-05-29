<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

//Aspirasi Routes
Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.show');

//Forum routes
Route::get('/forum', [ForumController::class, 'index'])->name('forum.show');


//Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/{users}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{profile}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{profile}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Comment Routes
Route::middleware(['auth', 'role:admin,mahasiswa'])->group(function () {
    Route::post('/articles/{article}/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

//Article atau News Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/articles', [ArticleController::class, 'index'])->name('admin.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('admin.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('admin.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('admin.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('admin.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('admin.destroy');
});