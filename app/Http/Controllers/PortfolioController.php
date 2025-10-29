<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\ContactMessage;
use App\Models\Achievement;
use App\Models\CharacterReference;
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
            'profile_image' =>env('APP_URL') . env('PORTFOLIO_PROFILE_IMAGE', 'https://ui-avatars.com/api/?name=Nelson+Vargas&size=400'),
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
        $projects = Project::all();
        $skills = Skill::all();
        $achievements = Achievement::all();
        $characterReferences = CharacterReference::all();

        // Load seminars from public/seminars folder
        $seminars = $this->getSeminars();

        return view('portfolio.index', compact('profile', 'projects', 'skills', 'socialLinks', 'achievements', 'about', 'seminars', 'characterReferences'));
    }

    /**
     * Get seminars from public/seminars folder
     */
    private function getSeminars()
    {
        $seminars = [];
        $seminarPath = public_path('seminars');

        if (!is_dir($seminarPath)) {
            return $seminars;
        }

        $files = array_diff(scandir($seminarPath), ['.', '..', '.gitkeep']);

        foreach ($files as $filename) {
            $filePath = $seminarPath . '/' . $filename;

            // Skip .gitkeep and other hidden files
            if (is_file($filePath) && !str_starts_with($filename, '.')) {
                $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $type = $this->getFileType($extension);
                $badgeClass = $this->getBadgeClass($extension);

                $seminars[] = [
                    'name' => pathinfo($filename, PATHINFO_FILENAME),
                    'url' => asset('seminars/' . rawurlencode($filename)),
                    'date' => date('M Y', filemtime($filePath)),
                    'type' => $type,
                    'badge_class' => $badgeClass,
                    'extension' => $extension,
                    'is_image' => in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']),
                    'filename' => $filename, // Store original filename for sorting
                    'modified_time' => filemtime($filePath), // Store timestamp for sorting
                ];
            }
        }

        // Sort by most recent using stored timestamp
        usort($seminars, function($a, $b) {
            return $b['modified_time'] - $a['modified_time'];
        });

        return $seminars;
    }

    /**
     * Get file type label from extension
     */
    private function getFileType($extension)
    {
        $types = [
            'pdf' => 'PDF',
            'doc' => 'DOC',
            'docx' => 'DOC',
            'ppt' => 'PPT',
            'pptx' => 'PPT',
            'xls' => 'XLS',
            'xlsx' => 'XLS',
            'mp4' => 'Video',
            'avi' => 'Video',
            'mov' => 'Video',
            'zip' => 'ZIP',
            'jpg' => 'Image',
            'jpeg' => 'Image',
            'png' => 'Image',
        ];

        return $types[$extension] ?? 'File';
    }

    /**
     * Get badge CSS class based on file extension
     */
    private function getBadgeClass($extension)
    {
        $classes = [
            'pdf' => 'bg-red-500/20 text-red-400 border border-red-500/30',
            'doc' => 'bg-blue-500/20 text-blue-400 border border-blue-500/30',
            'docx' => 'bg-blue-500/20 text-blue-400 border border-blue-500/30',
            'ppt' => 'bg-orange-500/20 text-orange-400 border border-orange-500/30',
            'pptx' => 'bg-orange-500/20 text-orange-400 border border-orange-500/30',
            'xls' => 'bg-green-500/20 text-green-400 border border-green-500/30',
            'xlsx' => 'bg-green-500/20 text-green-400 border border-green-500/30',
            'mp4' => 'bg-purple-500/20 text-purple-400 border border-purple-500/30',
            'avi' => 'bg-purple-500/20 text-purple-400 border border-purple-500/30',
            'mov' => 'bg-purple-500/20 text-purple-400 border border-purple-500/30',
            'zip' => 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30',
            'jpg' => 'bg-pink-500/20 text-pink-400 border border-pink-500/30',
            'jpeg' => 'bg-pink-500/20 text-pink-400 border border-pink-500/30',
            'png' => 'bg-pink-500/20 text-pink-400 border border-pink-500/30',
        ];

        return $classes[$extension] ?? 'bg-slate-500/20 text-slate-400 border border-slate-500/30';
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
