@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-3xl space-y-8">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">My Profile</h1>
            <p class="mt-1 text-sm text-slate-500">
                Update your account information and password.
            </p>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="rounded-lg bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Profile Information --}}
        <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-semibold text-slate-800">
                Profile Information
            </h2>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="mb-1 block text-sm font-medium text-slate-700">
                        Name
                    </label>

                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:outline-none">

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-1 block text-sm font-medium text-slate-700">
                        Email
                    </label>

                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:outline-none">

                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="rounded-lg bg-indigo-600 px-5 py-2 font-medium text-white hover:bg-indigo-700">
                    Save Profile
                </button>
            </form>
        </section>

        {{-- Change Password --}}
        <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-semibold text-slate-800">
                Change Password
            </h2>

            <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="mb-1 block text-sm font-medium text-slate-700">
                        Current Password
                    </label>

                    <input id="current_password" type="password" name="current_password" autocomplete="current-password"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:outline-none">

                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-1 block text-sm font-medium text-slate-700">
                        New Password
                    </label>

                    <input id="password" type="password" name="password" autocomplete="new-password"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:outline-none">

                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-1 block text-sm font-medium text-slate-700">
                        Confirm New Password
                    </label>

                    <input id="password_confirmation" type="password" name="password_confirmation"
                        autocomplete="new-password"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:outline-none">
                </div>

                <button type="submit"
                    class="rounded-lg bg-indigo-600 px-5 py-2 font-medium text-white hover:bg-indigo-700">
                    Change Password
                </button>
            </form>
        </section>

    </div>
@endsection
