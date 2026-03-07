<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FileDataService;
use Illuminate\Http\Request;

class ReviewManagementController extends Controller
{
    protected $fileDataService;

    public function __construct(FileDataService $fileDataService)
    {
        $this->fileDataService = $fileDataService;
    }

    public function index()
    {
        $reviews = $this->fileDataService->read('reviews.json')->sortByDesc('submitted_at');

        return view('admin.reviews.index', compact('reviews'));
    }

    public function destroy($id)
    {
        if ($this->fileDataService->delete('reviews.json', $id)) {
            return back()->with('status', 'Review deleted successfully.');
        }

        return back()->withErrors(['error' => 'Failed to delete review.']);
    }
}
