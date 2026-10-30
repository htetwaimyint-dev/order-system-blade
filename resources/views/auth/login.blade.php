<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | OrderFlow</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body
    class="flex min-h-screen items-center justify-center bg-gradient-to-br from-indigo-50 via-slate-50 to-indigo-100 p-4 sm:p-6">

    <main
        class="w-full max-w-lg rounded-3xl border border-slate-200 bg-white/95 p-6 shadow-2xl shadow-slate-300/50 sm:p-10">

        {{-- Brand --}}
        <div class="mb-10 flex items-center gap-4">
            <div
                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 text-white shadow-lg shadow-indigo-200">
                <i data-lucide="package-check" class="h-8 w-8"></i>
            </div>

            <div>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900">
                    OrderFlow
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Order Management System
                </p>
            </div>
        </div>

        {{-- Heading --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                Welcome back
            </h1>

            <p class="mt-4 text-base leading-7 text-slate-500 sm:text-lg">
                Sign in to manage your items and orders.
            </p>
        </div>

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="mb-2 block text-sm font-bold text-slate-700">
                    Email address
                </label>

                <div class="relative">
                    <i data-lucide="mail"
                        class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"></i>

                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        placeholder="you@example.com" autocomplete="email" autofocus required
                        class="block w-full rounded-xl border border-slate-300 bg-white py-4 pl-12 pr-4 text-base text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                </div>

                @error('email')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="mb-2 block text-sm font-bold text-slate-700">
                    Password
                </label>

                <div class="relative">
                    <i data-lucide="lock-keyhole"
                        class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"></i>

                    <input id="password" type="password" name="password" placeholder="Enter your password"
                        autocomplete="current-password" required
                        class="block w-full rounded-xl border border-slate-300 bg-white py-4 pl-12 pr-4 text-base text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                </div>

                @error('password')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Login Button --}}
            <button type="submit"
                class="flex w-full items-center justify-center gap-3 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-700 px-6 py-4 text-base font-bold text-white shadow-lg shadow-indigo-200 transition duration-200 hover:-translate-y-0.5 hover:from-indigo-700 hover:to-violet-800 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-indigo-200 active:translate-y-0">
                <i data-lucide="log-in" class="h-5 w-5"></i>
                Sign in
            </button>
        </form>

        {{-- Register Link --}}
        <div class="mt-7 text-center text-sm text-slate-500 sm:text-base">
            Don't have an account?

            <a href="{{ route('register') }}" class="ml-1 font-bold text-indigo-600 transition hover:text-violet-700">
                Create account
            </a>
        </div>

        {{-- Security Note --}}
        <div class="mt-10 flex items-center justify-center gap-2 text-sm text-slate-400">
            <i data-lucide="shield-check" class="h-5 w-5"></i>
            <span>Your account is protected</span>
        </div>

    </main>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>
