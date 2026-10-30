@extends('layouts.app')

@section('title', isset($item) ? 'Edit Item' : 'Create Item')
@section('page-heading', isset($item) ? 'Edit Item' : 'Create New Item')

@section('content')
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('items.index') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600">
                ← Back to Items
            </a>

            <h1 class="mt-4 text-2xl font-bold text-slate-900">
                {{ isset($item) ? 'Edit Item' : 'Create New Item' }}
            </h1>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <form action="{{ isset($item) ? route('items.update', $item) : route('items.store') }}" method="POST"
                class="space-y-6 p-6">

                @csrf

                @if (isset($item))
                    @method('PUT')
                @endif

                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
                        Item Name *
                    </label>

                    <input type="text" id="name" name="name" value="{{ old('name', $item->name ?? '') }}"
                        required
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="mb-2 block text-sm font-semibold text-slate-700">
                        Price *
                    </label>

                    <input type="number" id="price" name="price" value="{{ old('price', $item->price ?? '') }}"
                        min="0" step="0.01" required
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">

                    @error('price')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 border-t border-slate-100 pt-6">
                    <a href="{{ route('items.index') }}"
                        class="rounded-lg border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                        {{ isset($item) ? 'Update Item' : 'Save Item' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
