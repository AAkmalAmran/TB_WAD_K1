<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AdminAspirasiController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BeritaController;

// ---------------------------------------------------- AUTH ROUTE ----------------------------------------------------
// JANGAN DIHAPUS ATAU DIUBAH, INI PENTING UNTUK AUTENTIKASI
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
// ---------------------------------------------------- END AUTH ROUTE ----------------------------------------------------

// ---------------------------------------------------- GENERAL ROUTE ----------------------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Rute untuk Komentar (Memerlukan Autentikasi dan Role)
Route::middleware(['auth', 'role:admin, mahasiswa'])->group(function () {
    Route::post('/articles/{article}/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});


// Rute untuk halaman Aspirasi (Untuk Mahasiswa danan Admin)
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    // Gunakan 'only' karena edit/update/destroy untuk aspirasi akan dikelola oleh admin
    Route::resource('aspirasi', AspirasiController::class)->only(['index', 'create', 'store', 'show']);
});

// Route untuk komentar
Route::group(['middleware' => 'auth'], function() {
    Route::post('/aspirasi/{aspirasi}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});

// Rute untuk halaman forum
#Route::get('/forum', [ForumController::class, 'index'])->name('forum.show');
Route::middleware(['auth'])->group(function () {
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum/store', [ForumController::class, 'store'])->name('forum.store');
    Route::post('/forum/{forum}/upvote', [ForumController::class, 'upvote'])->name('forum.upvote');
    Route::post('/forum/{forum}/downvote', [ForumController::class, 'downvote'])->name('forum.downvote');
    Route::delete('/forum/{forum}', [ForumController::class, 'destroy'])->name('forum.destroy');

});


// Rute untuk halaman profil
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route resource untuk berita (kecuali show)
Route::resource('berita', \App\Http\Controllers\BeritaController::class)->except(['show']);

// Route untuk komentar berita
Route::get('berita/{id}/komentar', [\App\Http\Controllers\BeritaController::class, 'komentar'])->name('berita.komentar');
Route::post('berita/{id}/komentar', [\App\Http\Controllers\BeritaController::class, 'storeKomentar'])->name('berita.komentar.store');

// ---------------------------------------------------- END GENERAL ROUTE ----------------------------------------------------

// ---------------------------------------------------- ADMIN ROUTES ----------------------------------------------------

// Rute Admin (Memerlukan Autentikasi dan Role Admin)
// PASTIKAN BARIS INI BENAR: Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Rute untuk Admin mengelola User
    // Nama-nama rute ini akan menjadi admin.users.index, dll.
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // --- Rute untuk Admin mengelola Aspirasi ---
    // Rute-rute ini menunjuk ke AdminAspirasiController
    Route::get('/aspirasi', [AdminAspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'show'])->name('aspirasi.show');
    Route::get('/aspirasi/{aspirasi}/edit', [AdminAspirasiController::class, 'edit'])->name('aspirasi.edit');
    Route::put('/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'update'])->name('aspirasi.update');
    Route::delete('/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'destroy'])->name('aspirasi.destroy');

    // Rute khusus untuk update status aspirasi
    Route::patch('/aspirasi/{aspirasi}/update-status', [AdminAspirasiController::class, 'updateStatus'])->name('aspirasi.update_status');
});

// ---------------------------------------------------- END ADMIN ROUTES ----------------------------------------------------
// ---------------------------------------------------- END OF FILE ----------------------------------------------------