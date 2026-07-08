@extends('layouts.app')

@section('title', 'Admin — Users')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    <header class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Users</h1>
        <p class="text-sm text-gray-500 mt-0.5">All records from the <span class="font-mono text-gray-600">users</span> table.</p>
    </header>

    <form method="GET" action="{{ route('admin.users.index') }}"
        class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm mb-8 flex justify-end">
        <select name="role" onchange="this.form.submit()"
            class="block w-full md:w-auto pl-3 pr-8 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white text-gray-700 cursor-pointer">
            <option value="">All Roles</option>
            @foreach ($roles as $role)
                <option value="{{ $role }}" @selected(request('role') === $role)>{{ ucfirst($role) }}</option>
            @endforeach
        </select>
    </form>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-sm">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email Verified</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Credentials</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Requests</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Created At</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50/60">
                            <td class="px-4 py-4 font-mono text-xs text-gray-500">{{ $user->id }}</td>
                            <td class="px-4 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-4 py-4 text-gray-700">{{ $user->email }}</td>
                            <td class="px-4 py-4 capitalize text-gray-700">{{ $user->role }}</td>
                            <td class="px-4 py-4 text-gray-600">
                                {{ $user->email_verified_at?->format('M j, Y') ?? '—' }}
                            </td>
                            <td class="px-4 py-4 text-gray-700">{{ $user->credentials_count }}</td>
                            <td class="px-4 py-4 text-gray-700">{{ $user->verification_request_count }}</td>
                            <td class="px-4 py-4 text-gray-600">{{ $user->created_at?->format('M j, Y') ?? '—' }}</td>
                            <td class="px-4 py-4">
                                <a href="{{ route('admin.users.show', $user) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-12 text-center text-gray-400">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($users->hasPages())
        <div class="mt-8">{{ $users->links() }}</div>
    @endif

</div>

@endsection
