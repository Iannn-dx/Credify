@extends('layouts.app')

@section('title', 'Credential Details')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    
    {{-- Navigation Breadcrumbs / Back Button --}}
    <nav class="mb-6">
        <a href="#" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Credentials
        </a>
    </nav>

    {{-- Main Document Header --}}
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6 border-b border-gray-100 mb-8">
        <div>
            <div class="flex items-center gap-3 flex-wrap">
                <h1 class="text-2xl font-semibold tracking-tight text-gray-900">B.Sc. Computer Science Degree</h1>
                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-100">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Verified
                </span>
            </div>
            <p class="text-sm text-gray-500 mt-1">Uploaded on May 14, 2026 • Education Category</p>
        </div>

        {{-- Primary Actions --}}
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <button class="flex-1 sm:flex-initial inline-flex justify-center items-center gap-2 bg-white border border-gray-200 text-gray-700 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-50 transition-all">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Download PDF
            </button>
            <button class="flex-1 sm:flex-initial inline-flex justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                Share Credential
            </button>
        </div>
    </header>

    {{-- Workspace Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        {{-- Left 2 Columns: Metadata & Document Frame --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Metadata Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Credential Attributes</h2>
                </div>
                
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-medium text-gray-400">Issuing Institution</p>
                        <p class="text-sm font-medium text-gray-900 mt-1">Stanford University</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">Credential ID / Serial</p>
                        <p class="text-sm font-mono text-gray-900 mt-1">STFD-98325-CS</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">Issue Date</p>
                        <p class="text-sm font-medium text-gray-900 mt-1">June 12, 2025</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">Expiration Date</p>
                        <p class="text-sm font-medium text-gray-500 mt-1">Does not expire</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-xs font-medium text-gray-400">Description / Scope</p>
                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                            Official academic transcript confirming the completion of a undergraduate degree program in Computer Science, specialized in Intelligent Systems and Machine Learning architectures.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Document Preview Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">File Preview</h2>
                    <span class="text-xs font-medium text-gray-400">PDF • 2.4 MB</span>
                </div>
                
                {{-- Mock Interactive Preview Frame --}}
                <div class="p-6 bg-gray-100 flex justify-center items-center aspect-[4/3] border-t border-gray-100 relative group">
                    <div class="bg-white shadow-lg rounded-md w-4/5 h-5/6 p-8 flex flex-col justify-between border border-gray-200 select-none">
                        <div class="flex justify-between items-start border-b pb-4 border-gray-100">
                            <div>
                                <div class="h-4 w-24 bg-gray-200 rounded mb-2"></div>
                                <div class="h-3 w-36 bg-gray-100 rounded"></div>
                            </div>
                            <div class="h-8 w-8 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-300 font-bold text-xs">SU</div>
                        </div>
                        <div class="space-y-3 py-4 flex-1 justify-center flex flex-col items-center">
                            <div class="h-5 w-48 bg-gray-200 rounded"></div>
                            <div class="h-3 w-64 bg-gray-100 rounded"></div>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            <div class="h-3 w-16 bg-gray-100 rounded"></div>
                            <div class="h-6 w-16 bg-emerald-50 rounded"></div>
                        </div>
                    </div>
                    
                    {{-- Open full screen overlay on hover --}}
                    <div class="absolute inset-0 bg-gray-900/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-[1px]">
                        <button class="bg-white text-gray-800 text-xs font-medium px-4 py-2 rounded-lg shadow-md border border-gray-200/50 flex items-center gap-1.5 hover:scale-105 transition-transform">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            Open File in Full Window
                        </button>
                    </div>
                </div>
            </div>

        </div>

        {{-- Right 1 Column: Verification & Security Blueprint --}}
        <div class="space-y-6">
            
            {{-- Audit/Verification Sidebar Component --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
                <h3 class="text-sm font-semibold text-gray-900">Verification Status</h3>
                
                <div class="space-y-4">
                    <div class="bg-emerald-50/50 border border-emerald-100 rounded-xl p-4 flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <div>
                            <p class="text-xs font-semibold text-emerald-900">Cryptographically Secure</p>
                            <p class="text-xs text-emerald-700/80 mt-0.5 leading-relaxed">This record matches the source issuer's signed registry anchor exactly.</p>
                        </div>
                    </div>

                    <div class="divide-y divide-gray-50 text-xs">
                        <div class="py-3 flex justify-between items-center">
                            <span class="text-gray-400">Verified By</span>
                            <span class="font-medium text-gray-800">Stanford Registrar Service</span>
                        </div>
                        <div class="py-3 flex justify-between items-center">
                            <span class="text-gray-400">Timestamp</span>
                            <span class="font-medium text-gray-800">May 20, 2026 14:32 UTC</span>
                        </div>
                        <div class="py-3 flex flex-col gap-1.5 justify-center">
                            <span class="text-gray-400">SHA-256 Checksum Hash</span>
                            <span class="font-mono bg-gray-50 p-2 rounded text-[10px] text-gray-600 truncate tracking-tight">
                                e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Danger / Destructive Management Zone --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Management</h3>
                <p class="text-xs text-gray-400 leading-relaxed mb-4">Deleting this credential will revoke all active sharing handles and links permanently associated with it.</p>
                
                <button type="button" class="w-full inline-flex justify-center items-center gap-2 bg-white border border-rose-200 text-rose-600 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-rose-50 hover:border-rose-300 transition-all focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Delete Record
                </button>
            </div>

        </div>

    </div>
</div>

@endsection