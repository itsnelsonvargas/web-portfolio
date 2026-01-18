@php($title = 'Dashboard')
<x-admin-layout :title="$title">
    <!-- File-Based Storage Notice -->
    <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 mb-6 rounded-lg">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <strong>File-Based Storage Active</strong>
        </div>
        <p class="text-sm mt-1">Your portfolio uses JSON files instead of a database. Content is stored in the <code>data/</code> directory and survives Render.com's 30-day database reset.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4">
            <p class="text-sm text-slate-500">Projects</p>
            <p class="text-3xl font-bold mt-1">{{ $stats['projects'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4">
            <p class="text-sm text-slate-500">Trainings</p>
            <p class="text-3xl font-bold mt-1">{{ $stats['trainings'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4">
            <p class="text-sm text-slate-500">Uploads</p>
            <p class="text-3xl font-bold mt-1">{{ $stats['uploads'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4">
            <p class="text-sm text-slate-500">Messages</p>
            <p class="text-3xl font-bold mt-1">{{ $stats['messages'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4">
            <p class="text-sm text-slate-500">Admins</p>
            <p class="text-3xl font-bold mt-1">{{ $stats['admins'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold">Recent trainings</h3>
                <a href="{{ route('admin.trainings.index') }}" class="text-sm text-blue-600">Manage</a>
            </div>
            <div class="space-y-3">
                @forelse ($recentTrainings as $training)
                    <div class="p-3 rounded-lg border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-800/40">
                        <p class="font-semibold">{{ $training->title }}</p>
                        <p class="text-sm text-slate-500">{{ $training->organization }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No trainings yet.</p>
                @endforelse
            </div>
        </div>
        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold">Recent uploads</h3>
                <a href="{{ route('admin.uploads.index') }}" class="text-sm text-blue-600">Manage</a>
            </div>
            <div class="space-y-3">
                @forelse ($recentUploads as $upload)
                    <div class="p-3 rounded-lg border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-800/40 flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-sm">{{ $upload->original_name }}</p>
                            <p class="text-xs text-slate-500">{{ $upload->category ?? 'general' }}</p>
                        </div>
                        <a href="{{ Storage::disk($upload->disk)->url($upload->path) }}" class="text-blue-600 text-sm" target="_blank">View</a>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No uploads yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>

