<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-950 text-slate-50">
    <div class="min-h-full flex items-center justify-center px-4">
        <div class="w-full max-w-md space-y-6 bg-white/5 border border-white/10 rounded-2xl p-8 shadow-xl backdrop-blur">
            <div class="text-center space-y-2">
                <p class="text-sm uppercase tracking-[0.25em] text-slate-400">Portfolio Admin</p>
                <h1 class="text-2xl font-bold text-white">Sign in</h1>
                <p class="text-slate-400 text-sm">Restricted access</p>
            </div>

            @if ($errors->any())
                <div class="rounded-lg border border-red-500/40 bg-red-500/10 px-4 py-3 text-red-100 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm text-slate-300" for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white placeholder:text-slate-500 focus:border-blue-400 focus:ring-2 focus:ring-blue-500/40">
                </div>
                <div class="space-y-2">
                    <label class="text-sm text-slate-300" for="password">Password</label>
                    <input type="password" id="password" name="password" required class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white placeholder:text-slate-500 focus:border-blue-400 focus:ring-2 focus:ring-blue-500/40">
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-300">
                    <input type="checkbox" name="remember" class="rounded border-white/20 bg-white/10 text-blue-500 focus:ring-blue-500/40">
                    Remember me
                </label>
                <button class="w-full rounded-lg bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 transition">Sign in</button>
            </form>
        </div>
    </div>
</body>
</html>

