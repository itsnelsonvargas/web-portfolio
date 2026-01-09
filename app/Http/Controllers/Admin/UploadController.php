<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        $uploads = Upload::latest()->paginate(15);

        return view('admin.uploads.index', compact('uploads'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'files' => ['required', 'array'],
            'files.*' => ['required', 'file', 'max:10240'],
            'category' => ['nullable', 'string', 'max:100'],
        ]);

        foreach ($request->file('files', []) as $file) {
            $path = $file->store('uploads', 'public');

            Upload::create([
                'category' => $validated['category'] ?? 'general',
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'disk' => 'public',
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'extension' => $file->getClientOriginalExtension(),
                'meta' => ['context' => 'manual_upload'],
            ]);
        }

        return back()->with('status', 'Files uploaded.');
    }

    public function destroy(Upload $upload)
    {
        if ($upload->path) {
            \Storage::disk($upload->disk ?? 'public')->delete($upload->path);
        }

        $upload->trainings()->detach();
        $upload->delete();

        return back()->with('status', 'File deleted.');
    }
}
