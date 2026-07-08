@extends('layouts.app')

@section('title', 'Admin — Request Details')

@section('content')

@php
    $credential = $verificationRequest->credential;
    $statusClasses = match ($verificationRequest->status) {
        'pending' => 'text-amber-700 bg-amber-50 border-amber-100',
        'accepted' => 'text-indigo-700 bg-indigo-50 border-indigo-100',
        'declined' => 'text-rose-700 bg-rose-50 border-rose-100',
        'completed' => 'text-emerald-700 bg-emerald-50 border-emerald-100',
        default => 'text-gray-700 bg-gray-50 border-gray-100',
    };
@endphp

<div class="max-w-5xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <nav class="mb-6">
        <a href="{{ route('admin.requests.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">← Back to Requests</a>
    </nav>

    <header class="pb-6 border-b border-gray-100 mb-8 flex flex-wrap justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 flex-wrap">
                <h1 class="text-2xl font-semibold text-gray-900">Request #{{ $verificationRequest->id }}</h1>
                <span class="inline-flex px-2.5 py-1 rounded-md border text-xs font-medium capitalize {{ $statusClasses }}">
                    {{ $verificationRequest->status }}
                </span>
            </div>
            <p class="text-sm text-gray-500 mt-1">{{ $credential?->title ?? 'Unknown credential' }}</p>
        </div>
        @if ($verificationRequest->status === 'pending')
            <a href="{{ route('verification.create', ['verification_request_id' => $verificationRequest->id]) }}"
                class="inline-flex items-center bg-indigo-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700">
                Record Verification
            </a>
        @endif
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30">
                <h2 class="text-xs font-semibold text-gray-400 uppercase">verification_requests</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                <div><p class="text-xs text-gray-400">id</p><p class="font-mono mt-1">{{ $verificationRequest->id }}</p></div>
                <div><p class="text-xs text-gray-400">credential_id</p><p class="font-mono mt-1">{{ $verificationRequest->credential_id }}</p></div>
                <div><p class="text-xs text-gray-400">requested_by</p><p class="font-mono mt-1">{{ $verificationRequest->requested_by }}</p></div>
                <div><p class="text-xs text-gray-400">requester</p><p class="mt-1">{{ $verificationRequest->user?->name ?? '—' }}</p></div>
                <div><p class="text-xs text-gray-400">status</p><p class="mt-1 capitalize">{{ $verificationRequest->status }}</p></div>
                <div><p class="text-xs text-gray-400">requested_at</p><p class="mt-1">{{ ($verificationRequest->requested_at ?? $verificationRequest->created_at)?->format('M j, Y g:i A') ?? '—' }}</p></div>
                <div><p class="text-xs text-gray-400">responded_at</p><p class="mt-1">{{ $verificationRequest->responded_at?->format('M j, Y g:i A') ?? '—' }}</p></div>
                <div class="sm:col-span-2">
                    <p class="text-xs text-gray-400">message</p>
                    <p class="mt-1 text-gray-600">{{ $verificationRequest->message ?? '—' }}</p>
                </div>
            </div>
        </div>

        @if ($credential)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase">credentials</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                    <div><p class="text-xs text-gray-400">title</p><p class="mt-1">{{ $credential->title }}</p></div>
                    <div><p class="text-xs text-gray-400">owner</p>
                        @if ($credential->user)
                            <a href="{{ route('admin.users.show', $credential->user) }}" class="mt-1 text-indigo-600 hover:underline block">{{ $credential->user->name }}</a>
                        @else
                            <p class="mt-1">—</p>
                        @endif
                    </div>
                    <div><p class="text-xs text-gray-400">type</p><p class="mt-1 capitalize">{{ $credential->type }}</p></div>
                    <div><p class="text-xs text-gray-400">issuer</p><p class="mt-1">{{ $credential->issuer }}</p></div>
                    <div><p class="text-xs text-gray-400">status</p><p class="mt-1 capitalize">{{ $credential->status }}</p></div>
                    <div><p class="text-xs text-gray-400">file_path</p><p class="font-mono text-xs mt-1 break-all">{{ $credential->file_path }}</p></div>
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
