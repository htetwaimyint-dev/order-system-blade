@extends('layouts.app')

@section('title', 'Order Details')
@section('page-heading', 'Order Details')

@section('content')
    <div class="mx-auto max-w-5xl space-y-6">

        {{-- Page header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <a href="{{ route('orders.index') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600">
                    ← Back to Orders
                </a>

                <h1 class="mt-4 text-2xl font-bold tracking-tight text-slate-900">
                    Order #{{ $order->id }}
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Created on {{ $order->created_at->format('d M Y, h:i A') }}
                </p>
            </div>


            {{-- Edit and delete actions --}}
            <div class="flex flex-wrap items-center gap-3">

                {{-- Edit order --}}
                <a href="{{ route('orders.edit', $order->id) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    <i data-lucide="pencil" class="h-4 w-4"></i>
                    Edit Order
                </a>

                {{-- Delete order --}}
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this order?');">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-4 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-50">
                        <i data-lucide="trash-2" class="h-4 w-4"></i>
                        Delete Order
                    </button>
                </form>

            </div>

        </div>

        {{-- Order summary --}}
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">
                Order Summary
            </h2>

            <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">

                <div>
                    <p class="text-sm text-slate-500">Order ID</p>
                    <p class="mt-1 font-semibold text-slate-900">
                        #{{ $order->id }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Status</p>
                    <span
                        class="mt-2 inline-flex rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold capitalize text-amber-700 ring-1 ring-inset ring-amber-200">
                        {{ $order->status }}
                    </span>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Order Total</p>
                    <p class="mt-1 text-xl font-bold text-indigo-600">
                        {{ number_format((float) $order->total, 2) }} MMK
                    </p>
                </div>

            </div>
        </section>

        {{-- Order line items --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="font-semibold text-slate-900">Order Items</h2>
                <p class="mt-1 text-sm text-slate-500">
                    {{ $order->orderItems->count() }} line items
                </p>
            </div>

            @if ($order->orderItems->isEmpty())
                <div class="px-6 py-10 text-center text-sm text-slate-500">
                    No items found for this order.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-6 py-4">Item</th>
                                <th class="px-6 py-4 text-right">Unit Price</th>
                                <th class="px-6 py-4 text-right">Quantity</th>
                                <th class="px-6 py-4 text-right">Subtotal</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @foreach ($order->orderItems as $orderItem)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4 font-medium text-slate-900">
                                        {{ $orderItem->item?->name ?? 'Item unavailable' }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-right text-slate-600">
                                        {{ number_format((float) $orderItem->unit_price, 2) }} MMK
                                    </td>

                                    <td class="px-6 py-4 text-right text-slate-600">
                                        {{ $orderItem->quantity }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-right font-semibold text-slate-900">
                                        {{ number_format((float) $orderItem->unit_price * $orderItem->quantity, 2) }} MMK
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot class="border-t border-slate-200 bg-slate-50">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right font-semibold text-slate-700">
                                    Total
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-base font-bold text-indigo-600">
                                    {{ number_format((float) $order->total, 2) }} MMK
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
        </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
@endsection
