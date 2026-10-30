@extends('layouts.app')

@section('title', 'View Item')
@section('page-heading', 'Item Details')

@section('content')

    <div class="item-details-page mx-auto max-w-6xl">

        {{-- Breadcrumb --}}
        <div class="mb-6 flex items-center gap-2 text-sm text-slate-500">
            <i data-lucide="house" class="h-4 w-4"></i>
            <span>Inventory</span>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <a href="{{ route('items.index') }}" class="transition hover:text-indigo-600">
                Items
            </a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="font-semibold text-indigo-600">Details</span>
        </div>

        {{-- Page Heading --}}
        <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 via-violet-600 to-purple-600 text-white shadow-xl shadow-indigo-200">
                    <i data-lucide="package" class="h-8 w-8"></i>
                </div>

                <div>
                    <p class="mb-1 text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">
                        Inventory Management
                    </p>
                    <h1 class="text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                        Item Details
                    </h1>
                    <p class="mt-2 text-sm text-slate-500">
                        View and manage your product information.
                    </p>
                </div>
            </div>

            <a href="{{ route('items.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 font-semibold text-slate-700 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700 hover:shadow-md">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                Back to Items
            </a>
        </div>

        {{-- Main Details Card --}}
        <div
            class="details-card animate-[itemDetailsEnter_.55s_cubic-bezier(.2,.7,.2,1)_both] overflow-hidden rounded-3xl border border-white bg-white shadow-xl shadow-slate-200/70 motion-reduce:animate-none">

            {{-- Colorful Hero Section --}}
            <div
                class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-purple-700 p-6 text-white sm:p-9">
                <div
                    class="pointer-events-none absolute -right-12 -top-16 h-64 w-64 rounded-full border-[35px] border-white/10">
                </div>
                <div
                    class="pointer-events-none absolute -bottom-24 right-1/3 h-48 w-48 rounded-full bg-fuchsia-400/20 blur-2xl">
                </div>

                <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center">
                    <div
                        class="flex h-24 w-24 shrink-0 items-center justify-center rounded-3xl border border-white/20 bg-white/15 shadow-inner backdrop-blur-sm transition duration-300 hover:rotate-3 hover:scale-105">
                        <i data-lucide="package-open" class="h-12 w-12"></i>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-indigo-100">
                            Product Name
                        </p>

                        <h2 class="mt-2 break-words text-3xl font-black tracking-tight sm:text-4xl">
                            {{ $item->name }}
                        </h2>

                        <div class="mt-4 flex flex-wrap items-center gap-3">
                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/15 px-3 py-1.5 text-xs font-bold backdrop-blur-sm">
                                <i data-lucide="hash" class="h-3.5 w-3.5"></i>
                                Item ID: {{ $item->id }}
                            </span>

                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-emerald-400/20 px-3 py-1.5 text-xs font-bold text-emerald-100">
                                <i data-lucide="check-circle-2" class="h-3.5 w-3.5"></i>
                                Inventory Item
                            </span>
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="rounded-2xl border border-white/20 bg-white/10 p-5 backdrop-blur-md sm:min-w-48">
                        <div class="flex items-center gap-2 text-sm font-medium text-indigo-100">
                            <i data-lucide="wallet" class="h-4 w-4"></i>
                            Item Price
                        </div>

                        <p class="mt-3 break-words text-2xl font-black sm:text-3xl">
                            {{ number_format((float) $item->price, 2) }}
                        </p>

                        <p class="mt-1 text-xs font-semibold tracking-widest text-indigo-200">
                            MYANMAR KYAT (MMK)
                        </p>
                    </div>
                </div>
            </div>

            {{-- Information Section --}}
            <div class="p-6 sm:p-9">

                <div class="mb-6 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        <i data-lucide="clipboard-list" class="h-5 w-5"></i>
                    </div>

                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900">
                            Product Information
                        </h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Complete details about this item.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- Item ID --}}
                    <div
                        class="detail-tile group animate-[itemTileEnter_.45s_ease-out_both] rounded-2xl border border-indigo-100 bg-gradient-to-br from-indigo-50 to-white p-5 transition duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-100/60 motion-reduce:animate-none motion-reduce:transition-none">
                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-md shadow-indigo-200 transition group-hover:rotate-6 motion-reduce:transition-none">
                                <i data-lucide="tag" class="h-6 w-6"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs font-bold uppercase tracking-wider text-indigo-600">
                                    Item ID
                                </p>
                                <p class="mt-2 break-words text-lg font-extrabold text-slate-900">
                                    #{{ $item->id }}
                                </p>
                                <p class="mt-1 text-xs text-slate-500">
                                    Unique product identifier
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Name --}}
                    <div
                        class="detail-tile group animate-[itemTileEnter_.45s_ease-out_both] rounded-2xl border border-violet-100 bg-gradient-to-br from-violet-50 to-white p-5 transition duration-300 delay-[60ms] hover:-translate-y-1 hover:border-violet-200 hover:shadow-lg hover:shadow-violet-100/60 motion-reduce:animate-none motion-reduce:transition-none">
                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-violet-600 text-white shadow-md shadow-violet-200 transition group-hover:-rotate-6 motion-reduce:transition-none">
                                <i data-lucide="text" class="h-6 w-6"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs font-bold uppercase tracking-wider text-violet-600">
                                    Product Name
                                </p>
                                <p class="mt-2 break-words text-lg font-extrabold text-slate-900">
                                    {{ $item->name }}
                                </p>
                                <p class="mt-1 text-xs text-slate-500">
                                    Name saved in your inventory
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div
                        class="detail-tile group animate-[itemTileEnter_.45s_ease-out_both] rounded-2xl border border-fuchsia-100 bg-gradient-to-br from-fuchsia-50 to-white p-5 transition duration-300 delay-[120ms] hover:-translate-y-1 hover:border-fuchsia-200 hover:shadow-lg hover:shadow-fuchsia-100/60 md:col-span-2 motion-reduce:animate-none motion-reduce:transition-none">
                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-fuchsia-600 text-white shadow-md shadow-fuchsia-200 transition group-hover:scale-105 motion-reduce:transition-none">
                                <i data-lucide="file-text" class="h-6 w-6"></i>
                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-bold uppercase tracking-wider text-fuchsia-600">
                                    Description
                                </p>
                                <p class="mt-2 whitespace-pre-line break-words text-sm leading-7 text-slate-700">
                                    {{ $item->description ?: 'No description provided.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Created At --}}
                    <div
                        class="detail-tile group animate-[itemTileEnter_.45s_ease-out_both] rounded-2xl border border-teal-100 bg-gradient-to-br from-teal-50 to-white p-5 transition duration-300 delay-[180ms] hover:-translate-y-1 hover:border-teal-200 hover:shadow-lg hover:shadow-teal-100/60 md:col-span-2 motion-reduce:animate-none motion-reduce:transition-none">
                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-teal-600 text-white shadow-md shadow-teal-200 transition group-hover:rotate-6 motion-reduce:transition-none">
                                <i data-lucide="calendar-clock" class="h-5 w-5"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs font-bold uppercase tracking-wider text-teal-700">
                                    Created At
                                </p>
                                <p class="mt-2 text-base font-extrabold text-slate-900">
                                    {{ $item->created_at->format('d M Y') }}
                                </p>
                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $item->created_at->format('h:i A') }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>


                {{-- Related Orders --}}
                <div class="mt-8 border-t border-slate-100 pt-7">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                            <i data-lucide="shopping-cart" class="h-5 w-5"></i>
                        </div>

                        <div>
                            <h3 class="text-lg font-extrabold text-slate-900">
                                Related Orders
                            </h3>
                            <p class="mt-1 text-sm text-slate-500">
                                Orders that contain this item.
                            </p>
                        </div>
                    </div>

                    @forelse ($orders as $order)
                        <div
                            class="mb-3 flex flex-col gap-3 rounded-xl border border-slate-200 bg-white p-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="font-bold text-slate-900">
                                    Order #{{ $order->id }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $order->created_at?->format('d M Y, h:i A') ?? 'Date unavailable' }}
                                </p>
                            </div>

                            <a href="{{ route('orders.show', $order) }}"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-50 px-4 py-2 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100">
                                View Order
                                <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                            </a>
                        </div>
                    @empty
                        <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center">
                            <i data-lucide="shopping-bag" class="mx-auto h-8 w-8 text-slate-400"></i>

                            <p class="mt-3 font-semibold text-slate-700">
                                No orders found
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                This item has not been added to any order yet.
                            </p>
                        </div>
                    @endforelse
                </div>



                {{-- Bottom Information and Actions --}}
                <div class="mt-8 border-t border-slate-100 pt-7">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                        <div class="flex items-start gap-3">
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                                <i data-lucide="shield-check" class="h-5 w-5"></i>
                            </div>

                            <div>
                                <h3 class="font-bold text-slate-900">
                                    Item Information
                                </h3>
                                <p class="mt-1 max-w-lg text-sm leading-6 text-slate-500">
                                    This item is stored in your inventory. You can edit its details or return to the item
                                    list.
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('items.edit', $item) }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition duration-300 hover:-translate-y-1 hover:from-indigo-700 hover:to-violet-700 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-indigo-200">
                                <i data-lucide="square-pen" class="h-4 w-4"></i>
                                Edit Item
                                <i data-lucide="arrow-up-right" class="ml-1 h-4 w-4"></i>
                            </a>

                            <a href="{{ route('items.index') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3.5 text-sm font-bold text-slate-600 transition duration-300 hover:-translate-y-0.5 hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600 focus:outline-none focus:ring-4 focus:ring-rose-100">
                                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                                Back to Items
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        {{-- Footer --}}
        <div class="mt-6 flex flex-col gap-2 px-2 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
            <p class="flex items-center gap-2">
                <i data-lucide="package" class="h-4 w-4 text-indigo-500"></i>
                OrderFlow Inventory Management
            </p>
            <p>Keep your inventory organized.</p>
        </div>

    </div>

    {{-- Render icons --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>

@endsection
