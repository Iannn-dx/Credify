@extends('layouts.landing')

@section('title', 'About — '.config('app.name', 'Credify'))

@section('content')
    <section class="bg-white">
        <div class="mx-auto max-w-4xl px-6 py-20 sm:py-28">

            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                About the system
            </h1>

            <p class="mt-5 text-gray-600 leading-relaxed">
                {{ config('app.name', 'Credify') }} is a support platform that helps users submit issues and lets admins manage them from a central dashboard.
            </p>

            <div class="mt-14 space-y-6">

                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">What it does</h2>
                    <p class="mt-2 text-sm leading-relaxed text-gray-600">
                        Users can open tickets for help, track their status, and receive updates. Admins get a separate view to see all tickets and users across the system.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">Who it's for</h2>
                    <p class="mt-2 text-sm leading-relaxed text-gray-600">
                        Built for teams and organizations that need a straightforward way to handle support requests without unnecessary complexity.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">How to get started</h2>
                    <p class="mt-2 text-sm leading-relaxed text-gray-600">
                        Create an account to submit tickets, or log in if you already have one. Admin accounts are assigned separately and include access to the admin dashboard.
                    </p>
                </div>

            </div>

            @guest
                <div class="mt-12">
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center rounded-xl bg-red-600 px-6 py-3 text-sm font-medium text-white hover:bg-red-500 transition">
                        Get Started
                    </a>
                </div>
            @endguest

        </div>
    </section>
@endsection