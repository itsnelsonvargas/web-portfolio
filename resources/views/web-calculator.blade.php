<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Calculator</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
                                <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-blue-500/70 transition-colors">
                                    <input type="checkbox" class="accent-blue-500">
                                    <span>Application Programming Interface</span>
                                </label>
                            </div>
                        </article>

                        <article class="bg-gradient-to-br from-slate-800 to-slate-900 border-2 border-slate-700 rounded-2xl p-6 md:p-8">
                            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3 mb-6">
                                <div>
                                    <h2 class="text-2xl font-bold text-white">Add-ons</h2>
                                    <p class="text-sm text-slate-400 mt-1">Optional services for compliance, testing, and delivery readiness.</p>
                                </div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Select all that apply</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="flex items-start gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-cyan-500/70 transition-colors">
                                    <input type="checkbox" class="mt-1 accent-cyan-500">
                                    <span>
                                        <span class="block text-slate-100 font-semibold">UAT Support</span>
                                        <span class="block text-xs text-slate-400 mt-1">User acceptance testing support and defect triage.</span>
                                    </span>
                                </label>

                                <label class="flex items-start gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-cyan-500/70 transition-colors">
                                    <input type="checkbox" class="mt-1 accent-cyan-500">
                                    <span>
                                        <span class="block text-slate-100 font-semibold">PIA Assessment</span>
                                        <span class="block text-xs text-slate-400 mt-1">Privacy impact analysis for personal data handling.</span>
                                    </span>
                                </label>

                                <label class="flex items-start gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-cyan-500/70 transition-colors">
                                    <input type="checkbox" class="mt-1 accent-cyan-500">
                                    <span>
                                        <span class="block text-slate-100 font-semibold">QA Assessment</span>
                                        <span class="block text-xs text-slate-400 mt-1">Structured quality assurance checks and reporting.</span>
                                    </span>
                                </label>

                                <label class="flex items-start gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-cyan-500/70 transition-colors">
                                    <input type="checkbox" class="mt-1 accent-cyan-500">
                                    <span>
                                        <span class="block text-slate-100 font-semibold">VA Assessment</span>
                                        <span class="block text-xs text-slate-400 mt-1">Vulnerability assessment for common web security risks.</span>
                                    </span>
                                </label>

                                <label class="flex items-start gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-cyan-500/70 transition-colors">
                                    <input type="checkbox" class="mt-1 accent-cyan-500">
                                    <span>
                                        <span class="block text-slate-100 font-semibold">Performance Audit</span>
                                        <span class="block text-xs text-slate-400 mt-1">Load, speed, and Core Web Vitals improvement review.</span>
                                    </span>
                                </label>

                                <label class="flex items-start gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-cyan-500/70 transition-colors">
                                    <input type="checkbox" class="mt-1 accent-cyan-500">
                                    <span>
                                        <span class="block text-slate-100 font-semibold">Post-launch Monitoring</span>
                                        <span class="block text-xs text-slate-400 mt-1">Early support window with incident monitoring and fixes.</span>
                                    </span>
                                </label>

                                <label class="flex items-start gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-cyan-500/70 transition-colors">
                                    <input type="checkbox" class="mt-1 accent-cyan-500">
                                    <span>
                                        <span class="block text-slate-100 font-semibold">User Manual / Documentation</span>
                                        <span class="block text-xs text-slate-400 mt-1">Structured guide that explains how to use, manage, and maintain the website or system.</span>
                                    </span>
                                </label>

                                <label class="flex items-start gap-3 p-4 rounded-xl border border-slate-700 bg-slate-900/60 hover:border-cyan-500/70 transition-colors">
                                    <input type="checkbox" class="mt-1 accent-cyan-500">
                                    <span>
                                        <span class="block text-slate-100 font-semibold">Client Training Session</span>
                                        <span class="block text-xs text-slate-400 mt-1">Guided walkthrough (live or recorded) where the developer teaches the client how to use and manage the website or system.</span>
                                    </span>
                                </label>

                            </div>
                        </article>
                    </div>

                    <aside class="lg:col-span-1">
                        <div class="sticky top-6 bg-gradient-to-br from-slate-800 to-slate-900 border-2 border-blue-500/40 rounded-2xl p-6 md:p-8 shadow-2xl shadow-blue-900/20">
                            <div class="flex items-start justify-between gap-4 mb-2">
                                <p class="text-xs uppercase tracking-wider text-slate-400 font-bold">Estimated Amount</p>
                                <div>
                                    <label for="currency-selector" class="sr-only">Choose currency</label>
                                    <select id="currency-selector" class="bg-slate-900 border border-slate-700 text-slate-200 text-xs font-semibold rounded-md px-2.5 py-1.5 focus:border-blue-500 focus:outline-none">
                                        <option value="PHP" selected>PHP (₱)</option>
                                        <option value="USD">USD ($)</option>
                                    </select>
                                </div>
                            </div>
                            <p id="estimated-total" class="text-4xl md:text-5xl font-black bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent mb-6">
                                ₱147,000
                            </p>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between border-b border-slate-700/70 pb-2">
                                    <span class="text-slate-400">Base Project</span>
                                    <span id="estimated-base" class="text-slate-200">₱90,000</span>
                                </div>
                                <div class="flex justify-between border-b border-slate-700/70 pb-2">
                                    <span class="text-slate-400">Pages & Sections</span>
                                    <span id="estimated-pages" class="text-slate-200">₱27,000</span>
                                </div>
                                <div class="flex justify-between border-b border-slate-700/70 pb-2">
                                    <span class="text-slate-400">Features</span>
                                    <span id="estimated-features" class="text-slate-200">₱21,000</span>
                                </div>
                                <div class="flex justify-between pt-1">
                                    <span class="text-slate-300 font-semibold">Timeline Adjustment</span>
                                    <span id="estimated-timeline" class="text-emerald-300 font-semibold">+₱9,000</span>
                                </div>
                            </div>
                            <button type="button" class="w-full mt-8 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold py-3.5 rounded-lg transition-all duration-200">
                                Request Full Quotation
                            </button>
                            <button id="download-estimate-pdf" type="button" class="w-full mt-3 bg-slate-900 hover:bg-slate-800 border border-slate-600 text-slate-100 font-semibold py-3 rounded-lg transition-all duration-200">
                                Download Estimate PDF
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
                        <a href="https://www.webfx.com/web-design/website-design-cost-calculator.html" target="_blank" rel="noopener noreferrer" class="external-compare-link group rounded-xl border border-slate-700 bg-slate-900/70 hover:border-blue-500/70 p-5 transition-all">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-white font-bold text-lg">WebFX Calculator</p>
                                <span class="inline-flex items-center justify-center w-9 h-9 bg-slate-950/70 border border-slate-600/80 rounded-lg shadow-sm" title="United States">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="2.5" y="5" width="19" height="14" rx="2" fill="#ffffff"/>
                                        <rect x="2.5" y="5" width="19" height="2" fill="#B22234"/>
                                        <rect x="2.5" y="9" width="19" height="2" fill="#B22234"/>
                                        <rect x="2.5" y="13" width="19" height="2" fill="#B22234"/>
                                        <rect x="2.5" y="17" width="19" height="2" fill="#B22234"/>
                                        <rect x="2.5" y="5" width="8.5" height="8" rx="1" fill="#3C3B6E"/>
                                    </svg>
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

                        <a href="https://www.upwork.com/tools/website-design-cost-calculator" target="_blank" rel="noopener noreferrer" class="external-compare-link group rounded-xl border border-slate-700 bg-slate-900/70 hover:border-blue-500/70 p-5 transition-all">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-white font-bold text-lg">Upwork Calculator</p>
                                <span class="inline-flex items-center justify-center w-9 h-9 bg-slate-950/70 border border-slate-600/80 rounded-lg shadow-sm" title="United States">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="2.5" y="5" width="19" height="14" rx="2" fill="#ffffff"/>
                                        <rect x="2.5" y="5" width="19" height="2" fill="#B22234"/>
                                        <rect x="2.5" y="9" width="19" height="2" fill="#B22234"/>
                                        <rect x="2.5" y="13" width="19" height="2" fill="#B22234"/>
                                        <rect x="2.5" y="17" width="19" height="2" fill="#B22234"/>
                                        <rect x="2.5" y="5" width="8.5" height="8" rx="1" fill="#3C3B6E"/>
                                    </svg>
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

                        <a href="https://www.scnsoft.com/web-development/calculator" target="_blank" rel="noopener noreferrer" class="external-compare-link group rounded-xl border border-slate-700 bg-slate-900/70 hover:border-blue-500/70 p-5 transition-all">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-white font-bold text-lg">ScienceSoft Calculator</p>
                                <span class="inline-flex items-center justify-center w-9 h-9 bg-slate-950/70 border border-slate-600/80 rounded-lg shadow-sm" title="United States">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="2.5" y="5" width="19" height="14" rx="2" fill="#ffffff"/>
                                        <rect x="2.5" y="5" width="19" height="2" fill="#B22234"/>
                                        <rect x="2.5" y="9" width="19" height="2" fill="#B22234"/>
                                        <rect x="2.5" y="13" width="19" height="2" fill="#B22234"/>
                                        <rect x="2.5" y="17" width="19" height="2" fill="#B22234"/>
                                        <rect x="2.5" y="5" width="8.5" height="8" rx="1" fill="#3C3B6E"/>
                                    </svg>
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
                        <a href="https://www.truelogic.com.ph/blog/website-cost/" target="_blank" rel="noopener noreferrer" class="external-compare-link group rounded-xl border border-slate-700 bg-slate-900/70 hover:border-cyan-500/70 p-5 transition-all">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-white font-bold text-lg">Truelogic Cost Guide</p>
                                <span class="inline-flex items-center justify-center w-9 h-9 bg-slate-950/70 border border-slate-600/80 rounded-lg shadow-sm" title="Philippines">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="2.5" y="5" width="19" height="14" rx="2" fill="#ffffff"/>
                                        <path d="M7 5h14.5v7H7z" fill="#0038A8"/>
                                        <path d="M7 12h14.5v7H7z" fill="#CE1126"/>
                                        <path d="M2.5 5l8.5 7-8.5 7z" fill="#ffffff"/>
                                        <circle cx="6" cy="12" r="1" fill="#FCD116"/>
                                    </svg>
                                </span>
                            </div>
                            <p class="text-slate-400 text-sm mt-2">Philippine agency pricing guide with local website cost ranges and benchmarks.</p>
                            <span class="inline-flex items-center gap-2 mt-4 text-cyan-400 group-hover:text-cyan-300 font-semibold text-sm">
                                Open Website
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </span>
                        </a>

                        <a href="https://nordicconsult.ph/website-price-calculator/" target="_blank" rel="noopener noreferrer" class="external-compare-link group rounded-xl border border-slate-700 bg-slate-900/70 hover:border-cyan-500/70 p-5 transition-all">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-white font-bold text-lg">Nordic Consult Calculator</p>
                                <span class="inline-flex items-center justify-center w-9 h-9 bg-slate-950/70 border border-slate-600/80 rounded-lg shadow-sm" title="Philippines">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="2.5" y="5" width="19" height="14" rx="2" fill="#ffffff"/>
                                        <path d="M7 5h14.5v7H7z" fill="#0038A8"/>
                                        <path d="M7 12h14.5v7H7z" fill="#CE1126"/>
                                        <path d="M2.5 5l8.5 7-8.5 7z" fill="#ffffff"/>
                                        <circle cx="6" cy="12" r="1" fill="#FCD116"/>
                                    </svg>
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

                        <a href="https://www.praferosawebworks.com/blog/website-cost-philippines-2026/" target="_blank" rel="noopener noreferrer" class="external-compare-link group rounded-xl border border-slate-700 bg-slate-900/70 hover:border-cyan-500/70 p-5 transition-all">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-white font-bold text-lg">Praferosa Cost Guide</p>
                                <span class="inline-flex items-center justify-center w-9 h-9 bg-slate-950/70 border border-slate-600/80 rounded-lg shadow-sm" title="Philippines">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="2.5" y="5" width="19" height="14" rx="2" fill="#ffffff"/>
                                        <path d="M7 5h14.5v7H7z" fill="#0038A8"/>
                                        <path d="M7 12h14.5v7H7z" fill="#CE1126"/>
                                        <path d="M2.5 5l8.5 7-8.5 7z" fill="#ffffff"/>
                                        <circle cx="6" cy="12" r="1" fill="#FCD116"/>
                                    </svg>
                                </span>
                            </div>
                            <p class="text-slate-400 text-sm mt-2">Detailed Philippines web pricing breakdown with updated local market ranges.</p>
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

        <section class="pb-20 md:pb-28">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto bg-gradient-to-br from-slate-800 to-slate-900 border-2 border-slate-700 rounded-2xl p-6 md:p-8">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl md:text-3xl font-black text-white mb-3">Available Developers</h2>
                        <p class="text-slate-400 max-w-3xl mx-auto">
                            Current team members available to support planning, development, QA, and delivery.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <article class="rounded-xl border border-slate-700 bg-slate-900/70 p-5">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="text-white font-bold">Lead Full-stack Developer</h3>
                                <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 px-2 py-1 rounded-md">Available</span>
                            </div>
                            <p class="text-sm text-slate-400">Architecture, backend APIs, database design, and deployment setup.</p>
                        </article>

                        <article class="rounded-xl border border-slate-700 bg-slate-900/70 p-5">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="text-white font-bold">Frontend Developer</h3>
                                <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 px-2 py-1 rounded-md">Available</span>
                            </div>
                            <p class="text-sm text-slate-400">Responsive UI implementation, accessibility, and performance tuning.</p>
                        </article>

                        <article class="rounded-xl border border-slate-700 bg-slate-900/70 p-5">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="text-white font-bold">UI/UX Designer</h3>
                                <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 px-2 py-1 rounded-md">Available</span>
                            </div>
                            <p class="text-sm text-slate-400">Wireframes, design systems, interactive prototypes, and visual assets.</p>
                        </article>

                        <article class="rounded-xl border border-slate-700 bg-slate-900/70 p-5">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="text-white font-bold">QA Engineer</h3>
                                <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 px-2 py-1 rounded-md">Available</span>
                            </div>
                            <p class="text-sm text-slate-400">Test planning, regression testing, UAT assistance, and bug validation.</p>
                        </article>

                        <article class="rounded-xl border border-slate-700 bg-slate-900/70 p-5">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="text-white font-bold">Security Specialist</h3>
                                <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 px-2 py-1 rounded-md">Available</span>
                            </div>
                            <p class="text-sm text-slate-400">Vulnerability assessment, secure coding checks, and hardening recommendations.</p>
                        </article>

                        <article class="rounded-xl border border-slate-700 bg-slate-900/70 p-5">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="text-white font-bold">Project Coordinator</h3>
                                <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 px-2 py-1 rounded-md">Available</span>
                            </div>
                            <p class="text-sm text-slate-400">Timeline tracking, communication updates, and milestone management.</p>
                        </article>

                        <article class="rounded-xl border border-slate-700 bg-slate-900/70 p-5">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="text-white font-bold">PIA Specialist</h3>
                                <span class="text-[11px] font-semibold text-amber-300 bg-amber-500/10 border border-amber-500/30 px-2 py-1 rounded-md">Outsourceable</span>
                            </div>
                            <p class="text-sm text-slate-400">Privacy impact assessment support for compliance documentation and reviews.</p>
                        </article>

                        <article class="rounded-xl border border-slate-700 bg-slate-900/70 p-5">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="text-white font-bold">Backend Developer</h3>
                                <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 px-2 py-1 rounded-md">Available</span>
                            </div>
                            <p class="text-sm text-slate-400">API development, integrations, business logic, and database optimization.</p>
                        </article>

                        <article class="rounded-xl border border-slate-700 bg-slate-900/70 p-5">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="text-white font-bold">Mobile Developer</h3>
                                <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 px-2 py-1 rounded-md">Available</span>
                            </div>
                            <p class="text-sm text-slate-400">Cross-platform app support, mobile optimization, and API integration.</p>
                        </article>

                        <article class="rounded-xl border border-slate-700 bg-slate-900/70 p-5">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="text-white font-bold">DevOps Engineer</h3>
                                <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 px-2 py-1 rounded-md">Available</span>
                            </div>
                            <p class="text-sm text-slate-400">CI/CD pipelines, cloud deployment, monitoring setup, and release automation.</p>
                        </article>

                        <article class="rounded-xl border border-slate-700 bg-slate-900/70 p-5">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="text-white font-bold">Business Analyst</h3>
                                <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 px-2 py-1 rounded-md">Available</span>
                            </div>
                            <p class="text-sm text-slate-400">Requirement mapping, process analysis, and scope definition support.</p>
                        </article>

                        <article class="rounded-xl border border-slate-700 bg-slate-900/70 p-5">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="text-white font-bold">Technical Writer</h3>
                                <span class="text-[11px] font-semibold text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 px-2 py-1 rounded-md">Available</span>
                            </div>
                            <p class="text-sm text-slate-400">User guides, API documentation, and handover documentation for teams.</p>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="pb-24 md:pb-32">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto relative overflow-hidden bg-gradient-to-br from-slate-800 via-slate-800 to-slate-900 border-2 border-slate-700 rounded-2xl p-6 md:p-8">
                    <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute -bottom-24 -left-20 w-72 h-72 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="relative text-center mb-8">
                        <span class="inline-flex items-center gap-2 px-4 py-2 mb-4 bg-blue-500/10 border border-blue-500/30 rounded-lg text-xs font-bold uppercase tracking-wider text-blue-300">
                            Quality Insights
                        </span>
                        <h2 class="text-3xl md:text-4xl font-black text-white mb-3 leading-tight">
                            How Extremely Low-Cost Development
                            <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">Affects Product Quality</span>
                        </h2>
                        <p class="text-slate-300/90 max-w-3xl mx-auto">
                            Lower cost can look appealing at first, but very low quotes often remove essential quality controls that protect stability, security, and long-term business performance.
                        </p>
                    </div>

                    <div class="relative grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <article class="group rounded-xl border border-slate-700/90 bg-slate-900/70 p-5 hover:border-blue-500/60 transition-all duration-200">
                            <div class="w-9 h-9 rounded-md bg-blue-500/15 border border-blue-500/30 flex items-center justify-center text-blue-300 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-white font-bold mb-2">Minimal Discovery Phase</h3>
                            <p class="text-sm text-slate-400">Requirements are rushed, causing unclear scope, missing features, and costly rework later.</p>
                        </article>

                        <article class="group rounded-xl border border-slate-700/90 bg-slate-900/70 p-5 hover:border-blue-500/60 transition-all duration-200">
                            <div class="w-9 h-9 rounded-md bg-blue-500/15 border border-blue-500/30 flex items-center justify-center text-blue-300 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3v2.25m4.5-2.25V6m-7.5 4.5h10.5M6 21h12a2.25 2.25 0 002.25-2.25V8.25A2.25 2.25 0 0018 6H6A2.25 2.25 0 003.75 8.25v10.5A2.25 2.25 0 006 21z"></path>
                                </svg>
                            </div>
                            <h3 class="text-white font-bold mb-2">Weak Code Quality</h3>
                            <p class="text-sm text-slate-400">Quick fixes and poor architecture lead to unstable systems that are harder to maintain and scale.</p>
                        </article>

                        <article class="group rounded-xl border border-slate-700/90 bg-slate-900/70 p-5 hover:border-blue-500/60 transition-all duration-200">
                            <div class="w-9 h-9 rounded-md bg-blue-500/15 border border-blue-500/30 flex items-center justify-center text-blue-300 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-white font-bold mb-2">Limited QA Testing</h3>
                            <p class="text-sm text-slate-400">Lack of structured testing means bugs reach production and hurt user trust.</p>
                        </article>

                        <article class="group rounded-xl border border-slate-700/90 bg-slate-900/70 p-5 hover:border-blue-500/60 transition-all duration-200">
                            <div class="w-9 h-9 rounded-md bg-blue-500/15 border border-blue-500/30 flex items-center justify-center text-blue-300 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-1.5 0h12a1.5 1.5 0 011.5 1.5v7.5A1.5 1.5 0 0118 21h-12a1.5 1.5 0 01-1.5-1.5V12a1.5 1.5 0 011.5-1.5z"></path>
                                </svg>
                            </div>
                            <h3 class="text-white font-bold mb-2">Security Gaps</h3>
                            <p class="text-sm text-slate-400">Security checks are often skipped, increasing risk of vulnerabilities and data exposure.</p>
                        </article>

                        <article class="group rounded-xl border border-slate-700/90 bg-slate-900/70 p-5 hover:border-blue-500/60 transition-all duration-200">
                            <div class="w-9 h-9 rounded-md bg-blue-500/15 border border-blue-500/30 flex items-center justify-center text-blue-300 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A3.375 3.375 0 0011.25 11.625v2.625m8.25 0v3a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-3m13.5 0H6m13.5 0v-1.5a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 006 12.75v1.5"></path>
                                </svg>
                            </div>
                            <h3 class="text-white font-bold mb-2">Poor Documentation</h3>
                            <p class="text-sm text-slate-400">Without proper docs, future updates become slower, more expensive, and error-prone.</p>
                        </article>

                        <article class="group rounded-xl border border-slate-700/90 bg-slate-900/70 p-5 hover:border-blue-500/60 transition-all duration-200">
                            <div class="w-9 h-9 rounded-md bg-blue-500/15 border border-blue-500/30 flex items-center justify-center text-blue-300 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 10.5v6.75a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25V10.5m13.5 0l-1.5-6h-9l-1.5 6m12 0h-12"></path>
                                </svg>
                            </div>
                            <h3 class="text-white font-bold mb-2">No Reliable Support</h3>
                            <p class="text-sm text-slate-400">After launch, unresolved issues and weak handover can interrupt operations and growth.</p>
                        </article>
                    </div>

                    <div class="relative mt-6 rounded-2xl border border-blue-500/20 bg-gradient-to-br from-blue-500/10 to-blue-600/5 p-5 shadow-sm">

                        <!-- Message -->
                        <p class="text-center text-sm leading-relaxed text-blue-100">
                            Low upfront costs can be deceptive—projects priced too cheaply often lead to hidden expenses in 
                            <span class="font-medium text-white">security</span>, 
                            <span class="font-medium text-white">deployment</span>, and 
                            <span class="font-medium text-white">long-term stability</span>.
                        </p>

                        <!-- Divider -->
                        <div class="my-4 h-px bg-blue-500/20"></div>

                        <!-- Sources -->
                        <div class="text-center">
                            <p class="mb-2 text-[11px] uppercase tracking-wide text-blue-300/70">
                                Backed by industry research
                            </p>

                            <div class="flex flex-wrap justify-center gap-2 text-xs">
                                <a href="https://www.techtarget.com/searchcloudcomputing/tip/The-hidden-costs-of-technical-debt-in-infrastructure" target="_blank"
                                    class="rounded-full border border-blue-400/20 px-3 py-1 text-blue-200 hover:border-blue-300 hover:text-white transition">
                                    TechTarget
                                </a>

                                <a href="https://www.csoonline.com/article/570851/7-ways-technical-debt-increases-security-risk.html" target="_blank"
                                    class="rounded-full border border-blue-400/20 px-3 py-1 text-blue-200 hover:border-blue-300 hover:text-white transition">
                                    CSO Online
                                </a>

                                <a href="https://www.sonarsource.com/blog/new-research-from-sonar-on-cost-of-technical-debt/" target="_blank"
                                    class="rounded-full border border-blue-400/20 px-3 py-1 text-blue-200 hover:border-blue-300 hover:text-white transition">
                                    SonarSource
                                </a>

                                <a href="https://www.sciencedirect.com/science/article/abs/pii/S016412121630108X" target="_blank"
                                    class="rounded-full border border-blue-400/20 px-3 py-1 text-blue-200 hover:border-blue-300 hover:text-white transition">
                                    Case Study
                                </a>

                                <a href="https://www.sciencedirect.com/science/article/abs/pii/S0164121216300978" target="_blank"
                                    class="rounded-full border border-blue-400/20 px-3 py-1 text-blue-200 hover:border-blue-300 hover:text-white transition">
                                    Research Paper
                                </a>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </section>
    </main>
    <script>
        const conversionRate = 60;
        const estimateUsd = {
            base: 1500,
            pages: 450,
            features: 350,
            timeline: 150,
            total: 2450,
        };

        const currencySelector = document.getElementById('currency-selector');
        const estimatedTotal = document.getElementById('estimated-total');
        const estimatedBase = document.getElementById('estimated-base');
        const estimatedPages = document.getElementById('estimated-pages');
        const estimatedFeatures = document.getElementById('estimated-features');
        const estimatedTimeline = document.getElementById('estimated-timeline');
        const downloadEstimatePdfButton = document.getElementById('download-estimate-pdf');

        function formatCurrency(amount, currency) {
            const locale = currency === 'PHP' ? 'en-PH' : 'en-US';
            return new Intl.NumberFormat(locale, {
                style: 'currency',
                currency,
                maximumFractionDigits: 0,
            }).format(amount);
        }

        function convertAmount(usdAmount, currency) {
            return currency === 'PHP' ? usdAmount * conversionRate : usdAmount;
        }

        function renderEstimate(currency) {
            estimatedTotal.textContent = formatCurrency(convertAmount(estimateUsd.total, currency), currency);
            estimatedBase.textContent = formatCurrency(convertAmount(estimateUsd.base, currency), currency);
            estimatedPages.textContent = formatCurrency(convertAmount(estimateUsd.pages, currency), currency);
            estimatedFeatures.textContent = formatCurrency(convertAmount(estimateUsd.features, currency), currency);
            estimatedTimeline.textContent = `+${formatCurrency(convertAmount(estimateUsd.timeline, currency), currency)}`;
        }

        if (currencySelector) {
            currencySelector.addEventListener('change', (event) => {
                renderEstimate(event.target.value);
            });

            renderEstimate(currencySelector.value);
        }

        if (downloadEstimatePdfButton) {
            downloadEstimatePdfButton.addEventListener('click', () => {
                const jsPdfModule = window.jspdf;
                if (!jsPdfModule || !jsPdfModule.jsPDF) {
                    const fallbackContent = [
                        'Web Project Estimate',
                        `Generated: ${new Date().toLocaleString()}`,
                        '',
                        `Currency: ${currencySelector ? currencySelector.value : 'PHP'}`,
                        `Project Type: ${document.getElementById('project-type')?.value || 'N/A'}`,
                        `Estimated Pages: ${document.getElementById('pages')?.value || 'N/A'}`,
                        `Timeline: ${document.getElementById('timeline')?.value || 'N/A'}`,
                        `Design Level: ${document.getElementById('design-level')?.value || 'N/A'}`,
                        '',
                        'Estimate Breakdown',
                        `Base Project: ${estimatedBase?.textContent || '-'}`,
                        `Pages & Sections: ${estimatedPages?.textContent || '-'}`,
                        `Features: ${estimatedFeatures?.textContent || '-'}`,
                        `Timeline Adjustment: ${estimatedTimeline?.textContent || '-'}`,
                        `Estimated Total: ${estimatedTotal?.textContent || '-'}`,
                        '',
                        'Note: PDF library unavailable. This fallback is a text export.',
                    ].join('\n');

                    const blob = new Blob([fallbackContent], { type: 'text/plain;charset=utf-8' });
                    const fallbackUrl = URL.createObjectURL(blob);
                    const link = document.createElement('a');
                    link.href = fallbackUrl;
                    link.download = 'web-project-estimate.txt';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    URL.revokeObjectURL(fallbackUrl);
                    window.alert('PDF library did not load, so a text estimate was downloaded instead.');
                    return;
                }

                const { jsPDF } = jsPdfModule;
                const doc = new jsPDF();
                const currency = currencySelector ? currencySelector.value : 'PHP';
                const projectType = document.getElementById('project-type')?.value || 'N/A';
                const pages = document.getElementById('pages')?.value || 'N/A';
                const timeline = document.getElementById('timeline')?.value || 'N/A';
                const designLevel = document.getElementById('design-level')?.value || 'N/A';

                doc.setFontSize(18);
                doc.text('Web Project Estimate', 14, 20);
                doc.setFontSize(11);
                doc.text(`Generated: ${new Date().toLocaleString()}`, 14, 28);
                doc.text(`Currency: ${currency}`, 14, 34);

                doc.setFontSize(13);
                doc.text('Project Details', 14, 45);
                doc.setFontSize(11);
                doc.text(`Project Type: ${projectType}`, 14, 53);
                doc.text(`Estimated Pages: ${pages}`, 14, 59);
                doc.text(`Timeline: ${timeline}`, 14, 65);
                doc.text(`Design Level: ${designLevel}`, 14, 71);

                doc.setFontSize(13);
                doc.text('Estimate Breakdown', 14, 84);
                doc.setFontSize(11);
                doc.text(`Base Project: ${estimatedBase?.textContent || '-'}`, 14, 92);
                doc.text(`Pages & Sections: ${estimatedPages?.textContent || '-'}`, 14, 98);
                doc.text(`Features: ${estimatedFeatures?.textContent || '-'}`, 14, 104);
                doc.text(`Timeline Adjustment: ${estimatedTimeline?.textContent || '-'}`, 14, 110);

                doc.setFontSize(14);
                doc.text(`Estimated Total: ${estimatedTotal?.textContent || '-'}`, 14, 123);

                doc.setFontSize(10);
                doc.text('This estimate is for budgeting purposes only and may change based on final scope.', 14, 135);

                doc.save(`web-project-estimate-${currency.toLowerCase()}.pdf`);
            });
        }

        document.querySelectorAll('.external-compare-link').forEach((link) => {
            link.addEventListener('click', (event) => {
                const confirmed = window.confirm(
                    'You are about to open a third-party website.\n\n' +
                    'For transparency: we do not own, control, or verify these links.\n\n' +
                    'Do you want to continue?'
                );


 
                if (!confirmed) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
