@php
    $user = auth()->user();

    $homeRoute = $user && $user->isAdmin() ? route('admin.dashboard') : route('dashboard');

    $isDashboardActive = request()->routeIs('dashboard') || request()->routeIs('admin.dashboard');
@endphp

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-neutral-800 shadow=xl bg-black/95 transition-transform duration-200 ease-in-out lg:translate-x-0">

    <div class="flex h-16 shrink-0 items-center border-b border-neutral-800 px-6">
        <a href="{{ $homeRoute }}" class="text-lg font-bold tracking-tight text-red-500">
            {{ config('app.name', 'Ticketing System') }}
        </a>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4">

        @auth
            <a href="{{ $homeRoute }}" class="block rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800">
                Dashboard
            </a>
        @endauth

        @if ($user && $user->isAdmin())
            <a href="{{ route('admin.requests.index') }}" class="block rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800 {{ request()->routeIs('admin.requests.*') ? 'bg-neutral-800 text-white' : '' }}">
                Verification Requests
            </a>

            <a href="{{ route('admin.users.index') }}" class="block rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800 {{ request()->routeIs('admin.users.*') ? 'bg-neutral-800 text-white' : '' }}">
                Users
            </a>

            <a href="{{ route('admin.credentials.index') }}" class="block rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800 {{ request()->routeIs('admin.credentials.*') ? 'bg-neutral-800 text-white' : '' }}">
                Credentials
            </a>

            <a href="{{ route('admin.verifications.index') }}" class="block rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800 {{ request()->routeIs('admin.verifications.*') ? 'bg-neutral-800 text-white' : '' }}">
                Verifications
            </a>

            <a href="{{ route('verification.create') }}" class="block rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800">
                Record Verification
            </a>
        @else
            <div x-data="{ open: {{ request()->routeIs('credentials.*') || request()->routeIs('requests.create') || request()->routeIs('verification.*') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800"
                    :class="open ? 'bg-neutral-800/50 text-white' : ''">

                    <span>Credentials</span>

                    <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <div x-show="open" x-collapse class="ml-4 space-y-1">

                    <a href="{{ route('credentials.index') }}" class="block rounded px-3 py-2 text-sm hover:bg-neutral-800 {{ request()->routeIs('credentials.index') ? 'bg-neutral-800 text-white' : 'text-neutral-300' }}">
                        My Credentials
                    </a>

                    <a href="{{ route('requests.create') }}" class="block rounded px-3 py-2 text-sm hover:bg-neutral-800 {{ request()->routeIs('requests.create') ? 'bg-neutral-800 text-white' : 'text-neutral-300' }}">
                        Submit Request
                    </a>

                    <a href="{{ route('verification.index') }}" class="block rounded px-3 py-2 text-sm hover:bg-neutral-800 {{ request()->routeIs('verification.index') ? 'bg-neutral-800 text-white' : 'text-neutral-300' }}">
                        Verification
                    </a>

                </div>
            </div>

            <div x-data="{ open: {{ request()->routeIs('requests.index') || request()->routeIs('history.index') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800"
                    :class="open ? 'bg-neutral-800/50 text-white' : ''">

                    <span>Tracking</span>

                    <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <div class="ml-4 space-y-1" x-show="open" x-collapse>

                    <a href="{{ route('requests.index') }}" class="block rounded px-3 py-2 text-sm hover:bg-neutral-800 {{ request()->routeIs('requests.index') && !request()->routeIs('history.index') ? 'bg-neutral-800 text-white' : 'text-neutral-300' }}">
                        Request Status
                    </a>

                    <a href="{{ route('history.index') }}" class="block rounded px-3 py-2 text-sm hover:bg-neutral-800 {{ request()->routeIs('history.index') ? 'bg-neutral-800 text-white' : 'text-neutral-300' }}">
                        History
                    </a>

                    <a href="#" class="block rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800">
                        Notifications
                    </a>
                </div>
            </div>
        @endif

        <a href="{{ route('profile.edit') }}" class="block rounded px-3 py-2 text-sm hover:bg-neutral-800 {{ request()->routeIs('profile.*') ? 'bg-neutral-800 text-white' : 'text-neutral-300' }}">
            Profile
        </a>
    </nav>

    <div class="shrink-0 border-t border-neutral-800 p-4">

        <div class="mb-3 truncate px-3">
            <p class="truncate text-sm font-medium text-white">
                {{ $user?->name }}
            </p>
            <p class="truncate text-xs text-neutral-500">
                {{ $user?->email }}
            </p>

            @if ($user && $user->isAdmin())
                <p class="mt-1 text-xs font-medium uppercase tracking-wide text-red-500">
                    Admin
                </p>
            @endif
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-neutral-400 transition hover:bg-neutral-800/50 hover:text-white">
                Log Out
            </button>
        </form>

    </div>
</aside>
