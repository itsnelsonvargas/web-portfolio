@php($title = 'Add Training')
<x-admin-layout :title="$title">
    <div class="max-w-4xl">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-semibold mb-4">Create training</h2>
            <form action="{{ route('admin.trainings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @include('admin.trainings.partials.form')
                <div class="flex justify-end">
                    <button class="px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>

