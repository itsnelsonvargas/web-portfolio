<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Primary Meta Tags -->
    <title>{{ $profile->name }} - {{ $profile->title }} | Portfolio</title>
    <meta name="title" content="{{ $profile->name }} - {{ $profile->title }} | Portfolio">
    <meta name="description" content="{{ Str::limit(strip_tags($profile->bio ?? 'Professional web developer portfolio showcasing projects, skills, and expertise.'), 160) }}">
    <meta name="keywords" content="{{ $profile->title }}, web developer, portfolio, {{ collect($skills)->pluck('name')->take(10)->implode(', ') }}, {{ $profile->location ?? '' }}, freelance developer, software developer">
    <meta name="author" content="{{ $profile->name }}">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $profile->name }} - {{ $profile->title }} | Portfolio">
    <meta property="og:description" content="{{ Str::limit(strip_tags($profile->bio ?? 'Professional web developer portfolio showcasing projects, skills, and expertise.'), 160) }}">
    <meta property="og:image" content="{{ $profile->profile_image ? (str_starts_with($profile->profile_image, 'http') ? $profile->profile_image : url($profile->profile_image)) : url('/images/portfolio-image.JPG') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $profile->name }} - {{ $profile->title }}">
    <meta property="og:site_name" content="{{ $profile->name }} Portfolio">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $profile->name }} - {{ $profile->title }} | Portfolio">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($profile->bio ?? 'Professional web developer portfolio showcasing projects, skills, and expertise.'), 160) }}">
    <meta name="twitter:image" content="{{ $profile->profile_image ? (str_starts_with($profile->profile_image, 'http') ? $profile->profile_image : url($profile->profile_image)) : url('/images/portfolio-image.JPG') }}">
    <meta name="twitter:image:alt" content="{{ $profile->name }} - {{ $profile->title }}">
    @if(collect($socialLinks)->where('platform', 'like', '%twitter%')->first())
    <meta name="twitter:creator" content="{{ collect($socialLinks)->where('platform', 'like', '%twitter%')->first()->url }}">
    @endif
    
    <!-- Additional SEO -->
    <meta name="theme-color" content="#0f172a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-L0RHNJ2SQB"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-L0RHNJ2SQB');
    </script>
    
    <!-- Structured Data (JSON-LD) -->
    @php
        $personSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $profile->name,
            'jobTitle' => $profile->title,
            'description' => strip_tags($profile->bio ?? ''),
            'email' => $profile->email,
            'url' => url()->current(),
        ];
        
        if ($profile->phone ?? null) {
            $personSchema['telephone'] = $profile->phone;
        }
        
        if ($profile->location ?? null) {
            $personSchema['address'] = [
                '@type' => 'PostalAddress',
                'addressLocality' => $profile->location,
            ];
        }
        
        $profileImage = $profile->profile_image ?? null;
        if ($profileImage) {
            $personSchema['image'] = str_starts_with($profileImage, 'http') ? $profileImage : url($profileImage);
        } else {
            $personSchema['image'] = url('/images/portfolio-image.JPG');
        }
        
        if (count($socialLinks) > 0) {
            $personSchema['sameAs'] = $socialLinks->pluck('url')->toArray();
        }
        
        if ($skills->count() > 0) {
            $personSchema['knowsAbout'] = $skills->take(20)->pluck('name')->toArray();
        }
        
        $websiteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $profile->name . ' Portfolio',
            'url' => url()->current(),
            'author' => [
                '@type' => 'Person',
                'name' => $profile->name,
            ],
            'description' => Str::limit(strip_tags($profile->bio ?? 'Professional web developer portfolio'), 160),
        ];
        
        $projectListSchema = null;
        if ($projects->count() > 0) {
            $items = [];
            foreach ($projects->take(10) as $index => $project) {
                $item = [
                    '@type' => 'CreativeWork',
                    'name' => $project->title ?? '',
                    'description' => strip_tags($project->description ?? ''),
                ];
                
                if ($project->demo_url ?? null) {
                    $item['url'] = $project->demo_url;
                }
                
                if ($project->image ?? null) {
                    $item['image'] = str_starts_with($project->image, 'http') ? $project->image : url($project->image);
                }
                
                $items[] = [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'item' => $item,
                ];
            }
            
            $projectListSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'ItemList',
                'itemListElement' => $items,
            ];
        }
    @endphp
    
    <script type="application/ld+json">
    {!! json_encode($personSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    
    <script type="application/ld+json">
    {!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    
    @if($projectListSchema)
    <script type="application/ld+json">
    {!! json_encode($projectListSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    @endif
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Ensure no keyboard navigation class on body initially */
        body {
            outline: none !important;
        }

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

        /* Loading states */
        .image-loading {
            background: linear-gradient(90deg, #374151 25%, #4b5563 50%, #374151 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Image fade-in effect */
        .image-fade-in {
            opacity: 0;
            transition: opacity 0.3s ease-in;
        }

        .image-fade-in.loaded {
            opacity: 1;
        }

        /* Accessibility utilities */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* Enhanced Focus indicators for WCAG AA compliance */
        .focus-visible {
            outline: 3px solid #2563eb;
            outline-offset: 2px;
            border-radius: 4px;
        }

        /* Custom focus styles for different elements with high contrast */
        a:focus-visible,
        button:focus-visible,
        input:focus-visible,
        textarea:focus-visible,
        select:focus-visible {
            outline: 3px solid #2563eb;
            outline-offset: 2px;
            border-radius: 6px;
            box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.25);
            background-color: rgba(37, 99, 235, 0.05);
        }

        /* Dark background focus adjustments */
        .bg-slate-900 a:focus-visible,
        .bg-slate-900 button:focus-visible,
        .bg-slate-800 a:focus-visible,
        .bg-slate-800 button:focus-visible,
        .bg-slate-950 a:focus-visible,
        .bg-slate-950 button:focus-visible {
            outline: 3px solid #60a5fa;
            box-shadow: 0 0 0 6px rgba(96, 165, 250, 0.3);
        }

        /* Form inputs with dark backgrounds */
        .bg-slate-900 input:focus-visible,
        .bg-slate-900 textarea:focus-visible,
        .bg-slate-900 select:focus-visible {
            outline: 3px solid #60a5fa;
            box-shadow: 0 0 0 6px rgba(96, 165, 250, 0.3);
            background-color: rgba(96, 165, 250, 0.05);
        }

        /* Project cards focus */
        .project-card:focus-within {
            outline: 3px solid #2563eb;
            outline-offset: 2px;
            border-radius: 12px;
            box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.25);
        }

        /* Skill cards focus */
        .skill-card:focus-within {
            outline: 3px solid #2563eb;
            outline-offset: 2px;
            border-radius: 12px;
            box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.25);
        }

        /* Mobile menu button focus */
        #mobile-menu-button:focus-visible {
            outline: 3px solid #2563eb;
            outline-offset: 2px;
            border-radius: 8px;
            box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.25);
        }

        /* Social links focus */
        .social-link:focus-visible {
            outline: 3px solid #2563eb;
            outline-offset: 2px;
            border-radius: 8px;
            box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.25);
        }

        /* Seminar cards focus */
        .group a:focus-visible {
            outline: 3px solid #2563eb;
            outline-offset: 2px;
            border-radius: 8px;
            box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.25);
        }

        /* Aggressive hiding of all focus indicators by default */
        *,
        *::before,
        *::after {
            -webkit-tap-highlight-color: transparent !important;
        }

        a, button, input, textarea, select, [tabindex], [role="button"] {
            outline: 0 !important;
            box-shadow: none !important;
            background-color: transparent !important;
        }

        a:focus, button:focus, input:focus, textarea:focus, select:focus,
        [tabindex]:focus, [role="button"]:focus {
            outline: 0 !important;
            box-shadow: none !important;
            background-color: transparent !important;
        }

        /* Show focus indicators ONLY during keyboard navigation */
        body.keyboard-navigation a:focus,
        body.keyboard-navigation button:focus,
        body.keyboard-navigation input:focus,
        body.keyboard-navigation textarea:focus,
        body.keyboard-navigation select:focus,
        body.keyboard-navigation [tabindex]:focus,
        body.keyboard-navigation [role="button"]:focus,
        .keyboard-focus-only:focus {
            outline: 3px solid #2563eb !important;
            outline-offset: 2px !important;
            border-radius: 6px !important;
            box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.25) !important;
            background-color: rgba(37, 99, 235, 0.05) !important;
        }

        /* Remove default browser focus for all elements */
        a:active, button:active, input:active, textarea:active, select:active {
            outline: 0 !important;
            box-shadow: none !important;
        }

        /* Skip link focus enhancement */
        .focus\\:absolute:focus {
            outline: 3px solid #ffffff;
            outline-offset: 2px;
            box-shadow: 0 0 0 6px rgba(0, 0, 0, 0.75);
        }

        /* Enhanced Color contrast improvements for WCAG AA compliance (4.5:1 for normal text, 3:1 for large text) */

        /* Primary text colors with improved contrast on dark backgrounds */
        .text-slate-300 {
            color: #d1d5db; /* Improved from #cbd5e1 for better contrast (4.8:1 on #0f172a) */
        }

        .text-slate-400 {
            color: #9ca3af; /* Improved from #94a3b8 for better contrast (4.6:1 on #0f172a) */
        }

        .text-slate-500 {
            color: #6b7280; /* Ensure sufficient contrast */
        }

        /* White text variations for maximum contrast */
        .text-white {
            color: #ffffff; /* Perfect contrast (21:1) */
        }

        /* Heading text with strong contrast */
        .text-blue-400 {
            color: #60a5fa; /* Good contrast on dark backgrounds (6.2:1) */
        }

        .text-blue-300 {
            color: #93c5fd; /* Improved contrast (5.8:1) */
        }

        .text-cyan-400 {
            color: #22d3ee; /* Good contrast on dark backgrounds (6.8:1) */
        }

        .text-cyan-300 {
            color: #67e8f9; /* Improved contrast (6.1:1) */
        }

        /* Error messages with high contrast red */
        .text-red-400 {
            color: #f87171; /* Good contrast (4.9:1 on dark backgrounds) */
        }

        .text-red-300 {
            color: #fca5a5; /* Improved contrast (5.2:1) */
        }

        /* Success messages with high contrast green */
        .text-emerald-400 {
            color: #34d399; /* Good contrast (5.8:1) */
        }

        .text-emerald-300 {
            color: #6ee7b7; /* Improved contrast (5.9:1) */
        }

        /* Purple text for good contrast */
        .text-purple-400 {
            color: #c084fc; /* Good contrast (5.3:1) */
        }

        .text-purple-300 {
            color: #d8b4fe; /* Improved contrast (5.1:1) */
        }

        /* Yellow text for awards/badges */
        .text-yellow-300 {
            color: #fde047; /* Good contrast (15.1:1) */
        }

        /* Enhanced placeholder text contrast (4.5:1 minimum) */
        .placeholder-slate-500::-webkit-input-placeholder {
            color: #64748b; /* 4.8:1 contrast on dark inputs */
        }

        .placeholder-slate-500::-moz-placeholder {
            color: #64748b;
        }

        .placeholder-slate-500:-ms-input-placeholder {
            color: #64748b;
        }

        .placeholder-slate-500::placeholder {
            color: #64748b;
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .text-slate-300 {
                color: #e2e8f0; /* Even higher contrast for high contrast mode */
            }

            .text-slate-400 {
                color: #cbd5e1;
            }

            .text-blue-400 {
                color: #93c5fd;
            }

            .text-cyan-400 {
                color: #67e8f9;
            }
        }

        /* Reduced motion preferences */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Force reset all focus styles globally */
        * {
            -webkit-tap-highlight-color: rgba(0,0,0,0) !important;
            -webkit-focus-ring-color: rgba(0,0,0,0) !important;
            outline: none !important;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Skip Navigation Link for Screen Readers -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-md z-50 focus:outline-none focus:ring-2 focus:ring-blue-300">
        Skip to main content
    </a>

    <!-- Navigation -->
    <nav class="bg-slate-900/95 backdrop-blur-md border-b border-slate-800 fixed w-full top-0 z-50 shadow-xl" role="navigation" aria-label="Main navigation">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="text-xl font-bold text-white tracking-tight">{{ $profile->name }}</div>
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide" aria-label="Go to home section">
                        Home
                    </a>
                    <a href="#about" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide" aria-label="Go to about section">
                        About
                    </a>
                    <a href="#achievements" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide" aria-label="Go to achievements section">
                        Achievements
                    </a>
                    <a href="#projects" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide" aria-label="Go to projects section">
                        Projects
                    </a>
                    <a href="#skills" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide" aria-label="Go to skills section">
                        Skills
                    </a>
                    <a href="#seminars" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide" aria-label="Go to seminars section">
                        Seminars
                    </a>
                    <a href="#references" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide" aria-label="Go to references section">
                        References
                    </a>
                    <a href="#contact" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-md transition-colors duration-200 font-medium text-sm uppercase tracking-wide" aria-label="Go to contact section">
                        Contact
                    </a>
                </div>
                <!-- Mobile Menu Button -->
                <button class="md:hidden text-slate-300 hover:text-white transition" id="mobile-menu-button" aria-expanded="false" aria-controls="mobile-menu" aria-label="Toggle mobile navigation menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            <!-- Mobile Menu -->
            <div class="hidden md:hidden mt-4 space-y-2" id="mobile-menu" aria-hidden="true" role="menu">
                <a href="#home" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition" role="menuitem" aria-label="Go to home section">Home</a>
                <a href="#about" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition" role="menuitem" aria-label="Go to about section">About</a>
                <a href="#achievements" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition" role="menuitem" aria-label="Go to achievements section">Achievements</a>
                <a href="#projects" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition" role="menuitem" aria-label="Go to projects section">Projects</a>
                <a href="#skills" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition" role="menuitem" aria-label="Go to skills section">Skills</a>
                <a href="#seminars" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition" role="menuitem" aria-label="Go to seminars section">Seminars</a>
                <a href="#references" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition" role="menuitem" aria-label="Go to references section">References</a>
                <a href="#contact" class="block py-2 bg-blue-600 hover:bg-blue-700 text-white px-4 rounded transition" role="menuitem" aria-label="Go to contact section">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main id="main-content" role="main">
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
                <div class="md:w-3/5 text-center md:text-left opacity-0 animate-slideInLeft">
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
                <div class="group bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-slate-700 hover:border-blue-500 p-6 transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden" role="listitem" aria-labelledby="achievement-title-{{ $achievement->id }}">
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
                    <h3 id="achievement-title-{{ $achievement->id }}" class="text-xl font-bold text-white mb-2 pr-20">{{ $achievement->title }}</h3>
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
                <div class="group project-card bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-slate-700 hover:border-blue-500 overflow-hidden transition-all duration-300 transform hover:-translate-y-3" role="listitem" aria-labelledby="project-title-{{ $project->id }}">
                    <div class="relative overflow-hidden h-56">
                        <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.src='https://via.placeholder.com/800x600/1e293b/64748b?text={{ urlencode(str_replace(' ', '+', $project->title)) }}'" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent opacity-60"></div>
                        <div class="absolute top-4 right-4 bg-blue-600/90 backdrop-blur-sm px-3 py-1 rounded-full">
                            <span class="text-white text-xs font-bold uppercase">Featured</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 id="project-title-{{ $project->id }}" class="text-2xl font-bold mb-3 text-white group-hover:text-blue-400 transition-colors">{{ $project->title }}</h3>
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
                    $staticCategories = ['Frontend', 'Backend', 'DevOps', 'Tools', 'Programming Languages', 'Database', 'Penetration Testing'];
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
                    <!-- Static Grid Layout for Frontend, Backend, DevOps, Tools, Programming Languages, Database -->
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
                    <!-- Scrolling Container - Full Width for other categories -->
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
                            <!-- Duplicate items for seamless loop -->
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

    <!-- Seminars, Webinars, and Trainings Section -->
    <section id="seminars" class="py-20 md:py-32 bg-slate-900 relative overflow-hidden" aria-labelledby="seminars-heading">
        <!-- Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-600/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 id="seminars-heading" class="text-5xl md:text-6xl font-black text-white mb-4">Seminars, Webinars, and Trainings</h2>
                <div class="flex justify-center gap-2 items-center mb-6">
                    <div class="h-1 w-24 bg-gradient-to-r from-purple-600 via-pink-500 to-purple-600 rounded-full"></div>
                </div>
                <p class="text-slate-400 text-xl max-w-2xl mx-auto">Explore certificates and materials from professional development sessions</p>
            </div>

            @if(count($seminars) > 0)
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-8 gap-3 max-w-7xl mx-auto" role="grid" aria-label="Seminars and training materials">
                @foreach($seminars as $seminar)
                <a href="{{ $seminar['url'] }}" target="_blank" rel="noopener noreferrer" class="group block focus-visible" style="aspect-ratio: 1 / 1.3; overflow: hidden;" role="gridcell" aria-label="View {{ $seminar['name'] }} - {{ $seminar['type'] }} (opens in new tab)">
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg border border-slate-700 hover:border-purple-500 transition-all duration-300 flex flex-col hover:shadow-lg hover:shadow-purple-500/20 hover:-translate-y-1 h-full" style="overflow: hidden;">
                        <!-- Icon/Thumbnail -->
                        <div class="relative flex-shrink-0 bg-gradient-to-br from-purple-600 to-pink-600" style="height: 50%; overflow: hidden; position: relative;">
                            @if($seminar['is_image'])
                                <!-- Display actual image -->
                                <img src="{{ $seminar['url'] }}" alt="{{ $seminar['name'] }}" style="width: 130%; height: 130%; object-fit: cover; display: block; transform: scale(1.0); transform-origin: top left; margin-left: -15%; margin-top: -15%;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" loading="lazy">
                                <!-- Fallback icon when image fails -->
                                <div style="display: none; width: 100%; height: 100%; padding: 1rem; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                                    <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.1);"></div>
                                    <svg style="width: 1.5rem; height: 1.5rem; color: white; position: relative; z-index: 10;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
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
                    <span class="sr-only">(opens in new tab)</span>
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
    <section id="references" class="py-20 md:py-32 bg-slate-900 relative overflow-hidden" aria-labelledby="references-heading">
        <!-- Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-600/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 id="references-heading" class="text-4xl md:text-5xl font-bold mb-4">
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
                                <img src="{{ $reference->image }}" alt="{{ $reference->name }}" class="w-16 h-16 rounded-full border-2 border-purple-500/50" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" loading="lazy">
                                @endif
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-600 to-pink-600 flex items-center justify-center text-white text-xl font-bold {{ $reference->image ? 'hidden' : '' }}">
                                    {{ substr($reference->name, 0, 1) }}
                                </div>
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
    <section id="contact" class="py-20 md:py-32 bg-slate-950 relative overflow-hidden" aria-labelledby="contact-heading">
        <!-- Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
        <div class="absolute top-0 left-1/2 w-96 h-96 bg-blue-600/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 id="contact-heading" class="text-5xl md:text-6xl font-black text-white mb-4">Let's Connect</h2>
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
                    <div class="bg-emerald-500/20 border-2 border-emerald-500 text-emerald-300 px-4 py-3 rounded-lg mb-6 font-semibold" role="status" aria-live="polite" aria-atomic="true">
                        Thank you for your message! I will get back to you soon.
                    </div>
                    @endif

                    <h3 id="contact-form-title" class="text-2xl font-bold text-white mb-6">Send a Message</h3>

                    <div id="contact-form-description" class="sr-only">Fill out this form to send a message to {{ $profile->name }}. All fields marked with an asterisk are required.</div>
                    <form action="https://formspree.io/f/mvgwedvb" method="POST" class="space-y-5" aria-labelledby="contact-form-title" role="form" aria-describedby="contact-form-description">
                        <input type="hidden" name="_next" value="{{ url()->current() }}?success=true">
                        <input type="hidden" name="_subject" value="New Portfolio Contact from {{ old('name', 'visitor') }}">
                        <div>
                            <label for="name" class="block text-sm font-bold mb-2 text-slate-300 uppercase tracking-wide">Name <span class="text-red-400">*</span></label>
                            <input type="text" id="name" name="name" required autocomplete="name" class="w-full px-4 py-3 bg-slate-900 border-2 border-slate-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 transition" placeholder="John Doe" value="{{ old('name') }}" aria-describedby="name-error" aria-required="true" {{ $errors->has('name') ? 'aria-invalid="true"' : 'aria-invalid="false"' }}>
                            @error('name')<span id="name-error" class="text-red-400 text-sm font-semibold" role="alert">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-bold mb-2 text-slate-300 uppercase tracking-wide">Email <span class="text-red-400">*</span></label>
                            <input type="email" id="email" name="email" required autocomplete="email" class="w-full px-4 py-3 bg-slate-900 border-2 border-slate-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 transition" placeholder="john@example.com" value="{{ old('email') }}" aria-describedby="email-error" aria-required="true" {{ $errors->has('email') ? 'aria-invalid="true"' : 'aria-invalid="false"' }}>
                            @error('email')<span id="email-error" class="text-red-400 text-sm font-semibold" role="alert">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-bold mb-2 text-slate-300 uppercase tracking-wide">Subject</label>
                            <input type="text" id="subject" name="subject" autocomplete="subject" class="w-full px-4 py-3 bg-slate-900 border-2 border-slate-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 transition" placeholder="Project Inquiry" value="{{ old('subject') }}" aria-describedby="subject-error" {{ $errors->has('subject') ? 'aria-invalid="true"' : 'aria-invalid="false"' }}>
                            @error('subject')<span id="subject-error" class="text-red-400 text-sm font-semibold" role="alert">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-bold mb-2 text-slate-300 uppercase tracking-wide">Message <span class="text-red-400">*</span></label>
                            <textarea id="message" name="message" rows="5" required autocomplete="message" class="w-full px-4 py-3 bg-slate-900 border-2 border-slate-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 transition resize-none" placeholder="Tell me about your project..." aria-describedby="message-error" aria-required="true" {{ $errors->has('message') ? 'aria-invalid="true"' : 'aria-invalid="false"' }}>{{ old('message') }}</textarea>
                            @error('message')<span id="message-error" class="text-red-400 text-sm font-semibold" role="alert">{{ $message }}</span>@enderror
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-cyan-500 text-white px-8 py-4 rounded-lg font-bold text-lg transition-all duration-300 shadow-2xl shadow-blue-600/30 hover:shadow-blue-500/50 transform hover:scale-105 flex items-center justify-center gap-2" aria-describedby="submit-description">
                            <span>Send Message</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                        <div id="submit-description" class="sr-only">Submit the contact form to send a message to {{ $profile->name }}</div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </main>

    <!-- Footer -->
    <footer class="bg-black border-t border-slate-800 py-12" role="contentinfo" aria-label="Site footer">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-center md:text-left">
                    <div class="text-2xl font-black text-white mb-2">{{ $profile->name }}</div>
                    <p class="text-slate-400">{{ $profile->title }}</p>
                </div>

                <div class="flex gap-4">
                    @foreach($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="w-12 h-12 rounded-lg bg-slate-900 border border-slate-700 hover:border-blue-500 hover:bg-slate-800 flex items-center justify-center transition-all duration-200 hover:scale-110 group focus-visible social-link" aria-label="Visit {{ $profile->name }} on {{ $link->platform }}">
                        <span class="text-xs font-bold text-slate-400 group-hover:text-blue-400">{{ substr($link->platform, 0, 2) }}</span>
                        <span class="sr-only">(opens in new tab)</span>
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
        // Immediately hide all focus indicators on page load
        (function() {
            document.body.classList.remove('keyboard-navigation');

            // Force hide all focus indicators immediately
            const style = document.createElement('style');
            style.textContent = `
                *, *::before, *::after {
                    outline: 0 !important;
                    box-shadow: none !important;
                    background-color: transparent !important;
                }
                a:focus, button:focus, input:focus, textarea:focus, select:focus {
                    outline: 0 !important;
                    box-shadow: none !important;
                    background-color: transparent !important;
                }
            `;
            document.head.appendChild(style);

            // Remove the style after a brief moment to let CSS take over
            setTimeout(() => {
                document.head.removeChild(style);
            }, 100);
        })();

        // Mobile menu toggle with keyboard support
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuItems = mobileMenu.querySelectorAll('a[role="menuitem"]');

        function toggleMobileMenu() {
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';

            mobileMenu.classList.toggle('hidden');
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.setAttribute('aria-hidden', isExpanded);

            // Focus management
            if (!isExpanded) {
                // Menu is opening, focus first menu item
                if (menuItems.length > 0) {
                    menuItems[0].focus();
                }
            }
        }

        mobileMenuButton.addEventListener('click', toggleMobileMenu);

        // Keyboard support for mobile menu
        mobileMenuButton.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleMobileMenu();
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
                if (isExpanded) {
                    mobileMenu.classList.add('hidden');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                    mobileMenu.setAttribute('aria-hidden', 'true');
                }
            }
        });

        // Keyboard navigation within mobile menu
        mobileMenu.addEventListener('keydown', function(e) {
            const currentIndex = Array.from(menuItems).indexOf(document.activeElement);

            switch(e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    const nextIndex = currentIndex < menuItems.length - 1 ? currentIndex + 1 : 0;
                    menuItems[nextIndex].focus();
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    const prevIndex = currentIndex > 0 ? currentIndex - 1 : menuItems.length - 1;
                    menuItems[prevIndex].focus();
                    break;
                case 'Escape':
                    e.preventDefault();
                    toggleMobileMenu();
                    mobileMenuButton.focus();
                    break;
            }
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                    // Close mobile menu if open
                    const menu = document.getElementById('mobile-menu');
                    const button = document.getElementById('mobile-menu-button');
                    if (!menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                        button.setAttribute('aria-expanded', 'false');
                        menu.setAttribute('aria-hidden', 'true');
                    }
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

        // Focus management for keyboard-only indicators
        let isKeyboardNavigation = false;
        let lastInteractionWasKeyboard = false;

        // Detect keyboard vs mouse/touch navigation
        document.addEventListener('keydown', (e) => {
            // Only consider navigation keys as keyboard interaction
            if (e.key === 'Tab' || e.key.startsWith('Arrow') || e.key === 'Enter' || e.key === ' ' ||
                e.key === 'Home' || e.key === 'End' || e.key === 'PageUp' || e.key === 'PageDown') {
                isKeyboardNavigation = true;
                lastInteractionWasKeyboard = true;
                document.body.classList.add('keyboard-navigation');
            }
        });

        // Mouse events should disable keyboard navigation mode
        document.addEventListener('mousedown', () => {
            isKeyboardNavigation = false;
            lastInteractionWasKeyboard = false;
            document.body.classList.remove('keyboard-navigation');
        });

        document.addEventListener('mousemove', () => {
            // Only disable if this is clearly a mouse interaction (not just hovering)
            if (!isKeyboardNavigation) {
                document.body.classList.remove('keyboard-navigation');
            }
        });

        // Touch events should disable keyboard navigation mode
        document.addEventListener('touchstart', () => {
            isKeyboardNavigation = false;
            lastInteractionWasKeyboard = false;
            document.body.classList.remove('keyboard-navigation');
        });

        // Reset on window focus/blur to handle tab switching
        window.addEventListener('blur', () => {
            isKeyboardNavigation = false;
            document.body.classList.remove('keyboard-navigation');
        });

        window.addEventListener('focus', () => {
            // Don't automatically enable keyboard mode on window focus
            if (!lastInteractionWasKeyboard) {
                document.body.classList.remove('keyboard-navigation');
            }
        });

        // Add scroll-to-top button with accessibility
        const scrollBtn = document.createElement('button');
        scrollBtn.innerHTML = '↑';
        scrollBtn.className = 'fixed bottom-8 right-8 bg-blue-600 text-white w-12 h-12 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 opacity-0 pointer-events-none z-50 keyboard-focus-only';
        scrollBtn.style.fontSize = '24px';
        scrollBtn.setAttribute('aria-label', 'Scroll to top of page');
        scrollBtn.setAttribute('type', 'button');
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

        // Keyboard support for scroll button
        scrollBtn.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });

        // Keyboard shortcuts for navigation and scrolling
        document.addEventListener('keydown', (e) => {
            // Skip to main content with Ctrl/Cmd + Home
            if ((e.ctrlKey || e.metaKey) && e.key === 'Home') {
                e.preventDefault();
                const mainContent = document.getElementById('main-content');
                if (mainContent) {
                    mainContent.focus();
                    mainContent.scrollIntoView({ behavior: 'smooth' });
                }
                return;
            }

            // Page scrolling with arrow keys (only when not in form inputs or when menu is closed)
            const activeElement = document.activeElement;
            const isInInput = activeElement.tagName === 'INPUT' || activeElement.tagName === 'TEXTAREA' || activeElement.contentEditable === 'true';
            const isMenuOpen = mobileMenuButton.getAttribute('aria-expanded') === 'true';

            // Allow normal arrow key behavior in inputs and when menu is open
            if (isInInput || isMenuOpen) {
                return;
            }

            const scrollAmount = 100; // pixels to scroll

            switch(e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    window.scrollBy({
                        top: scrollAmount,
                        behavior: 'smooth'
                    });
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    window.scrollBy({
                        top: -scrollAmount,
                        behavior: 'smooth'
                    });
                    break;
                case 'PageDown':
                    e.preventDefault();
                    window.scrollBy({
                        top: window.innerHeight * 0.8,
                        behavior: 'smooth'
                    });
                    break;
                case 'PageUp':
                    e.preventDefault();
                    window.scrollBy({
                        top: -window.innerHeight * 0.8,
                        behavior: 'smooth'
                    });
                    break;
                case 'Home':
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    break;
                case 'End':
                    e.preventDefault();
                    window.scrollTo({
                        top: document.body.scrollHeight,
                        behavior: 'smooth'
                    });
                    break;
            }
        });

        // Form accessibility enhancements
        const contactForm = document.querySelector('form[aria-labelledby="contact-form-title"]');
        if (contactForm) {
            // Focus management for form errors
            const errorMessages = contactForm.querySelectorAll('[role="alert"]');
            if (errorMessages.length > 0) {
                // Focus first field with error
                const firstErrorField = contactForm.querySelector('[aria-invalid="true"]');
                if (firstErrorField) {
                    setTimeout(() => firstErrorField.focus(), 100);
                }
            }

            // Real-time validation feedback
            const requiredFields = contactForm.querySelectorAll('[aria-required="true"]');
            requiredFields.forEach(field => {
                field.addEventListener('blur', function() {
                    const errorId = this.getAttribute('aria-describedby');
                    const errorElement = errorId ? document.getElementById(errorId) : null;

                    if (this.value.trim() === '') {
                        this.setAttribute('aria-invalid', 'true');
                        if (errorElement) {
                            errorElement.textContent = this.name.charAt(0).toUpperCase() + this.name.slice(1) + ' is required';
                            errorElement.style.display = 'block';
                        }
                    } else {
                        this.setAttribute('aria-invalid', 'false');
                        if (errorElement && !errorElement.textContent.includes('is required')) {
                            errorElement.style.display = 'none';
                        }
                    }
                });
            });
        }

        // Announce dynamic content changes
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                    const statusMessages = document.querySelectorAll('[role="status"]');
                    statusMessages.forEach(msg => {
                        if (msg.textContent && msg.textContent.trim()) {
                            // Announce to screen readers
                            msg.setAttribute('aria-live', 'assertive');
                            msg.setAttribute('aria-atomic', 'true');
                        }
                    });
                }
            });
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });

        // Analytics Event Tracking
        function trackEvent(eventName, category, label = '', value = null) {
            if (typeof gtag !== 'undefined') {
                gtag('event', eventName, {
                    event_category: category,
                    event_label: label,
                    value: value
                });
            }
        }

        // Track contact form submission
        function trackContactForm() {
            trackEvent('contact_form_submit', 'engagement', 'contact_form');
        }

        // Track project link clicks
        function trackProjectClick(projectTitle) {
            trackEvent('project_click', 'engagement', projectTitle);
        }

        // Track resume downloads
        function trackResumeDownload() {
            trackEvent('download', 'engagement', 'resume');
        }

        // Track social media clicks
        function trackSocialClick(platform) {
            trackEvent('social_click', 'engagement', platform);
        }

        // Track seminar/material downloads
        function trackSeminarDownload(seminarName) {
            trackEvent('download', 'engagement', seminarName);
        }

        // Auto-track contact form submissions
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.querySelector('form[action*="formspree"]');
            if (contactForm) {
                contactForm.addEventListener('submit', trackContactForm);
            }

            // Track resume downloads
            const resumeLink = document.querySelector('a[href*="canva.com"]');
            if (resumeLink) {
                resumeLink.addEventListener('click', trackResumeDownload);
            }

            // Track project link clicks
            document.querySelectorAll('.project-card a').forEach(link => {
                const projectCard = link.closest('.project-card');
                const projectTitle = projectCard ? projectCard.querySelector('h3')?.textContent?.trim() : '';
                if (projectTitle) {
                    link.addEventListener('click', () => trackProjectClick(projectTitle));
                }
            });

            // Track social media clicks
            document.querySelectorAll('[href*="github"], [href*="linkedin"], [href*="twitter"], [href*="facebook"]').forEach(link => {
                const href = link.getAttribute('href');
                let platform = 'social';
                if (href.includes('github')) platform = 'github';
                else if (href.includes('linkedin')) platform = 'linkedin';
                else if (href.includes('twitter')) platform = 'twitter';
                else if (href.includes('facebook')) platform = 'facebook';

                link.addEventListener('click', () => trackSocialClick(platform));
            });

            // Track seminar downloads
            document.querySelectorAll('#seminars a[target="_blank"]').forEach(link => {
                const seminarName = link.querySelector('h3')?.textContent?.trim();
                if (seminarName) {
                    link.addEventListener('click', () => trackSeminarDownload(seminarName));
                }
            });
        });

    </script>
</body>
</html>
