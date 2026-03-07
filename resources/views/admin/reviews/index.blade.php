@php($title = 'Portfolio Feedback')
<x-admin-layout :title="$title">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-slate-900 dark:text-white">User Suggestions</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">Manage feedback submitted through the /portfolio-feedback page.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6">
            @forelse ($reviews as $review)
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <!-- Rating Badge -->
                    @if(isset($review['rating']))
                        <div class="absolute top-6 right-6 flex gap-1">
                            @foreach(range(1, 5) as $i)
                                <svg class="w-5 h-5 {{ $i <= $review['rating'] ? 'text-yellow-400 fill-current' : 'text-slate-300 dark:text-slate-700' }}" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endforeach
                        </div>
                    @endif

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                            {{ substr($review['name'] ?? 'U', 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="mb-1">
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white truncate pr-24">{{ $review['name'] }}</h3>
                                <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">{{ $review['email'] }}</p>
                            </div>
                            
                            <p class="text-slate-600 dark:text-slate-300 mt-4 leading-relaxed whitespace-pre-wrap">{{ $review['suggestion'] }}</p>
                            
                            <div class="mt-6 flex items-center justify-between text-xs text-slate-400 dark:text-slate-500">
                                <div class="flex items-center gap-4">
                                    <span>Submitted: {{ \Carbon\Carbon::parse($review['submitted_at'])->diffForHumans() }}</span>
                                    <span>IP: {{ $review['ip_address'] ?? 'N/A' }}</span>
                                </div>
                                
                                <form action="{{ route('admin.reviews.destroy', $review['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-600 font-bold uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white dark:bg-slate-900 border border-dashed border-slate-300 dark:border-slate-700 rounded-3xl">
                    <div class="w-20 h-20 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">No feedback yet</h3>
                    <p class="text-slate-500">When people submit suggestions on the /review page, they will appear here.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-admin-layout>
