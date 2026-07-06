@extends('layouts.app')

@section('title', 'My Credentials')

@section('content')

    <div x-data="{ open: false }" class="max-w-7xl mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

            {{-- header --}}
            <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight text-gray-900">My Credentials</h1>
                    <p class="text-sm text-gray-500 mt-0.5">View, manage, and share your uploaded documents.</p>
                </div>

                <button @click="open = !open"
                    class="inline-flex justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Upload New Document
                </button>
            </header>

            {{-- search --}}
            <div
                class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm mb-8 flex flex-col md:flex-row gap-4 justify-between items-center">

                {{-- search bar --}}
                <div class="relative w-full md:max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" placeholder="Search credentials..."
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white">
                </div>

                {{-- filter --}}
                <div class="flex items-center gap-3 w-full md:w-auto overflow-x-auto pb-1 md:pb-0">
                    <select
                        class="block w-full md:w-auto pl-3 pr-8 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white text-gray-700 cursor-pointer">
                        <option>All Categories</option>
                        <option>Education</option>
                        <option>Work</option>
                        <option>Certificates</option>
                        <option>ID</option>
                    </select>

                    <select
                        class="block w-full md:w-auto pl-3 pr-8 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white text-gray-700 cursor-pointer">
                        <option>All Statuses</option>
                        <option>Verified</option>
                        <option>Pending</option>
                        <option>Rejected</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- cards index --}}
                
                
                {{-- <div
                    class="bg-white rounded-2xl border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all group flex flex-col">
                    <div class="p-5 flex-1">
                        <div class="flex justify-between items-start mb-4">
                            <div class="h-12 w-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-4-9 5 9 4zm0 0v6l9-5V9l-9 5zm0 0l-9-5v6l9 5v-6z"></path>
                                </svg>
                            </div>
                            <span
                                class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Verified
                            </span>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900 leading-tight">B.Sc. Computer Science</h3>
                        <p class="text-sm text-gray-500 mt-1">Stanford University</p>
                        <div class="flex items-center gap-2 mt-4 text-xs font-medium text-gray-400">
                            <span class="bg-gray-100 px-2 py-1 rounded">Education</span>
                            <span>•</span>
                            <span>Uploaded May 2026</span>
                        </div>
                    </div>
                    <div
                        class="border-t border-gray-100 p-4 bg-gray-50/50 rounded-b-2xl flex justify-between items-center opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                        <button class="text-sm font-medium text-indigo-600 hover:text-indigo-800">View Details</button>
                        <div class="flex gap-2">
                            <button
                                class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                title="Share">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                                    </path>
                                </svg>
                            </button>
                            <button
                                class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                                title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div> --}}

                {{-- Card 2: Pending (Work) --}}
                {{-- <div
                    class="bg-white rounded-2xl border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all group flex flex-col">
                    <div class="p-5 flex-1">
                        <div class="flex justify-between items-start mb-4">
                            <div class="h-12 w-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <span
                                class="inline-flex items-center gap-1.5 text-xs font-medium text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending
                            </span>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900 leading-tight">Employment Verification Letter</h3>
                        <p class="text-sm text-gray-500 mt-1">Stripe Inc.</p>
                        <div class="flex items-center gap-2 mt-4 text-xs font-medium text-gray-400">
                            <span class="bg-gray-100 px-2 py-1 rounded">Work</span>
                            <span>•</span>
                            <span>Uploaded July 1, 2026</span>
                        </div>
                    </div>
                    <div
                        class="border-t border-gray-100 p-4 bg-gray-50/50 rounded-b-2xl flex justify-between items-center opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                        <button class="text-sm font-medium text-indigo-600 hover:text-indigo-800">View Details</button>
                        <div class="flex gap-2">
                            <button
                                class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                                title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div> --}}

                {{-- Card 3: Rejected (Certificate) --}}
                {{-- <div
                    class="bg-white rounded-2xl border border-gray-200 hover:border-rose-300 hover:shadow-md transition-all group flex flex-col relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-rose-500"></div>
                    <div class="p-5 flex-1 pl-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="h-12 w-12 rounded-xl bg-gray-100 flex items-center justify-center text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                            </div>
                            <span
                                class="inline-flex items-center gap-1.5 text-xs font-medium text-rose-700 bg-rose-50 px-2.5 py-1 rounded-md border border-rose-100">
                                Fix Needed
                            </span>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900 leading-tight">AWS Cloud Architect</h3>
                        <p class="text-sm text-gray-500 mt-1">Amazon Web Services</p>
                        <div class="flex items-center gap-2 mt-4 text-xs font-medium text-gray-400">
                            <span class="bg-gray-100 px-2 py-1 rounded">Certificate</span>
                            <span>•</span>
                            <span>Uploaded June 28, 2026</span>
                        </div>
                    </div>
                    <div
                        class="border-t border-rose-100 p-4 bg-rose-50/30 rounded-b-2xl flex justify-between items-center opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity pl-6">
                        <button class="text-sm font-medium text-rose-600 hover:text-rose-800">Resolve Issue</button>
                        <div class="flex gap-2">
                            <button
                                class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                                title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div> --}}

                {{-- Card 4: Verified (Certificate) --}}
                {{-- <div
                    class="bg-white rounded-2xl border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all group flex flex-col">
                    <div class="p-5 flex-1">
                        <div class="flex justify-between items-start mb-4">
                            <div class="h-12 w-12 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </div>
                            <span
                                class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Verified
                            </span>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900 leading-tight">Project Management Professional
                            (PMP)</h3>
                        <p class="text-sm text-gray-500 mt-1">Project Management Institute</p>
                        <div class="flex items-center gap-2 mt-4 text-xs font-medium text-gray-400">
                            <span class="bg-gray-100 px-2 py-1 rounded">Certificate</span>
                            <span>•</span>
                            <span>Uploaded Jan 2025</span>
                        </div>
                    </div>
                    <div
                        class="border-t border-gray-100 p-4 bg-gray-50/50 rounded-b-2xl flex justify-between items-center opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                        <button class="text-sm font-medium text-indigo-600 hover:text-indigo-800">View Details</button>
                        <div class="flex gap-2">
                            <button
                                class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                title="Share">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                                    </path>
                                </svg>
                            </button>
                            <button
                                class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                                title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div> --}}

            </div>

            {{-- Pagination Area --}}
            <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
                <p class="text-sm text-gray-500">Showing <span class="font-medium text-gray-900">1</span> to <span
                        class="font-medium text-gray-900">4</span> of <span class="font-medium text-gray-900">12</span>
                    results</p>
                <div class="flex gap-2">
                    <button
                        class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50"
                        disabled>Previous</button>
                    <button
                        class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
                </div>
            </div>

        </div>

        @include('user.credentials.create')


    </div>
@endsection
