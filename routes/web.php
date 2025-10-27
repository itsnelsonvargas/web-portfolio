<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SeminarController;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [PortfolioController::class, 'contact'])->name('contact.submit');

// Google Drive / Seminars Routes (removed upload/delete routes to avoid conflicts with static files)
// Route::get('/seminars', [SeminarController::class, 'index'])->name('seminars.index');
// Route::get('/google/auth', [SeminarController::class, 'redirectToGoogle'])->name('google.auth');
// Route::get('/google/callback', [SeminarController::class, 'handleGoogleCallback'])->name('google.callback');
