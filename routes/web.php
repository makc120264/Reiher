<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Book routes
    Route::resource('books', BookController::class)->parameters([
        'books' => 'slug'
    ]);

    // Category routes
    Route::resource('categories', CategoryController::class)->parameters([
        'categories' => 'slug'
    ]);

    // Books by category
    Route::get('categories/{slug}/books', [CategoryController::class, 'show'])->name('categories.books');
});

require __DIR__.'/auth.php';
