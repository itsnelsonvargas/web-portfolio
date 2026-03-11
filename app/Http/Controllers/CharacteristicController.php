<?php

namespace App\Http\Controllers;

use App\Services\FileDataService;
use Illuminate\Http\Request;

class CharacteristicController extends Controller
{
    protected $fileDataService;

    public function __construct(FileDataService $fileDataService)
    {
        $this->fileDataService = $fileDataService;
    }

    public function index()
    {
        // Load profile from JSON file
        $profileData = $this->fileDataService->first('profile.json');
        $profile = $profileData ? (object) $profileData : (object) [
            'name' => env('PORTFOLIO_NAME', 'John Doe'),
            'title' => env('PORTFOLIO_TITLE', 'Full Stack Web Developer'),
            'bio' => env('PORTFOLIO_BIO', 'Passionate web developer'),
            'email' => env('PORTFOLIO_EMAIL', 'hello@example.com'),
            'phone' => env('PORTFOLIO_PHONE', '+1 (555) 123-4567'),
            'location' => env('PORTFOLIO_LOCATION', 'San Francisco, CA'),
            'profile_image' => env('PORTFOLIO_PROFILE_IMAGE', 'https://ui-avatars.com/api/?name=Portfolio&size=400'),
            'resume_url' => env('PORTFOLIO_RESUME_URL', '#'),
        ];

        // Load characteristics from JSON file
        $characteristics = $this->fileDataService->read('characteristics.json')->map(function ($characteristic) {
            return (object) $characteristic;
        });

        // Load social links from JSON file (for footer)
        $socialLinks = $this->fileDataService->read('social_links.json')->map(function ($link) {
            return (object) $link;
        });

        return view('portfolio.characteristic', compact('profile', 'characteristics', 'socialLinks'));
    }

    public function showCharacter($character)
    {
        // Load profile from JSON file
        $profileData = $this->fileDataService->first('profile.json');
        $profile = $profileData ? (object) $profileData : (object) [
            'name' => env('PORTFOLIO_NAME', 'John Doe'),
            'title' => env('PORTFOLIO_TITLE', 'Full Stack Web Developer'),
            'bio' => env('PORTFOLIO_BIO', 'Passionate web developer'),
            'email' => env('PORTFOLIO_EMAIL', 'hello@example.com'),
            'phone' => env('PORTFOLIO_PHONE', '+1 (555) 123-4567'),
            'location' => env('PORTFOLIO_LOCATION', 'San Francisco, CA'),
            'profile_image' => env('PORTFOLIO_PROFILE_IMAGE', 'https://ui-avatars.com/api/?name=Portfolio&size=400'),
            'resume_url' => env('PORTFOLIO_RESUME_URL', '#'),
        ];

        // Load social links from JSON file (for footer)
        $socialLinks = $this->fileDataService->read('social_links.json')->map(function ($link) {
            return (object) $link;
        });

        // Find the specific characteristic by ID
        $characteristic = $this->fileDataService->read('characteristics.json')
            ->where('id', $character)
            ->first();

        if (!$characteristic) {
            return redirect()->route('characteristic.index');
        }

        $characteristic = (object) $characteristic;
        // Convert proofs to objects if they exist
        if (isset($characteristic->proofs)) {
            $characteristic->proofs = collect($characteristic->proofs)->map(function ($proof) {
                return (object) $proof;
            });
        }

        return view('portfolio.characteristic-detail', compact('profile', 'characteristic', 'socialLinks'));
    }
}
