@extends('layouts.app')

@section('title', 'Verifications')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Verifications</h1>
            <p class="text-sm text-gray-500 mt-0.5">Verification outcomes recorded in the <span class="font-mono text-gray-600">verifications</span> table.</p>
        </div>

        @if ($pendingRequests->isNotEmpty())
            <a href="{{ route('verification.create') }}"
                class="inline-flex justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Review Pending Request
            </a>
        @endif
    </header>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    @if ($pendingRequests->isNotEmpty())
        <section class="mb-10">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-gray-900">Pending Requests Queue</h2>
                <p class="text-xs text-gray-400">From <span class="font-mono">verification_requests</span> where status = pending</p>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm">
                        <thead class="bg-gray-50/80">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Credential</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Requested By</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Message</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Requested At</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach ($pendingRequests as $pendingRequest)
                                <tr class="hover:bg-gray-50/60 transition-colors">
                                    <td class="px-4 py-4 whitespace-nowrap font-mono text-xs text-gray-500">
                                        {{ $pendingRequest->id }}
                                    </td>
                                    <td class="px-4 py-4 min-w-[10rem]">
                                        <p class="font-medium text-gray-900">{{ $pendingRequest->credential?->title ?? '—' }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">credential_id: {{ $pendingRequest->credential_id }}</p>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                        {{ $pendingRequest->user?->name ?? '—' }}
                                        <p class="text-xs text-gray-400">requested_by: {{ $pendingRequest->requested_by }}</p>
                                    </td>
                                    <td class="px-4 py-4 max-w-xs">
                                        @if ($pendingRequest->message)
                                            <p class="text-gray-600 truncate" title="{{ $pendingRequest->message }}">{{ $pendingRequest->message }}</p>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-gray-600">
                                        {{ ($pendingRequest->requested_at ?? $pendingRequest->created_at)?->format('M j, Y g:i A') ?? '—' }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <a href="{{ route('verification.create', ['verification_request_id' => $pendingRequest->id]) }}"
                                            class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                            Review
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endif

    <form method="GET" action="{{ route('verification.index') }}"
        class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm mb-8 flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="relative w-full md:max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" placeholder="Search verifications..."
                class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white"
                disabled>
        </div>

        <div class="flex items-center gap-3 w-full md:w-auto">
            <select name="status" onchange="this.form.submit()"
                class="block w-full md:w-auto pl-3 pr-8 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white text-gray-700 cursor-pointer">
                <option value="">All Statuses</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @if ($verifications->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 px-6 border-2 border-dashed border-gray-200 rounded-xl bg-white text-center">
            <div class="p-4 bg-gray-50 rounded-full mb-4 ring-1 ring-gray-100">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                    </path>
                </svg>
            </div>

            <h3 class="text-lg font-semibold text-gray-900">No verifications recorded yet</h3>
            <p class="mt-1 max-w-sm text-sm text-gray-500">
                Completed reviews will appear here once a verifier records an outcome.
            </p>
        </div>
    @else
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Credential</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Verifier</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Remarks</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Verified At</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Created At</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @foreach ($verifications as $verification)
                            @php
                                $status = $verification->status;
                                $statusClasses = match ($status) {
                                    'verified' => 'text-emerald-700 bg-emerald-50 border-emerald-100',
                                    'rejected' => 'text-rose-700 bg-rose-50 border-rose-100',
                                    default => 'text-gray-700 bg-gray-50 border-gray-100',
                                };
                            @endphp

                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap font-mono text-xs text-gray-500">
                                    {{ $verification->id }}
                                </td>

                                <td class="px-4 py-4 min-w-[10rem]">
                                    <p class="font-medium text-gray-900">{{ $verification->credential?->title ?? '—' }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">credential_id: {{ $verification->credential_id }}</p>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ $verification->verifier?->name ?? '—' }}
                                    <p class="text-xs text-gray-400">verifier_id: {{ $verification->verifier_id }}</p>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md border text-xs font-medium capitalize {{ $statusClasses }}">
                                        {{ $status }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 max-w-xs">
                                    @if ($verification->remarks)
                                        <p class="text-gray-600 truncate" title="{{ $verification->remarks }}">{{ $verification->remarks }}</p>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-600">
                                    {{ $verification->verified_at?->format('M j, Y g:i A') ?? '—' }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-600">
                                    {{ $verification->created_at?->format('M j, Y g:i A') ?? '—' }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">
                                    <a href="{{ route('verification.show', $verification) }}"
                                        class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($verifications->hasPages())
            <div class="mt-8 pt-6 border-t border-gray-200">
                {{ $verifications->links() }}
            </div>
        @endif
    @endif

</div>

@endsection
