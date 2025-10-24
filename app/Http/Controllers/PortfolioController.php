<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\ContactMessage;
use App\Models\Achievement;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        // Build profile from .env instead of database
        $profile = (object) [
            'name' => env('PORTFOLIO_NAME', 'John Doe'),
            'title' => env('PORTFOLIO_TITLE', 'Full Stack Web Developer'),
            'bio' => env('PORTFOLIO_BIO', 'Passionate web developer'),
            'email' => env('PORTFOLIO_EMAIL', 'hello@example.com'),
            'phone' => env('PORTFOLIO_PHONE', '+1 (555) 123-4567'),
            'location' => env('PORTFOLIO_LOCATION', 'San Francisco, CA'),
            'profile_image' => env('PORTFOLIO_PROFILE_IMAGE', 'https://ui-avatars.com/api/?name=John+Doe&size=400'),
            'resume_url' => env('PORTFOLIO_RESUME_URL', '#'),
        ];

        // Parse social links from env
        $socialLinks = collect([
            env('PORTFOLIO_SOCIAL_GITHUB'),
            env('PORTFOLIO_SOCIAL_LINKEDIN'),
            env('PORTFOLIO_SOCIAL_FACEBOOK'),
            env('PORTFOLIO_SOCIAL_EMAIL'),
        ])->filter()->map(function($social) {
            if (str_contains($social, '|')) {
                [$platform, $url] = explode('|', $social, 2);
                return (object) ['platform' => $platform, 'url' => $url];
            }
            return null;
        })->filter();

        // About me from .env instead
        $about = (object) [
            'large_scale_projects' => env('LARGE_SCALE_PROJECTS', '0'),
            'years_of_experience' => env('YEARS_OF_EXPERIENCE', '1'),

        ];

        // Keep database queries for projects, skills, and achievements
        $projects = Project::orderBy('order')->get();
        $skills = Skill::orderBy('order')->get();
        $achievements = Achievement::orderBy('order')->get();

        return view('portfolio.index', compact('profile', 'projects', 'skills', 'socialLinks', 'achievements', 'about'));
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|max:255',
            'message' => 'required',
        ]);

        // Save to database for your records
        ContactMessage::create($validated);

        return back()->with('success', 'Thank you for your message! I will get back to you soon.');
    }
}
