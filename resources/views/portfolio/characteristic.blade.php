@extends('layouts.portfolio')

@section('title', 'Professional Characteristics – ' . $profile->name)

@section('styles')
<style>
    .characteristic-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .characteristic-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px -15px rgba(59, 130, 246, 0.2);
    }
    .bg-dots {
        background-image: radial-gradient(rgba(148, 163, 184, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
    }
</style>
@endsection

@section('content')
<div class="relative min-h-screen bg-slate-950">
    <!-- Background Accents -->
    <div class="absolute inset-0 bg-dots opacity-20"></div>
    <div class="absolute top-0 right-0 w-1/2 h-1/2 bg-blue-600/5 rounded-full filter blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-purple-600/5 rounded-full filter blur-3xl"></div>

    <div class="container mx-auto px-4 py-20 relative z-10">
        <!-- Header Section -->
        <div class="text-center mb-24 animate-fadeIn">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/10 border border-blue-500/20 rounded-full mb-6">
                <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                <span class="text-blue-400 text-xs font-bold uppercase tracking-widest">Professional Identity</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-white mb-8 tracking-tight">
                Key <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">Characteristics</span>
            </h1>
            <p class="text-slate-400 text-xl max-w-2xl mx-auto leading-relaxed">
                A deeper look into the core values and professional traits that drive my work and ensure high-quality results for employers and clients.
            </p>
        </div>

        <!-- Characteristics Detailed Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-24">
            @foreach($characteristics as $characteristic)
            <a href="{{ route('characteristic.show', $characteristic->id) }}" class="characteristic-card group bg-slate-900/50 backdrop-blur-sm border border-slate-800 rounded-3xl p-8 md:p-10 hover:border-blue-500/50 transition-all duration-300">
                <div class="flex flex-col h-full">
                    <!-- Icon & Title -->
                    <div class="flex items-start gap-6 mb-8">
                        <div class="w-16 h-16 flex items-center justify-center bg-blue-600/10 rounded-2xl border border-blue-500/20 group-hover:bg-blue-600 group-hover:scale-110 transition-all duration-500">
                            @if(filter_var($characteristic->icon, FILTER_VALIDATE_URL) || str_starts_with($characteristic->icon, 'data:image'))
                                <img src="{{ $characteristic->icon }}" alt="{{ $characteristic->characteristic }}" class="w-10 h-10 object-contain brightness-0 invert group-hover:brightness-100 group-hover:invert-0 transition-all">
                            @else
                                <span class="text-4xl leading-none group-hover:scale-110 transition-transform duration-500">{{ $characteristic->icon }}</span>
                            @endif
                        </div>
                        <div>
                            <h2 class="text-2xl md:text-3xl font-black text-white mb-2 tracking-tight group-hover:text-blue-400 transition-colors">
                                {{ $characteristic->characteristic }}
                            </h2>
                            <div class="h-1 w-12 bg-blue-600 rounded-full group-hover:w-24 transition-all duration-500"></div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="flex-grow">
                        <p class="text-slate-300 text-lg leading-relaxed mb-8">
                            {{ $characteristic->description }}
                        </p>
                    </div>

                    <!-- Proof/Value Section -->
                    <div class="pt-8 border-t border-slate-800/50 mt-auto flex items-center justify-between">
                        <div class="flex items-center gap-2 text-blue-400 font-black text-xs uppercase tracking-widest group-hover:translate-x-2 transition-transform">
                            <span>View Proof</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Call to Action -->
        <div class="text-center bg-gradient-to-br from-blue-600 to-cyan-600 rounded-3xl p-12 md:p-20 shadow-2xl shadow-blue-600/20 animate-fadeIn">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tight">Ready to work together?</h2>
            <p class="text-blue-100 text-lg mb-10 max-w-xl mx-auto">
                If these characteristics align with what you're looking for in a professional, I'd love to hear from you.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('portfolio.index') }}#contact" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-slate-100 transition-colors shadow-lg">
                    Get In Touch
                </a>
                <a href="{{ $profile->resume_url ?? '#' }}" target="_blank" class="bg-blue-700/50 text-white border border-blue-400/30 px-8 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-blue-700 transition-colors backdrop-blur-sm">
                    View Resume
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Reveal animation on scroll
    const cards = document.querySelectorAll('.characteristic-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fadeIn');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(card => {
        card.classList.add('opacity-0');
        observer.observe(card);
    });
</script>
@endsection