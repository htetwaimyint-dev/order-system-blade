@extends('layouts.app')

@section('title', isset($order) ? 'Edit Order' : 'Create Order')
@section('page-heading', isset($order) ? 'Edit Order' : 'Create Order')

@section('content')
    <div class="mx-auto max-w-5xl space-y-6">

        {{-- Page header --}}
        <div>
            <a href="{{ route('orders.index') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600">
                ← Back to Orders
            </a>

            <h1 class="mt-4 text-2xl font-bold tracking-tight text-slate-900">
                {{ isset($order) ? 'Edit Order' : 'Create New Order' }}
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Select items and specify the quantity for each item.
            </p>
        </div>

        {{-- Order form: store or update depending on the current order --}}
        <form action="{{ isset($order) ? route('orders.update', $order) : route('orders.store') }}" method="POST"
            class="space-y-6">

            @csrf

            @if (isset($order))
                @method('PUT')
            @endif

            {{-- Order information --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="font-semibold text-slate-900">Order Information</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Choose the current status of this order.
                    </p>
                </div>

                <div class="p-6">
                    <label for="status" class="mb-2 block text-sm font-semibold text-slate-700">
                        Order Status <span class="text-red-500">*</span>
                    </label>

                    <select id="status" name="status"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100 sm:max-w-sm">
                        @foreach (['pending', 'processing', 'completed', 'cancelled'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $order->status ?? 'pending') === $status)>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>

                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </section>


            {{-- Select items and quantities --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="font-semibold text-slate-900">Order Items</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Select at least one item and enter its quantity.
                    </p>
                </div>

                <div class="space-y-5 p-6">

                    @error('items')
                        <p class="rounded-lg bg-red-50 p-3 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    @error('items.*.item_id')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    @error('items.*.quantity')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    @forelse ($items as $item)
                        <div
                            class="grid grid-cols-1 gap-4 rounded-xl border border-slate-200 p-4 sm:grid-cols-12 sm:items-center">

                            {{-- Item name and price --}}
                            <div class="sm:col-span-6">
                                <label class="flex items-start gap-3">
                                    <input type="checkbox" name="items[{{ $loop->index }}][item_id]"
                                        value="{{ $item->id }}" @checked(collect(old('items', isset($order) ? $order->orderItems->toArray() : []))->contains(
                                                fn($row) => (string) ($row['item_id'] ?? '') === (string) $item->id))
                                        class="mt-1 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">

                                    <span>
                                        <span class="block font-semibold text-slate-900">
                                            {{ $item->name }}
                                        </span>
                                        <span class="mt-1 block text-sm text-slate-500">
                                            Price: {{ number_format((float) $item->price, 2) }} MMK
                                        </span>
                                    </span>
                                </label>
                            </div>

                            {{-- Quantity input --}}
                            <div class="sm:col-span-3">
                                <label for="quantity-{{ $item->id }}"
                                    class="mb-2 block text-sm font-medium text-slate-700">
                                    Quantity
                                </label>

                                <input type="number" id="quantity-{{ $item->id }}"
                                    name="items[{{ $loop->index }}][quantity]" min="1" step="1"
                                    value="{{ old('items.' . $loop->index . '.quantity', isset($order) ? optional($order->orderItems->firstWhere('item_id', $item->id))->quantity ?? 1 : 1) }}"
                                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            </div>

                            {{-- Display item ID for reference --}}
                            <div class="text-xs text-slate-400 sm:col-span-3 sm:text-right">
                                Item #{{ $item->id }}
                            </div>

                        </div>
                    @empty
                        <div class="rounded-xl border border-dashed border-slate-300 px-6 py-10 text-center">
                            <p class="font-semibold text-slate-800">No items available</p>
                            <p class="mt-1 text-sm text-slate-500">
                                Create an item before creating an order.
                            </p>
                            <a href="{{ route('items.create') }}"
                                class="mt-4 inline-flex rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                                Create Item
                            </a>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- Form actions --}}
            <div class="flex flex-col-reverse justify-end gap-3 sm:flex-row">
                <a href="{{ route('orders.index') }}"
                    class="inline-flex justify-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Cancel
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200">
                    <i data-lucide="save" class="h-4 w-4"></i>
                    {{ isset($order) ? 'Update Order' : 'Create Order' }}
                </button>
            </div>

        </form>
    </div>
@endsection
