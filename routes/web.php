<?php

use App\Http\Controllers\VulnerableNoteController;
use App\Http\Controllers\SecureNoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VulnerableProfileController;
use App\Http\Controllers\SecureProfileController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('vulnerable.notes.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Vulnerable Notes Routes - demonstrates IDOR vulnerability
    Route::prefix('vulnerable')->name('vulnerable.')->group(function () {
        Route::get('/notes', [VulnerableNoteController::class, 'index'])->name('notes.index');
        Route::get('/notes/create', [VulnerableNoteController::class, 'create'])->name('notes.create');
        Route::post('/notes', [VulnerableNoteController::class, 'store'])->name('notes.store');
        Route::get('/notes/{id}', [VulnerableNoteController::class, 'show'])->name('notes.show');
        Route::get('/notes/{id}/edit', [VulnerableNoteController::class, 'edit'])->name('notes.edit');
        Route::put('/notes/{id}', [VulnerableNoteController::class, 'update'])->name('notes.update');
        Route::delete('/notes/{id}', [VulnerableNoteController::class, 'destroy'])->name('notes.destroy');
        
        // Search functionality
        Route::get('/notes-search', [VulnerableNoteController::class, 'search'])->name('notes.search');
        
        // Vulnerable Profile Routes
        Route::get('/profile', [VulnerableProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [VulnerableProfileController::class, 'update'])->name('profile.update');
    });
    
    // Secure Notes Routes - demonstrates how to prevent IDOR
    Route::prefix('secure')->name('secure.')->group(function () {
        Route::get('/notes', [SecureNoteController::class, 'index'])->name('notes.index');
        Route::get('/notes/create', [SecureNoteController::class, 'create'])->name('notes.create');
        Route::post('/notes', [SecureNoteController::class, 'store'])->name('notes.store');
        Route::get('/notes/{id}', [SecureNoteController::class, 'show'])->name('notes.show');
        Route::get('/notes/{id}/edit', [SecureNoteController::class, 'edit'])->name('notes.edit');
        Route::put('/notes/{id}', [SecureNoteController::class, 'update'])->name('notes.update');
        Route::delete('/notes/{id}', [SecureNoteController::class, 'destroy'])->name('notes.destroy');
        
        // Search functionality
        Route::get('/notes-search', [SecureNoteController::class, 'search'])->name('notes.search');
        
        // Secure Profile Routes
        Route::get('/profile', [SecureProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [SecureProfileController::class, 'update'])->name('profile.update');
    });
});

require __DIR__.'/auth.php';
