@php($title = 'Personal Information')
<x-admin-layout :title="$title">
    <div class="max-w-4xl">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-semibold mb-4">Profile</h2>
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div class="space-y-4 md:col-span-2">
                    <div>
                        <label class="block text-sm font-medium mb-1">Full name</label>
                        <input type="text" name="name" value="{{ old('name', $profile->name ?? $envDefaults['name'] ?? '') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Title</label>
                        <input type="text" name="title" value="{{ old('title', $profile->title ?? $envDefaults['title'] ?? '') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900" required>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Bio</label>
                    <textarea name="bio" rows="4" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900" required>{{ old('bio', $profile->bio ?? $envDefaults['bio'] ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email ?? $envDefaults['email'] ?? '') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? $envDefaults['phone'] ?? '') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Location</label>
                    <input type="text" name="location" value="{{ old('location', $profile->location ?? $envDefaults['location'] ?? '') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Resume URL</label>
                    <input type="url" name="resume_url" value="{{ old('resume_url', $profile->resume_url ?? $envDefaults['resume_url'] ?? '') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Large Scale Projects</label>
                    <input type="number" name="large_scale_projects" value="{{ old('large_scale_projects', $profile->large_scale_projects ?? $envDefaults['large_scale_projects'] ?? 0) }}" min="0" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
                    <p class="text-xs text-slate-500 mt-1">Number of large-scale projects completed</p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Years of Experience</label>
                    <input type="number" name="years_of_experience" value="{{ old('years_of_experience', $profile->years_of_experience ?? $envDefaults['years_of_experience'] ?? 0) }}" min="0" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
                    <p class="text-xs text-slate-500 mt-1">Total years of professional experience</p>
                </div>
                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                    <div>
                        <label class="block text-sm font-medium mb-1">Profile photo</label>
                        <input type="file" name="profile_image" accept="image/*" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 bg-white dark:bg-slate-900">
                        <p class="text-xs text-slate-500 mt-1">Max 4MB, will replace current photo.</p>
                    </div>
                    @if(isset($profile) && $profile->profileImageUrl())
                        <div class="flex items-center gap-3">
                            <img src="{{ $profile->profileImageUrl() }}" class="w-20 h-20 rounded-lg object-cover border border-slate-200 dark:border-slate-700" alt="Current photo">
                            <span class="text-sm text-slate-500">Current photo</span>
                        </div>
                    @endif
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <button class="px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>

