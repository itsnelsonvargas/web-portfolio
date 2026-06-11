<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    private const MAX_LINES = 1000;

    private const MAX_BYTES = 512000;

    private const LEVELS = [
        'emergency',
        'alert',
        'critical',
        'error',
        'warning',
        'notice',
        'info',
        'debug',
    ];

    public function index(Request $request)
    {
        $files = $this->logFiles();
        $selectedFile = $request->query('file', $files->first());

        if (! $files->contains($selectedFile)) {
            $selectedFile = $files->first();
        }

        $lines = min(max((int) $request->query('lines', 200), 1), self::MAX_LINES);
        $level = $request->query('level');
        $level = in_array($level, self::LEVELS, true) ? $level : null;

        $entries = [];
        $fileSize = null;

        if ($selectedFile) {
            $path = storage_path('logs/'.$selectedFile);
            $fileSize = file_exists($path) ? filesize($path) : null;
            $entries = $this->readLogEntries($path, $lines, $level);
        }

        return view('admin.logs.index', [
            'files' => $files,
            'selectedFile' => $selectedFile,
            'lines' => $lines,
            'level' => $level,
            'levels' => self::LEVELS,
            'entries' => $entries,
            'fileSize' => $fileSize,
        ]);
    }

    private function logFiles()
    {
        $logsPath = storage_path('logs');

        if (! File::isDirectory($logsPath)) {
            return collect();
        }

        return collect(File::files($logsPath))
            ->filter(fn ($file) => $file->getExtension() === 'log')
            ->map(fn ($file) => $file->getFilename())
            ->sortDesc()
            ->values();
    }

    private function readLogEntries(string $path, int $limit, ?string $level): array
    {
        if (! file_exists($path)) {
            return [];
        }

        $content = $this->tailFile($path);
        $pattern = '/(?=\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\])/';
        $entries = preg_split($pattern, $content, -1, PREG_SPLIT_NO_EMPTY) ?: [];

        $entries = array_reverse($entries);

        if ($level) {
            $entries = array_values(array_filter(
                $entries,
                fn (string $entry) => preg_match('/\.'.$level.':/i', $entry) === 1
            ));
        }

        return array_slice($entries, 0, $limit);
    }

    private function tailFile(string $path): string
    {
        $size = filesize($path);

        if ($size === 0) {
            return '';
        }

        $readBytes = min(self::MAX_BYTES, $size);
        $handle = fopen($path, 'r');
        fseek($handle, max(0, $size - $readBytes));
        $content = fread($handle, $readBytes);
        fclose($handle);

        if ($size > $readBytes) {
            $content = preg_replace('/^[^\[]*/', '', $content) ?? $content;
        }

        return $content;
    }
}
