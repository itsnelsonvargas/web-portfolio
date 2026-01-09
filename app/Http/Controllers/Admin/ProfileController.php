<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FileDataService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $fileDataService = new FileDataService();
        $profile = $fileDataService->first('profile.json');

        $envDefaults = [
            'name' => env('PORTFOLIO_NAME'),
            'title' => env('PORTFOLIO_TITLE'),
            'bio' => env('PORTFOLIO_BIO'),
            'email' => env('PORTFOLIO_EMAIL'),
            'phone' => env('PORTFOLIO_PHONE'),
            'location' => env('PORTFOLIO_LOCATION'),
            'resume_url' => env('PORTFOLIO_RESUME_URL'),
            'large_scale_projects' => env('LARGE_SCALE_PROJECTS'),
            'years_of_experience' => env('YEARS_OF_EXPERIENCE'),
        ];

        return view('admin.profile.edit', compact('profile', 'envDefaults'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'bio' => ['required', 'string'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:255'],
            'resume_url' => ['nullable', 'url'],
            'large_scale_projects' => ['nullable', 'integer', 'min:0'],
            'years_of_experience' => ['nullable', 'integer', 'min:0'],
            'profile_image' => ['nullable', 'image', 'max:4096'],
        ]);

        $fileDataService = new FileDataService();

        // Get current profile data
        $currentProfile = $fileDataService->first('profile.json') ?? [];

        // Handle profile image upload if provided
        if ($request->hasFile('profile_image')) {
            // Store the uploaded file
            $path = $request->file('profile_image')->store('profile', 'public');
            $validated['profile_image'] = $path;
        }

        // Merge current data with validated data
        $updatedProfile = array_merge($currentProfile, $validated);

        // Ensure we have an ID
        if (!isset($updatedProfile['id'])) {
            $updatedProfile['id'] = 1;
        }

        // Update timestamps
        $updatedProfile['updated_at'] = now()->toISOString();

        // Save to JSON file
        $fileDataService->write('profile.json', [$updatedProfile]);

        return redirect()->route('admin.profile.edit')->with('status', 'Profile updated successfully.');
    }
}
