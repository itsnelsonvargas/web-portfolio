<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Database Check:\n";
echo "===============\n";
echo "Trainings: " . App\Models\Training::count() . "\n";
echo "Users: " . App\Models\User::count() . "\n";
echo "Projects: " . App\Models\Project::count() . "\n";
echo "Skills: " . App\Models\Skill::count() . "\n";

if (App\Models\Training::count() > 0) {
    echo "\nTraining Titles:\n";
    echo "================\n";
    foreach (App\Models\Training::all() as $training) {
        echo "- " . $training->title . "\n";
        echo "  Organization: " . ($training->organization ?? 'N/A') . "\n";
        echo "  Date: " . ($training->acquired_at ? $training->acquired_at->format('Y-m-d') : 'N/A') . "\n";
        echo "  Credential ID: " . ($training->credential_id ?? 'N/A') . "\n";
        echo "  Link: " . ($training->link ?? 'N/A') . "\n";
        echo "  Tags: " . ($training->tags ?? 'N/A') . "\n";
        echo "\n";
    }
}
