@extends('layouts.app')

@section('title', 'Admin — Verification Requests')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Verification Requests</h1>
            <p class="text-sm text-gray-500 mt-0.5">All records from <span class="font-mono text-gray-600">verification_requests</span>.</p>
        </div>
        <a href="{{ route('verification.create') }}"
            class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700">
            Review & Record
        </a>
    </header>

    <form method="GET" action="{{ route('admin.requests.index') }}"
        class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm mb-8 flex justify-end">
        <select name="status" onchange="this.form.submit()"
            class="block w-full md:w-auto pl-3 pr-8 py-2.5 text-sm border border-gray-200 rounded-lg bg-white text-gray-700 cursor-pointer">
            <option value="">All Statuses</option>
            @foreach ($statuses as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </form>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-sm">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Credential</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Requested By</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Message</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Requested At</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Responded At</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($requests as $verificationRequest)
                        @php
                            $statusClasses = match ($verificationRequest->status) {
                                'pending' => 'text-amber-700 bg-amber-50 border-amber-100',
                                'accepted' => 'text-indigo-700 bg-indigo-50 border-indigo-100',
                                'declined' => 'text-rose-700 bg-rose-50 border-rose-100',
                                'completed' => 'text-emerald-700 bg-emerald-50 border-emerald-100',
                                default => 'text-gray-700 bg-gray-50 border-gray-100',
                            };
                        @endphp
                        <tr class="hover:bg-gray-50/60">
                            <td class="px-4 py-4 font-mono text-xs">{{ $verificationRequest->id }}</td>
                            <td class="px-4 py-4">
                                <p class="font-medium">{{ $verificationRequest->credential?->title ?? '—' }}</p>
                                <p class="text-xs text-gray-400">credential_id: {{ $verificationRequest->credential_id }}</p>
                            </td>
                            <td class="px-4 py-4">
                                <p>{{ $verificationRequest->user?->name ?? '—' }}</p>
                                <p class="text-xs text-gray-400">requested_by: {{ $verificationRequest->requested_by }}</p>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex px-2.5 py-1 rounded-md border text-xs font-medium capitalize {{ $statusClasses }}">
                                    {{ $verificationRequest->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 max-w-xs truncate">{{ $verificationRequest->message ?? '—' }}</td>
                            <td class="px-4 py-4 text-gray-600">{{ ($verificationRequest->requested_at ?? $verificationRequest->created_at)?->format('M j, Y g:i A') ?? '—' }}</td>
                            <td class="px-4 py-4 text-gray-600">{{ $verificationRequest->responded_at?->format('M j, Y g:i A') ?? '—' }}</td>
                            <td class="px-4 py-4">
                                <a href="{{ route('admin.requests.show', $verificationRequest) }}" class="text-sm font-medium text-indigo-600">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-4 py-12 text-center text-gray-400">No requests found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($requests->hasPages())
        <div class="mt-8">{{ $requests->links() }}</div>
    @endif

</div>

@endsection
