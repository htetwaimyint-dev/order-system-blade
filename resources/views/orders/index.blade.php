@extends('layouts.app')

@section('title', 'Orders')

@section('page-heading', 'Orders')

@section('content')
    <div class="mx-auto max-w-7xl space-y-6">

        {{-- Page Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                    Orders
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    View and manage your orders.
                </p>

                <div class="mt-4">
                    <a href="{{ route('orders.create') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                        <i data-lucide="plus" class="h-4 w-4"></i>
                        Create Order
                    </a>
                </div>

            </div>
        </div>

        {{-- Search Orders --}}
        <form action="{{ route('orders.index') }}" method="GET"
            class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

            <div class="flex flex-col gap-3 sm:flex-row">

                {{-- Search input: keeps the current keyword after submission --}}
                <div class="relative flex-1">
                    <i data-lucide="search" class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"></i>

                    <input type="search" name="search" value="{{ $search ?? request('search') }}"
                        placeholder="Search by order ID, status, or item name..."
                        class="w-full rounded-xl border border-slate-300 py-3 pl-10 pr-4 text-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                </div>

                {{-- Submit search --}}
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    <i data-lucide="search" class="h-4 w-4"></i>
                    Search
                </button>

                {{-- Clear search and return to the full list --}}
                @if (request()->filled('search'))
                    <a href="{{ route('orders.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        <i data-lucide="x" class="h-4 w-4"></i>
                        Clear
                    </a>
                @endif

            </div>
        </form>


        {{-- Orders Table --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="font-semibold text-slate-900">
                    Order List
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Total: {{ $orders->total() }} orders
                </p>
            </div>

            @if ($orders->isEmpty())
                <div class="px-6 py-16 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">
                        <i data-lucide="shopping-cart" class="h-7 w-7 text-slate-400"></i>
                    </div>

                    <h3 class="mt-4 text-base font-semibold text-slate-900">
                        No orders found
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Your orders will appear here.
                    </p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-6 py-4">Order ID</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Total</th>
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @foreach ($orders as $order)
                                <tr class="transition hover:bg-slate-50">

                                    <td class="whitespace-nowrap px-6 py-4 font-semibold">
                                        <a href="{{ route('orders.show', $order->id) }}"
                                            class="text-indigo-600 transition hover:text-indigo-800 hover:underline">
                                            #{{ $order->id }}
                                        </a>
                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="inline-flex rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold capitalize text-amber-700 ring-1 ring-inset ring-amber-200">
                                            {{ $order->status }}
                                        </span>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 font-medium text-slate-700">
                                        {{ number_format((float) $order->total, 2) }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-slate-500">
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>


                                    {{-- Actions: edit and delete the current order --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">

                                            {{-- Edit button --}}
                                            <a href="{{ route('orders.edit', $order->id) }}"
                                                class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium text-indigo-600 transition hover:border-indigo-300 hover:bg-indigo-50">
                                                <i data-lucide="pencil" class="h-4 w-4"></i>
                                                Edit
                                            </a>

                                            {{-- Delete form --}}
                                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this order?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-flex items-center gap-2 rounded-lg border border-red-200 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50">
                                                    <i data-lucide="trash-2" class="h-4 w-4"></i>
                                                    Delete
                                                </button>
                                            </form>

                                            {{-- View Order Details --}}
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium text-blue-600 transition hover:bg-blue-50">
                                                <i data-lucide="eye" class="h-4 w-4"></i>
                                                View
                                            </a>


                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="border-t border-slate-200 px-6 py-4">
                    {{ $orders->links() }}
                </div>
            @endif

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
@endsection
