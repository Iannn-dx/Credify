@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Credentials Overview</h1>
            <p class="text-sm text-gray-500 mt-0.5">Your account summary from the database.</p>
        </div>

        <div class="flex items-center gap-3 w-full sm:w-auto">
            <a href="{{ route('requests.create') }}"
                class="flex-1 sm:flex-initial inline-flex justify-center items-center gap-2 bg-white border border-gray-200 text-gray-700 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-50 transition-all">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
                Submit Request
            </a>
            <a href="{{ route('credentials.index') }}"
                class="flex-1 sm:flex-initial inline-flex justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Upload Document
            </a>
        </div>
    </header>

    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">credentials</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $stats['total_credentials'] }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">verified</p>
            <div class="flex items-baseline gap-2 mt-2">
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['verified'] }}</p>
                @if ($stats['total_credentials'] > 0)
                    <span class="text-[11px] font-medium text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded">
                        {{ $stats['verified_percent'] }}%
                    </span>
                @endif
            </div>
            <p class="text-[10px] text-gray-400 mt-1">from verifications.status</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">pending</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $stats['pending_credentials'] }}</p>
            <p class="text-[10px] text-gray-400 mt-1">credentials.status = pending</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">rejected</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $stats['rejected_credentials'] }}</p>
            <p class="text-[10px] text-gray-400 mt-1">credentials.status = rejected</p>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        <section class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-900 tracking-tight">Recent credentials</h2>
                <a href="{{ route('credentials.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700 transition-colors">View all →</a>
            </div>

            @if ($recentCredentials->isEmpty())
                <div class="bg-white p-8 rounded-xl border border-dashed border-gray-200 text-center">
                    <p class="text-sm text-gray-500">No credentials uploaded yet.</p>
                    <a href="{{ route('credentials.index') }}" class="mt-3 inline-block text-sm font-medium text-indigo-600 hover:text-indigo-800">
                        Upload your first credential →
                    </a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($recentCredentials as $credential)
                        @php
                            $latestVerification = $credential->verifications->first();
                            $status = $credential->status;

                            $statusClasses = match ($status) {
                                'pending' => 'text-amber-700 bg-amber-50',
                                'unverified' => 'text-gray-700 bg-gray-50',
                                'rejected' => 'text-rose-700 bg-rose-50',
                                default => 'text-gray-700 bg-gray-50',
                            };

                            $dotClasses = match ($status) {
                                'pending' => 'bg-amber-500',
                                'unverified' => 'bg-gray-400',
                                'rejected' => 'bg-rose-500',
                                default => 'bg-gray-400',
                            };
                        @endphp

                        <a href="{{ route('credentials.show', $credential) }}"
                            class="bg-white p-4 rounded-xl border border-gray-100 flex items-center justify-between gap-4 hover:border-gray-200 transition-all block">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <div class="h-10 w-10 rounded-xl bg-indigo-50 flex items-center justify-center flex-shrink-0 text-indigo-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l9-5-9-4-9 5 9 4zm0 0v6l9-5V9l-9 5zm0 0l-9-5v6l9 5v-6z"></path>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">{{ $credential->title }}</h3>
                                    <p class="text-xs text-gray-400 truncate mt-0.5">
                                        {{ $credential->issuer }} • {{ ucfirst($credential->type) }}
                                    </p>
                                    @if ($status === 'rejected' && $latestVerification?->remarks)
                                        <p class="text-xs text-rose-500 font-medium mt-1 truncate">{{ $latestVerification->remarks }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col items-end gap-1 flex-shrink-0">
                                <span class="inline-flex items-center gap-1.5 text-[11px] font-medium px-2.5 py-1 rounded-md capitalize {{ $statusClasses }}">
                                    <span class="h-1 w-1 rounded-full {{ $dotClasses }}"></span>
                                    {{ $status }}
                                </span>
                                @if ($latestVerification)
                                    <span class="text-[10px] text-gray-400 capitalize">verification: {{ $latestVerification->status }}</span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </section>

        <section class="space-y-4">
            <h2 class="text-sm font-semibold text-gray-900 tracking-tight">Activity</h2>
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

            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-2 text-xs">
                <a href="{{ route('requests.index') }}" class="block text-indigo-600 hover:text-indigo-800 font-medium">My Requests →</a>
                <a href="{{ route('verification.index') }}" class="block text-indigo-600 hover:text-indigo-800 font-medium">Verifications →</a>
                <a href="{{ route('profile.edit') }}" class="block text-indigo-600 hover:text-indigo-800 font-medium">Profile →</a>
            </div>
        </section>

    </div>
</div>

@endsection
