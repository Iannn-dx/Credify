@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <header class="mb-10">
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Admin Dashboard</h1>
        <p class="text-sm text-gray-500 mt-0.5">System overview across all database tables.</p>
    </header>

    <section class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-10">
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">users</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $stats['users'] }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">credentials</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $stats['credentials'] }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">pending requests</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $stats['pending_requests'] }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">verifications</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $stats['verifications'] }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">verified</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $stats['verified'] }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">rejected credentials</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $stats['rejected_credentials'] }}</p>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-900">Recent verification_requests</h2>
                <a href="{{ route('admin.requests.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">View all →</a>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                @if ($recentRequests->isEmpty())
                    <p class="p-6 text-sm text-gray-400">No requests yet.</p>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach ($recentRequests as $request)
                            <div class="p-4 flex items-center justify-between gap-4 hover:bg-gray-50/60">
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        #{{ $request->id }} — {{ $request->credential?->title ?? 'Unknown' }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        {{ $request->user?->name ?? '—' }} • {{ ucfirst($request->status) }}
                                    </p>
                                </div>
                                <a href="{{ route('admin.requests.show', $request) }}" class="text-xs font-medium text-indigo-600 shrink-0">View</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-900">Recent credentials</h2>
                <a href="{{ route('admin.credentials.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">View all →</a>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                @if ($recentCredentials->isEmpty())
                    <p class="p-6 text-sm text-gray-400">No credentials yet.</p>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach ($recentCredentials as $credential)
                            <div class="p-4 flex items-center justify-between gap-4 hover:bg-gray-50/60">
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $credential->title }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        {{ $credential->user?->name ?? '—' }} • {{ ucfirst($credential->status) }}
                                    </p>
                                </div>
                                <span class="text-xs text-gray-400 shrink-0 capitalize">{{ $credential->type }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

    </div>

    <section class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.users.index') }}" class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm hover:border-gray-200 transition-all">
            <p class="text-sm font-semibold text-gray-900">Manage Users</p>
            <p class="text-xs text-gray-400 mt-1">Browse all users records</p>
        </a>
        <a href="{{ route('admin.requests.index') }}" class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm hover:border-gray-200 transition-all">
            <p class="text-sm font-semibold text-gray-900">Verification Requests</p>
            <p class="text-xs text-gray-400 mt-1">Review all submitted requests</p>
        </a>
        <a href="{{ route('admin.credentials.index') }}" class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm hover:border-gray-200 transition-all">
            <p class="text-sm font-semibold text-gray-900">All Credentials</p>
            <p class="text-xs text-gray-400 mt-1">View every uploaded credential</p>
        </a>
        <a href="{{ route('admin.verifications.index') }}" class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm hover:border-gray-200 transition-all">
            <p class="text-sm font-semibold text-gray-900">All Verifications</p>
            <p class="text-xs text-gray-400 mt-1">Browse verification outcomes</p>
        </a>
    </section>

</div>

@endsection
