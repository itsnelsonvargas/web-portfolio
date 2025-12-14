@php($title = 'Trainings & Certificates')
<x-admin-layout :title="$title">
    <div class="space-y-6">
        <!-- File-Based Storage Notice -->
        <div class="bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-lg">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <strong>File-Based Storage</strong>
            </div>
            <p class="text-sm mt-1">Training creation/editing is disabled. To modify trainings, edit the <code>data/trainings.json</code> file directly. See <code>FILE_EDITING_GUIDE.md</code> for instructions.</p>
        </div>

        <!-- Header with Search (no Add Button) -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Trainings & Certificates</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">View all your certifications, seminars, and webinars</p>
            </div>
        </div>

        <!-- Search and Filter Bar -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-4">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.trainings.index') }}" class="flex-1 flex flex-col sm:flex-row gap-4">
                    <div class="flex-1 relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search by title, organization, credential ID, or tags..."
                            class="w-full pl-10 pr-4 py-2 border border-slate-300 dark:border-slate-700 rounded-lg bg-white dark:bg-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.trainings.index') }}" class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-lg hover:bg-slate-300 dark:hover:bg-slate-600 font-medium">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Hide/Show Toggle -->
                <div class="flex items-center gap-3">
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Show:</span>
                    <div class="flex bg-slate-100 dark:bg-slate-800 rounded-lg p-1">
                        <a href="{{ route('admin.trainings.index', array_merge(request()->all(), ['hide_completed' => null])) }}"
                           class="px-3 py-1.5 text-xs font-medium rounded-md transition-colors {{ !request('hide_completed') ? 'bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100' }}">
                            All
                        </a>
                        <a href="{{ route('admin.trainings.index', array_merge(request()->all(), ['hide_completed' => '1'])) }}"
                           class="px-3 py-1.5 text-xs font-medium rounded-md transition-colors {{ request('hide_completed') ? 'bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100' }}">
                            Active Only
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- User-Friendly Table -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800/50 dark:to-slate-800/70 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <!-- Title & Status Column -->
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider w-80">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    Training & Status
                                </div>
                            </th>

                            <!-- Organization Column -->
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider w-48">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Organization
                                </div>
                            </th>

                            <!-- Duration Column -->
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider w-40">
                                <a href="{{ route('admin.trainings.index', array_merge(request()->all(), ['sort_by' => 'started_at', 'sort_dir' => request('sort_by') == 'started_at' && request('sort_dir') == 'desc' ? 'asc' : 'desc'])) }}" class="flex items-center gap-2 hover:text-blue-600 transition-colors">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Duration
                                    @if(request('sort_by') == 'started_at')
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ request('sort_dir') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                        </svg>
                                    @endif
                                </a>
                            </th>

                            <!-- Details Column -->
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider w-64">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Details & Files
                                </div>
                            </th>

                            <!-- Actions Column -->
                            <th class="px-6 py-4 text-right text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider w-32">
                                <div class="flex items-center justify-end gap-2">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Actions
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @if($trainings->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="text-slate-500">No trainings found in the database.</div>
                                </td>
                            </tr>
                        @else
                        @foreach ($trainings as $training)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-all duration-200 group">
                                <!-- Title & Status -->
                                <td class="px-6 py-5">
                                    <div class="flex items-start gap-3">
                                        <!-- Status Badge -->
                                        <div class="flex-shrink-0 mt-1">
                                            @if($training->ended_at)
                                                <div class="w-3 h-3 bg-green-500 rounded-full shadow-sm" title="Completed"></div>
                                            @elseif($training->started_at)
                                                <div class="w-3 h-3 bg-blue-500 rounded-full shadow-sm animate-pulse" title="In Progress"></div>
                                            @else
                                                <div class="w-3 h-3 bg-slate-400 rounded-full shadow-sm" title="Not Started"></div>
                                            @endif
                                        </div>

                                        <!-- Title & Description -->
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <h3 class="font-semibold text-slate-900 dark:text-slate-100 text-sm leading-tight">{{ $training->title }}</h3>
                                                @if($training->ended_at && $training->started_at)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                                        {{ \Carbon\Carbon::parse($training->started_at)->diffInDays(\Carbon\Carbon::parse($training->ended_at)) }} days
                                                    </span>
                                                @elseif($training->started_at && !$training->ended_at)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                                        Ongoing
                                                    </span>
                                                @endif
                                            </div>
                                            @if($training->description)
                                                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-2">{{ \Illuminate\Support\Str::limit($training->description, 80) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Organization -->
                                <td class="px-6 py-5">
                                    <p class="font-medium text-slate-900 dark:text-slate-100 text-sm">{{ $training->organization ?? '—' }}</p>
                                </td>

                                <!-- Duration -->
                                <td class="px-6 py-5">
                                    <div class="text-sm">
                                        @if($training->started_at && $training->ended_at)
                                            <div class="space-y-1">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-green-600 dark:text-green-400 font-medium">{{ \Carbon\Carbon::parse($training->started_at)->format('M j, Y') }}</span>
                                                    <span class="text-slate-400">→</span>
                                                    <span class="text-slate-600 dark:text-slate-400">{{ \Carbon\Carbon::parse($training->ended_at)->format('M j, Y') }}</span>
                                                </div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                                    {{ \Carbon\Carbon::parse($training->started_at)->diffInDays(\Carbon\Carbon::parse($training->ended_at)) }} days
                                                </div>
                                            </div>
                                        @elseif($training->started_at && !$training->ended_at)
                                            <div class="space-y-1">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-blue-600 dark:text-blue-400 font-medium">{{ \Carbon\Carbon::parse($training->started_at)->format('M j, Y') }}</span>
                                                    <span class="text-slate-400">→</span>
                                                    <span class="text-blue-600 dark:text-blue-400 animate-pulse">Ongoing</span>
                                                </div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                                    {{ \Carbon\Carbon::parse($training->started_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-slate-400 dark:text-slate-500 italic">Not scheduled</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Details & Files -->
                                <td class="px-6 py-5">
                                    <div class="space-y-2">
                                        <!-- Credential ID -->
                                        @if($training->credential_id)
                                            <div class="flex items-center gap-2">
                                                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <code class="text-xs bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded font-mono text-slate-700 dark:text-slate-300">{{ $training->credential_id }}</code>
                                            </div>
                                        @endif

                                        <!-- Tags -->
                                        @if($training->tags)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach(explode(',', $training->tags) as $tag)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                                        #{{ trim($tag) }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <!-- Files & Link -->
                                        <div class="flex items-center gap-3 pt-1">
                                            @if($training->uploads_count > 0)
                                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-300 text-xs font-medium">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    {{ $training->uploads_count }} file{{ $training->uploads_count !== 1 ? 's' : '' }}
                                                </span>
                                            @endif

                                            @if($training->link)
                                                <a href="{{ $training->link }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-slate-50 text-slate-600 hover:bg-slate-100 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 text-xs font-medium transition-colors">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                    </svg>
                                                    View
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-end">
                                        <span class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-slate-400 dark:text-slate-500 bg-slate-100 dark:bg-slate-800 rounded-md cursor-not-allowed">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                            <span class="hidden sm:inline">Read Only</span>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary Footer -->
        <div class="bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800/50 dark:to-slate-800/70 border border-slate-200 dark:border-slate-700 rounded-xl px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-200">
                            {{ $trainings->count() }} training{{ $trainings->count() !== 1 ? 's' : '' }}
                        </span>
                    </div>

                    @if($trainings->count() > 0)
                        <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                            @if(!request('hide_completed'))
                                <div class="flex items-center gap-1">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span>{{ $trainings->whereNotNull('ended_at')->count() }} completed</span>
                                </div>
                            @endif
                            <div class="flex items-center gap-1">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span>{{ $trainings->whereNotNull('started_at')->whereNull('ended_at')->count() }} active</span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="text-xs text-slate-500 dark:text-slate-400">
                    @if(request('search') && request('hide_completed'))
                        <span class="font-medium text-blue-600 dark:text-blue-400">Active trainings matching search</span>
                    @elseif(request('search'))
                        <span class="font-medium text-blue-600 dark:text-blue-400">Search results</span>
                    @elseif(request('hide_completed'))
                        <span class="font-medium text-blue-600 dark:text-blue-400">Active trainings only</span>
                    @else
                        <span>All trainings</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

