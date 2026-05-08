@extends('layouts.portfolio')

@section('title', 'Insights & Thoughts – Nelson Vargas')

@section('styles')
<style>
    .insight-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .insight-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -15px rgba(59, 130, 246, 0.25);
    }
    .bg-dots {
        background-image: radial-gradient(rgba(148, 163, 184, 0.1) 1px, transparent 1px);
        background-size: 24px 24px;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection

@section('content')
<div class="relative min-h-screen bg-slate-950 pb-24">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-dots opacity-20"></div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/5 rounded-full filter blur-[120px] -mr-64 -mt-64"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-cyan-600/5 rounded-full filter blur-[120px] -ml-64 -mb-64"></div>

    <div class="container mx-auto px-4 pt-24 relative z-10">
        <!-- Header -->
        <div class="max-w-4xl mx-auto text-center mb-20 animate-fadeIn">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-500/10 border border-blue-500/20 rounded-full mb-6">
                <span class="text-blue-400 text-[10px] font-black uppercase tracking-widest">Knowledge Base</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-white mb-8 tracking-tight">
                Insights & <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Expertise</span>
            </h1>
            <p class="text-slate-400 text-xl leading-relaxed max-w-2xl mx-auto">
                Sharing my thoughts on software architecture, design principles, and the evolving landscape of web technology.
            </p>
        </div>

        <!-- Filter/Categories (Optional for now) -->
        <div class="flex flex-wrap justify-center gap-4 mb-16 animate-fadeIn" style="animation-delay: 0.1s">
            <button class="px-6 py-2 rounded-full bg-blue-600 text-white text-xs font-bold uppercase tracking-widest transition-all">All Posts</button>
            <button class="px-6 py-2 rounded-full bg-slate-900 border border-slate-800 text-slate-400 hover:text-white hover:border-slate-700 text-xs font-bold uppercase tracking-widest transition-all">Architecture</button>
            <button class="px-6 py-2 rounded-full bg-slate-900 border border-slate-800 text-slate-400 hover:text-white hover:border-slate-700 text-xs font-bold uppercase tracking-widest transition-all">Design</button>
            <button class="px-6 py-2 rounded-full bg-slate-900 border border-slate-800 text-slate-400 hover:text-white hover:border-slate-700 text-xs font-bold uppercase tracking-widest transition-all">Performance</button>
        </div>

        <!-- Insights Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-24">
            @forelse($insights as $index => $insight)
            <article class="insight-card group flex flex-col bg-slate-900/50 border border-slate-800 rounded-3xl overflow-hidden backdrop-blur-sm animate-fadeIn" style="animation-delay: {{ 0.2 + ($index * 0.1) }}s">
                <!-- Image Container -->
                <div class="relative aspect-video overflow-hidden">
                    <img src="{{ $insight->image }}" alt="{{ $insight->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-blue-600/90 text-white text-[10px] font-black uppercase tracking-widest rounded-lg backdrop-blur-md">
                            {{ $insight->category }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8 flex flex-col flex-grow">
                    <div class="flex items-center gap-4 mb-4 text-[10px] font-black uppercase tracking-widest text-slate-500">
                        <span>{{ \Carbon\Carbon::parse($insight->date)->format('M d, Y') }}</span>
                        <span class="w-1 h-1 bg-slate-700 rounded-full"></span>
                        <span>{{ $insight->reading_time }}</span>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-white mb-4 leading-tight group-hover:text-blue-400 transition-colors line-clamp-2">
                        <a href="{{ route('insights.show', $insight->id) }}">
                            {{ $insight->title }}
                        </a>
                    </h3>
                    
                    <p class="text-slate-400 text-sm leading-relaxed mb-8 line-clamp-3">
                        {{ $insight->excerpt }}
                    </p>

                    <div class="mt-auto flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ $profile->profile_image }}" alt="{{ $profile->name }}" class="w-8 h-8 rounded-full border border-slate-700">
                            <span class="text-xs font-bold text-slate-300">{{ $profile->name }}</span>
                        </div>
                        
                        <a href="{{ route('insights.show', $insight->id) }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 text-xs font-black uppercase tracking-widest transition-colors group/link">
                            Read More
                            <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-24 bg-slate-900/30 rounded-3xl border border-dashed border-slate-800">
                <p class="text-slate-500 italic">I am currently drafting new insights. Check back soon!</p>
            </div>
            @endforelse
        </div>

        <!-- CTA Section -->
        <div class="max-w-4xl mx-auto animate-fadeIn" style="animation-delay: 0.6s">
            <div class="bg-gradient-to-br from-blue-600/10 to-cyan-600/5 border border-blue-500/20 rounded-[40px] p-12 relative overflow-hidden text-center">
                <div class="absolute top-0 right-0 -mt-12 -mr-12 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
                
                <h2 class="text-3xl md:text-4xl font-black text-white mb-6">Need expert guidance for your next project?</h2>
                <p class="text-slate-400 text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
                    I help businesses build scalable, performant, and user-centric web applications. Let's discuss how we can work together.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                    <a href="{{ route('portfolio.index') }}#contact" class="px-10 py-4 bg-blue-600 hover:bg-blue-500 text-white font-black uppercase tracking-widest text-sm rounded-2xl transition-all shadow-lg shadow-blue-600/20">
                        Start a Conversation
                    </a>
                    <a href="{{ route('consultant') }}" class="px-10 py-4 bg-slate-900 border border-slate-800 hover:border-slate-700 text-white font-black uppercase tracking-widest text-sm rounded-2xl transition-all">
                        Consultancy Services
                    </a>
                </div>
            </div>
        </div>
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
