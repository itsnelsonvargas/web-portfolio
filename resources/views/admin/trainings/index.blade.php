@php($title = 'Trainings & Certificates')
<x-admin-layout :title="$title">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-xl font-semibold">Trainings</h2>
            <p class="text-sm text-slate-500">Manage certifications, seminars, webinars.</p>
        </div>
        <a href="{{ route('admin.trainings.create') }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700">Add training</a>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-left">
                <tr>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Organization</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Files</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trainings as $training)
                    <tr class="border-t border-slate-100 dark:border-slate-800">
                        <td class="px-4 py-3 font-semibold">{{ $training->title }}</td>
                        <td class="px-4 py-3">{{ $training->organization }}</td>
                        <td class="px-4 py-3">{{ optional($training->acquired_at)->format('M d, Y') }}</td>
                        <td class="px-4 py-3">{{ $training->uploads()->count() }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.trainings.edit', $training) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('admin.trainings.destroy', $training) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this training?')" class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-slate-500">No trainings yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $trainings->links() }}
    </div>
</x-admin-layout>

