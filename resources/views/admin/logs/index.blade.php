@php($title = 'Application Logs')
<x-admin-layout :title="$title">
    <div class="space-y-6">
        <div>
            <h2 class="text-xl font-black text-slate-900 dark:text-white">Application Logs</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">View Laravel log files from <code class="text-xs bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded">storage/logs</code>.</p>
        </div>

        <form method="GET" action="{{ route('admin.logs.index') }}" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label for="file" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Log file</label>
                    <select id="file" name="file" class="w-full rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-3 py-2 text-sm">
                        @forelse ($files as $file)
                            <option value="{{ $file }}" @selected($file === $selectedFile)>{{ $file }}</option>
                        @empty
                            <option value="">No log files found</option>
                        @endforelse
                    </select>
                </div>
                <div>
                    <label for="level" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Level</label>
                    <select id="level" name="level" class="w-full rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-3 py-2 text-sm">
                        <option value="">All levels</option>
                        @foreach ($levels as $logLevel)
                            <option value="{{ $logLevel }}" @selected($level === $logLevel)>{{ ucfirst($logLevel) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="lines" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Entries</label>
                    <select id="lines" name="lines" class="w-full rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-3 py-2 text-sm">
                        @foreach ([50, 100, 200, 500, 1000] as $option)
                            <option value="{{ $option }}" @selected($lines === $option)>Latest {{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700">Apply</button>
                    <a href="{{ route('admin.logs.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-800">Reset</a>
                </div>
            </div>
            @if ($selectedFile && $fileSize !== null)
                <p class="text-xs text-slate-500 mt-3">
                    Showing up to {{ $lines }} entries from <strong>{{ $selectedFile }}</strong>
                    ({{ number_format($fileSize / 1024, 1) }} KB)
                </p>
            @endif
        </form>

        <div class="space-y-3">
            @forelse ($entries as $entry)
                @php
                    $levelClass = match (true) {
                        str_contains($entry, '.EMERGENCY:') || str_contains($entry, '.emergency:') => 'border-red-500 bg-red-50 dark:bg-red-950/30',
                        str_contains($entry, '.ALERT:') || str_contains($entry, '.alert:') => 'border-red-500 bg-red-50 dark:bg-red-950/30',
                        str_contains($entry, '.CRITICAL:') || str_contains($entry, '.critical:') => 'border-red-500 bg-red-50 dark:bg-red-950/30',
                        str_contains($entry, '.ERROR:') || str_contains($entry, '.error:') => 'border-red-400 bg-red-50/70 dark:bg-red-950/20',
                        str_contains($entry, '.WARNING:') || str_contains($entry, '.warning:') => 'border-amber-400 bg-amber-50 dark:bg-amber-950/20',
                        str_contains($entry, '.NOTICE:') || str_contains($entry, '.notice:') => 'border-blue-300 bg-blue-50 dark:bg-blue-950/20',
                        str_contains($entry, '.INFO:') || str_contains($entry, '.info:') => 'border-emerald-300 bg-emerald-50 dark:bg-emerald-950/20',
                        default => 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900',
                    };
                @endphp
                <div class="border-l-4 {{ $levelClass }} rounded-r-xl border border-slate-200 dark:border-slate-800 p-4 shadow-sm">
                    <pre class="text-xs font-mono whitespace-pre-wrap break-words text-slate-800 dark:text-slate-200 leading-relaxed">{{ trim($entry) }}</pre>
                </div>
            @empty
                <div class="text-center py-20 bg-white dark:bg-slate-900 border border-dashed border-slate-300 dark:border-slate-700 rounded-3xl">
                    <div class="w-20 h-20 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">No log entries</h3>
                    <p class="text-slate-500">
                        @if ($files->isEmpty())
                            No log files exist yet. Logs will appear here once the application writes to <code>storage/logs</code>.
                        @else
                            No entries match your filters in the selected log file.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</x-admin-layout>
