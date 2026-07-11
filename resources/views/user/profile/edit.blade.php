@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <header class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Profile</h1>
        <p class="text-sm text-gray-500 mt-0.5">Your account details from the <span class="font-mono text-gray-600">users</span> table.</p>
    </header>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">users</h2>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                    <div>
                        <p class="text-xs font-medium text-gray-400">id</p>
                        <p class="font-mono text-gray-900 mt-1">{{ $user->id }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">role</p>
                        <p class="text-gray-900 mt-1 capitalize">{{ $user->role }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">name</p>
                        <p class="text-gray-900 mt-1">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">email</p>
                        <p class="text-gray-900 mt-1">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">email_verified_at</p>
                        <p class="text-gray-900 mt-1">
                            {{ $user->email_verified_at?->format('M j, Y g:i A') ?? 'Not verified' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">password</p>
                        <p class="font-mono text-gray-500 mt-1">••••••••</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">created_at</p>
                        <p class="text-gray-900 mt-1">{{ $user->created_at?->format('M j, Y g:i A') ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">updated_at</p>
                        <p class="text-gray-900 mt-1">{{ $user->updated_at?->format('M j, Y g:i A') ?? '—' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-base font-semibold text-gray-900">Update Profile</h2>
                    <p class="text-xs text-gray-500 mt-1">Edit <span class="font-mono">name</span> and <span class="font-mono">email</span>.</p>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="name" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">
                            Name <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                            class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">
                            Email <span class="text-rose-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white">
                        <p class="text-xs text-gray-400 mt-1.5">Changing email clears <span class="font-mono">email_verified_at</span>.</p>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit"
                            class="inline-flex justify-center items-center bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-100">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-base font-semibold text-gray-900">Update Password</h2>
                    <p class="text-xs text-gray-500 mt-1">Updates the <span class="font-mono">password</span> field (stored hashed).</p>
                </div>

                <form action="{{ route('profile.password.update') }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">
                            Current Password <span class="text-rose-500">*</span>
                        </label>
                        <input type="password" id="current_password" name="current_password" required
                            class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white">
                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">
                            New Password <span class="text-rose-500">*</span>
                        </label>
                        <input type="password" id="password" name="password" required
                            class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">
                            Confirm Password <span class="text-rose-500">*</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white">
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit"
                            class="inline-flex justify-center items-center bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-50 transition-all">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>

        </div>

        {{-- <div class="space-y-4 lg:sticky lg:top-8">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-1">Account Activity</h3>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="h-12 w-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 text-lg font-semibold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $user->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="bg-gray-50/50 rounded-xl p-3.5 border border-gray-100 text-xs space-y-2">
                    <div class="flex justify-between gap-4">
                        <span class="text-gray-400">credentials</span>
                        <span class="font-medium text-gray-700">{{ $stats['credentials'] }}</span>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-gray-400">verification_requests</span>
                        <span class="font-medium text-gray-700">{{ $stats['verification_requests'] }}</span>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-gray-400">verifications</span>
                        <span class="font-medium text-gray-700">{{ $stats['verifications'] }}</span>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-gray-400">credential_histories</span>
                        <span class="font-medium text-gray-700">{{ $stats['credential_histories'] }}</span>
                    </div>
                </div>

                <div class="space-y-2 text-xs">
                    <a href="{{ route('credentials.index') }}"
                        class="block text-indigo-600 hover:text-indigo-800 font-medium">
                        My Credentials →
                    </a>
                    <a href="{{ route('requests.index') }}"
                        class="block text-indigo-600 hover:text-indigo-800 font-medium">
                        My Requests →
                    </a>
                    <a href="{{ route('verification.index') }}"
                        class="block text-indigo-600 hover:text-indigo-800 font-medium">
                        Verifications →
                    </a>
                </div>
            </div>
        </div> --}}

    </div>
</div>

@endsection
