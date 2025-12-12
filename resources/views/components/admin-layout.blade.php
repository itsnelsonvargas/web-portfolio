<!DOCTYPE html>
<html lang="en" class="h-full" x-data="{ dark: localStorage.getItem('admin-dark') === 'true' }" x-bind:class="dark ? 'dark' : ''" xmlns:x-slot="http://www.w3.org/1999/XSL/Transform">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="h-full bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
    <div class="min-h-full flex">
        <aside class="w-64 hidden md:flex flex-col border-r border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/80 backdrop-blur">
            <div class="px-6 py-6 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-600 text-white font-bold flex items-center justify-center">AD</div>
                <div>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Portfolio Admin</p>
                    <p class="font-semibold">{{ auth()->user()->name ?? 'Admin' }}</p>
                </div>
            </div>
            <nav class="flex-1 px-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-100' : 'hover:bg-slate-100 dark:hover:bg-slate-800' }}">Dashboard</a>
                <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.profile.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-100' : 'hover:bg-slate-100 dark:hover:bg-slate-800' }}">Personal Info</a>
                <a href="{{ route('admin.trainings.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.trainings.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-100' : 'hover:bg-slate-100 dark:hover:bg-slate-800' }}">Trainings & Certificates</a>
                <a href="{{ route('admin.uploads.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.uploads.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-100' : 'hover:bg-slate-100 dark:hover:bg-slate-800' }}">Files</a>
                <a href="{{ route('admin.password.edit') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.password.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-100' : 'hover:bg-slate-100 dark:hover:bg-slate-800' }}">Password</a>
            </nav>
            <div class="p-4 space-y-2">
                <button @click="dark = !dark; localStorage.setItem('admin-dark', dark)" class="w-full flex items-center justify-between px-3 py-2 text-sm rounded-lg border border-slate-200 dark:border-slate-700">
                    <span>Dark mode</span>
                    <span x-text="dark ? 'On' : 'Off'"></span>
                </button>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button class="w-full px-3 py-2 text-sm rounded-lg bg-red-50 text-red-700 hover:bg-red-100 dark:bg-red-900/50 dark:text-red-100">Logout</button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-h-screen">
            <header class="border-b border-slate-200 dark:border-slate-800 bg-white/70 dark:bg-slate-900/80 backdrop-blur sticky top-0 z-10">
                <div class="flex items-center justify-between px-4 py-4">
                    <div>
                        <p class="text-sm text-slate-500 uppercase tracking-wide">Admin</p>
                        <h1 class="text-xl font-bold">{{ $title ?? 'Dashboard' }}</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <button @click="dark = !dark; localStorage.setItem('admin-dark', dark)" class="md:hidden px-3 py-2 text-sm rounded-lg border border-slate-200 dark:border-slate-700">Toggle theme</button>
                        <form action="{{ route('admin.logout') }}" method="POST" class="md:hidden">
                            @csrf
                            <button class="px-3 py-2 text-sm rounded-lg bg-red-50 text-red-700 hover:bg-red-100 dark:bg-red-900/50 dark:text-red-100">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 md:p-8 space-y-4">
                @if (session('status'))
                    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-900/30 dark:text-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800 dark:border-red-900/50 dark:bg-red-900/30 dark:text-red-100">
                        <p class="font-semibold mb-1">Please fix the following:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>

