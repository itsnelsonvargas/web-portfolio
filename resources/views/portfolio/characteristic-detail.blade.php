@extends('layouts.portfolio')

@section('title', $characteristic->characteristic . ' – Proof of Professionalism')

@section('styles')
<style>
    .proof-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .proof-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px -10px rgba(59, 130, 246, 0.3);
    }
    .bg-dots {
        background-image: radial-gradient(rgba(148, 163, 184, 0.1) 1px, transparent 1px);
        background-size: 24px 24px;
    }
    .glow-text {
        text-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
    }
</style>
@endsection

@section('content')
<div class="relative min-h-screen bg-slate-950 pb-24">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-dots opacity-20"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-96 bg-gradient-to-b from-blue-600/10 to-transparent"></div>
    <div class="absolute top-40 right-10 w-64 h-64 bg-blue-500/5 rounded-full filter blur-3xl animate-pulse"></div>

    <div class="container mx-auto px-4 pt-16 relative z-10">
        <!-- Breadcrumb & Back -->
        <div class="mb-12 animate-fadeIn">
            <a href="{{ route('characteristic.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-blue-400 transition-colors group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-bold uppercase tracking-widest text-xs">Back to Characteristics</span>
            </a>
        </div>

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row items-center gap-12 mb-20">
            <div class="w-32 h-32 md:w-48 md:h-48 flex items-center justify-center bg-blue-600/10 rounded-3xl border-2 border-blue-500/20 shadow-2xl shadow-blue-500/10 animate-fadeIn">
                @if(filter_var($characteristic->icon, FILTER_VALIDATE_URL) || str_starts_with($characteristic->icon, 'data:image'))
                    <img src="{{ $characteristic->icon }}" alt="{{ $characteristic->characteristic }}" class="w-20 h-20 md:w-32 md:h-32 object-contain">
                @else
                    <span class="text-7xl md:text-8xl leading-none">{{ $characteristic->icon }}</span>
                @endif
            </div>
            <div class="text-center md:text-left animate-fadeIn" style="animation-delay: 0.1s">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-500/10 border border-blue-500/20 rounded-full mb-4">
                    <span class="text-blue-400 text-[10px] font-black uppercase tracking-widest">Evidence of Trait</span>
                </div>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white mb-6 tracking-tight glow-text">
                    {{ $characteristic->characteristic }}
                </h1>
                <p class="text-slate-300 text-xl max-w-2xl leading-relaxed font-light">
                    {{ $characteristic->description }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Column: Key Highlights & Examples -->
            <div class="lg:col-span-1 space-y-8 animate-fadeIn" style="animation-delay: 0.2s">
                <div class="bg-slate-900/50 border border-slate-800 rounded-3xl p-8 backdrop-blur-sm">
                    <h3 class="text-sm font-black text-blue-400 uppercase tracking-widest mb-6">Key Observations</h3>
                    <ul class="space-y-4">
                        @foreach($characteristic->examples as $example)
                        <li class="flex items-start gap-3">
                            <div class="mt-1.5 w-1.5 h-1.5 bg-blue-500 rounded-full flex-shrink-0"></div>
                            <p class="text-slate-300 text-sm leading-relaxed">{{ $example }}</p>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-gradient-to-br from-blue-600/10 to-transparent border border-blue-500/20 rounded-3xl p-8">
                    <h3 class="text-sm font-black text-blue-400 uppercase tracking-widest mb-4">Why it matters</h3>
                    <p class="text-slate-300 text-sm leading-relaxed italic">
                        "In a professional environment, being {{ strtolower($characteristic->characteristic) }} means more than just a personality trait—it's a commitment to excellence and reliability that directly impacts project success."
                    </p>
                </div>
            </div>

            <!-- Right Column: Concrete Proofs -->
            <div class="lg:col-span-2 space-y-8 animate-fadeIn" style="animation-delay: 0.3s">
                <h2 class="text-2xl font-black text-white tracking-tight flex items-center gap-3">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    The Proof of Action
                </h2>

                <div class="grid grid-cols-1 gap-6">
                    @forelse($characteristic->proofs as $proof)
                    <div class="proof-card bg-slate-900/80 border border-slate-800 rounded-3xl p-8 hover:border-blue-500/50 transition-all">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                            <h4 class="text-xl font-bold text-white tracking-tight">{{ $proof->title }}</h4>
                            <span class="px-3 py-1 bg-slate-800 text-slate-400 rounded-full text-[10px] font-black uppercase tracking-widest border border-slate-700">
                                {{ $proof->type }}
                            </span>
                        </div>
                        <p class="text-slate-300 leading-relaxed text-lg {{ isset($proof->file_url) ? 'mb-8' : '' }}">
                            {{ $proof->content }}
                        </p>

                        @if(isset($proof->file_url))
                        <div class="mt-6">
                            @if(isset($proof->file_type) && $proof->file_type === 'image')
                                <div class="relative group/img overflow-hidden rounded-2xl border border-slate-800">
                                    <img src="{{ str_starts_with($proof->file_url, 'http') ? $proof->file_url : asset($proof->file_url) }}" 
                                         alt="{{ $proof->title }}" 
                                         class="w-full h-auto max-h-[400px] object-cover transition-transform duration-500 group-hover/img:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent opacity-0 group-hover/img:opacity-100 transition-opacity flex items-end p-6">
                                        <a href="{{ str_starts_with($proof->file_url, 'http') ? $proof->file_url : asset($proof->file_url) }}" 
                                           target="_blank" 
                                           class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-white hover:text-blue-600 transition-all">
                                            View Full Image
                                        </a>
                                    </div>
                                </div>
                            @else
                                <a href="{{ str_starts_with($proof->file_url, 'http') ? $proof->file_url : asset($proof->file_url) }}" 
                                   target="_blank" 
                                   class="inline-flex items-center gap-3 bg-slate-800 hover:bg-blue-600 text-white px-6 py-4 rounded-2xl border border-slate-700 hover:border-blue-500 transition-all group/btn">
                                    <div class="p-2 bg-slate-900 rounded-lg group-hover/btn:bg-blue-500 transition-colors">
                                        @if(isset($proof->file_type) && $proof->file_type === 'pdf')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        @endif
                                    </div>
                                    <span class="font-bold text-sm uppercase tracking-widest">
                                        @if(isset($proof->file_type) && $proof->file_type === 'pdf')
                                            View PDF Document
                                        @else
                                            View Reference Material
                                        @endif
                                    </span>
                                </a>
                            @endif
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="text-center py-12 bg-slate-900/30 rounded-3xl border border-dashed border-slate-800">
                        <p class="text-slate-500 italic">Extended proof materials are being compiled for this characteristic.</p>
                    </div>
                    @endforelse
                </div>
                
                <!-- CTA -->
                <div class="pt-12">
                    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-3xl p-10 text-center">
                        <h3 class="text-2xl font-black text-white mb-4">Interested in seeing more?</h3>
                        <p class="text-blue-100 mb-8 max-w-lg mx-auto">I'd be happy to discuss how my {{ strtolower($characteristic->characteristic) }} nature can add value to your team.</p>
                        <a href="{{ route('portfolio.index') }}#contact" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-xl font-black uppercase tracking-widest text-sm hover:bg-slate-100 transition-colors">
                            Let's Talk
                        </a>
                    </div>
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