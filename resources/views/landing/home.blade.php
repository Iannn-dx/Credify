@extends('layouts.landing')

@section('title', 'Certification System')

@section('content')

<!-- HERO -->
<section class="bg-white">
    <div class="mx-auto max-w-6xl px-6 py-28 text-center sm:py-36">

        <div class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-gray-50 px-4 py-2 text-sm text-gray-600">
            <span class="h-2 w-2 animate-pulse rounded-full bg-green-500"></span>
            LMS Certification Platform
        </div>

        <h1 class="mt-6 text-5xl font-bold tracking-tight text-gray-900 sm:text-6xl">
            Issue, Verify, and Manage Certificates Instantly
        </h1>

        <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-600 leading-relaxed">
            A complete certification and badge system for training platforms, schools, and organizations.
            Generate secure PDF certificates, verify via QR code, and track expiration with ease.
        </p>

        <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">

            <a href="#" class="rounded-xl bg-indigo-600 px-8 py-3 font-medium text-white hover:bg-indigo-500 transition">
                Get Started
            </a>

            <a href="#" class="rounded-xl border border-gray-300 px-8 py-3 text-gray-700 hover:bg-gray-50 transition">
                Verify Certificate
            </a>

        </div>

        <p class="mt-6 text-sm text-gray-500">
            Secure • Scalable • LMS-ready
        </p>
    </div>
</section>

<section class="bg-gray-50 border-t border-gray-200">
    <div class="mx-auto max-w-6xl px-6 py-20 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">

        <div class="rounded-2xl bg-white border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-900">Issue Certificates</h3>
            <p class="mt-2 text-sm text-gray-600">
                Automatically generate certificates for completed courses or trainings.
            </p>
        </div>

        <div class="rounded-2xl bg-white border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-900">PDF Generation</h3>
            <p class="mt-2 text-sm text-gray-600">
                Download beautifully designed, printable certificate PDFs.
            </p>
        </div>

        <div class="rounded-2xl bg-white border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-900">QR Verification</h3>
            <p class="mt-2 text-sm text-gray-600">
                Each certificate includes a QR code for instant validation.
            </p>
        </div>

        <div class="rounded-2xl bg-white border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-900">Expiration Tracking</h3>
            <p class="mt-2 text-sm text-gray-600">
                Set validity periods and automatically manage renewals.
            </p>
        </div>

    </div>
</section>

<section class="bg-white">
    <div class="mx-auto max-w-6xl px-6 py-20">

        <h2 class="text-center text-3xl font-bold text-gray-900">
            How it works
        </h2>

        <div class="mt-12 grid gap-8 sm:grid-cols-3 text-center">

            <div>
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-bold">
                    1
                </div>
                <h3 class="mt-4 font-semibold">Complete Training</h3>
                <p class="mt-2 text-sm text-gray-600">User finishes a course or program.</p>
            </div>

            <div>
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-bold">
                    2
                </div>
                <h3 class="mt-4 font-semibold">Certificate Issued</h3>
                <p class="mt-2 text-sm text-gray-600">System generates a secure PDF certificate.</p>
            </div>

            <div>
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-bold">
                    3
                </div>
                <h3 class="mt-4 font-semibold">Verify Anytime</h3>
                <p class="mt-2 text-sm text-gray-600">QR code allows instant validation online.</p>
            </div>

        </div>
    </div>
</section>
@endsection