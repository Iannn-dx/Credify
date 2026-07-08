@extends('layouts.app')

@section('title', 'Admin — User Details')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <nav class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-700">
            ← Back to Users
        </a>
    </nav>

    <header class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">{{ $user->name }}</h1>
        <p class="text-sm text-gray-500 mt-0.5">{{ $user->email }}</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">users</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                    <div><p class="text-xs text-gray-400">id</p><p class="font-mono mt-1">{{ $user->id }}</p></div>
                    <div><p class="text-xs text-gray-400">role</p><p class="mt-1 capitalize">{{ $user->role }}</p></div>
                    <div><p class="text-xs text-gray-400">name</p><p class="mt-1">{{ $user->name }}</p></div>
                    <div><p class="text-xs text-gray-400">email</p><p class="mt-1">{{ $user->email }}</p></div>
                    <div><p class="text-xs text-gray-400">email_verified_at</p><p class="mt-1">{{ $user->email_verified_at?->format('M j, Y g:i A') ?? '—' }}</p></div>
                    <div><p class="text-xs text-gray-400">created_at</p><p class="mt-1">{{ $user->created_at?->format('M j, Y g:i A') ?? '—' }}</p></div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">credentials</h2>
                </div>
                @if ($credentials->isEmpty())
                    <p class="p-6 text-sm text-gray-400">No credentials.</p>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach ($credentials as $credential)
                            <div class="px-6 py-4 flex justify-between gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $credential->title }}</p>
                                    <p class="text-xs text-gray-400">{{ $credential->issuer }} • {{ ucfirst($credential->status) }}</p>
                                </div>
                                <span class="text-xs text-gray-400 capitalize">{{ $credential->type }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">verification_requests</h2>
                </div>
                @if ($verificationRequests->isEmpty())
                    <p class="p-6 text-sm text-gray-400">No requests.</p>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach ($verificationRequests as $request)
                            <div class="px-6 py-4 flex justify-between gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">#{{ $request->id }} — {{ $request->credential?->title ?? '—' }}</p>
                                    <p class="text-xs text-gray-400 capitalize">{{ $request->status }}</p>
                                </div>
                                <a href="{{ route('admin.requests.show', $request) }}" class="text-xs text-indigo-600">View</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-3 text-sm">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Counts</h3>
            <div class="flex justify-between"><span class="text-gray-400">credentials</span><span>{{ $user->credentials_count }}</span></div>
            <div class="flex justify-between"><span class="text-gray-400">verification_requests</span><span>{{ $user->verification_request_count }}</span></div>
            <div class="flex justify-between"><span class="text-gray-400">verifications</span><span>{{ $user->verifications_count }}</span></div>
            <div class="flex justify-between"><span class="text-gray-400">credential_histories</span><span>{{ $user->credential_histories_count }}</span></div>
        </div>

    </div>
</div>

@endsection
