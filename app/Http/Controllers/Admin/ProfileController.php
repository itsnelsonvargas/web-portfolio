<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first();

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

        $profile = Profile::first() ?? new Profile();

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile', 'public');

            Upload::create([
                'category' => 'profile_image',
                'original_name' => $request->file('profile_image')->getClientOriginalName(),
                'path' => $path,
                'disk' => 'public',
                'mime_type' => $request->file('profile_image')->getMimeType(),
                'size' => $request->file('profile_image')->getSize(),
                'extension' => $request->file('profile_image')->getClientOriginalExtension(),
                'meta' => ['type' => 'profile_image'],
            ]);

            // Delete old file if stored locally
            if ($profile->profile_image && ! str_starts_with($profile->profile_image, ['http://', 'https://'])) {
                Storage::disk('public')->delete($profile->profile_image);
            }

            $profile->profile_image = $path;
        }

        $profile->fill($validated);
        $profile->save();

        return redirect()->route('admin.profile.edit')->with('status', 'Profile updated successfully.');
    }
}

