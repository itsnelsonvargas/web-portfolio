<?php

namespace App\Http\Controllers;

use App\Services\FileDataService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReviewController extends Controller
{
    protected $fileDataService;

    public function __construct(FileDataService $fileDataService)
    {
        $this->fileDataService = $fileDataService;
    }

    public function index()
    {
        // Get all the data needed for the index page
        $profileData = $this->fileDataService->first('profile.json');
        $profile = $profileData ? (object) $profileData : (object) [
            'name' => config('portfolio.name', 'John Doe'),
            'title' => config('portfolio.title', 'Full Stack Web Developer'),
            'bio' => config('portfolio.bio', 'Passionate web developer'),
            'email' => config('portfolio.email', 'hello@example.com'),
            'phone' => config('portfolio.phone', '+1 (555) 123-4567'),
            'location' => config('portfolio.location', 'San Francisco, CA'),
            'profile_image' => config('portfolio.profile_image', 'https://ui-avatars.com/api/?name=Portfolio&size=400'),
            'resume_url' => config('portfolio.resume_url', '#'),
            'large_scale_projects' => config('portfolio.large_scale_projects', 0),
            'years_of_experience' => config('portfolio.years_of_experience', 1),
        ];

        $projects = $this->fileDataService->read('projects.json')->map(function ($project) {
            return (object) $project;
        });

        $skills = $this->fileDataService->read('skills.json')->sortByDesc('proficiency')->map(function ($skill) {
            return (object) $skill;
        });

        $achievements = $this->fileDataService->read('achievements.json')->map(function ($achievement) {
            return (object) $achievement;
        });

        $characterReferences = $this->fileDataService->read('references.json')->map(function ($reference) {
            return (object) $reference;
        });

        $socialLinks = $this->fileDataService->read('social_links.json')->map(function ($link) {
            return (object) $link;
        });

        $about = (object) [
            'large_scale_projects' => $profile->large_scale_projects ?? 0,
            'years_of_experience' => $profile->years_of_experience ?? 1,
        ];

        $characteristics = $this->fileDataService->read('characteristics.json')->map(function ($characteristic) {
            return (object) $characteristic;
        });
        
        $seminars = $this->getSeminars();

        return view('portfolio.review', compact('profile', 'projects', 'skills', 'socialLinks', 'achievements', 'about', 'characteristics', 'seminars', 'characterReferences'));
    }

    public function store(Request $request)
    {
        // For /review page, we use Formspree directly in the frontend.
        // This store method is kept for any internal/admin usage but is currently 
        // bypassed by the frontend form to avoid server-side database dependencies (like cache/session tables).
        
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'suggestion' => 'required|string|max:2000',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $this->fileDataService->create('reviews.json', array_merge($validated, [
            'name' => $validated['name'] ?? 'Anonymous',
            'email' => $validated['email'] ?? 'not-provided@example.com',
            'submitted_at' => now()->toIso8601String(),
            'ip_address' => $request->ip(),
        ]));

        return back()->with('success', 'Thank you for your suggestion!');
    }

    private function getSeminars()
    {
        $seminars = [];
        $seminarPath = public_path('seminars');

        if (! is_dir($seminarPath)) {
            return $seminars;
        }

        $files = array_diff(scandir($seminarPath), ['.', '..', '.gitkeep']);

        foreach ($files as $filename) {
            $filePath = $seminarPath.'/'.$filename;

            if (is_file($filePath) && ! str_starts_with($filename, '.')) {
                $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $type = $this->getFileType($extension);
                $badgeClass = $this->getBadgeClass($extension);

                $seminars[] = [
                    'name' => pathinfo($filename, PATHINFO_FILENAME),
                    'url' => asset('seminars/'.rawurlencode($filename)),
                    'date' => date('M Y', filemtime($filePath)),
                    'type' => $type,
                    'badge_class' => $badgeClass,
                    'extension' => $extension,
                    'is_image' => in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']),
                    'filename' => $filename,
                    'modified_time' => filemtime($filePath),
                ];
            }
        }

        usort($seminars, function ($a, $b) {
            return $b['modified_time'] - $a['modified_time'];
        });

        return $seminars;
    }

    private function getFileType($extension)
    {
        $types = [
            'pdf' => 'PDF', 'doc' => 'DOC', 'docx' => 'DOC', 'ppt' => 'PPT', 'pptx' => 'PPT',
            'xls' => 'XLS', 'xlsx' => 'XLS', 'mp4' => 'Video', 'avi' => 'Video', 'mov' => 'Video',
            'zip' => 'ZIP', 'jpg' => 'Image', 'jpeg' => 'Image', 'png' => 'Image',
        ];

        return $types[$extension] ?? 'File';
    }

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
}
