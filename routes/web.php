<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Depan (Publik)
Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('article.show');

// 2. Grup Route yang Wajib Login (Admin/Dashboard)
Route::middleware('auth')->group(function () {
    
    // --- Route Bawaan Breeze untuk Profile (Tambahkan Ini) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // ---------------------------------------------------------

    // Dashboard Artikel
    Route::get('/dashboard', [ArticleController::class, 'adminIndex'])->name('dashboard');
    Route::patch('/articles/{article}/toggle', [ArticleController::class, 'togglePublish'])->name('articles.toggle');
    // CRUD Artikel
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

require __DIR__.'/auth.php';