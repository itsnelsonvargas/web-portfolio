<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// Health check endpoint for Docker/Render
Route::get('/health', function () {
    return response('healthy', 200)->header('Content-Type', 'text/plain');
});

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [PortfolioController::class, 'contact'])->name('contact.submit');

// Admin authentication
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
});

Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth')->name('admin.logout');

// Admin dashboard + content management
Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/trainings', [TrainingController::class, 'index'])->name('trainings.index');
    Route::get('/trainings/create', [TrainingController::class, 'create'])->name('trainings.create');
    Route::post('/trainings', [TrainingController::class, 'store'])->name('trainings.store');
    Route::get('/trainings/{training}/edit', [TrainingController::class, 'edit'])->name('trainings.edit');
    Route::put('/trainings/{training}', [TrainingController::class, 'update'])->name('trainings.update');
    Route::delete('/trainings/{training}', [TrainingController::class, 'destroy'])->name('trainings.destroy');
    Route::delete('/trainings/{training}/uploads/{upload}', [TrainingController::class, 'detachUpload'])->name('trainings.uploads.detach');

    Route::get('/files', [UploadController::class, 'index'])->name('uploads.index');
    Route::post('/files', [UploadController::class, 'store'])->name('uploads.store');
    Route::delete('/files/{upload}', [UploadController::class, 'destroy'])->name('uploads.destroy');

    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/password', [PasswordController::class, 'update'])->name('password.update');
});

