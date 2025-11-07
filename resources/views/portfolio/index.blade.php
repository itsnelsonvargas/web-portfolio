<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name }} - {{ $profile->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
        }
        .animate-slideInLeft {
            animation: slideInLeft 0.6s ease-out forwards;
        }
        .animate-slideInRight {
            animation: slideInRight 0.6s ease-out forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .opacity-0 { opacity: 0; }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(-5%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }
            50% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }

        .skill-bar {
            transition: width 1.5s ease-out;
        }

        .project-card {
            transition: all 0.3s ease;
        }
        .project-card:hover {
            transform: translateY(-8px);
        }

        .bg-grid-pattern {
            background-image:
                linear-gradient(to right, rgba(148, 163, 184, 0.1) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(148, 163, 184, 0.1) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Starry Galaxy Background */
        .stars-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .stars {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(3px 3px at 20% 30%, white, transparent),
                radial-gradient(3px 3px at 60% 70%, white, transparent),
                radial-gradient(2px 2px at 50% 50%, white, transparent),
                radial-gradient(2px 2px at 80% 10%, white, transparent),
                radial-gradient(3px 3px at 90% 60%, white, transparent),
                radial-gradient(2px 2px at 33% 80%, white, transparent),
                radial-gradient(2px 2px at 15% 90%, white, transparent),
                radial-gradient(3px 3px at 45% 20%, white, transparent),
                radial-gradient(2px 2px at 25% 40%, white, transparent),
                radial-gradient(2px 2px at 75% 25%, white, transparent),
                radial-gradient(3px 3px at 10% 60%, white, transparent),
                radial-gradient(2px 2px at 95% 45%, white, transparent),
                radial-gradient(2px 2px at 40% 15%, white, transparent),
                radial-gradient(2px 2px at 65% 85%, white, transparent),
                radial-gradient(3px 3px at 30% 55%, white, transparent),
                radial-gradient(2px 2px at 85% 30%, white, transparent);
            background-size: 300px 300px;
            filter: blur(0.8px);
            opacity: 0.8;
            animation: twinkle 4s ease-in-out infinite alternate;
        }

        .stars-layer-2 {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(2px 2px at 10% 20%, rgba(147, 197, 253, 1), transparent),
                radial-gradient(2px 2px at 40% 40%, rgba(147, 197, 253, 1), transparent),
                radial-gradient(2px 2px at 70% 60%, rgba(125, 211, 252, 1), transparent),
                radial-gradient(2px 2px at 25% 75%, rgba(147, 197, 253, 1), transparent),
                radial-gradient(2px 2px at 85% 85%, rgba(125, 211, 252, 1), transparent),
                radial-gradient(2px 2px at 55% 15%, rgba(147, 197, 253, 1), transparent),
                radial-gradient(2px 2px at 15% 45%, rgba(125, 211, 252, 1), transparent),
                radial-gradient(2px 2px at 92% 25%, rgba(147, 197, 253, 1), transparent),
                radial-gradient(2px 2px at 35% 65%, rgba(125, 211, 252, 1), transparent),
                radial-gradient(2px 2px at 78% 48%, rgba(147, 197, 253, 1), transparent);
            background-size: 250px 250px;
            filter: blur(1px);
            opacity: 0.7;
            animation: twinkle 6s ease-in-out infinite alternate-reverse;
        }

        @keyframes twinkle {
            0% {
                opacity: 0.5;
                transform: scale(1);
            }
            100% {
                opacity: 1;
                transform: scale(1.05);
            }
        }

        /* Infinite Scroll Animation for Skills */
        .scroll-container {
            animation: scroll 5.33s linear infinite;
        }

        .scroll-container:hover {
            animation-play-state: paused;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        /* Skill card hover effects */
        .skill-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-slate-900/95 backdrop-blur-md border-b border-slate-800 fixed w-full top-0 z-50 shadow-xl">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="text-xl font-bold text-white tracking-tight">{{ $profile->name }}</div>
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide">
                        Home
                    </a>
                    <a href="#about" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide">
                        About
                    </a>
                    <a href="#projects" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide">
                        Projects
                    </a>
                    <a href="#skills" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide">
                        Skills
                    </a>
                    <a href="#contact" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-colors duration-200 font-medium text-sm uppercase tracking-wide">
                        Contact
                    </a>
                </div>
                <!-- Mobile Menu Button -->
                <button class="md:hidden text-slate-300 hover:text-white transition" id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            <!-- Mobile Menu -->
            <div class="hidden md:hidden mt-4 space-y-2" id="mobile-menu">
                <a href="#home" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition">Home</a>
                <a href="#about" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition">About</a>
                <a href="#projects" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition">Projects</a>
                <a href="#skills" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition">Skills</a>
                <a href="#contact" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative pt-24 pb-20 md:pt-32 md:pb-32 bg-slate-950 overflow-hidden">
        <!-- Animated Grid Pattern -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.03]"></div>

        <!-- Dynamic gradient orbs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 rounded-full mix-blend-screen filter blur-3xl opacity-10 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-500 rounded-full mix-blend-screen filter blur-3xl opacity-10 animate-pulse" style="animation-delay: 1s;"></div>

        <!-- Diagonal accent stripe -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-bl from-blue-600/5 via-transparent to-transparent transform skew-x-12"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-16">
                <div class="md:w-3/5 text-center md:text-left opacity-0 animate-slideInLeft">
                    <!-- Status Badge with glow -->
                    <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-500/10 to-emerald-600/10 border border-emerald-500/30 rounded-lg mb-8 backdrop-blur-sm">
                        <div class="relative">
                            <div class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-pulse"></div>
                            <div class="absolute inset-0 w-2.5 h-2.5 bg-emerald-400 rounded-full animate-ping"></div>
                        </div>
                        <span class="text-emerald-300 text-sm font-bold uppercase tracking-wider">Available for Work</span>
                    </div>

                    <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white mb-8 leading-none">
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
                        <a href="#contact" class="group relative bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-cyan-500 text-white px-10 py-5 rounded-lg font-bold text-lg transition-all duration-300 flex items-center justify-center gap-3 shadow-2xl shadow-blue-600/30 hover:shadow-blue-500/50 transform hover:scale-105">
                            <span>Let's Build Something</span>
                            <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        @if($profile->resume_url)
                        <a href="{{ $profile->resume_url }}" class="group relative bg-slate-800/50 hover:bg-slate-700/50 border-2 border-slate-600 hover:border-blue-500 text-slate-200 hover:text-white px-10 py-5 rounded-lg font-bold text-lg transition-all duration-300 flex items-center justify-center gap-3 backdrop-blur-sm transform hover:scale-105">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <span>View Resume</span>
                        </a>
                        @endif
                    </div>

                    <!-- Social Links with Icons -->
                    <div class="flex flex-wrap justify-center md:justify-start gap-5 pt-8 border-t border-slate-800/50">
                        @foreach($socialLinks as $link)
                        <a href="{{ $link->url }}" target="_blank" class="group flex items-center gap-2 text-slate-400 hover:text-blue-400 transition-all duration-200">
                            <div class="w-10 h-10 rounded-lg bg-slate-800/50 border border-slate-700 group-hover:border-blue-500 group-hover:bg-slate-700/50 flex items-center justify-center transition-all duration-200 group-hover:scale-110">
                                <span class="text-xs font-bold">{{ substr($link->platform, 0, 2) }}</span>
                            </div>
                            <span class="font-medium text-sm">{{ $link->platform }}</span>
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
                            <img src="{{ $profile->profile_image }}" alt="{{ $profile->name }}" class="relative w-72 h-72 md:w-80 md:h-80 lg:w-96 lg:h-96 object-contain rounded-2xl shadow-2xl border-4 border-slate-700">
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
    <section id="about" class="py-20 md:py-32 bg-slate-900 relative overflow-hidden">
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
                <h2 class="text-5xl md:text-6xl font-black text-white mb-4">About Me</h2>
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
    <section id="achievements" class="py-20 md:py-32 bg-slate-950 relative overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute top-0 left-1/2 w-96 h-96 bg-blue-600/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-5xl md:text-6xl font-black text-white mb-4">Certificates & Achievements</h2>
                <div class="flex justify-center gap-2 items-center mb-4">
                    <div class="h-1 w-24 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 rounded-full"></div>
                </div>
                <p class="text-slate-400 text-lg">Professional certifications, seminars, webinars, and recognitions</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($achievements as $achievement)
                <div class="group bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-slate-700 hover:border-blue-500 p-6 transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
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
                    <h3 class="text-xl font-bold text-white mb-2 pr-20">{{ $achievement->title }}</h3>
                    @if($achievement->issuer)
                    <p class="text-blue-400 font-semibold text-sm mb-3">{{ $achievement->issuer }}</p>
                    @endif

                    <!-- Date -->
                    @if($achievement->date)
                    <p class="text-slate-500 text-sm mb-3">{{ $achievement->date->format('F Y') }}</p>
                    @endif

                    <!-- Description -->
                    @if($achievement->description)
                    <p class="text-slate-400 text-sm leading-relaxed mb-4">{{ $achievement->description }}</p>
                    @endif

                    <!-- Link -->
                    @if($achievement->url)
                    <a href="{{ $achievement->url }}" target="_blank" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 font-bold text-sm transition group/link">
                        <span>View Credential</span>
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
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
    <section id="projects" class="py-20 md:py-32 bg-slate-900 relative overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-600/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-5xl md:text-6xl font-black text-white mb-4">Featured Projects</h2>
                <div class="flex justify-center gap-2 items-center mb-4">
                    <div class="h-1 w-24 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 rounded-full"></div>
                </div>
                <p class="text-slate-400 text-lg">Showcasing my best work and technical expertise</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                <div class="group project-card bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-slate-700 hover:border-blue-500 overflow-hidden transition-all duration-300 transform hover:-translate-y-3">
                    <div class="relative overflow-hidden h-56">
                        <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent opacity-60"></div>
                        <div class="absolute top-4 right-4 bg-blue-600/90 backdrop-blur-sm px-3 py-1 rounded-full">
                            <span class="text-white text-xs font-bold uppercase">Featured</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 text-white group-hover:text-blue-400 transition-colors">{{ $project->title }}</h3>
                        <p class="text-slate-400 mb-4 line-clamp-2">{{ $project->description }}</p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($project->technologies as $tech)
                            <span class="bg-slate-700/50 border border-slate-600 text-blue-300 text-xs px-3 py-1.5 rounded-lg font-medium hover:bg-blue-600 hover:text-white hover:border-blue-500 transition-all">{{ $tech }}</span>
                            @endforeach
                        </div>
                        <div class="flex gap-4 pt-4 border-t border-slate-700">
                            @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" class="flex items-center gap-2 text-blue-400 hover:text-blue-300 font-bold transition group/link">
                                <span>Link</span>
                                <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                            @endif
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="flex items-center gap-2 text-slate-400 hover:text-white font-bold transition group/link">
                                <span>GitHub</span>
                                <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
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
    <section id="skills" class="py-20 md:py-32 bg-slate-900 relative overflow-x-clip">
        <!-- Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute top-1/2 right-0 w-96 h-96 bg-blue-600/10 rounded-full filter blur-3xl"></div>

        <div class="relative z-10">
            <div class="text-center mb-16 container mx-auto px-4">
                <h2 class="text-5xl md:text-6xl font-black text-white mb-4">Skills & Expertise</h2>
                <div class="flex justify-center gap-2 items-center mb-4">
                    <div class="h-1 w-24 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 rounded-full"></div>
                </div>
                <p class="text-slate-400 text-lg">Technologies I work with</p>
            </div>

            <div class="space-y-16">
                @php
                    $categories = $skills->groupBy('category');
                    $staticCategories = ['Frontend', 'Backend', 'DevOps', 'Tools', 'Programming Languages', 'Database'];
                    // Define category order to ensure AI appears after Programming Languages
                    $categoryOrder = ['Frontend', 'Backend', 'Database', 'DevOps', 'Tools', 'Programming Languages', 'AI'];
                    $orderedCategories = [];
                    foreach ($categoryOrder as $cat) {
                        if (isset($categories[$cat])) {
                            $orderedCategories[$cat] = $categories[$cat];
                        }
                    }
                    // Add any remaining categories not in the order list
                    foreach ($categories as $cat => $skills) {
                        if (!isset($orderedCategories[$cat])) {
                            $orderedCategories[$cat] = $skills;
                        }
                    }
                    $categories = $orderedCategories;
                @endphp
                @foreach($categories as $category => $categorySkills)
                <div class="relative w-full">
                    <!-- Category Title - Centered with Badge Design -->
                    <div class="flex justify-center mb-8">
                        <div class="relative inline-block">
                            <h3 class="text-3xl md:text-4xl font-black bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-400 bg-clip-text text-transparent px-8 py-3">
                                {{ $category }}
                            </h3>
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-blue-500 to-transparent rounded-full"></div>
                        </div>
                    </div>

                    @if($category === 'AI')
                    <!-- AI Section - No Percentage Bars -->
                    <div class="container mx-auto px-4">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6 justify-items-center">
                            @foreach($categorySkills as $skill)
                            <div class="skill-card bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border-2 border-slate-700 hover:border-blue-500 transition-all duration-300 p-4 w-48">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 flex items-center justify-center bg-white rounded-lg p-2 shadow-lg">
                                        @if($skill->logo_url)
                                        <img src="{{ $skill->logo_url }}" alt="{{ $skill->name }}" class="w-full h-full object-contain">
                                        @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-cyan-500 rounded text-white font-black text-lg">
                                            {{ strtoupper(substr($skill->name, 0, 2)) }}
                                        </div>
                                        @endif
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
                    <!-- Static Grid Layout for Frontend, Backend, DevOps, Tools, Programming Languages, Database -->
                    <div class="container mx-auto px-4">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6 justify-items-center">
                            @foreach($categorySkills as $skill)
                            <div class="skill-card bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border-2 border-slate-700 hover:border-blue-500 transition-all duration-300 p-4 w-48">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 flex items-center justify-center bg-white rounded-lg p-2 shadow-lg">
                                        @if($skill->logo_url)
                                        <img src="{{ $skill->logo_url }}" alt="{{ $skill->name }}" class="w-full h-full object-contain">
                                        @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-cyan-500 rounded text-white font-black text-lg">
                                            {{ strtoupper(substr($skill->name, 0, 2)) }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="text-center w-full">
                                        <div class="font-bold text-slate-200 text-base mb-2">{{ $skill->name }}</div>
                                        <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden mb-1.5">
                                            <div class="skill-bar bg-gradient-to-r from-blue-600 to-cyan-500 h-1.5 rounded-full" data-width="{{ $skill->proficiency }}" style="width: 0%"></div>
                                        </div>
                                        <span class="text-blue-400 font-bold text-xs">{{ $skill->proficiency }}%</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <!-- Scrolling Container - Full Width for other categories -->
                    <div class="relative overflow-hidden py-4 w-full">
                        <div class="scroll-container flex {{ $category === 'Database' ? 'gap-24' : 'gap-6' }} animate-scroll">
                            @foreach($categorySkills as $skill)
                            <div class="skill-card flex-shrink-0 bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border-2 border-slate-700 hover:border-blue-500 transition-all duration-300 p-4 w-48">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 flex items-center justify-center bg-white rounded-lg p-2 shadow-lg">
                                        @if($skill->logo_url)
                                        <img src="{{ $skill->logo_url }}" alt="{{ $skill->name }}" class="w-full h-full object-contain">
                                        @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-cyan-500 rounded text-white font-black text-lg">
                                            {{ strtoupper(substr($skill->name, 0, 2)) }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="text-center w-full">
                                        <div class="font-bold text-slate-200 text-base mb-2">{{ $skill->name }}</div>
                                        <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden mb-1.5">
                                            <div class="skill-bar bg-gradient-to-r from-blue-600 to-cyan-500 h-1.5 rounded-full" data-width="{{ $skill->proficiency }}" style="width: 0%"></div>
                                        </div>
                                        <span class="text-blue-400 font-bold text-xs">{{ $skill->proficiency }}%</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- Duplicate items for seamless loop -->
                            @foreach($categorySkills as $skill)
                            <div class="skill-card flex-shrink-0 bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border-2 border-slate-700 hover:border-blue-500 transition-all duration-300 p-4 w-48">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 flex items-center justify-center bg-white rounded-lg p-2 shadow-lg">
                                        @if($skill->logo_url)
                                        <img src="{{ $skill->logo_url }}" alt="{{ $skill->name }}" class="w-full h-full object-contain">
                                        @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-cyan-500 rounded text-white font-black text-lg">
                                            {{ strtoupper(substr($skill->name, 0, 2)) }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="text-center w-full">
                                        <div class="font-bold text-slate-200 text-base mb-2">{{ $skill->name }}</div>
                                        <div class="w-full bg-slate-800 rounded-full h-1.5 overflow-hidden mb-1.5">
                                            <div class="skill-bar bg-gradient-to-r from-blue-600 to-cyan-500 h-1.5 rounded-full" data-width="{{ $skill->proficiency }}" style="width: 0%"></div>
                                        </div>
                                        <span class="text-blue-400 font-bold text-xs">{{ $skill->proficiency }}%</span>
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

    <!-- Seminars, Webinars, and Trainings Section -->
    <section id="seminars" class="py-20 md:py-32 bg-slate-900 relative overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-600/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-5xl md:text-6xl font-black text-white mb-4">Seminars, Webinars, and Trainings</h2>
                <div class="flex justify-center gap-2 items-center mb-6">
                    <div class="h-1 w-24 bg-gradient-to-r from-purple-600 via-pink-500 to-purple-600 rounded-full"></div>
                </div>
                <p class="text-slate-400 text-xl max-w-2xl mx-auto">Explore certificates and materials from professional development sessions</p>
            </div>

            @if(count($seminars) > 0)
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-8 gap-3 max-w-7xl mx-auto">
                @foreach($seminars as $seminar)
                <a href="{{ $seminar['url'] }}" target="_blank" class="group block" style="aspect-ratio: 1 / 1.3; overflow: hidden;">
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg border border-slate-700 hover:border-purple-500 transition-all duration-300 flex flex-col hover:shadow-lg hover:shadow-purple-500/20 hover:-translate-y-1 h-full" style="overflow: hidden;">
                        <!-- Icon/Thumbnail -->
                        <div class="relative flex-shrink-0 bg-gradient-to-br from-purple-600 to-pink-600" style="height: 50%; overflow: hidden; position: relative;">
                            @if($seminar['is_image'])
                                <!-- Display actual image -->
                                <img src="{{ $seminar['url'] }}" alt="{{ $seminar['name'] }}" style="width: 130%; height: 130%; object-fit: cover; display: block; transform: scale(1.0); transform-origin: top left; margin-left: -15%; margin-top: -15%;">
                            @elseif($seminar['extension'] === 'pdf')
                                <!-- Embed PDF preview -->
                                <div style="width: 100%; height: 100%; overflow: hidden; position: relative;">
                                    <iframe src="{{ $seminar['url'] }}#view=FitH&toolbar=0&navpanes=0&scrollbar=0" style="width: 130%; height: 130%; border: 0; pointer-events: none; display: block; position: absolute; top: -15%; left: -15%;" scrolling="no"></iframe>
                                </div>
                            @else
                                <!-- Default icon for other file types -->
                                <div style="width: 100%; height: 100%; padding: 1rem; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                                    <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.1);"></div>
                                    <svg style="width: 1.5rem; height: 1.5rem; color: white; position: relative; z-index: 10;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-3 flex-1 flex flex-col justify-between" style="height: 50%;">
                            <h3 class="text-white font-medium text-[11px] line-clamp-3 group-hover:text-purple-400 transition-colors leading-tight overflow-hidden" style="height: 3.3em;">{{ $seminar['name'] }}</h3>

                            <div class="mt-auto pt-2">
                                <span class="px-2 py-1 text-[9px] font-semibold rounded text-center {{ $seminar['badge_class'] }} block truncate">
                                    {{ $seminar['type'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <div class="inline-block p-6 bg-slate-800/50 rounded-2xl border-2 border-slate-700">
                    <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-slate-400 text-lg">No seminars or webinars available yet</p>
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- Character References Section -->
    <section id="references" class="py-20 md:py-32 bg-slate-900 relative overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-600/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    <span class="bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">
                        Character References
                    </span>
                </h2>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">
                    Testimonials from professionals I've had the privilege to work with
                </p>
            </div>

            @if(count($characterReferences) > 0)
            <div class="flex flex-wrap justify-center gap-8 max-w-7xl mx-auto">
                @foreach($characterReferences as $reference)
                <div class="w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.33rem)] group bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border border-slate-700 hover:border-purple-500 transition-all duration-300 overflow-hidden">
                    <div class="p-6">
                        <!-- Profile Header -->
                        <div class="flex items-start gap-4 mb-4">
                            <div class="flex-shrink-0">
                                @if($reference->image)
                                <img src="{{ $reference->image }}" alt="{{ $reference->name }}" class="w-16 h-16 rounded-full border-2 border-purple-500/50">
                                @else
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-600 to-pink-600 flex items-center justify-center text-white text-xl font-bold">
                                    {{ substr($reference->name, 0, 1) }}
                                </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-white mb-1">{{ $reference->name }}</h3>
                                <p class="text-sm text-slate-400 mb-1">{{ $reference->position }}</p>
                                <p class="text-sm text-purple-400">{{ $reference->company }}</p>
                            </div>
                        </div>

                        <!-- Relationship Badge -->
                        <div class="mb-4">
                            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full bg-purple-500/20 text-purple-400 border border-purple-500/30">
                                {{ $reference->relationship }}
                            </span>
                        </div>

                        <!-- Testimonial -->
                        <div class="mb-4">
                            <p class="text-slate-300 text-sm leading-relaxed italic">
                                "{{ $reference->testimonial }}"
                            </p>
                        </div>

                        <!-- Contact Info -->
                        <div class="pt-4 border-t border-slate-700 space-y-2">
                            <div class="flex items-center gap-2 text-sm text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <a href="mailto:{{ $reference->email }}" class="hover:text-purple-400 transition-colors">
                                    {{ $reference->email }}
                                </a>
                            </div>
                            @if($reference->phone)
                            <div class="flex items-center gap-2 text-sm text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>{{ $reference->phone }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <p class="text-slate-400">No character references available at the moment.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 md:py-32 bg-slate-950 relative overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute top-0 left-1/2 w-96 h-96 bg-blue-600/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-5xl md:text-6xl font-black text-white mb-4">Let's Connect</h2>
                <div class="flex justify-center gap-2 items-center mb-6">
                    <div class="h-1 w-24 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 rounded-full"></div>
                </div>
                <p class="text-slate-400 text-xl max-w-2xl mx-auto">Have a project in mind? Let's collaborate and build something extraordinary together.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
                <!-- Contact Info -->
                <div class="space-y-8">
                    <div class="group p-6 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-slate-700 hover:border-blue-500 transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-xl bg-blue-600/20 border border-blue-500/30 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-slate-300 mb-1 uppercase tracking-wide text-sm">Email</div>
                                <a href="mailto:{{ $profile->email }}" class="text-white text-lg font-semibold hover:text-blue-400 transition">{{ $profile->email }}</a>
                            </div>
                        </div>
                    </div>

                    @if($profile->phone)
                    <div class="group p-6 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-slate-700 hover:border-cyan-500 transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-xl bg-cyan-600/20 border border-cyan-500/30 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-slate-300 mb-1 uppercase tracking-wide text-sm">Phone</div>
                                <a href="tel:{{ $profile->phone }}" class="text-white text-lg font-semibold hover:text-cyan-400 transition">{{ $profile->phone }}</a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($profile->location)
                    <div class="group p-6 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-slate-700 hover:border-blue-500 transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-xl bg-blue-600/20 border border-blue-500/30 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-slate-300 mb-1 uppercase tracking-wide text-sm">Location</div>
                                <div class="text-white text-lg font-semibold">{{ $profile->location }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Contact Form -->
                <div class="bg-gradient-to-br from-slate-800 to-slate-900 border-2 border-slate-700 rounded-2xl p-8">
                    @if(session('success') || request()->get('success'))
                    <div class="bg-emerald-500/20 border-2 border-emerald-500 text-emerald-300 px-4 py-3 rounded-lg mb-6 font-semibold">
                        Thank you for your message! I will get back to you soon.
                    </div>
                    @endif

                    <form action="https://formspree.io/f/mvgwedvb" method="POST" class="space-y-5">
                        <input type="hidden" name="_next" value="{{ url()->current() }}?success=true">
                        <input type="hidden" name="_subject" value="New Portfolio Contact from {{ old('name', 'visitor') }}">
                        <div>
                            <label for="name" class="block text-sm font-bold mb-2 text-slate-300 uppercase tracking-wide">Name *</label>
                            <input type="text" id="name" name="name" required class="w-full px-4 py-3 bg-slate-900 border-2 border-slate-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 transition" placeholder="John Doe" value="{{ old('name') }}">
                            @error('name')<span class="text-red-400 text-sm font-semibold">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-bold mb-2 text-slate-300 uppercase tracking-wide">Email *</label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-3 bg-slate-900 border-2 border-slate-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 transition" placeholder="john@example.com" value="{{ old('email') }}">
                            @error('email')<span class="text-red-400 text-sm font-semibold">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-bold mb-2 text-slate-300 uppercase tracking-wide">Subject</label>
                            <input type="text" id="subject" name="subject" class="w-full px-4 py-3 bg-slate-900 border-2 border-slate-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 transition" placeholder="Project Inquiry" value="{{ old('subject') }}">
                            @error('subject')<span class="text-red-400 text-sm font-semibold">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-bold mb-2 text-slate-300 uppercase tracking-wide">Message *</label>
                            <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3 bg-slate-900 border-2 border-slate-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 transition resize-none" placeholder="Tell me about your project...">{{ old('message') }}</textarea>
                            @error('message')<span class="text-red-400 text-sm font-semibold">{{ $message }}</span>@enderror
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-cyan-500 text-white px-8 py-4 rounded-lg font-bold text-lg transition-all duration-300 shadow-2xl shadow-blue-600/30 hover:shadow-blue-500/50 transform hover:scale-105 flex items-center justify-center gap-2">
                            <span>Send Message</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black border-t border-slate-800 py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-center md:text-left">
                    <div class="text-2xl font-black text-white mb-2">{{ $profile->name }}</div>
                    <p class="text-slate-400">{{ $profile->title }}</p>
                </div>

                <div class="flex gap-4">
                    @foreach($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" class="w-12 h-12 rounded-lg bg-slate-900 border border-slate-700 hover:border-blue-500 hover:bg-slate-800 flex items-center justify-center transition-all duration-200 hover:scale-110 group">
                        <span class="text-xs font-bold text-slate-400 group-hover:text-blue-400">{{ substr($link->platform, 0, 2) }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-slate-800 text-center">
                <p class="text-slate-500">&copy; {{ date('Y') }} {{ $profile->name }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                    // Close mobile menu if open
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });
        });

        // Animate skill bars when they come into view
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '0px 0px -100px 0px'
        };

        const skillObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const skillBars = entry.target.querySelectorAll('.skill-bar');
                    skillBars.forEach(bar => {
                        const width = bar.getAttribute('data-width');
                        setTimeout(() => {
                            bar.style.width = width + '%';
                        }, 100);
                    });
                    skillObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        const skillsSection = document.querySelector('#skills');
        if (skillsSection) {
            skillObserver.observe(skillsSection);
        }

        // Scroll-based navigation highlighting
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('nav a[href^="#"]');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= sectionTop - 100) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('text-blue-600');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('text-blue-600');
                }
            });
        });

        // Add scroll-to-top button
        const scrollBtn = document.createElement('button');
        scrollBtn.innerHTML = '↑';
        scrollBtn.className = 'fixed bottom-8 right-8 bg-blue-600 text-white w-12 h-12 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 opacity-0 pointer-events-none z-50';
        scrollBtn.style.fontSize = '24px';
        document.body.appendChild(scrollBtn);

        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                scrollBtn.style.opacity = '1';
                scrollBtn.style.pointerEvents = 'auto';
            } else {
                scrollBtn.style.opacity = '0';
                scrollBtn.style.pointerEvents = 'none';
            }
        });

        scrollBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
