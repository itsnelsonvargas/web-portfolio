@extends('layouts.portfolio')

@section('title', $insight->title . ' – Insights')

@section('styles')
<style>
    .bg-dots {
        background-image: radial-gradient(rgba(148, 163, 184, 0.1) 1px, transparent 1px);
        background-size: 24px 24px;
    }
    .prose-custom {
        color: #94a3b8;
        line-height: 1.8;
    }
    .prose-custom h2, .prose-custom h3 {
        color: white;
        font-weight: 800;
        margin-top: 2.5rem;
        margin-bottom: 1.25rem;
        letter-spacing: -0.025em;
    }
    .prose-custom h2 { font-size: 1.875rem; }
    .prose-custom h3 { font-size: 1.5rem; }
    .prose-custom p { margin-bottom: 1.5rem; }
</style>
@endsection

@section('content')
<div class="relative min-h-screen bg-slate-950 pb-24">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-dots opacity-20"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[600px] bg-gradient-to-b from-blue-600/10 to-transparent"></div>

    <div class="container mx-auto px-4 pt-16 relative z-10">
        <!-- Back Link -->
        <div class="mb-12 animate-fadeIn">
            <a href="{{ route('insights.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-blue-400 transition-colors group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-bold uppercase tracking-widest text-xs">Back to Insights</span>
            </a>
        </div>

        <article class="max-w-4xl mx-auto">
            <!-- Header -->
            <header class="mb-16 animate-fadeIn">
                <div class="flex items-center gap-4 mb-6 text-xs font-black uppercase tracking-widest text-blue-400">
                    <span>{{ $insight->category }}</span>
                    <span class="w-1.5 h-1.5 bg-slate-800 rounded-full"></span>
                    <span class="text-slate-500">{{ \Carbon\Carbon::parse($insight->date)->format('F d, Y') }}</span>
                    <span class="w-1.5 h-1.5 bg-slate-800 rounded-full"></span>
                    <span class="text-slate-500">{{ $insight->reading_time }}</span>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-black text-white mb-8 tracking-tight leading-[1.1]">
                    {{ $insight->title }}
                </h1>

                <div class="flex items-center gap-4 py-6 border-y border-slate-900">
                    <img src="{{ $profile->profile_image }}" alt="{{ $profile->name }}" class="w-12 h-12 rounded-full border-2 border-blue-500/20">
                    <div>
                        <span class="block text-white font-bold text-sm">{{ $profile->name }}</span>
                        <span class="block text-slate-500 text-xs font-bold uppercase tracking-widest">Author & Developer</span>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            <div class="mb-16 rounded-[40px] overflow-hidden border border-slate-800 animate-fadeIn" style="animation-delay: 0.1s">
                <img src="{{ $insight->image }}" alt="{{ $insight->title }}" class="w-full h-auto aspect-video object-cover">
            </div>

            <!-- Content -->
            <div class="prose-custom text-lg animate-fadeIn" style="animation-delay: 0.2s">
                <p class="text-xl text-slate-300 font-medium mb-12 italic leading-relaxed">
                    {{ $insight->excerpt }}
                </p>

                <div class="whitespace-pre-wrap">
                    {{ $insight->content }}
                </div>
                
                <p class="mt-12 text-slate-500">
                    [More content is being written for this specific insight. Stay tuned for the full technical breakdown.]
                </p>
            </div>

            <!-- Footer / Sharing -->
            <footer class="mt-20 pt-12 border-t border-slate-900 animate-fadeIn" style="animation-delay: 0.3s">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex items-center gap-6">
                        <span class="text-xs font-black uppercase tracking-widest text-slate-500">Share Insight</span>
                        <div class="flex gap-4">
                            <!-- Placeholder social icons -->
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-blue-400 hover:border-blue-500/30 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-blue-400 hover:border-blue-500/30 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </article>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Reveal animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fadeIn');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate-fadeIn').forEach(el => observer.observe(el));
</script>
@endsection
