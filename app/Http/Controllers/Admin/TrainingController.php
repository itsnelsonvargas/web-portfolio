<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $query = Training::query()->withCount('uploads');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('organization', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('credential_id', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        // Hide completed trainings filter
        if ($request->boolean('hide_completed')) {
            $query->whereNull('ended_at');
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'started_at');
        $sortDir = $request->get('sort_dir', 'desc');

        // Handle sorting by started_at (nulls last)
        if ($sortBy === 'started_at') {
            $query->orderByRaw('started_at IS NULL ASC, started_at ' . $sortDir);
        } else {
            $query->orderBy($sortBy, $sortDir);
        }

        $trainings = $query->get();

        return view('admin.trainings.index', compact('trainings'));
    }

    public function create()
    {
        return view('admin.trainings.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validatedTraining($request);

        DB::transaction(function () use ($request, $validated) {
            $training = Training::create($validated);
            $this->handleUploads($training, $request);
        });

        return redirect()->route('admin.trainings.index')->with('status', 'Training created.');
    }

    public function edit(Training $training)
    {
        $training->load('uploads');

        return view('admin.trainings.edit', compact('training'));
    }

    public function update(Request $request, Training $training)
    {
        $validated = $this->validatedTraining($request);

        DB::transaction(function () use ($request, $training, $validated) {
            $training->update($validated);
            $this->handleUploads($training, $request);
        });

        return redirect()->route('admin.trainings.edit', $training)->with('status', 'Training updated.');
    }

    public function destroy(Training $training)
    {
        $training->delete();

        return redirect()->route('admin.trainings.index')->with('status', 'Training deleted.');
    }

    public function detachUpload(Training $training, Upload $upload)
    {
        $training->uploads()->detach($upload->id);

        if ($upload->trainings()->count() === 0) {
            \Storage::disk($upload->disk ?? 'public')->delete($upload->path);
            $upload->delete();
        }

        return back()->with('status', 'File removed.');
    }

    private function validatedTraining(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'organization' => ['nullable', 'string', 'max:255'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'acquired_at' => ['nullable', 'date'],
            'credential_id' => ['nullable', 'string', 'max:255'],
            'link' => ['nullable', 'url'],
            'tags' => ['nullable', 'string', 'max:255'],
            'files.*' => ['nullable', 'file', 'max:10240'],
        ]);
    }

    private function handleUploads(Training $training, Request $request): void
    {
        if (! $request->hasFile('files')) {
            return;
        }

        foreach ($request->file('files') as $file) {
            $path = $file->store('trainings', 'public');

            $upload = Upload::create([
                'category' => 'training',
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'disk' => 'public',
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'extension' => $file->getClientOriginalExtension(),
                'meta' => ['context' => 'training'],
            ]);

            $training->uploads()->syncWithoutDetaching([$upload->id]);
        }
    }
}

