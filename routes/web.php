<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectManagementController;
use App\Http\Controllers\TestUploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserLevel;

// Portfolio Routes (Public)
Route::get('/', [PortfolioController::class, 'home'])->name('home');
Route::get('/about', [PortfolioController::class, 'about'])->name('about');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('contact');

// Project Routes (Public)
Route::get('/projects', [ProjectManagementController::class, 'clientIndex'])->name('client.projects');
Route::get('/projects/{type}', [ProjectManagementController::class, 'clientProjectsByType'])->name('client.projects.by.type');
Route::get('/project/{project}', [ProjectManagementController::class, 'clientShow'])->name('client.project.show');

// Breeze Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Project Management Routes (Admin Only)
Route::prefix('ngeditdulu')->name('project-management.')->middleware([CheckUserLevel::class])->group(function () {
    Route::get('/', [ProjectManagementController::class, 'index'])->name('index');
    Route::get('/create', [ProjectManagementController::class, 'create'])->name('create');
    Route::post('/', [ProjectManagementController::class, 'store'])->name('store');
    Route::get('/{project}/edit', [ProjectManagementController::class, 'edit'])->name('edit');
    Route::put('/{project}', [ProjectManagementController::class, 'update'])->name('update');
    Route::delete('/{project}', [ProjectManagementController::class, 'destroy'])->name('destroy');
    Route::delete('/images/{image}', [ProjectManagementController::class, 'deleteImage'])->name('delete-image');
    Route::post('/images/reorder', [ProjectManagementController::class, 'reorderImages'])->name('reorder-images');
});

// Test Upload Routes (Admin Only)
Route::middleware([CheckUserLevel::class])->group(function () {
    Route::get('/test-upload', [TestUploadController::class, 'index'])->name('test-upload.index');
    Route::post('/test-upload', [TestUploadController::class, 'upload'])->name('test-upload.upload');
    Route::post('/test-upload/delete', [TestUploadController::class, 'delete'])->name('test-upload.delete');
});

// Breeze Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
