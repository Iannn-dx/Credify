@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Admin Dashboard</h1>
            <p class="text-sm text-gray-500 mt-0.5">System-wide overview from all database tables.</p>
        </div>

        <div class="flex items-center gap-3 w-full sm:w-auto">
            @if ($stats['pending_requests'] > 0)
                <a href="{{ route('verification.create') }}"
                    class="flex-1 sm:flex-initial inline-flex justify-center items-center gap-2 bg-amber-500 text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-amber-600 transition-all">
                    {{ $stats['pending_requests'] }} Pending Review
                </a>
            @endif
            <a href="{{ route('admin.requests.index') }}"
                class="flex-1 sm:flex-initial inline-flex justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-100">
                All Requests
            </a>
        </div>
    </header>

    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">users</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $stats['users'] }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">credentials</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $stats['credentials'] }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">verified</p>
            <div class="flex items-baseline gap-2 mt-2">
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['verified'] }}</p>
                @if ($stats['credentials'] > 0)
                    <span class="text-[11px] font-medium text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded">
                        {{ $stats['verified_percent'] }}%
                    </span>
                @endif
            </div>
            <p class="text-[10px] text-gray-400 mt-1">verifications.status = verified</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">pending requests</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $stats['pending_requests'] }}</p>
            <p class="text-[10px] text-gray-400 mt-1">verification_requests.status = pending</p>
        </div>
    </section>

    <section class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-10">
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">admins</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $stats['admins'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">regular users</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $stats['regular_users'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">cred. pending</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $stats['pending_credentials'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">cred. unverified</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $stats['unverified_credentials'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">cred. rejected</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $stats['rejected_credentials'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">verifications</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $stats['verifications'] }}</p>
        </div>
    </section>

    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">total requests</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $stats['total_requests'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">completed requests</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $stats['completed_requests'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">declined requests</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $stats['declined_requests'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">credential_histories</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $stats['credential_histories'] }}</p>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start mb-10">

        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-900">Pending queue</h2>
                <a href="{{ route('admin.requests.index', ['status' => 'pending']) }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">View all →</a>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                @if ($pendingRequests->isEmpty())
                    <p class="p-6 text-sm text-gray-400">No pending verification requests.</p>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach ($pendingRequests as $request)
                            <div class="p-4 hover:bg-gray-50/60">
                                <div class="flex items-center justify-between gap-3">
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            #{{ $request->id }} — {{ $request->credential?->title ?? 'Unknown' }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-0.5">
                                            {{ $request->user?->name ?? '—' }} • {{ ($request->requested_at ?? $request->created_at)?->diffForHumans() }}
                                        </p>
                                    </div>
                                    <a href="{{ route('verification.create', ['verification_request_id' => $request->id]) }}"
                                        class="text-xs font-medium text-indigo-600 shrink-0 hover:text-indigo-800">Review</a>
                                </div>
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
                            @php
                                $statusClasses = match ($credential->status) {
                                    'pending' => 'text-amber-700 bg-amber-50',
                                    'unverified' => 'text-gray-700 bg-gray-50',
                                    'rejected' => 'text-rose-700 bg-rose-50',
                                    default => 'text-gray-700 bg-gray-50',
                                };
                            @endphp
                            <div class="p-4 flex items-center justify-between gap-4 hover:bg-gray-50/60">
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $credential->title }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        {{ $credential->user?->name ?? '—' }} • {{ ucfirst($credential->type) }}
                                    </p>
                                </div>
                                <span class="text-[11px] font-medium px-2 py-1 rounded-md capitalize shrink-0 {{ $statusClasses }}">
                                    {{ $credential->status }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-between pt-2">
                <h2 class="text-sm font-semibold text-gray-900">Recent verifications</h2>
                <a href="{{ route('admin.verifications.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">View all →</a>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                @if ($recentVerifications->isEmpty())
                    <p class="p-6 text-sm text-gray-400">No verifications recorded yet.</p>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach ($recentVerifications as $verification)
                            @php
                                $statusClasses = match ($verification->status) {
                                    'verified' => 'text-emerald-700 bg-emerald-50',
                                    'rejected' => 'text-rose-700 bg-rose-50',
                                    default => 'text-gray-700 bg-gray-50',
                                };
                            @endphp
                            <div class="p-4 hover:bg-gray-50/60">
                                <div class="flex items-center justify-between gap-3">
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $verification->credential?->title ?? '—' }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-0.5">
                                            by {{ $verification->verifier?->name ?? '—' }} • {{ $verification->verified_at?->diffForHumans() ?? '—' }}
                                        </p>
                                    </div>
                                    <span class="text-[11px] font-medium px-2 py-1 rounded-md capitalize shrink-0 {{ $statusClasses }}">
                                        {{ $verification->status }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="space-y-4">
            <h2 class="text-sm font-semibold text-gray-900">System activity</h2>
            <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
                @if ($activities->isEmpty())
                    <p class="text-sm text-gray-400">No activity yet.</p>
                @else
                    <div class="space-y-5">
                        @foreach ($activities as $index => $activity)
                            @php
                                $toneClasses = match ($activity['tone']) {
                                    'emerald' => 'bg-emerald-500 ring-emerald-500/20',
                                    'rose' => 'bg-rose-500 ring-rose-500/20',
                                    'amber' => 'bg-amber-500 ring-amber-500/20',
                                    'indigo' => 'bg-indigo-500 ring-indigo-500/20',
                                    default => 'bg-gray-400 ring-gray-400/20',
                                };
                                $isLast = $index === $activities->count() - 1;
                            @endphp
                            <div class="flex gap-3 text-xs relative">
                                @if (! $isLast)
                                    <div class="absolute left-1.5 top-4 bottom-0 w-0.5 bg-gray-100"></div>
                                @endif
                                <div class="h-3 w-3 rounded-full border-2 border-white ring-1 flex-shrink-0 mt-0.5 z-10 {{ $toneClasses }}"></div>
                                <div>
                                    <p class="font-medium text-gray-800 leading-relaxed">{{ $activity['message'] }}</p>
                                    <p class="text-gray-400 mt-1">{{ $activity['at']?->diffForHumans() ?? '—' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-between pt-2">
                <h2 class="text-sm font-semibold text-gray-900">Recent users</h2>
                <a href="{{ route('admin.users.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">View all →</a>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                @if ($recentUsers->isEmpty())
                    <p class="p-6 text-sm text-gray-400">No users yet.</p>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach ($recentUsers as $recentUser)
                            <a href="{{ route('admin.users.show', $recentUser) }}"
                                class="p-4 flex items-center justify-between gap-4 hover:bg-gray-50/60 block">
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $recentUser->name }}</p>
                                    <p class="text-xs text-gray-400 truncate">{{ $recentUser->email }}</p>
                                </div>
                                <span class="text-xs text-gray-400 capitalize shrink-0">{{ $recentUser->role }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-2 text-xs">
                <a href="{{ route('admin.users.index') }}" class="block text-indigo-600 hover:text-indigo-800 font-medium">Manage Users →</a>
                <a href="{{ route('admin.requests.index') }}" class="block text-indigo-600 hover:text-indigo-800 font-medium">Verification Requests →</a>
                <a href="{{ route('admin.credentials.index') }}" class="block text-indigo-600 hover:text-indigo-800 font-medium">All Credentials →</a>
                <a href="{{ route('verification.create') }}" class="block text-indigo-600 hover:text-indigo-800 font-medium">Record Verification →</a>
            </div>
        </section>

    </div>

</div>

@endsection
