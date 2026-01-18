@php($title = 'Reset Password')
<x-admin-layout :title="$title">
    <div class="max-w-xl">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold mb-4">Update password</h2>
            <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1" for="current_password">Current password</label>
                    <input type="password" name="current_password" id="current_password" required class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1" for="password">New password</label>
                    <input type="password" name="password" id="password" required class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1" for="password_confirmation">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2">
                </div>
                <button class="rounded-lg bg-blue-600 text-white px-4 py-2 font-semibold hover:bg-blue-700">Save</button>
            </form>
        </div>
    </div>
</x-admin-layout>

