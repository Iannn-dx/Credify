@extends('layouts.app')

@section('title', 'Verification Details')

@section('content')

@php
    $credential = $verification->credential;
    $status = $verification->status;
    $statusClasses = match ($status) {
        'verified' => 'text-emerald-700 bg-emerald-50 border-emerald-100',
        'rejected' => 'text-rose-700 bg-rose-50 border-rose-100',
        default => 'text-gray-700 bg-gray-50 border-gray-100',
    };
@endphp

<div class="max-w-5xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <nav class="mb-6">
        <a href="{{ route('verification.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Verifications
        </a>
    </nav>

    <header class="pb-6 border-b border-gray-100 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <div class="flex items-center gap-3 flex-wrap">
                    <h1 class="text-2xl font-semibold tracking-tight text-gray-900">
                        {{ $credential?->title ?? 'Verification Record' }}
                    </h1>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md border text-xs font-medium capitalize {{ $statusClasses }}">
                        {{ $status }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 mt-1">
                    Verification #{{ $verification->id }} • Recorded {{ $verification->verified_at?->format('M j, Y g:i A') ?? '—' }}
                </p>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">verifications</h2>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                <div>
                    <p class="text-xs font-medium text-gray-400">id</p>
                    <p class="font-mono text-gray-900 mt-1">{{ $verification->id }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400">credential_id</p>
                    <p class="font-mono text-gray-900 mt-1">{{ $verification->credential_id }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400">verifier_id</p>
                    <p class="font-mono text-gray-900 mt-1">{{ $verification->verifier_id }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400">verifier</p>
                    <p class="text-gray-900 mt-1">{{ $verification->verifier?->name ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400">status</p>
                    <p class="text-gray-900 mt-1 capitalize">{{ $verification->status }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400">verified_at</p>
                    <p class="text-gray-900 mt-1">{{ $verification->verified_at?->format('M j, Y g:i A') ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400">created_at</p>
                    <p class="text-gray-900 mt-1">{{ $verification->created_at?->format('M j, Y g:i A') ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400">updated_at</p>
                    <p class="text-gray-900 mt-1">{{ $verification->updated_at?->format('M j, Y g:i A') ?? '—' }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-xs font-medium text-gray-400">remarks</p>
                    @if ($verification->remarks)
                        <p class="text-gray-600 mt-1 bg-gray-50/60 p-3 rounded-xl border border-gray-100 leading-relaxed">
                            {{ $verification->remarks }}
                        </p>
                    @else
                        <p class="text-gray-400 mt-1">—</p>
                    @endif
                </div>
            </div>
        </div>

        @if ($credential)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">credentials</h2>
                    <a href="{{ route('credentials.show', $credential) }}"
                        class="text-xs font-medium text-indigo-600 hover:text-indigo-800">
                        View credential →
                    </a>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                    <div>
                        <p class="text-xs font-medium text-gray-400">title</p>
                        <p class="text-gray-900 mt-1">{{ $credential->title }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">type</p>
                        <p class="text-gray-900 mt-1 capitalize">{{ $credential->type }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">issuer</p>
                        <p class="text-gray-900 mt-1">{{ $credential->issuer }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">status</p>
                        <p class="text-gray-900 mt-1 capitalize">{{ $credential->status }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">issue_date</p>
                        <p class="text-gray-900 mt-1">
                            {{ $credential->issue_date ? \Carbon\Carbon::parse($credential->issue_date)->format('M j, Y') : '—' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">expiry_date</p>
                        <p class="text-gray-900 mt-1">
                            {{ $credential->expiry_date ? \Carbon\Carbon::parse($credential->expiry_date)->format('M j, Y') : '—' }}
                        </p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-xs font-medium text-gray-400">file_path</p>
                        <p class="font-mono text-xs text-gray-600 mt-1 break-all">{{ $credential->file_path }}</p>
                    </div>
                    @if ($credential->description)
                        <div class="sm:col-span-2">
                            <p class="text-xs font-medium text-gray-400">description</p>
                            <p class="text-gray-600 mt-1 leading-relaxed">{{ $credential->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
