<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Order Management') | Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* Mobile sidebar: closed by default */
        @media (max-width: 767px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.sidebar-open {
                transform: translateX(0);
            }

            #sidebar-overlay {
                display: none;
            }

            #sidebar-overlay.sidebar-overlay-open {
                display: block;
            }
        }

        /* Desktop sidebar: always visible */
        @media (min-width: 768px) {
            #sidebar {
                position: static;
                transform: translateX(0);
            }

            #sidebar-overlay {
                display: none !important;
            }
        }

        /* Smooth navigation interaction */
        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                    rgba(99, 102, 241, 0.12),
                    transparent);
            opacity: 0;
            transition: opacity .25s ease;
            pointer-events: none;
        }

        .nav-link:hover::before {
            opacity: 1;
        }

        .nav-link>* {
            position: relative;
        }

        .sidebar-brand-icon {
            box-shadow: 0 8px 22px rgba(99, 102, 241, 0.3);
        }

        .logout-button {
            transition:
                background-color .2s ease,
                color .2s ease,
                transform .2s ease;
        }

        .logout-button:hover {
            transform: translateX(3px);
        }

        button:focus-visible,
        a:focus-visible {
            outline: 2px solid #818cf8;
            outline-offset: 3px;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-100 font-sans text-slate-800">

    <div class="min-h-screen md:flex">

        {{-- Mobile Overlay --}}
        <div id="sidebar-overlay" onclick="closeSidebar()"
            class="fixed inset-0 z-40 bg-slate-950/50 backdrop-blur-sm md:hidden">
        </div>

        {{-- Sidebar --}}
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col bg-slate-900 text-white transition-transform duration-300 ease-in-out md:min-h-screen md:w-64 md:shrink-0">

            {{-- Logo --}}
            <div class="flex items-center justify-between border-b border-slate-700/80 px-6 py-6">
                <div class="flex items-center gap-3">
                    <div
                        class="sidebar-brand-icon flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600">
                        <i data-lucide="package-check" class="h-6 w-6"></i>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold tracking-wide">
                            Order<span class="text-indigo-400">Flow</span>
                        </h1>
                        <p class="mt-1 text-xs text-slate-400">
                            Management System
                        </p>
                    </div>
                </div>

                <button type="button" onclick="closeSidebar()"
                    class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-300 transition hover:bg-slate-800 hover:text-white md:hidden"
                    aria-label="Close menu">
                    <i data-lucide="x" class="h-5 w-5"></i>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 space-y-2 px-4 py-5">

                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}"
                    class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->is('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-950/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="home" class="h-5 w-5 shrink-0"></i>
                    <span>Dashboard</span>
                </a>

                {{-- Items --}}
                <a href="{{ route('items.index') }}"
                    class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->is('items*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-950/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="package" class="h-5 w-5 shrink-0"></i>
                    <span>Items</span>
                </a>

                {{-- Orders --}}
                <a href="{{ route('orders.index') }}"
                    class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->is('orders*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-950/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="shopping-cart" class="h-5 w-5 shrink-0"></i>
                    <span>Orders</span>
                </a>

                {{-- Profile --}}
                <a href="{{ route('profile.edit') }}"
                    class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->is('profile*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-950/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="user" class="h-5 w-5 shrink-0"></i>
                    <span>Profile</span>
                </a>

            </nav>

            {{-- Sidebar Account + Logout --}}
            <div class="border-t border-slate-700/80 p-4">

                {{-- Current User --}}
                <div class="mb-4 flex items-center gap-3 rounded-xl bg-slate-800/70 p-3">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-400 to-violet-500 text-sm font-bold text-white">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-semibold text-white">
                            {{ auth()->user()->name ?? 'Guest User' }}
                        </p>
                        <p class="truncate text-xs text-slate-400">
                            {{ auth()->user()->email ?? '' }}
                        </p>
                    </div>
                </div>

                {{-- Logout Form --}}
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="logout-button flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-red-300 transition hover:bg-red-500/10 hover:text-red-200">
                            <i data-lucide="log-out" class="h-5 w-5 shrink-0"></i>
                            <span>Logout</span>
                            <i data-lucide="arrow-up-right" class="ml-auto h-4 w-4 opacity-60"></i>
                        </button>
                    </form>
                @endauth

                <div class="mt-4 px-3 text-xs text-slate-500">
                    <p>Order Management System</p>
                    <p class="mt-1">© {{ date('Y') }} OrderFlow</p>
                </div>
            </div>

        </aside>

        {{-- Main Content --}}
        <div class="flex min-h-screen min-w-0 flex-1 flex-col">

            {{-- Top Navbar --}}
            <header
                class="sticky top-0 z-30 flex items-center justify-between border-b border-slate-200/80 bg-white/95 px-4 py-4 backdrop-blur-md sm:px-5 md:px-8">

                <div class="flex min-w-0 items-center gap-3">

                    {{-- Hamburger Button --}}
                    <button id="open-sidebar" type="button" onclick="openSidebar()"
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 text-slate-700 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 md:hidden"
                        aria-label="Open menu" aria-expanded="false" aria-controls="sidebar">
                        <i data-lucide="menu" class="h-5 w-5"></i>
                    </button>

                    <div class="min-w-0">
                        <p
                            class="flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">
                            <i data-lucide="layers" class="h-3.5 w-3.5"></i>
                            Administration
                        </p>

                        <h2 class="mt-1 truncate text-lg font-bold text-slate-900">
                            @yield('page-heading', 'Dashboard')
                        </h2>
                    </div>
                </div>

                {{-- User Information --}}
                @auth
                    <div class="ml-3 flex shrink-0 items-center gap-3">
                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-semibold text-slate-800">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs text-slate-500">
                                Order Manager
                            </p>
                        </div>

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-bold text-indigo-700 ring-2 ring-indigo-50">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>
                @endauth

            </header>
            {{-- Success Message --}}
            @if (session('success'))
                <div
                    class="mb-7 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-gradient-to-r from-emerald-50 to-white px-5 py-4 shadow-sm">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                        <i data-lucide="check-circle-2" class="h-5 w-5"></i>
                    </div>

                    <div class="flex-1">
                        <p class="font-bold text-emerald-800">Success</p>
                        <p class="mt-1 text-sm text-emerald-700">
                            {{ session('success') }}
                        </p>
                    </div>

                    <i data-lucide="sparkles" class="h-5 w-5 text-emerald-500"></i>
                </div>
            @endif

            {{-- Error Message --}}
            @if (session('error'))
                <div
                    class="mb-7 flex items-start gap-3 rounded-2xl border border-red-200 bg-gradient-to-r from-red-50 to-white px-5 py-4 shadow-sm">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                        <i data-lucide="alert-circle" class="h-5 w-5"></i>
                    </div>

                    <div class="flex-1">
                        <p class="font-bold text-red-800">Unable to Complete Action</p>
                        <p class="mt-1 text-sm text-red-700">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            @endif

            {{-- Page Content --}}
            <main class="w-full flex-1 p-4 sm:p-5 md:p-8">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="px-5 pb-6 text-center text-xs text-slate-400 md:px-8">
                © {{ date('Y') }} OrderFlow. All rights reserved.
            </footer>

        </div>
    </div>

    {{-- Sidebar JavaScript --}}
    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.add('sidebar-open');
            document.getElementById('sidebar-overlay').classList.add('sidebar-overlay-open');
            document.getElementById('open-sidebar').setAttribute('aria-expanded', 'true');
            document.body.classList.add('overflow-hidden');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('sidebar-open');
            document.getElementById('sidebar-overlay').classList.remove('sidebar-overlay-open');
            document.getElementById('open-sidebar').setAttribute('aria-expanded', 'false');
            document.body.classList.remove('overflow-hidden');
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                closeSidebar();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>

</body>

</html>
