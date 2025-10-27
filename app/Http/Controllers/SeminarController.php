<?php

namespace App\Http\Controllers;

use App\Services\GoogleDriveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeminarController extends Controller
{
    private $googleDriveService;

    public function __construct(GoogleDriveService $googleDriveService)
    {
        $this->googleDriveService = $googleDriveService;
    }

    /**
     * Display seminars and webinars
     */
    public function index()
    {
        $files = [];

        // Get manually uploaded files
        $manualFiles = $this->getManualFiles();

        // Get Google Drive files if authenticated
        if (session('google_access_token')) {
            $driveFiles = $this->googleDriveService->listFiles();

            if (!isset($driveFiles['error'])) {
                $files = array_merge($manualFiles, $driveFiles['files'] ?? []);
            } else {
                $files = $manualFiles;
            }
        } else {
            $files = $manualFiles;
        }

        return view('seminars.index', ['files' => $files]);
    }

    /**
     * Get manually uploaded files from storage
     */
    private function getManualFiles()
    {
        $files = [];
        $storagePath = storage_path('app/public/seminars');

        if (!is_dir($storagePath)) {
            return $files;
        }

        $uploadedFiles = array_diff(scandir($storagePath), ['.', '..']);

        foreach ($uploadedFiles as $filename) {
            $filePath = $storagePath . '/' . $filename;

            if (is_file($filePath)) {
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $mimeType = $this->getMimeTypeFromExtension($extension);

                $files[] = [
                    'name' => $filename,
                    'mimeType' => $mimeType,
                    'modifiedTime' => date('Y-m-d H:i:s', filemtime($filePath)),
                    'webViewLink' => asset('storage/seminars/' . $filename),
                    'isManual' => true,
                    'size' => filesize($filePath),
                    'iconLink' => null,
                    'thumbnailLink' => null
                ];
            }
        }

        return $files;
    }

    /**
     * Get MIME type from file extension
     */
    private function getMimeTypeFromExtension($extension)
    {
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'mp4' => 'video/mp4',
            'avi' => 'video/avi',
            'mov' => 'video/quicktime',
            'txt' => 'text/plain',
            'zip' => 'application/zip',
        ];

        return $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
    }

    /**
     * Show upload form
     */
    public function upload()
    {
        return view('seminars.upload');
    }

    /**
     * Handle file upload
     */
    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|max:102400', // 100MB max
        ]);

        $uploadedFiles = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/seminars', $filename);
                $uploadedFiles[] = $filename;
            }
        }

        return redirect()->route('seminars.index')->with('success', count($uploadedFiles) . ' file(s) uploaded successfully');
    }

    /**
     * Delete a manual file
     */
    public function destroy($filename)
    {
        $filePath = 'public/seminars/' . $filename;

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            return redirect()->route('seminars.index')->with('success', 'File deleted successfully');
        }

        return redirect()->route('seminars.index')->with('error', 'File not found');
    }

    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        $authUrl = $this->googleDriveService->getAuthUrl();
        return redirect($authUrl);
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback(Request $request)
    {
        $code = $request->get('code');

        if (!$code) {
            return redirect()->route('seminars.index')->with('error', 'Authorization failed');
        }

        $token = $this->googleDriveService->getAccessToken($code);

        if (!$token) {
            return redirect()->route('seminars.index')->with('error', 'Failed to get access token');
        }

        return redirect()->route('seminars.index')->with('success', 'Successfully connected to Google Drive');
    }
}
