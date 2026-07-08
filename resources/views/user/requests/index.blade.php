@extends('layouts.app')

@section('title', 'Verification Requests')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Verification Requests</h1>
            <p class="text-sm text-gray-500 mt-0.5">Requests submitted from your credentials for institutional review.</p>
        </div>

        <a href="{{ route('requests.create') }}"
            class="inline-flex justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-100">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Submit Request
        </a>
    </header>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('requests.index') }}"
        class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm mb-8 flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="relative w-full md:max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" placeholder="Search by credential title or issuer..."
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

    @if ($requests->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 px-6 border-2 border-dashed border-gray-200 rounded-xl bg-white text-center">
            <div class="p-4 bg-gray-50 rounded-full mb-4 ring-1 ring-gray-100">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
            </div>

            <h3 class="text-lg font-semibold text-gray-900">No verification requests yet</h3>
            <p class="mt-1 max-w-sm text-sm text-gray-500">
                Submit a request against one of your uploaded credentials to start the verification process.
            </p>

            <a href="{{ route('requests.create') }}"
                class="mt-6 inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700">
                Submit Request
            </a>
        </div>
    @else
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Credential</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Issuer</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Request Status</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Credential Status</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Message</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Requested At</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Responded At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @foreach ($requests as $verificationRequest)
                            @php
                                $credential = $verificationRequest->credential;
                                $requestStatus = $verificationRequest->status;
                                $credentialStatus = $credential?->status;

                                $requestStatusClasses = match ($requestStatus) {
                                    'pending' => 'text-amber-700 bg-amber-50 border-amber-100',
                                    'accepted' => 'text-indigo-700 bg-indigo-50 border-indigo-100',
                                    'declined' => 'text-rose-700 bg-rose-50 border-rose-100',
                                    'completed' => 'text-emerald-700 bg-emerald-50 border-emerald-100',
                                    default => 'text-gray-700 bg-gray-50 border-gray-100',
                                };

                                $credentialStatusClasses = match ($credentialStatus) {
                                    'pending' => 'text-amber-700 bg-amber-50 border-amber-100',
                                    'unverified' => 'text-gray-700 bg-gray-50 border-gray-100',
                                    'rejected' => 'text-rose-700 bg-rose-50 border-rose-100',
                                    default => 'text-gray-700 bg-gray-50 border-gray-100',
                                };
                            @endphp

                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap font-mono text-xs text-gray-500">
                                    {{ $verificationRequest->id }}
                                </td>

                                <td class="px-4 py-4 min-w-[10rem]">
                                    @if ($credential)
                                        <a href="{{ route('credentials.show', $credential) }}"
                                            class="font-medium text-gray-900 hover:text-indigo-600 transition-colors">
                                            {{ $credential->title }}
                                        </a>
                                        <p class="text-xs text-gray-400 mt-0.5">credential_id: {{ $verificationRequest->credential_id }}</p>
                                    @else
                                        <span class="text-gray-400 italic">Credential removed</span>
                                    @endif
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap capitalize text-gray-700">
                                    {{ $credential?->type ?? '—' }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ $credential?->issuer ?? '—' }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md border text-xs font-medium capitalize {{ $requestStatusClasses }}">
                                        {{ $requestStatus }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if ($credentialStatus)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md border text-xs font-medium capitalize {{ $credentialStatusClasses }}">
                                            {{ $credentialStatus }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>

                                <td class="px-4 py-4 max-w-xs">
                                    @if ($verificationRequest->message)
                                        <p class="text-gray-600 truncate" title="{{ $verificationRequest->message }}">
                                            {{ $verificationRequest->message }}
                                        </p>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-600">
                                    {{ ($verificationRequest->requested_at ?? $verificationRequest->created_at)?->format('M j, Y g:i A') ?? '—' }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-600">
                                    {{ $verificationRequest->responded_at?->format('M j, Y g:i A') ?? '—' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($requests->hasPages())
            <div class="mt-8 pt-6 border-t border-gray-200">
                {{ $requests->links() }}
            </div>
        @endif
    @endif

</div>

@endsection
