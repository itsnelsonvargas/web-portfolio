<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FileDataService;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $fileDataService = new FileDataService();
        $trainings = $fileDataService->read('trainings.json');

        // Apply search if provided
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $trainings = $trainings->filter(function ($training) use ($search) {
                return str_contains(strtolower($training['title'] ?? ''), $search) ||
                       str_contains(strtolower($training['organization'] ?? ''), $search) ||
                       str_contains(strtolower($training['description'] ?? ''), $search) ||
                       str_contains(strtolower($training['credential_id'] ?? ''), $search) ||
                       str_contains(strtolower($training['tags'] ?? ''), $search);
            });
        }

        // Apply hide completed filter if requested
        if ($request->boolean('hide_completed')) {
            $trainings = $trainings->filter(function ($training) {
                return empty($training['ended_at']);
            });
        }

        // Convert to objects for the view
        $trainings = $trainings->map(function ($training) {
            $obj = (object) $training;
            // Add uploads_count for compatibility
            $obj->uploads_count = isset($training['files']) ? count($training['files']) : 0;
            return $obj;
        });

        return view('admin.trainings.index', compact('trainings'));
    }

    public function create()
    {
        // For now, disable creation since we're using file-based storage
        return redirect()->route('admin.trainings.index')->with('error', 'Training creation is disabled in file-based mode. Edit the trainings.json file directly.');
    }

    public function store(Request $request)
    {
        // Disabled in file-based mode
        return redirect()->route('admin.trainings.index')->with('error', 'Training creation is disabled in file-based mode.');
    }

    public function edit($id)
    {
        $fileDataService = new FileDataService();
        $training = $fileDataService->find('trainings.json', $id);

        if (!$training) {
            return redirect()->route('admin.trainings.index')->with('error', 'Training not found.');
        }

        // Convert to object for the view
        $training = (object) $training;

        return view('admin.trainings.edit', compact('training'));
    }

    public function update(Request $request, $id)
    {
        // For now, disable updates since we're using file-based storage
        return redirect()->route('admin.trainings.index')->with('error', 'Training updates are disabled in file-based mode. Edit the trainings.json file directly.');
    }

    public function destroy($id)
    {
        // For now, disable deletion since we're using file-based storage
        return redirect()->route('admin.trainings.index')->with('error', 'Training deletion is disabled in file-based mode. Edit the trainings.json file directly.');
    }

    public function detachUpload($trainingId, $uploadId)
    {
        // For now, disable file operations since we're using file-based storage
        return redirect()->route('admin.trainings.index')->with('error', 'File operations are disabled in file-based mode.');
    }

}

