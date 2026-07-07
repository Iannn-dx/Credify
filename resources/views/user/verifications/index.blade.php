@extends('layouts.app')

@section('title', 'Review Verification Request')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    
    {{-- Top Utility Bar --}}
    <nav class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <a href="#" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Request Queue
        </a>
        <span class="text-xs font-mono text-gray-400 bg-gray-100 px-2 py-1 rounded">REQ-2026-89412</span>
    </nav>

    {{-- Main Document Header --}}
    <header class="pb-6 border-b border-gray-100 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <div class="flex items-center gap-3 flex-wrap">
                    <h1 class="text-2xl font-semibold tracking-tight text-gray-900">B.Sc. Computer Science Degree</h1>
                    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-100">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending Review
                    </span>
                </div>
                <p class="text-sm text-gray-500 mt-1">Submitted by <strong class="text-gray-700 font-medium">Sarah Jenkins</strong> • Received July 7, 2026</p>
            </div>
        </div>
    </header>

    {{-- Review Workspace --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- Left Column: Applicant Provided Data & File Preview (8 Columns) --}}
        <div class="lg:col-span-8 space-y-6">
            
            {{-- Provided Reference Check Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Submitted Reference Details</h2>
                </div>
                
                <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <p class="text-xs font-medium text-gray-400">Full Name (at Enrollment)</p>
                        <p class="text-sm font-medium text-gray-900 mt-1">Sarah Marie Jenkins</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">Student / Record ID</p>
                        <p class="text-sm font-mono text-gray-900 mt-1">SU-89412</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400">Graduation Year</p>
                        <p class="text-sm font-medium text-gray-900 mt-1">2025</p>
                    </div>
                    <div class="sm:col-span-3">
                        <p class="text-xs font-medium text-gray-400">Applicant Note to Registrar</p>
                        <p class="text-sm text-gray-600 mt-1 bg-gray-50/60 p-3 rounded-xl border border-gray-100 italic leading-relaxed">
                            "Hi, I graduated under my maiden name (Jenkins) in Winter 2025. Please let me know if you need me to attach my marriage certificate for legal name matching."
                        </p>
                    </div>
                </div>
            </div>

            {{-- Document Preview Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Uploaded Asset File</h2>
                    <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-700 transition-colors">Download Original PDF ↗</a>
                </div>
                
                {{-- Preview Canvas Frame --}}
                <div class="p-8 bg-gray-100 border-t border-gray-100 flex justify-center items-center aspect-[4/3]">
                    <div class="bg-white shadow-xl rounded-md w-full h-full p-8 flex flex-col justify-between border border-gray-200 select-none">
                        <div class="flex justify-between items-start border-b pb-4 border-gray-100">
                            <div>
                                <h3 class="text-sm font-bold tracking-tight text-gray-800">STANFORD UNIVERSITY</h3>
                                <p class="text-[10px] text-gray-400 uppercase tracking-wider">Office of the University Registrar</p>
                            </div>
                            <div class="h-8 w-8 rounded-full bg-red-800 flex items-center justify-center text-white font-bold text-xs shadow-sm">S</div>
                        </div>
                        
                        <div class="space-y-3 py-6 text-center">
                            <p class="text-xs font-serif text-gray-500">This certifies that upon the recommendation of the Faculty has conferred on</p>
                            <h2 class="text-lg font-serif font-semibold text-gray-900 tracking-wide">Sarah Marie Jenkins</h2>
                            <p class="text-xs font-serif text-gray-500">the degree of</p>
                            <h3 class="text-sm font-bold text-gray-800">Bachelor of Science in Computer Science</h3>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-gray-100 text-[10px] text-gray-400">
                            <span>Conferred June 12, 2025</span>
                            <div class="h-6 w-20 bg-gray-100 rounded border border-dashed flex items-center justify-center font-mono text-[8px]">MOCK_SIGNATURE</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Right Column: Decision Panel (4 Columns) --}}
        <div class="lg:col-span-4 space-y-6">
            
            {{-- Decision Action Box --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Verification Verdict</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Please evaluate the file match against your database records.</p>
                </div>

                {{-- Action Forms --}}
                <div class="space-y-3 pt-2">
                    <button type="button" class="w-full inline-flex justify-center items-center gap-2 bg-emerald-600 text-white px-4 py-3 rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-all shadow-sm shadow-emerald-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Approve & Cryptographically Sign
                    </button>
                    
                    <button type="button" class="w-full inline-flex justify-center items-center gap-2 bg-white border border-gray-200 text-gray-700 px-4 py-3 rounded-xl text-sm font-medium hover:bg-gray-50 transition-all">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Flag Issue / Decline Request
                    </button>
                </div>
            </div>

            {{-- Optional Feedback/Reason Box (Shown interactively if declining) --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                <label for="reject_reason" class="block text-xs font-medium text-gray-700 uppercase tracking-wider">Internal Rejection Feedback</label>
                <textarea id="reject_reason" rows="3" placeholder="Provide notes on why this request cannot be approved (e.g., ID number mismatch, low-resolution attachment)..." class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-gray-50/50 focus:bg-white resize-none"></textarea>
                <p class="text-[11px] text-gray-400 leading-normal">This commentary will be transmitted directly to the user to guide their corrective upload attempt.</p>
            </div>

        </div>

    </div>
</div>

@endsection