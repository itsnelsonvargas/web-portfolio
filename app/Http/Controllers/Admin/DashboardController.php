<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\Training;
use App\Models\Upload;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'projects' => Project::count(),
            'trainings' => Training::count(),
            'uploads' => Upload::count(),
            'messages' => ContactMessage::count(),
            'admins' => User::where('is_admin', true)->count(),
        ];

        $recentTrainings = Training::latest()->take(5)->get();
        $recentUploads = Upload::latest()->take(5)->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'recentTrainings' => $recentTrainings,
            'recentUploads' => $recentUploads,
        ]);
    }
}
