@extends('layouts.app')

@section('title', 'History Logs')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    {{-- Header --}}
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Activity History</h1>
            <p class="text-sm text-gray-500 mt-0.5">A complete audit log of updates to your credentials and verification requests.</p>
        </div>
    </header>

    {{-- Search and Filter Form --}}
    <form method="GET" action="{{ route('history.index') }}"
        class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm mb-8 flex flex-col md:flex-row gap-4 justify-between items-center">
        
        {{-- Search Input --}}
        <div class="relative w-full md:max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by description, credential title, or issuer..."
                class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white">
        </div>

        {{-- Filters --}}
        <div class="flex items-center gap-3 w-full md:w-auto">
            <select name="action" onchange="this.form.submit()"
                class="block w-full md:w-auto pl-3 pr-8 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white text-gray-700 cursor-pointer">
                <option value="">All Actions</option>
                @foreach ($actions as $action)
                    <option value="{{ $action }}" @selected(request('action') === $action)>
                        @if($action === 'uploaded') Uploaded
                        @elseif($action === 'requested') Verification Requested
                        @elseif($action === 'verified') Verified
                        @elseif($action === 'rejected') Rejected
                        @else {{ ucfirst($action) }}
                        @endif
                    </option>
                @endforeach
            </select>

            @if(request()->filled('search') || request()->filled('action'))
                <a href="{{ route('history.index') }}" 
                    class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors whitespace-nowrap px-2">
                    Clear Filters
                </a>
            @endif
        </div>
    </form>

    {{-- History Records Timeline/Table --}}
    @if ($histories->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 px-6 border-2 border-dashed border-gray-200 rounded-xl bg-white text-center">
            <div class="p-4 bg-gray-50 rounded-full mb-4 ring-1 ring-gray-100">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>

            <h3 class="text-lg font-semibold text-gray-900">No activity history found</h3>
            <p class="mt-1 max-w-sm text-sm text-gray-500">
                @if(request()->filled('search') || request()->filled('action'))
                    Try adjusting your search query or filter options.
                @else
                    Log details will automatically populate here as you upload credentials and request verifications.
                @endif
            </p>
        </div>
    @else
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-36">Action</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Credential</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-56">Date & Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @foreach ($histories as $history)
                            @php
                                $credential = $history->credential;
                                $action = $history->action;

                                $actionClasses = match ($action) {
                                    'uploaded' => 'text-indigo-700 bg-indigo-50 border-indigo-100',
                                    'requested' => 'text-amber-700 bg-amber-50 border-amber-100',
                                    'verified' => 'text-emerald-700 bg-emerald-50 border-emerald-100',
                                    'rejected' => 'text-rose-700 bg-rose-50 border-rose-100',
                                    default => 'text-gray-700 bg-gray-50 border-gray-100',
                                };
                            @endphp

                            <tr class="hover:bg-gray-50/60 transition-colors">
                                {{-- Action Badge --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md border text-xs font-medium capitalize {{ $actionClasses }}">
                                        @if($action === 'uploaded')
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                            </svg>
                                        @elseif($action === 'requested')
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                            </svg>
                                        @elseif($action === 'verified')
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        @elseif($action === 'rejected')
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        @endif
                                        @if($action === 'uploaded') Uploaded
                                        @elseif($action === 'requested') Requested
                                        @elseif($action === 'verified') Verified
                                        @elseif($action === 'rejected') Rejected
                                        @else {{ $action }}
                                        @endif
                                    </span>
                                </td>

                                {{-- Related Credential --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($credential)
                                        <a href="{{ route('credentials.show', $credential) }}"
                                            class="font-medium text-gray-900 hover:text-indigo-600 transition-colors">
                                            {{ $credential->title }}
                                        </a>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $credential->issuer }}</p>
                                    @else
                                        <span class="text-gray-400 italic">Credential deleted</span>
                                    @endif
                                </td>

                                {{-- Description --}}
                                <td class="px-6 py-4">
                                    <p class="text-gray-700 max-w-lg break-words">{{ $history->description }}</p>
                                </td>

                                {{-- Time --}}
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $history->created_at?->format('M j, Y g:i A') ?? '—' }}
                                    </div>
                                    <div class="text-xs text-gray-400 mt-0.5">
                                        {{ $history->created_at?->diffForHumans() ?? '—' }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if ($histories->hasPages())
            <div class="mt-8 pt-6 border-t border-gray-200">
                {{ $histories->links() }}
            </div>
        @endif
    @endif

</div>

@endsection
