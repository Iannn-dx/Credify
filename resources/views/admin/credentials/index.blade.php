@extends('layouts.app')

@section('title', 'Admin — Credentials')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <header class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">All Credentials</h1>
        <p class="text-sm text-gray-500 mt-0.5">All records from the <span class="font-mono text-gray-600">credentials</span> table.</p>
    </header>

    <form method="GET" action="{{ route('admin.credentials.index') }}"
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
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Title</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Owner</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Issuer</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Issue Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Created At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($credentials as $credential)
                        @php
                            $statusClasses = match ($credential->status) {
                                'pending' => 'text-amber-700 bg-amber-50 border-amber-100',
                                'unverified' => 'text-gray-700 bg-gray-50 border-gray-100',
                                'rejected' => 'text-rose-700 bg-rose-50 border-rose-100',
                                default => 'text-gray-700 bg-gray-50 border-gray-100',
                            };
                        @endphp
                        <tr class="hover:bg-gray-50/60">
                            <td class="px-4 py-4 font-mono text-xs">{{ $credential->id }}</td>
                            <td class="px-4 py-4 font-medium">{{ $credential->title }}</td>
                            <td class="px-4 py-4">
                                @if ($credential->user)
                                    <a href="{{ route('admin.users.show', $credential->user) }}" class="text-indigo-600 hover:underline">{{ $credential->user->name }}</a>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-4 py-4 capitalize">{{ $credential->type }}</td>
                            <td class="px-4 py-4">{{ $credential->issuer }}</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex px-2.5 py-1 rounded-md border text-xs font-medium capitalize {{ $statusClasses }}">{{ $credential->status }}</span>
                            </td>
                            <td class="px-4 py-4 text-gray-600">{{ $credential->issue_date ? \Carbon\Carbon::parse($credential->issue_date)->format('M j, Y') : '—' }}</td>
                            <td class="px-4 py-4 text-gray-600">{{ $credential->created_at?->format('M j, Y') ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-4 py-12 text-center text-gray-400">No credentials found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($credentials->hasPages())
        <div class="mt-8">{{ $credentials->links() }}</div>
    @endif

</div>

@endsection
