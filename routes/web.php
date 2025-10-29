<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SeminarController;

// Health check endpoint for Docker/Render
Route::get('/health', function () {
    return response('healthy', 200)->header('Content-Type', 'text/plain');
});

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [PortfolioController::class, 'contact'])->name('contact.submit');

// TEMPORARY SEEDER ROUTE - DELETE AFTER USE!
Route::get('/reset-db', function() {
    try {
        // Reset database and run seeders
        Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
        $output = Artisan::output();

        return response()->json([
            'status' => 'success',
            'message' => 'Database reset and seeded successfully!',
            'output' => $output,
            'counts' => [
                'projects' => \App\Models\Project::count(),
                'skills' => \App\Models\Skill::count(),
                'experiences' => \App\Models\Experience::count(),
                'education' => \App\Models\Education::count(),
                'achievements' => \App\Models\Achievement::count(),
                'references' => \App\Models\CharacterReference::count(),
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});
