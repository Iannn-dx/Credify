@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        
    {{-- Header Section --}}
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Credentials Overview</h1>
            <p class="text-sm text-gray-500 mt-0.5">Manage, verify, and share your official records securely.</p>
        </div>
        
        {{-- Quick Actions --}}
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <button class="flex-1 sm:flex-initial inline-flex justify-center items-center gap-2 bg-white border border-gray-200 text-gray-700 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-50 transition-all">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                Share Link
            </button>
            <button class="flex-1 sm:flex-initial inline-flex justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Upload Document
            </button>
        </div>
    </header>

    {{-- Metrics Summary Grid --}}
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total Documents</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">12</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Verified</p>
            <div class="flex items-baseline gap-2 mt-2">
                <p class="text-2xl font-semibold text-gray-900">9</p>
                <span class="text-[11px] font-medium text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded">
                    75%
                </span>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Pending</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">2</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Rejected</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2">1</p>
        </div>
    </section>

    {{-- Dashboard Core Workspace --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        {{-- Primary column: Recent Uploaded Credentials --}}
        <section class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-900 tracking-tight">Recent Uploads</h2>
                <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-700 transition-colors">View all documents →</a>
            </div>

            <div class="space-y-3">
                
                {{-- Static Item 1: Verified --}}
                <div class="bg-white p-4 rounded-xl border border-gray-100 flex items-center justify-between gap-4 hover:border-gray-200 transition-all">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div class="h-10 w-10 rounded-xl bg-indigo-50 flex items-center justify-center flex-shrink-0 text-indigo-500">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-4-9 5 9 4zm0 0v6l9-5V9l-9 5zm0 0l-9-5v6l9 5v-6z"></path></svg>
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-sm font-medium text-gray-900 truncate">B.Sc. Computer Science Degree</h3>
                            <p class="text-xs text-gray-400 truncate mt-0.5">Stanford University • Education</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4 flex-shrink-0">
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md">
                            <span class="h-1 w-1 rounded-full bg-emerald-500"></span> Verified
                        </span>
                    </div>
                </div>

                {{-- Static Item 2: Pending --}}
                <div class="bg-white p-4 rounded-xl border border-gray-100 flex items-center justify-between gap-4 hover:border-gray-200 transition-all">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div class="h-10 w-10 rounded-xl bg-gray-50 flex items-center justify-center flex-shrink-0 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-sm font-medium text-gray-900 truncate">Employment Verification Letter</h3>
                            <p class="text-xs text-gray-400 truncate mt-0.5">Stripe Inc. • Work</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4 flex-shrink-0">
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-medium text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md">
                            <span class="h-1 w-1 rounded-full bg-amber-500"></span> Pending
                        </span>
                    </div>
                </div>

                {{-- Static Item 3: Rejected --}}
                <div class="bg-white p-4 rounded-xl border border-gray-100 flex items-center justify-between gap-4 hover:border-gray-200 transition-all">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div class="h-10 w-10 rounded-xl bg-gray-50 flex items-center justify-center flex-shrink-0 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-sm font-medium text-gray-900 truncate">AWS Cloud Architect Certificate</h3>
                            <p class="text-xs text-gray-400 truncate mt-0.5">Amazon Web Services • Certificate</p>
                            <p class="text-xs text-rose-500 font-medium mt-1 truncate">Reason: Document is blurry, please re-upload</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4 flex-shrink-0">
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-medium text-rose-700 bg-rose-50 px-2.5 py-1 rounded-md">
                            Fix Needed
                        </span>
                    </div>
                </div>

            </div>
        </section>

        {{-- Secondary column: Recent Activity Feed (Audit Log) --}}
        <section class="space-y-4">
            <h2 class="text-sm font-semibold text-gray-900 tracking-tight">Activity History</h2>
            <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-5">
                
                {{-- Event 1: Verified (Emerald) --}}
                <div class="flex gap-3 text-xs relative">
                    <div class="absolute left-1.5 top-4 bottom-0 w-0.5 bg-gray-100"></div>
                    <div class="h-3 w-3 rounded-full border-2 border-white ring-1 flex-shrink-0 mt-0.5 z-10 bg-emerald-500 ring-emerald-500/20"></div>
                    
                    <div>
                        <p class="font-medium text-gray-800 leading-relaxed">Stanford University verified your degree</p>
                        <p class="text-gray-400 mt-1">2 hours ago</p>
                    </div>
                </div>

                {{-- Event 2: Shared (Purple) --}}
                <div class="flex gap-3 text-xs relative">
                    <div class="absolute left-1.5 top-4 bottom-0 w-0.5 bg-gray-100"></div>
                    <div class="h-3 w-3 rounded-full border-2 border-white ring-1 flex-shrink-0 mt-0.5 z-10 bg-purple-500 ring-purple-500/20"></div>
                    
                    <div>
                        <p class="font-medium text-gray-800 leading-relaxed">Generated time-limited share link</p>
                        <p class="text-gray-400 mt-1">5 hours ago</p>
                    </div>
                </div>

                {{-- Event 3: Uploaded (Indigo) --}}
                <div class="flex gap-3 text-xs relative">
                    <div class="absolute left-1.5 top-4 bottom-0 w-0.5 bg-gray-100"></div>
                    <div class="h-3 w-3 rounded-full border-2 border-white ring-1 flex-shrink-0 mt-0.5 z-10 bg-indigo-500 ring-indigo-500/20"></div>
                    
                    <div>
                        <p class="font-medium text-gray-800 leading-relaxed">Uploaded Employment Verification Letter</p>
                        <p class="text-gray-400 mt-1">1 day ago</p>
                    </div>
                </div>

                {{-- Event 4: Rejected (Rose) - Last item, no connecting line --}}
                <div class="flex gap-3 text-xs relative">
                    <div class="h-3 w-3 rounded-full border-2 border-white ring-1 flex-shrink-0 mt-0.5 z-10 bg-rose-500 ring-rose-500/20"></div>
                    
                    <div>
                        <p class="font-medium text-gray-800 leading-relaxed">AWS Certificate verification was rejected</p>
                        <p class="text-gray-400 mt-1">2 days ago</p>
                    </div>
                </div>

            </div>
        </section>

    </div>
</div>

@endsection