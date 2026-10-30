@extends('layouts.app')

@section('title', 'Items')

@section('page-heading', 'Items Management')

@section('content')






    {{-- Page Header --}}
    <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">
                <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                Inventory Management
            </div>

            <h1 class="text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                Items <span class="text-indigo-600">Overview</span>
            </h1>

            <p class="mt-2 max-w-xl text-sm leading-6 text-slate-500">
                Manage your products, monitor pricing, and keep your inventory organized in one place.
            </p>
        </div>

        <a href="{{ route('items.create') }}"
            class="group inline-flex items-center justify-center gap-3 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition duration-300 hover:-translate-y-1 hover:from-indigo-700 hover:to-violet-700 hover:shadow-xl hover:shadow-indigo-200 focus:outline-none focus:ring-4 focus:ring-indigo-200">
            <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-white/15 transition group-hover:rotate-90">
                <i data-lucide="plus" class="h-5 w-5"></i>
            </span>
            Add New Item
            <i data-lucide="arrow-up-right"
                class="h-4 w-4 opacity-70 transition group-hover:translate-x-0.5 group-hover:-translate-y-0.5"></i>
        </a>
    </div>

    {{-- Search Form --}}
    <div class="relative mb-8 overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm sm:p-6">
        <div class="absolute left-0 top-0 h-1 w-full bg-gradient-to-r from-indigo-500 via-violet-500 to-fuchsia-500"></div>

        <div class="mb-4 flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                <i data-lucide="search" class="h-5 w-5"></i>
            </div>

            <div>
                <h2 class="font-bold text-slate-900">Find Items</h2>
                <p class="mt-0.5 text-xs text-slate-500">Search by product name or description</p>
            </div>
        </div>

        <form action="{{ route('items.index') }}" method="GET" class="flex flex-col gap-3 sm:flex-row">
            <div class="relative flex-1">
                <i data-lucide="search"
                    class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"></i>

                <input type="search" name="search" value="{{ $search ?? '' }}"
                    placeholder="Search items by name or description..."
                    class="w-full rounded-xl border border-slate-200 bg-slate-50/70 py-3.5 pl-12 pr-4 text-sm text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 hover:border-slate-300 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
            </div>

            <button type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-3.5 text-sm font-bold text-white shadow-sm transition duration-200 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200">
                <i data-lucide="search" class="h-4 w-4"></i>
                Search
            </button>

            @if (!empty($search))
                <a href="{{ route('items.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3.5 text-sm font-semibold text-slate-600 transition hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600">
                    <i data-lucide="x" class="h-4 w-4"></i>
                    Clear
                </a>
            @endif
        </form>

        @if (!empty($search))
            <p class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                <i data-lucide="filter" class="h-4 w-4 text-indigo-500"></i>
                Search results for
                <span class="rounded-md bg-indigo-50 px-2 py-1 font-semibold text-indigo-700">
                    {{ $search }}
                </span>
            </p>
        @endif
    </div>

    {{-- Summary Cards --}}
    <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2">

        {{-- Total Items --}}
        <div
            class="group relative overflow-hidden rounded-2xl border border-indigo-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-100/60">
            <div
                class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-indigo-50 transition duration-500 group-hover:scale-150">
            </div>

            <div class="relative flex items-start justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500">
                        {{ !empty($search) ? 'Matching Items' : 'Total Items' }}
                    </p>

                    <p class="mt-4 text-4xl font-black tracking-tight text-slate-900">
                        {{ number_format($items->total()) }}
                    </p>

                    <p class="mt-2 flex items-center gap-1.5 text-xs font-medium text-slate-500">
                        <i data-lucide="package" class="h-3.5 w-3.5 text-indigo-500"></i>
                        {{ !empty($search) ? 'Items matching your search' : 'Products in your inventory' }}
                    </p>
                </div>

                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 text-white shadow-lg shadow-indigo-200 transition duration-300 group-hover:rotate-6 group-hover:scale-110">
                    <i data-lucide="package-check" class="h-7 w-7"></i>
                </div>
            </div>

            <div class="relative mt-6 h-1.5 overflow-hidden rounded-full bg-indigo-50">
                <div class="h-full w-2/3 rounded-full bg-gradient-to-r from-indigo-500 to-violet-500"></div>
            </div>
        </div>

        {{-- Total Price --}}
        <div
            class="group relative overflow-hidden rounded-2xl border border-emerald-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-emerald-200 hover:shadow-xl hover:shadow-emerald-100/60">
            <div
                class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-emerald-50 transition duration-500 group-hover:scale-150">
            </div>

            <div class="relative flex items-start justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500">
                        {{ !empty($search) ? 'Matching Items Total Price' : 'Total Price' }}
                    </p>

                    <p class="mt-4 break-words text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                        {{ number_format((float) $totalPrice, 2) }}
                        <span class="text-sm font-bold text-emerald-600">MMK</span>
                    </p>

                    <p class="mt-2 flex items-center gap-1.5 text-xs font-medium text-slate-500">
                        <i data-lucide="wallet" class="h-3.5 w-3.5 text-emerald-500"></i>
                        Total value based on item prices
                    </p>
                </div>

                <div
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white shadow-lg shadow-emerald-200 transition duration-300 group-hover:rotate-6 group-hover:scale-110">
                    <i data-lucide="banknote" class="h-7 w-7"></i>
                </div>
            </div>

            <div class="relative mt-6 h-1.5 overflow-hidden rounded-full bg-emerald-50">
                <div class="h-full w-full rounded-full bg-gradient-to-r from-emerald-500 to-teal-500"></div>
            </div>
        </div>

    </div>

    {{-- Items Table --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">

        {{-- Table Header --}}
        <div
            class="flex flex-col gap-4 border-b border-slate-100 bg-gradient-to-r from-white via-white to-indigo-50/50 px-5 py-6 sm:flex-row sm:items-center sm:justify-between sm:px-7">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600">
                    <i data-lucide="list" class="h-6 w-6"></i>
                </div>

                <div>
                    <h2 class="text-lg font-extrabold tracking-tight text-slate-900">
                        All Items
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        A list of products currently in your system.
                    </p>
                </div>
            </div>

            <div
                class="inline-flex w-fit items-center gap-2 rounded-full border border-emerald-100 bg-emerald-50 px-3.5 py-2 text-xs font-bold text-emerald-700">
                <span class="relative flex h-2 w-2">
                    <span
                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-50"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                </span>
                Inventory Active
            </div>
        </div>

        {{-- Responsive Table --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px] text-left text-sm">

                <thead class="bg-slate-50/80 text-[11px] uppercase tracking-[0.12em] text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-bold">Item</th>
                        <th class="px-6 py-4 font-bold">Description</th>
                        <th class="px-6 py-4 font-bold">Price</th>
                        <th class="px-6 py-4 font-bold">Created</th>
                        <th class="px-6 py-4 text-right font-bold">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($items as $item)
                        <tr class="group transition duration-200 hover:bg-indigo-50/40">

                            {{-- Item Name --}}
                            <td class="whitespace-nowrap px-6 py-5">
                                <div class="flex items-center gap-3.5">
                                    <div
                                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-100 to-violet-100 text-sm font-black text-indigo-700 ring-1 ring-indigo-100 transition duration-300 group-hover:scale-110 group-hover:rotate-3">
                                        {{ strtoupper(substr($item->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="font-bold text-slate-900 transition group-hover:text-indigo-700">
                                            {{ $item->name }}
                                        </p>

                                        <p class="mt-1 text-[11px] font-medium text-slate-400">
                                            ID #{{ $item->id }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Description --}}
                            <td class="max-w-xs px-6 py-5">
                                <p class="line-clamp-2 leading-6 text-slate-500">
                                    {{ $item->description ?: 'No description provided' }}
                                </p>
                            </td>

                            {{-- Price --}}
                            <td class="whitespace-nowrap px-6 py-5">
                                <div
                                    class="inline-flex items-center gap-2 rounded-xl border border-emerald-100 bg-emerald-50/80 px-3 py-2">
                                    <i data-lucide="banknote" class="h-4 w-4 text-emerald-600"></i>
                                    <span class="font-extrabold tabular-nums text-emerald-700">
                                        {{ number_format((float) $item->price, 2) }}
                                    </span>
                                    <span class="text-[10px] font-bold uppercase text-emerald-600">MMK</span>
                                </div>
                            </td>

                            {{-- Created Date --}}
                            <td class="whitespace-nowrap px-6 py-5">
                                <div class="flex items-center gap-2.5">
                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-500 transition group-hover:bg-white group-hover:text-indigo-600">
                                        <i data-lucide="calendar-days" class="h-4 w-4"></i>
                                    </div>

                                    <div>
                                        <p class="font-semibold text-slate-700">
                                            {{ $item->created_at->format('d M Y') }}
                                        </p>

                                        <p class="mt-1 text-[11px] text-slate-400">
                                            {{ $item->created_at->format('h:i A') }}
                                        </p>
                                    </div>
                                </div>
                            </td>


                            {{-- Actions --}}
                            <td class="whitespace-nowrap px-6 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">

                                    <a href="{{ route('items.show', $item) }}" aria-label="View {{ $item->name }}"
                                        title="View item"
                                        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-xs font-bold text-slate-600 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-sky-200 hover:bg-sky-50 hover:text-sky-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-sky-100">
                                        <i data-lucide="eye" class="h-4 w-4"></i>
                                        View
                                    </a>

                                    <a href="{{ route('items.edit', $item) }}" aria-label="Edit {{ $item->name }}"
                                        title="Edit item"
                                        class="inline-flex items-center gap-2 rounded-xl border border-indigo-100 bg-indigo-50/70 px-3.5 py-2.5 text-xs font-bold text-indigo-700 transition duration-200 hover:-translate-y-0.5 hover:border-indigo-300 hover:bg-indigo-600 hover:text-white hover:shadow-md hover:shadow-indigo-200 focus:outline-none focus:ring-4 focus:ring-indigo-100">
                                        <i data-lucide="square-pen" class="h-4 w-4"></i>
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('items.destroy', $item) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" aria-label="Delete {{ $item->name }}"
                                            title="Delete item"
                                            class="inline-flex items-center gap-2 rounded-xl border border-red-100 bg-red-50 px-3.5 py-2.5 text-xs font-bold text-red-700 transition duration-200 hover:-translate-y-0.5 hover:border-red-600 hover:!bg-red-600 hover:!text-white hover:shadow-md hover:shadow-red-200 focus:outline-none focus:ring-4 focus:ring-red-100">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>


                        </tr>
                    @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="mx-auto max-w-md">

                                    <div
                                        class="relative mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-gradient-to-br from-indigo-50 to-violet-100 text-indigo-500">
                                        <i data-lucide="package-search" class="h-9 w-9"></i>
                                        <span
                                            class="absolute -right-2 -top-2 flex h-8 w-8 items-center justify-center rounded-full border-4 border-white bg-white text-slate-400 shadow-sm">
                                            <i data-lucide="search-x" class="h-4 w-4"></i>
                                        </span>
                                    </div>

                                    <h3 class="mt-6 text-lg font-extrabold text-slate-900">
                                        {{ !empty($search) ? 'No matching items found' : 'No items yet' }}
                                    </h3>

                                    <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-500">
                                        @if (!empty($search))
                                            Try another search term or clear your search to see all items.
                                        @else
                                            Your inventory is waiting. Add your first item to start managing your products.
                                        @endif
                                    </p>

                                    @if (!empty($search))
                                        <a href="{{ route('items.index') }}"
                                            class="mt-6 inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 shadow-sm transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">
                                            <i data-lucide="rotate-ccw" class="h-4 w-4"></i>
                                            Clear Search
                                        </a>
                                    @else
                                        <a href="{{ route('items.create') }}"
                                            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition hover:-translate-y-0.5 hover:bg-indigo-700">
                                            <i data-lucide="plus" class="h-4 w-4"></i>
                                            Create First Item
                                        </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($items->hasPages())
            <div
                class="flex flex-col gap-4 border-t border-slate-100 bg-slate-50/50 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-7">
                <p class="text-xs font-medium text-slate-500">
                    Navigate through your inventory pages
                </p>

                <div class="flex flex-wrap items-center gap-2">
                    {{ $items->links() }}
                </div>
            </div>
        @endif

        {{-- Results Count --}}
        <div
            class="flex flex-col gap-2 border-t border-slate-100 bg-white px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-7">
            <p class="text-xs text-slate-500">
                Showing
                <span class="font-bold text-slate-800">{{ $items->firstItem() ?? 0 }}</span>
                to
                <span class="font-bold text-slate-800">{{ $items->lastItem() ?? 0 }}</span>
                of
                <span class="font-bold text-indigo-600">{{ $items->total() }}</span>
                items
            </p>

            <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                <i data-lucide="shield-check" class="h-4 w-4 text-emerald-500"></i>
                Inventory data overview
            </div>
        </div>

    </div>

    {{-- Render Lucide Icons --}}
    <script>
        function renderLucideIcons() {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        }

        document.addEventListener('DOMContentLoaded', renderLucideIcons);
        window.addEventListener('load', renderLucideIcons);
    </script>
@endsection
