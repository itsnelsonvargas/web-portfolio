<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $training->title ?? '') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900" required>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Organization</label>
        <input type="text" name="organization" value="{{ old('organization', $training->organization ?? '') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Start Date</label>
        <input type="date" name="started_at" value="{{ old('started_at', optional($training->started_at ?? null)->toDateString()) }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">End Date</label>
        <input type="date" name="ended_at" value="{{ old('ended_at', optional($training->ended_at ?? null)->toDateString()) }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Credential ID</label>
        <input type="text" name="credential_id" value="{{ old('credential_id', $training->credential_id ?? '') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Link</label>
        <input type="url" name="link" value="{{ old('link', $training->link ?? '') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Tags (comma separated)</label>
        <input type="text" name="tags" value="{{ old('tags', $training->tags ?? '') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">{{ old('description', $training->description ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Upload files</label>
        <input type="file" name="files[]" multiple class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
        <p class="text-xs text-slate-500 mt-1">Supports PDF, images, docs. Max 10MB each.</p>
    </div>
</div>

