<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- title --}}
    <title>{{ config('app.name', 'Credify') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

</head>

<body class="font-sans antialiased" x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false">
    {{-- page --}}
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/60 lg:hidden"
        x-cloak>
    </div>

    @include('layouts.sidebar')

    <div class="flex min-h-screen flex-col lg:pl-64">
        <header
            class="sticky top-0 z-30 flex h-16 items-center gap-4 px-4 lg:px-8">
            <button @click="sidebarOpen = !sidebarOpen" type="button"
                class="inline-flex items-center justify-center rounded-md p-2 text-neutral-400 hover:bg-neutral-800 hover-text-white lg:hidden">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            @isset($header)
                <div class="flex-1">
                    {{ $header }}
                </div>
            @else
                <div class="flex-1"></div>
            @endisset
        </header>

        {{-- main --}}
        <main class="flex-1 bg-neutral-950 p-4 lg:p-8">
          @yield('content')
        </main>
    </div>
</body>

</html>
