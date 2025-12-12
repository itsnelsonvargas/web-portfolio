<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Update existing trainings with start/end dates
$updates = [
    'Laravel Framework Certification' => ['started_at' => '2024-01-15', 'ended_at' => '2024-03-15'],
    'Advanced PHP Development' => ['started_at' => '2023-09-01', 'ended_at' => '2023-11-20'],
    'JavaScript Mastery Course' => ['started_at' => '2023-10-01', 'ended_at' => '2024-01-10'],
    'Vue.js Developer Certification' => ['started_at' => '2023-07-01', 'ended_at' => '2023-09-05'],
    'Database Design & Administration' => ['started_at' => '2023-05-01', 'ended_at' => '2023-07-18'],
    'Tailwind CSS Professional' => ['started_at' => '2024-01-01', 'ended_at' => '2024-02-28'],
];

foreach ($updates as $title => $dates) {
    $training = App\Models\Training::where('title', $title)->first();
    if ($training) {
        $training->update($dates);
        echo "Updated: $title\n";
    } else {
        echo "Not found: $title\n";
    }
}

echo "\nCurrent trainings:\n";
foreach (App\Models\Training::all() as $training) {
    echo $training->title . ': ' .
         ($training->started_at ? $training->started_at->format('Y-m-d') : 'null') . ' to ' .
         ($training->ended_at ? $training->ended_at->format('Y-m-d') : 'null') . "\n";
}
