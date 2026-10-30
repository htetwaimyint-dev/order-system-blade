@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-heading', 'Dashboard')

@section('content')
    <div class="space-y-8">

        {{-- Dashboard Heading --}}
        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Dashboard Overview
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Overview of your orders, items, and revenue.
            </p>
        </div>

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Total Orders --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-slate-500">
                        Total Orders
                    </p>

                    <div class="rounded-xl bg-indigo-50 p-3">
                        <i data-lucide="shopping-cart" class="h-6 w-6 text-indigo-600"></i>
                    </div>
                </div>

                <p class="mt-4 text-3xl font-bold text-slate-900">
                    {{ $totalOrders }}
                </p>

                <a href="{{ route('orders.index') }}"
                    class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                    View Orders
                    <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                </a>
            </div>

            {{-- Pending Orders --}}
            <div class="rounded-2xl border border-amber-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-amber-700">
                        Pending Orders
                    </p>

                    <div class="rounded-xl bg-amber-50 p-3">
                        <i data-lucide="clock" class="h-6 w-6 text-amber-600"></i>
                    </div>
                </div>

                <p class="mt-4 text-3xl font-bold text-slate-900">
                    {{ $pendingOrders }}
                </p>

                <a href="{{ route('orders.index') }}"
                    class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-amber-700 hover:text-amber-900">
                    Manage Orders
                    <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                </a>
            </div>

            {{-- Total Items --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-slate-500">
                        Total Items
                    </p>

                    <div class="rounded-xl bg-sky-50 p-3">
                        <i data-lucide="package" class="h-6 w-6 text-sky-600"></i>
                    </div>
                </div>

                <p class="mt-4 text-3xl font-bold text-slate-900">
                    {{ $totalItems }}
                </p>

                <a href="{{ route('items.index') }}"
                    class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                    View Items
                    <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                </a>
            </div>

            {{-- Completed Revenue --}}
            <div class="rounded-2xl border border-emerald-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-emerald-700">
                        Completed Revenue
                    </p>

                    <div class="rounded-xl bg-emerald-50 p-3">
                        <i data-lucide="banknote" class="h-6 w-6 text-emerald-600"></i>
                    </div>
                </div>

                <p class="mt-4 break-words text-3xl font-bold text-slate-900">
                    {{ number_format($totalRevenue, 2) }}
                </p>

                <p class="mt-4 text-sm text-slate-500">
                    From completed orders
                </p>
            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-indigo-50 p-3">
                    <i data-lucide="zap" class="h-6 w-6 text-indigo-600"></i>
                </div>

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Quick Actions
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Quickly manage your orders and items.
                    </p>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">

                {{-- Create Order --}}
                <a href="{{ route('orders.create') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    <i data-lucide="plus-circle" class="h-4 w-4"></i>
                    Create Order
                </a>

                {{-- Add New Item --}}
                <a href="{{ route('items.create') }}"
                    class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    <i data-lucide="package-plus" class="h-4 w-4"></i>
                    Add New Item
                </a>

            </div>
        </div>

    </div>
@endsection
