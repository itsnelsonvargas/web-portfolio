@extends('layouts.portfolio')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="relative pt-24 pb-20 md:pt-32 md:pb-32 bg-slate-950 overflow-hidden" role="banner" aria-labelledby="home-heading">
        <!-- Animated Grid Pattern -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.03]"></div>

        <!-- Dynamic gradient orbs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 rounded-full mix-blend-screen filter blur-3xl opacity-10 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-500 rounded-full mix-blend-screen filter blur-3xl opacity-10 animate-pulse" style="animation-delay: 1s;"></div>

        <!-- Diagonal accent stripe -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-bl from-blue-600/5 via-transparent to-transparent transform skew-x-12"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-16">
                <div class="md:w-3/5 text-center md:text-left">
                    <!-- Status Badge with glow -->
                    <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-500/10 to-emerald-600/10 border border-emerald-500/30 rounded-lg mb-8 backdrop-blur-sm">
                        <div class="relative">
                            <div class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-pulse"></div>
                            <div class="absolute inset-0 w-2.5 h-2.5 bg-emerald-400 rounded-full animate-ping"></div>
                        </div>
                        <span class="text-emerald-300 text-sm font-bold uppercase tracking-wider">Available for Work</span>
                    </div>

                    <h1 id="home-heading" class="text-5xl md:text-7xl lg:text-8xl font-black text-white mb-8 leading-none">
                        <span class="block text-slate-500 text-2xl md:text-3xl font-normal mb-2 tracking-wide">Hello, I'm</span>
                        <span class="bg-gradient-to-r from-white via-blue-100 to-white bg-clip-text text-transparent">{{ $profile->name }}</span>
                    </h1>

                    <div class="mb-10 relative">
                        <p class="text-2xl md:text-4xl text-blue-400 font-bold mb-3 tracking-tight">{{ $profile->title }}</p>
                        <div class="flex gap-2 items-center">
                            <div class="h-1 w-24 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 rounded-full"></div>
                            <div class="h-1 w-8 bg-gradient-to-r from-blue-600 to-transparent rounded-full"></div>
                        </div>
                    </div>

                    <!-- Impactful Description -->
                    <p class="text-xl text-slate-300 mb-12 max-w-2xl leading-relaxed font-light">
                        Transforming ideas into <span class="text-blue-400 font-semibold">powerful digital solutions</span>.
                        Specializing in building high-performance applications that drive real business results.
                    </p>

                    <!-- Bold CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-5 justify-center md:justify-start mb-12">
                        <a href="#contact" class="group relative bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-cyan-500 text-white px-10 py-5 rounded-lg font-bold text-lg transition-all duration-300 flex items-center justify-center gap-3 shadow-2xl shadow-blue-600/30 hover:shadow-blue-500/50 transform hover:scale-105" aria-label="Go to contact form to start a project collaboration">
                            <span>Let's Build Something</span>
                            <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        @if($profile->resume_url)
                        <a href="{{ $profile->resume_url }}" target="_blank" rel="noopener noreferrer" class="group relative bg-slate-800/50 hover:bg-slate-700/50 border-2 border-slate-600 hover:border-blue-500 text-slate-200 hover:text-white px-10 py-5 rounded-lg font-bold text-lg transition-all duration-300 flex items-center justify-center gap-3 backdrop-blur-sm transform hover:scale-105" aria-label="Download or view {{ $profile->name }}'s resume (opens in new tab)">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <span>View Resume</span>
                        </a>
                        @endif
                    </div>

                    <!-- Social Links with Icons -->
                    <div class="flex flex-wrap justify-center md:justify-start gap-5 pt-8 border-t border-slate-800/50">
                        @foreach($socialLinks as $link)
                        <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-2 text-slate-400 hover:text-blue-400 transition-all duration-200 focus-visible social-link" aria-label="Visit {{ $profile->name }}'s {{ $link->platform }} profile (opens in new tab)">
                            <div class="w-10 h-10 rounded-lg bg-slate-800/50 border border-slate-700 group-hover:border-blue-500 group-hover:bg-slate-700/50 flex items-center justify-center transition-all duration-200 group-hover:scale-110">
                                <span class="text-xs font-bold">{{ substr($link->platform, 0, 2) }}</span>
                            </div>
                            <span class="font-medium text-sm">{{ $link->platform }}</span>
                            <span class="sr-only">(opens in new tab)</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="md:w-2/5 flex justify-center opacity-0 animate-slideInRight delay-200">
                    <div class="relative group">
                        <!-- Animated background layers -->
                        <div class="absolute -inset-8 bg-gradient-to-br from-blue-600/20 via-cyan-500/20 to-blue-600/20 rounded-2xl transform rotate-6 group-hover:rotate-12 transition-transform duration-500 blur-xl"></div>
                        <div class="absolute -inset-6 bg-gradient-to-tr from-slate-800 via-slate-700 to-slate-800 rounded-2xl border border-slate-600 transform -rotate-3 group-hover:-rotate-6 transition-transform duration-500"></div>

                        <!-- Profile Image Container -->
                        <div class="relative transform group-hover:scale-105 transition-transform duration-500">
                            <img src="{{ $profile->profile_image }}" alt="{{ $profile->name }}" class="w-72 h-72 md:w-80 md:h-80 lg:w-96 lg:h-96 object-contain rounded-2xl shadow-2xl border-4 border-slate-700" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($profile->name) }}&size=400&background=1e293b&color=60a5fa&format=png'" loading="lazy">
                            <!-- Accent corners with glow -->
                            <div class="absolute -top-3 -right-3 w-20 h-20 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-tr-2xl shadow-lg shadow-blue-600/50"></div>
                            <div class="absolute -bottom-3 -left-3 w-20 h-20 bg-gradient-to-br from-slate-700 to-slate-800 rounded-bl-2xl shadow-lg"></div>

                            <!-- Glowing border effect -->
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-tr from-blue-600/0 via-blue-500/10 to-cyan-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        <!-- Enhanced Stats Badge -->
                        <div class="absolute -bottom-8 left-1/2 -translate-x-1/2 bg-gradient-to-br from-slate-900 to-slate-800 border-2 border-blue-500/30 px-10 py-5 rounded-xl shadow-2xl backdrop-blur-md">
                            <div class="flex items-center gap-6">
                                <div class="text-center border-r-2 border-slate-700 pr-6">
                                    <div class="text-3xl font-black bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">{{ $about->years_of_experience }}+</div>
                                    <div class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Years</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-3xl font-black bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">{{ $about->large_scale_projects }}+</div>
                                    <div class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Projects</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 md:py-32 bg-slate-900 relative overflow-hidden" aria-labelledby="about-heading">
        <!-- Starry Galaxy Background -->
        <div class="stars-background">
            <div class="stars"></div>
            <div class="stars-layer-2"></div>
        </div>

        <!-- Background elements -->
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 via-slate-900/40 to-slate-900/50"></div>
        <div class="absolute top-1/2 left-0 w-96 h-96 bg-blue-600/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 id="about-heading" class="text-5xl md:text-6xl font-black text-white mb-4">About Me</h2>
                <div class="flex justify-center gap-2 items-center mb-6">
                    <div class="h-1 w-24 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 rounded-full"></div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto">
                <p class="text-xl text-slate-300 leading-relaxed mb-16 text-center font-light">{{ $profile->bio }}</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="group relative bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-2xl border-2 border-slate-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-2">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-600/20 to-transparent rounded-bl-full"></div>
                        <div class="text-5xl font-black bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent mb-3">{{ $about->large_scale_projects }}+</div>
                        <div class="text-slate-300 font-bold text-lg uppercase tracking-wide">Large projects</div>
                        <div class="mt-4 w-12 h-1 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full group-hover:w-full transition-all duration-300"></div>
                    </div>

                    <div class="group relative bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-2xl border-2 border-slate-700 hover:border-cyan-500 transition-all duration-300 transform hover:-translate-y-2">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-cyan-600/20 to-transparent rounded-bl-full"></div>
                        <div class="text-5xl font-black bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent mb-3">{{ $about->years_of_experience }}+</div>
                        <div class="text-slate-300 font-bold text-lg uppercase tracking-wide">Years Experience</div>
                        <div class="mt-4 w-12 h-1 bg-gradient-to-r from-cyan-600 to-blue-500 rounded-full group-hover:w-full transition-all duration-300"></div>
                    </div>

                    <div class="group relative bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-2xl border-2 border-slate-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-2">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-600/20 to-transparent rounded-bl-full"></div>
                        <div class="text-5xl font-black bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent mb-3">{{ $skills->count() }}+</div>
                        <div class="text-slate-300 font-bold text-lg uppercase tracking-wide">Technologies</div>
                        <div class="mt-4 w-12 h-1 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full group-hover:w-full transition-all duration-300"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section id="achievements" class="py-20 md:py-32 bg-slate-950 relative overflow-hidden" aria-labelledby="achievements-heading">
        <!-- Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute top-0 left-1/2 w-96 h-96 bg-blue-600/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 id="achievements-heading" class="text-5xl md:text-6xl font-black text-white mb-4">Certificates & Achievements</h2>
                <div class="flex justify-center gap-2 items-center mb-4">
                    <div class="h-1 w-24 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 rounded-full"></div>
                </div>
                <p class="text-slate-400 text-lg">Professional certifications, seminars, webinars, and recognitions</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" role="list" aria-label="Certificates and achievements">
                @foreach($achievements as $achievement)
                <div class="group bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-slate-700 hover:border-blue-500 p-6 transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden" role="listitem" aria-labelledby="achievement-title-{{ $achievement->id ?? '' }}">
                    <!-- Type badge -->
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                            @if($achievement->type === 'award') bg-yellow-500/20 text-yellow-300 border border-yellow-500/30
                            @elseif($achievement->type === 'certificate') bg-blue-500/20 text-blue-300 border border-blue-500/30
                            @else bg-purple-500/20 text-purple-300 border border-purple-500/30
                            @endif">
                            {{ $achievement->type }}
                        </span>
                    </div>

                    <!-- Icon -->
                    <div class="text-5xl mb-4">{{ $achievement->icon }}</div>

                    <!-- Title and Issuer -->
                    <h3 id="achievement-title-{{ $achievement->id ?? '' }}" class="text-xl font-bold text-white mb-2 pr-20">{{ $achievement->title }}</h3>
                    @if($achievement->issuer)
                    <p class="text-blue-400 font-semibold text-sm mb-3">{{ $achievement->issuer }}</p>
                    @endif

                    <!-- Date -->
                    @if($achievement->date)
                    <p class="text-slate-500 text-sm mb-3">{{ \Carbon\Carbon::parse($achievement->date)->format('F Y') }}</p>
                    @endif

                    <!-- Description -->
                    @if($achievement->description)
                    <p class="text-slate-400 text-sm leading-relaxed mb-4">{{ $achievement->description }}</p>
                    @endif

                    <!-- Link -->
                    @if($achievement->url)
                    <a href="{{ $achievement->url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 font-bold text-sm transition group/link focus-visible" aria-label="View {{ $achievement->title }} credential (opens in new tab)">
                        <span>View Credential</span>
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                        <span class="sr-only">(opens in new tab)</span>
                    </a>
                    @endif

                    <!-- Hover effect -->
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 md:py-32 bg-slate-900 relative overflow-hidden" aria-labelledby="projects-heading">
        <!-- Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-600/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 id="projects-heading" class="text-5xl md:text-6xl font-black text-white mb-4">Featured Projects</h2>
                <div class="flex justify-center gap-2 items-center mb-4">
                    <div class="h-1 w-24 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 rounded-full"></div>
                </div>
                <p class="text-slate-400 text-lg">Showcasing my best work and technical expertise</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" role="list" aria-label="Featured projects">
                @foreach($projects as $project)
                <div class="group project-card bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-slate-700 hover:border-blue-500 overflow-hidden transition-all duration-300 transform hover:-translate-y-3" role="listitem" aria-labelledby="project-title-{{ $project->id ?? '' }}">
                    <div class="relative overflow-hidden h-56">
                        <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.src='https://via.placeholder.com/800x600/1e293b/64748b?text={{ urlencode(str_replace(' ', '+', $project->title)) }}'" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent opacity-60"></div>
                        <div class="absolute top-4 right-4 bg-blue-600/90 backdrop-blur-sm px-3 py-1 rounded-full">
                            <span class="text-white text-xs font-bold uppercase">Featured</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 id="project-title-{{ $project->id ?? '' }}" class="text-2xl font-bold mb-3 text-white group-hover:text-blue-400 transition-colors">{{ $project->title }}</h3>
                        <p class="text-slate-400 mb-4 line-clamp-2">{{ $project->description }}</p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($project->technologies as $tech)
                            <span class="bg-slate-700/50 border border-slate-600 text-blue-300 text-xs px-3 py-1.5 rounded-lg font-medium hover:bg-blue-600 hover:text-white hover:border-blue-500 transition-all">{{ $tech }}</span>
                            @endforeach
                        </div>
                        <div class="flex gap-4 pt-4 border-t border-slate-700">
                            @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-blue-400 hover:text-blue-300 font-bold transition group/link" aria-label="View {{ $project->title }} live demo (opens in new tab)">
                                <span>Link</span>
                                <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                                <span class="sr-only">(opens in new tab)</span>
                            </a>
                            @endif
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-slate-400 hover:text-white font-bold transition group/link" aria-label="View {{ $project->title }} source code on GitHub (opens in new tab)">
                                <span>GitHub</span>
                                <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                <span class="sr-only">(opens in new tab)</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 md:py-32 bg-slate-900 relative overflow-x-clip" aria-labelledby="skills-heading">
        <!-- Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute top-1/2 right-0 w-96 h-96 bg-blue-600/10 rounded-full filter blur-3xl"></div>

        <div class="relative z-10">
            <div class="text-center mb-16 container mx-auto px-4">
                <h2 id="skills-heading" class="text-5xl md:text-6xl font-black text-white mb-4">Skills & Expertise</h2>
                <div class="flex justify-center gap-2 items-center mb-4">
                    <div class="h-1 w-24 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 rounded-full"></div>
                </div>
                <p class="text-slate-400 text-lg">Technologies I work with</p>
            </div>

            <div class="space-y-16">
                @php
                    $categories = $skills->groupBy('category');
                    $staticCategories = [
                        'Frontend', 'Backend', 'DevOps', 'Automation', 'Tools',
                        'Programming Languages', 'Documentation & Technical Communication',
                        'Database', 'Penetration Testing', 'AI'
                    ];
                    $categoryOrder = [
                        'Frontend', 'Backend', 'Database', 'DevOps', 'Automation',
                        'Tools', 'Programming Languages', 'Documentation & Technical Communication', 'AI'
                    ];
                    $orderedCategories = [];
                    foreach ($categoryOrder as $cat) {
                        if (isset($categories[$cat])) {
                            $orderedCategories[$cat] = $categories[$cat];
                        }
                    }
                    foreach ($categories as $cat => $skills) {
                        if (!isset($orderedCategories[$cat])) {
                            $orderedCategories[$cat] = $skills;
                        }
                    }
                    $categories = $orderedCategories;
                @endphp
                @foreach($categories as $category => $categorySkills)
                @continue($category === 'Automation')
                <div class="relative w-full">
                    <div class="flex justify-center mb-8">
                        <div class="relative inline-block">
                            <h3 class="text-3xl md:text-4xl font-black bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-400 bg-clip-text text-transparent px-8 py-3">
                                {{ $category }}
                            </h3>
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-blue-500 to-transparent rounded-full"></div>
                        </div>
                    </div>

                    @if($category === 'AI')
                    <div class="container mx-auto px-4">
                        <div class="flex flex-wrap justify-center gap-6">
                            @foreach($categorySkills as $skill)
                            <div class="skill-card bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border-2 border-slate-700 hover:border-blue-500 transition-all duration-300 p-4 w-48">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 flex items-center justify-center bg-white rounded-lg p-2 shadow-lg">
                                        @if($skill->logo_url)
                                        <img src="{{ $skill->logo_url }}" alt="{{ $skill->name }}" class="w-full h-full object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" loading="lazy">
                                        @endif
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-cyan-500 rounded text-white font-black text-lg {{ $skill->logo_url ? 'hidden' : '' }}">
                                            {{ strtoupper(substr($skill->name, 0, 2)) }}
                                        </div>
                                    </div>
                                    <div class="text-center w-full">
                                        <div class="font-bold text-slate-200 text-base">{{ $skill->name }}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @elseif(in_array($category, $staticCategories))
                    <div class="container mx-auto px-4">
                        <div class="flex flex-wrap justify-center gap-6">
                            @foreach($categorySkills as $skill)
                            <div class="skill-card bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border-2 border-slate-700 hover:border-blue-500 transition-all duration-300 p-4 w-48">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 flex items-center justify-center bg-white rounded-lg p-2 shadow-lg">
                                        @if($skill->logo_url)
                                        <img src="{{ $skill->logo_url }}" alt="{{ $skill->name }}" class="w-full h-full object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" loading="lazy">
                                        @endif
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-cyan-500 rounded text-white font-black text-lg {{ $skill->logo_url ? 'hidden' : '' }}">
                                            {{ strtoupper(substr($skill->name, 0, 2)) }}
                                        </div>
                                    </div>
                                    <div class="text-center w-full">
                                        <div class="font-bold text-slate-200 text-base mb-2">{{ $skill->name }}</div>
                                        <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden mb-1.5" role="progressbar" aria-valuenow="{{ $skill->proficiency }}" aria-valuemin="0" aria-valuemax="100" aria-label="{{ $skill->name }} proficiency level">
                                            <div class="skill-bar bg-gradient-to-r from-blue-600 to-cyan-500 h-1.5 rounded-full" data-width="{{ $skill->proficiency }}" style="width: 0%"></div>
                                        </div>
                                        <span class="text-blue-400 font-bold text-xs" aria-hidden="true">{{ $skill->proficiency }}%</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="relative overflow-hidden py-4 w-full">
                        <div class="scroll-container flex {{ $category === 'Database' ? 'gap-24' : 'gap-6' }} animate-scroll">
                            @foreach($categorySkills as $skill)
                            <div class="skill-card flex-shrink-0 bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border-2 border-slate-700 hover:border-blue-500 transition-all duration-300 p-4 w-48">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 flex items-center justify-center bg-white rounded-lg p-2 shadow-lg">
                                        @if($skill->logo_url)
                                        <img src="{{ $skill->logo_url }}" alt="{{ $skill->name }}" class="w-full h-full object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" loading="lazy">
                                        @endif
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-cyan-500 rounded text-white font-black text-lg {{ $skill->logo_url ? 'hidden' : '' }}">
                                            {{ strtoupper(substr($skill->name, 0, 2)) }}
                                        </div>
                                    </div>
                                    <div class="text-center w-full">
                                        <div class="font-bold text-slate-200 text-base mb-2">{{ $skill->name }}</div>
                                        <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden mb-1.5" role="progressbar" aria-valuenow="{{ $skill->proficiency }}" aria-valuemin="0" aria-valuemax="100" aria-label="{{ $skill->name }} proficiency level">
                                            <div class="skill-bar bg-gradient-to-r from-blue-600 to-cyan-500 h-1.5 rounded-full" data-width="{{ $skill->proficiency }}" style="width: 0%"></div>
                                        </div>
                                        <span class="text-blue-400 font-bold text-xs" aria-hidden="true">{{ $skill->proficiency }}%</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @foreach($categorySkills as $skill)
                            <div class="skill-card flex-shrink-0 bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border-2 border-slate-700 hover:border-blue-500 transition-all duration-300 p-4 w-48">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 flex items-center justify-center bg-white rounded-lg p-2 shadow-lg">
                                        @if($skill->logo_url)
                                        <img src="{{ $skill->logo_url }}" alt="{{ $skill->name }}" class="w-full h-full object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" loading="lazy">
                                        @endif
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-cyan-500 rounded text-white font-black text-lg {{ $skill->logo_url ? 'hidden' : '' }}">
                                            {{ strtoupper(substr($skill->name, 0, 2)) }}
                                        </div>
                                    </div>
                                    <div class="text-center w-full">
                                        <div class="font-bold text-slate-200 text-base mb-2">{{ $skill->name }}</div>
                                        <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden mb-1.5" role="progressbar" aria-valuenow="{{ $skill->proficiency }}" aria-valuemin="0" aria-valuemax="100" aria-label="{{ $skill->name }} proficiency level">
                                            <div class="skill-bar bg-gradient-to-r from-blue-600 to-cyan-500 h-1.5 rounded-full" data-width="{{ $skill->proficiency }}" style="width: 0%"></div>
                                        </div>
                                        <span class="text-blue-400 font-bold text-xs" aria-hidden="true">{{ $skill->proficiency }}%</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Characteristics Section -->
    <section id="characteristics" class="py-20 md:py-32 bg-slate-950 relative overflow-hidden" aria-labelledby="characteristics-heading">
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute top-0 left-1/2 w-96 h-96 bg-purple-600/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 id="characteristics-heading" class="text-5xl md:text-6xl font-black text-white mb-4">Key Characteristics</h2>
                <div class="flex justify-center gap-2 items-center mb-4">
                    <div class="h-1 w-24 bg-gradient-to-r from-purple-600 via-pink-500 to-purple-600 rounded-full"></div>
                </div>
                <p class="text-slate-400 text-lg mb-6">Defining traits that shape my professional identity</p>
                {{-- <a href="{{ route('characteristic.index') }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 font-bold transition-all group">
                    View Detailed Characteristics
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a> --}}
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" role="list">
                @foreach($characteristics as $characteristic)
                <div class="group bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-slate-700 hover:border-purple-500 p-6 transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                    <div class="mb-4 w-12 h-12 flex items-center justify-center bg-transparent rounded-full">
                        @if(filter_var($characteristic->icon, FILTER_VALIDATE_URL) || str_starts_with($characteristic->icon, 'data:image'))
                        <img src="{{ $characteristic->icon }}" alt="{{ $characteristic->characteristic }}" class="w-full h-full object-contain bg-transparent">
                        @else
                        <span class="text-5xl leading-none">{{ $characteristic->icon }}</span>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">{{ $characteristic->characteristic }}</h3>
                    <p class="text-slate-400 text-sm leading-relaxed mb-4">{{ $characteristic->description }}</p>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-purple-600 via-pink-500 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Seminars Section -->
    <section id="seminars" class="py-20 md:py-32 bg-slate-900 relative overflow-hidden" aria-labelledby="seminars-heading">
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-600/10 rounded-full filter blur-3xl"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 id="seminars-heading" class="text-5xl md:text-6xl font-black text-white mb-4">Seminars & Training</h2>
                <div class="flex justify-center gap-2 items-center mb-6">
                    <div class="h-1 w-24 bg-gradient-to-r from-purple-600 via-pink-500 to-purple-600 rounded-full"></div>
                </div>
                <p class="text-slate-400 text-xl max-w-2xl mx-auto">Professional development materials</p>
            </div>

            @if(count($seminars) > 0)
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-8 gap-3 max-w-7xl mx-auto">
                @foreach($seminars as $seminar)
                <a href="{{ $seminar['url'] }}" target="_blank" class="group block">
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg border border-slate-700 hover:border-purple-500 transition-all h-full overflow-hidden">
                        <div class="relative bg-gradient-to-br from-purple-600 to-pink-600 h-32 overflow-hidden">
                            @if($seminar['is_image'])
                                <img src="{{ $seminar['url'] }}" alt="{{ $seminar['name'] }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-3">
                            <h3 class="text-white text-[11px] font-medium line-clamp-2">{{ $seminar['name'] }}</h3>
                            <div class="mt-2">
                                <span class="px-2 py-1 text-[9px] font-semibold rounded {{ $seminar['badge_class'] }} block truncate text-center">{{ $seminar['type'] }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- References Section -->
    <section id="references" class="py-20 md:py-32 bg-slate-900 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">Character References</h2>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">Professional testimonials</p>
            </div>
            <div class="flex flex-wrap justify-center gap-8 max-w-7xl mx-auto">
                @foreach($characterReferences as $reference)
                <div class="w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.33rem)] group bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border border-slate-700 hover:border-purple-500 p-6 transition-all">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-600 to-pink-600 flex items-center justify-center text-white text-xl font-bold overflow-hidden">
                            @if($reference->image) <img src="{{ $reference->image }}" class="w-full h-full object-cover"> @else {{ substr($reference->name, 0, 1) }} @endif
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">{{ $reference->name }}</h3>
                            <p class="text-sm text-slate-400">{{ $reference->position }}</p>
                            <p class="text-sm text-purple-400">{{ $reference->company }}</p>
                        </div>
                    </div>
                    <p class="text-slate-300 text-sm italic mb-4">"{{ $reference->testimonial }}"</p>
                    <div class="pt-4 border-t border-slate-700 text-sm text-slate-400">
                        <a href="mailto:{{ $reference->email }}" class="hover:text-purple-400">{{ $reference->email }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 md:py-32 bg-slate-950 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-5xl md:text-6xl font-black text-white mb-4">Let's Connect</h2>
                <p class="text-slate-400 text-xl max-w-2xl mx-auto">Have a project in mind? Let's collaborate.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
                <div class="space-y-8">
                    <div class="p-6 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-slate-700">
                        <div class="font-bold text-slate-300 text-sm uppercase mb-1">Email</div>
                        <a href="mailto:{{ $profile->email }}" class="text-white text-lg font-semibold hover:text-blue-400">{{ $profile->email }}</a>
                    </div>
                    @if($profile->location)
                    <div class="p-6 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-slate-700">
                        <div class="font-bold text-slate-300 text-sm uppercase mb-1">Location</div>
                        <div class="text-white text-lg font-semibold">{{ $profile->location }}</div>
                    </div>
                    @endif
                </div>
                <div class="bg-gradient-to-br from-slate-800 to-slate-900 border-2 border-slate-700 rounded-2xl p-8">
                    <form action="https://formspree.io/f/mvgwedvb" method="POST" class="space-y-5">
                        <input type="hidden" name="_next" value="{{ url()->current() }}?success=true">
                        <div>
                            <label class="block text-sm font-bold mb-2 text-slate-300 uppercase">Name</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 bg-slate-900 border-2 border-slate-700 rounded-lg text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-slate-300 uppercase">Email</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 bg-slate-900 border-2 border-slate-700 rounded-lg text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-slate-300 uppercase">Message</label>
                            <textarea name="message" rows="5" required class="w-full px-4 py-3 bg-slate-900 border-2 border-slate-700 rounded-lg text-white resize-none"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white py-4 rounded-lg font-bold text-lg transition-all transform hover:scale-105">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const target = document.querySelector(targetId);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
                // Close mobile menu if open
                const menu = document.getElementById('mobile-menu');
                const button = document.getElementById('mobile-menu-button');
                if (menu && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                    button.setAttribute('aria-expanded', 'false');
                }
            }
        });
    });

    // Skill bar animation
    const skillObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const skillBars = entry.target.querySelectorAll('.skill-bar');
                skillBars.forEach(bar => {
                    const width = bar.getAttribute('data-width');
                    setTimeout(() => { bar.style.width = width + '%'; }, 100);
                });
                skillObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    const skillsSection = document.querySelector('#skills');
    if (skillsSection) skillObserver.observe(skillsSection);
</script>
@endsection