<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AspirasiController; // Pastikan ini di-import
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;

// Rute Autentikasi
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rute Umum
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Rute untuk Komentar (Memerlukan Autentikasi dan Role)
Route::middleware(['auth', 'role:admin,mahasiswa'])->group(function () {
    Route::post('/articles/{article}/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

// Rute Admin (Memerlukan Autentikasi dan Role Admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/articles', [ArticleController::class, 'index'])->name('admin.articles.index'); // Sesuaikan nama rute
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('admin.articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('admin.articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('admin.articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');
});

// --- Rute Aspirasi ---
// Rute aspirasi memerlukan autentikasi mahasiswa untuk mengaksesnya.
// Route::resource akan membuat rute CRUD lengkap secara otomatis.
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::resource('aspirasi', AspirasiController::class);
});

// Rute untuk halaman forum
Route::get('/forum', [ForumController::class, 'index'])->name('forum.show');

// Rute untuk halaman profil
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/{users}', [ProfileController::class, 'show'])->name('profile.show');

// Rute Profil (Memerlukan Autentikasi dan Role Mahasiswa)
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/profile/{profile}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{profile}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});