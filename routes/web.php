<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Texts & Homepage
Route::get('/', [TextController::class, 'index'])->name('home');
Route::get('/article/{slug}', [TextController::class, 'show'])->name('article.show');
Route::get('/category/{slug}', [TextController::class, 'showCategory'])->name('category.show');

// Authentication
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Journalist panel
Route::middleware('auth', 'is.journalist')->group(function () {
    Route::get('/journalist', [TextController::class, 'showJournalist'])->name('journalist');
    Route::post('/journalist/store', [TextController::class, 'store'])->name('article.store');
    Route::get('/journalist/edit/{id}', [TextController::class, 'edit'])->name('article.edit');
    Route::put('/journalist/update/{id}', [TextController::class, 'update'])->name('article.update');
    Route::delete('/journalist/destroy/{id}', [TextController::class, 'destroy'])->name('article.destroy');
});

// Admin panel
Route::middleware('auth', 'is.admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::post('/admin/user/{user}/role', [AdminController::class, 'updateUserRole'])->name('admin.update-role');
    Route::delete('/admin/user/{user}/delete', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
});