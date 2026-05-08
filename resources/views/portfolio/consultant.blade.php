@extends('layouts.portfolio')

@section('title', 'Expert Consultancy Services – ' . $profile->name)

@section('styles')
<style>
    .service-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px -15px rgba(59, 130, 246, 0.2);
    }
    .bg-grid-fade {
        background-image: linear-gradient(to bottom, rgba(15, 23, 42, 0) 0%, rgba(15, 23, 42, 1) 100%), 
                          linear-gradient(to right, rgba(148, 163, 184, 0.05) 1px, transparent 1px),
                          linear-gradient(to bottom, rgba(148, 163, 184, 0.05) 1px, transparent 1px);
        background-size: 100% 100%, 40px 40px, 40px 40px;
    }
</style>
@endsection

@section('content')
<div class="relative min-h-screen bg-slate-950">
    <!-- Hero Section -->
    <div class="relative pt-20 pb-32 overflow-hidden bg-grid-fade">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-600/5 blur-3xl rounded-full"></div>
        <div class="absolute bottom-0 left-0 w-1/3 h-full bg-purple-600/5 blur-3xl rounded-full"></div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/10 border border-blue-500/20 rounded-full mb-8 animate-fadeIn">
                <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                <span class="text-blue-400 text-xs font-bold uppercase tracking-widest">Professional Advisory</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-white mb-8 tracking-tight animate-fadeIn" style="animation-delay: 0.1s">
                Technical <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">Consultancy</span>
            </h1>
            <p class="text-slate-400 text-xl max-w-2xl mx-auto leading-relaxed animate-fadeIn" style="animation-delay: 0.2s">
                Empowering your business with strategic technical insights, architectural guidance, and performance-driven solutions.
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-20 relative z-20 pb-24">
        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
            <!-- Service 1 -->
            <div class="service-card group bg-slate-900/80 backdrop-blur-md border border-slate-800 rounded-3xl p-10 hover:border-blue-500/50 transition-all animate-fadeIn" style="animation-delay: 0.3s">
                <div class="w-16 h-16 bg-blue-600/10 rounded-2xl border border-blue-500/20 flex items-center justify-center mb-8 group-hover:bg-blue-600 transition-colors duration-500">
                    <svg class="w-8 h-8 text-blue-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Software Architecture</h3>
                <p class="text-slate-400 leading-relaxed">Designing scalable, resilient, and maintainable systems tailored to your specific business needs and growth projections.</p>
            </div>

            <!-- Service 2 -->
            <div class="service-card group bg-slate-900/80 backdrop-blur-md border border-slate-800 rounded-3xl p-10 hover:border-blue-500/50 transition-all animate-fadeIn" style="animation-delay: 0.4s">
                <div class="w-16 h-16 bg-cyan-600/10 rounded-2xl border border-cyan-500/20 flex items-center justify-center mb-8 group-hover:bg-cyan-600 transition-colors duration-500">
                    <svg class="w-8 h-8 text-cyan-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Performance Audit</h3>
                <p class="text-slate-400 leading-relaxed">Comprehensive analysis of your web applications to identify bottlenecks, optimize speed, and improve overall user experience.</p>
            </div>

            <!-- Service 3 -->
            <div class="service-card group bg-slate-900/80 backdrop-blur-md border border-slate-800 rounded-3xl p-10 hover:border-blue-500/50 transition-all animate-fadeIn" style="animation-delay: 0.5s">
                <div class="w-16 h-16 bg-purple-600/10 rounded-2xl border border-purple-500/20 flex items-center justify-center mb-8 group-hover:bg-purple-600 transition-colors duration-500">
                    <svg class="w-8 h-8 text-purple-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Tech Stack Advisory</h3>
                <p class="text-slate-400 leading-relaxed">Choosing the right tools for the job. We evaluate modern technologies to ensure your team remains productive and competitive.</p>
            </div>
        </div>

        <!-- Detailed Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-24">
            <div class="animate-fadeIn" style="animation-delay: 0.6s">
                <h2 class="text-4xl font-black text-white mb-8 tracking-tight">Why Choose My <span class="text-blue-500">Consultancy?</span></h2>
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-6 h-6 mt-1 bg-blue-500/20 rounded-full flex items-center justify-center">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        </div>
                        <div>
                            <h4 class="text-white font-bold mb-2">Years of Experience</h4>
                            <p class="text-slate-400 text-sm">Drawing from years of building high-performance applications for diverse industries.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-6 h-6 mt-1 bg-blue-500/20 rounded-full flex items-center justify-center">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        </div>
                        <div>
                            <h4 class="text-white font-bold mb-2">Business-First Approach</h4>
                            <p class="text-slate-400 text-sm">Technology is a tool. My focus is on how it can solve your unique business challenges and drive ROI.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-6 h-6 mt-1 bg-blue-500/20 rounded-full flex items-center justify-center">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        </div>
                        <div>
                            <h4 class="text-white font-bold mb-2">End-to-End Partnership</h4>
                            <p class="text-slate-400 text-sm">From initial ideation to deployment and scaling, I provide consistent support throughout the journey.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative animate-fadeIn" style="animation-delay: 0.7s">
                <div class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-3xl opacity-20 blur-2xl"></div>
                <div class="relative bg-slate-900 border border-slate-800 rounded-3xl p-12 overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-10">
                        <svg class="w-32 h-32 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21L14.017 18C14.017 16.8954 13.1216 16 12.017 16C10.9124 16 10.017 16.8954 10.017 18L10.017 21H4.017V11C4.017 9.89543 4.91243 9 6.017 9H18.017C19.1216 9 20.017 9.89543 20.017 11V21H14.017Z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-black text-white mb-6">Ready to scale your technical vision?</h3>
                    <p class="text-slate-400 mb-8 leading-relaxed">Let's discuss your project goals and how I can help you achieve them with precision and expertise.</p>
                    <a href="{{ route('portfolio.index') }}#contact" class="inline-flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-bold transition-all transform hover:scale-105">
                        Book a Consultation
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
