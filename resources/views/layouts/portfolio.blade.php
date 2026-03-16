<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title>@yield('title', $profile->name . ' – ' . $profile->title)</title>
    <meta name="title" content="@yield('title', $profile->name . ' – ' . $profile->title)">
    <meta name="description" content="{{ Str::limit(strip_tags($profile->bio ?? 'Professional web developer portfolio showcasing projects, skills, and expertise.'), 160) }}">
    <meta name="keywords" content="{{ $profile->title }}, web developer, portfolio, {{ isset($skills) ? collect($skills)->pluck('name')->take(10)->implode(', ') : '' }}, {{ $profile->location ?? '' }}, freelance developer, software developer">
    <meta name="author" content="{{ $profile->name }}">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $profile->name . ' – ' . $profile->title)">
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
    <meta name="twitter:title" content="@yield('title', $profile->name . ' – ' . $profile->title)">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($profile->bio ?? 'Professional web developer portfolio showcasing projects, skills, and expertise.'), 160) }}">
    <meta name="twitter:image" content="{{ $profile->profile_image ? (str_starts_with($profile->profile_image, 'http') ? $profile->profile_image : url($profile->profile_image)) : url('/images/portfolio-image.JPG') }}">
    <meta name="twitter:image:alt" content="{{ $profile->name }} - {{ $profile->title }}">

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

        if (isset($socialLinks) && count($socialLinks) > 0) {
            $personSchema['sameAs'] = collect($socialLinks)->pluck('url')->toArray();
        }

        if (isset($skills) && $skills->count() > 0) {
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
    @endphp

    <script type="application/ld+json">
    {!! json_encode($personSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <script type="application/ld+json">
    {!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
    <style>
        /* Shared Styles */
        body {
            outline: none !important;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
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
    </style>
</head>
<body class="bg-slate-950 text-slate-300 font-sans selection:bg-blue-500/30 selection:text-blue-200 antialiased overflow-x-hidden">
    <!-- Skip to content -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-md z-50 focus:outline-none focus:ring-2 focus:ring-blue-300">
        Skip to main content
    </a>

    <!-- Navigation -->
    <nav class="bg-slate-900/95 backdrop-blur-md border-b border-slate-800 fixed w-full top-0 z-50 shadow-xl" role="navigation" aria-label="Main navigation">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('portfolio.index') }}" class="text-xl font-bold text-white tracking-tight">{{ $profile->name }}</a>
                <div class="hidden md:flex space-x-8">
                    @php
                        $isHome = Request::routeIs('portfolio.index');
                        $homeUrl = $isHome ? '' : route('portfolio.index');
                    @endphp
                    <a href="{{ $homeUrl }}#home" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide">Home</a>
                    <a href="{{ $homeUrl }}#about" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide">About</a>
                    <a href="{{ $homeUrl }}#characteristics" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide">Characteristics</a>
                    <a href="{{ $homeUrl }}#projects" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide">Projects</a>
                    <a href="{{ $homeUrl }}#skills" class="text-slate-300 hover:text-white transition-colors duration-200 font-medium text-sm uppercase tracking-wide">Skills</a>
                    <a href="{{ $homeUrl }}#contact" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-md transition-colors duration-200 font-medium text-sm uppercase tracking-wide">Contact</a>
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
                <a href="{{ $homeUrl }}#home" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition">Home</a>
                <a href="{{ $homeUrl }}#about" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition">About</a>
                <a href="{{ $homeUrl }}#characteristics" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition">Characteristics</a>
                <a href="{{ $homeUrl }}#projects" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition">Projects</a>
                <a href="{{ $homeUrl }}#skills" class="block py-2 text-slate-300 hover:text-white hover:bg-slate-800 px-4 rounded transition">Skills</a>
                <a href="{{ $homeUrl }}#contact" class="block py-2 bg-blue-600 hover:bg-blue-700 text-white px-4 rounded transition">Contact</a>
            </div>
        </div>
    </nav>

    <main id="main-content" role="main">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black border-t border-slate-800 py-12" role="contentinfo" aria-label="Site footer">
        <div class="container mx-auto px-4 text-center">
            <div class="flex justify-center space-x-6 mb-8">
                @if(isset($socialLinks))
                    @foreach($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-white transition-colors duration-200" aria-label="{{ $link->platform }}">
                        <span class="sr-only">{{ $link->platform }}</span>
                        @if(str_contains(strtolower($link->platform), 'github'))
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                        @elseif(str_contains(strtolower($link->platform), 'linkedin'))
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.761 0 5-2.239 5-5v-14c0-2.761-2.239-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        @elseif(str_contains(strtolower($link->platform), 'facebook'))
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        @endif
                    </a>
                    @endforeach
                @endif
            </div>
            <p class="text-slate-500 text-sm">
                &copy; {{ date('Y') }} {{ $profile->name }}. All rights reserved.
            </p>
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
                if (document.head.contains(style)) {
                    document.head.removeChild(style);
                }
            }, 100);
        })();

        // Mobile menu toggle with keyboard support
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        function toggleMobileMenu() {
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenu.classList.toggle('hidden');
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
        }

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', toggleMobileMenu);
        }

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (mobileMenuButton && !mobileMenuButton.contains(e.target) && mobileMenu && !mobileMenu.contains(e.target)) {
                const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
                if (isExpanded) {
                    mobileMenu.classList.add('hidden');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                }
            }
        });

        // Focus management for keyboard-only indicators
        let lastInteractionWasKeyboard = false;

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Tab' || e.key.startsWith('Arrow') || e.key === 'Enter' || e.key === ' ') {
                lastInteractionWasKeyboard = true;
                document.body.classList.add('keyboard-navigation');
            }
        });

        document.addEventListener('mousedown', () => {
            lastInteractionWasKeyboard = false;
            document.body.classList.remove('keyboard-navigation');
        });

        // Add scroll-to-top button
        const scrollBtn = document.createElement('button');
        scrollBtn.innerHTML = '↑';
        scrollBtn.className = 'fixed bottom-8 right-8 bg-blue-600 text-white w-12 h-12 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 opacity-0 pointer-events-none z-50';
        scrollBtn.style.fontSize = '24px';
        scrollBtn.setAttribute('aria-label', 'Scroll to top');
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
    @yield('scripts')
</body>
</html>