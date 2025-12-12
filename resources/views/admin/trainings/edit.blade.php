@php($title = 'Edit Training')
<x-admin-layout :title="$title">
    <div class="max-w-4xl space-y-4">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-semibold mb-4">Edit training</h2>
            <form action="{{ route('admin.trainings.update', $training) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                @include('admin.trainings.partials.form')
                <div class="flex justify-end">
                    <button class="px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
            <h3 class="text-lg font-semibold mb-3">Attached files</h3>
            <div class="space-y-3">
                @forelse ($training->uploads as $upload)
                    <div class="flex items-center justify-between rounded-lg border border-slate-100 dark:border-slate-800 px-3 py-2">
                        <div>
                            <p class="font-semibold text-sm">{{ $upload->original_name }}</p>
                            <p class="text-xs text-slate-500">{{ $upload->mime_type }} — {{ number_format(($upload->size ?? 0) / 1024, 1) }} KB</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ Storage::disk($upload->disk)->url($upload->path) }}" target="_blank" class="text-blue-600 text-sm">View</a>
                            <form action="{{ route('admin.trainings.uploads.detach', [$training, $upload]) }}" method="POST" onsubmit="return confirm('Remove this file?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 text-sm">Remove</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No files yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>

