<?php

namespace App\Http\Controllers;

use App\Services\FileDataService;
use Illuminate\Http\Request;

class InsightController extends Controller
{
    protected $fileDataService;

    public function __construct(FileDataService $fileDataService)
    {
        $this->fileDataService = $fileDataService;
    }

    public function index()
    {
        // Load profile
        $profileData = $this->fileDataService->first('profile.json');
        $profile = $profileData ? (object) $profileData : (object) [
            'name' => env('PORTFOLIO_NAME', 'Nelson Vargas'),
            'title' => env('PORTFOLIO_TITLE', 'Full Stack Web Developer'),
            'bio' => env('PORTFOLIO_BIO', 'Passionate web developer'),
            'email' => env('PORTFOLIO_EMAIL', 'dev@nelvargas.com'),
            'profile_image' => env('PORTFOLIO_PROFILE_IMAGE', 'https://ui-avatars.com/api/?name=Portfolio&size=400'),
        ];

        // Load social links
        $socialLinks = $this->fileDataService->read('social_links.json')->map(function ($link) {
            return (object) $link;
        });

        // Load insights from data/insights directory
        $insightsPath = base_path('data/insights');
        $insights = collect();

        if (is_dir($insightsPath)) {
            $files = array_diff(scandir($insightsPath), ['.', '..']);
            foreach ($files as $file) {
                if (str_ends_with($file, '.json')) {
                    $content = json_decode(file_get_contents($insightsPath.'/'.$file), true);
                    if ($content) {
                        $insights->push((object) $content);
                    }
                }
            }
        }

        // Sort insights by date descending
        $insights = $insights->sortByDesc('date');

        return view('portfolio.insights', compact('profile', 'socialLinks', 'insights'));
    }

    public function show($id)
    {
        // Load profile
        $profileData = $this->fileDataService->first('profile.json');
        $profile = $profileData ? (object) $profileData : (object) [
            'name' => env('PORTFOLIO_NAME', 'Nelson Vargas'),
            'profile_image' => env('PORTFOLIO_PROFILE_IMAGE', 'https://ui-avatars.com/api/?name=Portfolio&size=400'),
        ];

        // Load social links
        $socialLinks = $this->fileDataService->read('social_links.json')->map(function ($link) {
            return (object) $link;
        });

        $filePath = base_path("data/insights/{$id}.json");

        if (!file_exists($filePath)) {
            return redirect()->route('insights.index');
        }

        $insight = (object) json_decode(file_get_contents($filePath), true);

        return view('portfolio.insight-detail', compact('profile', 'socialLinks', 'insight'));
    }
}
