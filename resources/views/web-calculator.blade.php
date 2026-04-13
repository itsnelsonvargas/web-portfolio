<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Calculator</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-grid-pattern {
            background-image:
                linear-gradient(to right, rgba(148, 163, 184, 0.12) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(148, 163, 184, 0.12) 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-300 antialiased overflow-x-hidden">
    <div class="absolute inset-0 bg-grid-pattern opacity-[0.03] pointer-events-none"></div>
    <div class="absolute top-0 right-0 w-[28rem] h-[28rem] bg-blue-600 rounded-full mix-blend-screen filter blur-3xl opacity-10 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[24rem] h-[24rem] bg-cyan-500 rounded-full mix-blend-screen filter blur-3xl opacity-10 pointer-events-none"></div>

    <header class="relative z-10 border-b border-slate-800/80 bg-slate-900/70 backdrop-blur-md">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('portfolio.index') }}" class="text-white font-bold tracking-wide">Nami Portfolio</a>
            <a href="{{ route('portfolio.index') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors">
                Back to Homepage
            </a>
        </div>
    </header>

    <main class="relative z-10">
        <section class="pt-20 pb-12 md:pt-28 md:pb-16">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl text-center mx-auto">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/10 border border-blue-500/30 rounded-lg mb-6">
                        <span class="w-2.5 h-2.5 bg-blue-400 rounded-full"></span>
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-300">Project Estimator</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black text-white leading-tight mb-6">
                        Web Project
                        <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">Calculator</span>
                    </h1>
                    <p class="text-lg md:text-xl text-slate-400 leading-relaxed">
                        Get a quick estimated amount for your next website project by selecting your requirements below.
                    </p>
                </div>
            </div>
        </section>

        <section class="pb-20 md:pb-28">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <article class="bg-gradient-to-br from-slate-800 to-slate-900 border-2 border-slate-700 rounded-2xl p-6 md:p-8">
                            <h2 class="text-2xl font-bold text-white mb-6">Project Details</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="project-type" class="block text-sm font-bold text-slate-300 uppercase mb-2">Project Type</label>
                                    <select id="project-type" class="w-full bg-slate-900 border-2 border-slate-700 text-slate-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:outline-none">
                                        <option>Business Website</option>
                                        <option>E-commerce Website</option>
                                        <option>Web Application</option>
                                        <option>Landing Page</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="pages" class="block text-sm font-bold text-slate-300 uppercase mb-2">Estimated Pages</label>
                                    <input id="pages" type="number" min="1" value="5" class="w-full bg-slate-900 border-2 border-slate-700 text-slate-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:outline-none">
                                </div>
                                <div>
                                    <label for="timeline" class="block text-sm font-bold text-slate-300 uppercase mb-2">Timeline</label>
                                    <select id="timeline" class="w-full bg-slate-900 border-2 border-slate-700 text-slate-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:outline-none">
                                        <option>Standard (4-6 weeks)</option>
                                        <option>Priority (2-3 weeks)</option>
                                        <option>Flexible (6+ weeks)</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="design-level" class="block text-sm font-bold text-slate-300 uppercase mb-2">Design Level</label>
                                    <select id="design-level" class="w-full bg-slate-900 border-2 border-slate-700 text-slate-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:outline-none">
                                        <option>Standard UI</option>
                                        <option>Custom UI</option>
                                        <option>Premium UI/UX</option>
                                    </select>
                                </div>
                            </div>
                        </article>

                        <article class="bg-gradient-to-br from-slate-800 to-slate-900 border-2 border-slate-700 rounded-2xl p-6 md:p-8">
                            <h2 class="text-2xl font-bold text-white mb-6">Features</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-blue-500/70 transition-colors">
                                    <input type="checkbox" class="accent-blue-500">
                                    <span>Contact Form</span>
                                </label>
                                <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-blue-500/70 transition-colors">
                                    <input type="checkbox" class="accent-blue-500">
                                    <span>CMS / Admin Panel</span>
                                </label>
                                <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-blue-500/70 transition-colors">
                                    <input type="checkbox" class="accent-blue-500">
                                    <span>Booking System</span>
                                </label>
                                <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-blue-500/70 transition-colors">
                                    <input type="checkbox" class="accent-blue-500">
                                    <span>Payment Integration</span>
                                </label>
                                <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-blue-500/70 transition-colors">
                                    <input type="checkbox" class="accent-blue-500">
                                    <span>SEO Setup</span>
                                </label>
                                <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-blue-500/70 transition-colors">
                                    <input type="checkbox" class="accent-blue-500">
                                    <span>Content Upload</span>
                                </label>
                            </div>
                        </article>
                    </div>

                    <aside class="lg:col-span-1">
                        <div class="sticky top-6 bg-gradient-to-br from-slate-800 to-slate-900 border-2 border-blue-500/40 rounded-2xl p-6 md:p-8 shadow-2xl shadow-blue-900/20">
                            <p class="text-xs uppercase tracking-wider text-slate-400 font-bold mb-2">Estimated Amount</p>
                            <p class="text-4xl md:text-5xl font-black bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent mb-6">
                                $2,450
                            </p>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between border-b border-slate-700/70 pb-2">
                                    <span class="text-slate-400">Base Project</span>
                                    <span class="text-slate-200">$1,500</span>
                                </div>
                                <div class="flex justify-between border-b border-slate-700/70 pb-2">
                                    <span class="text-slate-400">Pages & Sections</span>
                                    <span class="text-slate-200">$450</span>
                                </div>
                                <div class="flex justify-between border-b border-slate-700/70 pb-2">
                                    <span class="text-slate-400">Features</span>
                                    <span class="text-slate-200">$350</span>
                                </div>
                                <div class="flex justify-between pt-1">
                                    <span class="text-slate-300 font-semibold">Timeline Adjustment</span>
                                    <span class="text-emerald-300 font-semibold">+$150</span>
                                </div>
                            </div>

                            <button type="button" class="w-full mt-8 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold py-3.5 rounded-lg transition-all duration-200">
                                Request Full Quotation
                            </button>
                            <p class="text-xs text-slate-500 mt-4 leading-relaxed">
                                This is a sample estimate. Final pricing depends on detailed requirements and project scope.
                            </p>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <section class="pb-20 md:pb-28">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto bg-gradient-to-br from-slate-800 to-slate-900 border-2 border-slate-700 rounded-2xl p-6 md:p-8">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl md:text-3xl font-black text-white mb-3">Compare With Trusted Calculators</h2>
                        <p class="text-slate-400 max-w-3xl mx-auto">
                            For transparency, you can compare our estimate with established platforms and agencies. In most similar scopes, these providers show higher market ranges.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="https://www.webfx.com/web-design/website-design-cost-calculator.html" target="_blank" rel="noopener noreferrer" class="group rounded-xl border border-slate-700 bg-slate-900/70 hover:border-blue-500/70 p-5 transition-all">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-white font-bold text-lg">WebFX Calculator</p>
                                <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-300 bg-slate-800 border border-slate-700 px-2.5 py-1 rounded-md">
                                    <span aria-hidden="true">🇺🇸</span>
                                    USA
                                </span>
                            </div>
                            <p class="text-slate-400 text-sm mt-2">Agency pricing calculator with enterprise-level service ranges.</p>
                            <span class="inline-flex items-center gap-2 mt-4 text-blue-400 group-hover:text-blue-300 font-semibold text-sm">
                                Open Website
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </span>
                        </a>

                        <a href="https://www.upwork.com/tools/website-design-cost-calculator" target="_blank" rel="noopener noreferrer" class="group rounded-xl border border-slate-700 bg-slate-900/70 hover:border-blue-500/70 p-5 transition-all">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-white font-bold text-lg">Upwork Calculator</p>
                                <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-300 bg-slate-800 border border-slate-700 px-2.5 py-1 rounded-md">
                                    <span aria-hidden="true">🇺🇸</span>
                                    USA
                                </span>
                            </div>
                            <p class="text-slate-400 text-sm mt-2">Popular freelancer marketplace cost estimator and budget guide.</p>
                            <span class="inline-flex items-center gap-2 mt-4 text-blue-400 group-hover:text-blue-300 font-semibold text-sm">
                                Open Website
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </span>
                        </a>

                        <a href="https://www.scnsoft.com/web-development/calculator" target="_blank" rel="noopener noreferrer" class="group rounded-xl border border-slate-700 bg-slate-900/70 hover:border-blue-500/70 p-5 transition-all">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-white font-bold text-lg">ScienceSoft Calculator</p>
                                <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-300 bg-slate-800 border border-slate-700 px-2.5 py-1 rounded-md">
                                    <span aria-hidden="true">🇺🇸</span>
                                    USA
                                </span>
                            </div>
                            <p class="text-slate-400 text-sm mt-2">Long-running software company calculator for custom web projects.</p>
                            <span class="inline-flex items-center gap-2 mt-4 text-blue-400 group-hover:text-blue-300 font-semibold text-sm">
                                Open Website
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </span>
                        </a>
                    </div>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="https://www.webdesignphils.com/web-project-cost-estimator/" target="_blank" rel="noopener noreferrer" class="group rounded-xl border border-slate-700 bg-slate-900/70 hover:border-cyan-500/70 p-5 transition-all">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-white font-bold text-lg">WebDesignPhils Estimator</p>
                                <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-300 bg-slate-800 border border-slate-700 px-2.5 py-1 rounded-md">
                                    <span aria-hidden="true">🇵🇭</span>
                                    Philippines
                                </span>
                            </div>
                            <p class="text-slate-400 text-sm mt-2">Philippine-based web project cost estimator for websites and apps.</p>
                            <span class="inline-flex items-center gap-2 mt-4 text-cyan-400 group-hover:text-cyan-300 font-semibold text-sm">
                                Open Website
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </span>
                        </a>

                        <a href="https://nordicconsult.ph/website-price-calculator/" target="_blank" rel="noopener noreferrer" class="group rounded-xl border border-slate-700 bg-slate-900/70 hover:border-cyan-500/70 p-5 transition-all">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-white font-bold text-lg">Nordic Consult Calculator</p>
                                <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-300 bg-slate-800 border border-slate-700 px-2.5 py-1 rounded-md">
                                    <span aria-hidden="true">🇵🇭</span>
                                    Philippines
                                </span>
                            </div>
                            <p class="text-slate-400 text-sm mt-2">Website price calculator from a Philippine digital services provider.</p>
                            <span class="inline-flex items-center gap-2 mt-4 text-cyan-400 group-hover:text-cyan-300 font-semibold text-sm">
                                Open Website
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </span>
                        </a>

                        <a href="https://dotnek.com/en-PH/Pricing" target="_blank" rel="noopener noreferrer" class="group rounded-xl border border-slate-700 bg-slate-900/70 hover:border-cyan-500/70 p-5 transition-all">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-white font-bold text-lg">DotNek Pricing Calculator</p>
                                <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-300 bg-slate-800 border border-slate-700 px-2.5 py-1 rounded-md">
                                    <span aria-hidden="true">🇵🇭</span>
                                    Philippines
                                </span>
                            </div>
                            <p class="text-slate-400 text-sm mt-2">Calculator-style pricing page with Philippines-localized web services.</p>
                            <span class="inline-flex items-center gap-2 mt-4 text-cyan-400 group-hover:text-cyan-300 font-semibold text-sm">
                                Open Website
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </span>
                        </a>
                    </div>

                    <p class="text-center text-xs text-slate-500 mt-6">
                        External calculator pricing varies by scope, timeline, and region. We keep our rates competitive for similar deliverables.
                    </p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
