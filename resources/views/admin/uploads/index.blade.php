@php($title = 'Files')
<x-admin-layout :title="$title">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h2 class="text-xl font-semibold">Uploaded files</h2>
                    <p class="text-sm text-slate-500">Preview, download, or delete.</p>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800/50 text-left">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Size</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($uploads as $upload)
                            <tr class="border-t border-slate-100 dark:border-slate-800">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        @if(str_starts_with($upload->mime_type, 'image'))
                                            <img src="{{ Storage::disk($upload->disk)->url($upload->path) }}" class="w-12 h-12 rounded object-cover border border-slate-200 dark:border-slate-800" alt="{{ $upload->original_name }}">
                                        @else
                                            <div class="w-12 h-12 rounded bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-xs text-slate-500">{{ strtoupper($upload->extension) }}</div>
                                        @endif
                                        <div>
                                            <p class="font-semibold">{{ $upload->original_name }}</p>
                                            <p class="text-xs text-slate-500">{{ $upload->category ?? 'general' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ $upload->mime_type }}</td>
                                <td class="px-4 py-3">{{ number_format(($upload->size ?? 0) / 1024, 1) }} KB</td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <a href="{{ Storage::disk($upload->disk)->url($upload->path) }}" target="_blank" class="text-blue-600">Preview</a>
                                    <form action="{{ route('admin.uploads.destroy', $upload) }}" method="POST" class="inline" onsubmit="return confirm('Delete this file?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-slate-500">No files uploaded.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $uploads->links() }}
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-sm">
            <h3 class="text-lg font-semibold mb-3">Upload files</h3>
            <form action="{{ route('admin.uploads.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">Category</label>
                    <input type="text" name="category" placeholder="e.g. certificate, asset" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Files</label>
                    <input type="file" name="files[]" multiple class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900" required>
                </div>
                <button class="w-full px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700">Upload</button>
            </form>
        </div>
    </div>
</x-admin-layout>

