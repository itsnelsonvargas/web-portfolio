<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Training Records with Start/End Dates:\n";
echo "=====================================\n\n";

foreach (App\Models\Training::all() as $training) {
    echo "Title: " . $training->title . "\n";
    echo "Organization: " . ($training->organization ?? 'N/A') . "\n";
    echo "Start Date: " . ($training->started_at ? $training->started_at->format('M d, Y') : 'N/A') . "\n";
    echo "End Date: " . ($training->ended_at ? $training->ended_at->format('M d, Y') : 'N/A') . "\n";
    echo "Duration: ";
    if ($training->started_at && $training->ended_at) {
        $days = $training->started_at->diffInDays($training->ended_at);
        echo $days . " days\n";
    } else {
        echo "N/A\n";
    }
    echo "Credential ID: " . ($training->credential_id ?? 'N/A') . "\n";
    echo "Link: " . ($training->link ?? 'N/A') . "\n";
    echo "Tags: " . ($training->tags ?? 'N/A') . "\n";
    echo "Files: " . $training->uploads_count . "\n";
    echo "------------------------\n";
}

echo "\nTotal: " . App\Models\Training::count() . " training records\n";
