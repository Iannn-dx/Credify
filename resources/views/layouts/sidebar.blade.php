@php
    $user = auth()->user();

    $homeRoute = $user && $user->isAdmin()
        ? route('admin.dashboard')
        : route('dashboard');

    $isDashboardActive =
        request()->routeIs('dashboard') ||
        request()->routeIs('admin.dashboard');
@endphp

<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-neutral-800 bg-black transition-transform duration-200 ease-in-out lg:translate-x-0"
>

    <div class="flex h-16 shrink-0 items-center border-b border-neutral-800 px-6">
        <a href="{{ $homeRoute }}" class="text-lg font-bold tracking-tight text-red-500">
            {{ config('app.name', 'Ticketing System') }}
        </a>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4">

        {{-- DASHBOARD LINK --}}
        @auth
            <a href="{{ $homeRoute }}"
               class="block rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800">
                Dashboard
            </a>
        @endauth

        {{-- ADMIN LINKS --}}
        @if ($user && $user->isAdmin())
            <a href="#"
               class="block rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800">
                All Tickets
            </a>

            <a href="#"
               class="block rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800">
                Users
            </a>
        @else
            {{-- USER LINKS --}}
            <a href="#}"
               class="block rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800">
                My Tickets
            </a>
        @endif

        {{-- PROFILE --}}
        <a href="#"
           class="block rounded px-3 py-2 text-sm text-neutral-300 hover:bg-neutral-800">
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

            <button
                type="submit"
                class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-neutral-400 transition hover:bg-neutral-800/50 hover:text-white"
            >
                Log Out
            </button>
        </form>

    </div>
</aside>