@extends('layouts.app')

@section('title', 'Request Verification')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    
    {{-- Back Link --}}
    <nav class="mb-6">
        <a href="#" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Credential
        </a>
    </nav>

    {{-- Main Workspace --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        {{-- Left: Request Form (2 Columns) --}}
        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                {{-- Header --}}
                <div class="p-6 border-b border-gray-100">
                    <h1 class="text-xl font-semibold text-gray-900 tracking-tight">Submit Verification Request</h1>
                    <p class="text-xs text-gray-500 mt-1">This will send an official review request directly to the issuing institution's registrar or HR department.</p>
                </div>

                {{-- Form Content --}}
                <form action="#" method="POST" class="p-6 space-y-6">
                    @csrf

                    {{-- Target Organization Select --}}
                    <div>
                        <label for="institution" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">Assign Verifying Institution</label>
                        <div class="relative">
                            <select id="institution" name="institution_id" class="block w-full pl-3 pr-10 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white text-gray-700 cursor-pointer">
                                <option value="" disabled selected>Search or select authority...</option>
                                <option value="1">Stanford University (Registrar Office)</option>
                                <option value="2">Stripe Inc. (Global HR Operations)</option>
                                <option value="3">Amazon Web Services (Certification Desk)</option>
                            </select>
                        </div>
                        <p class="text-xs text-gray-400 mt-1.5">Can't find the institution? <a href="#" class="text-indigo-600 hover:underline">Invite them to verify</a>.</p>
                    </div>

                    {{-- Account / Student Reference Details --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="reference_id" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">Student / Employee ID</label>
                            <input type="text" id="reference_id" name="reference_id" placeholder="e.g., SU-89412" class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white">
                        </div>
                        <div>
                            <label for="grad_year" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">Year of Graduation / Exit</label>
                            <input type="text" id="grad_year" name="completion_year" placeholder="e.g., 2025" class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white">
                        </div>
                    </div>

                    {{-- Custom Note for the Reviewer --}}
                    <div>
                        <label for="notes" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">Note for the Reviewer <span class="text-gray-400 text-[11px] font-normal">(Optional)</span></label>
                        <textarea id="notes" name="notes" rows="3" placeholder="Add any helpful details, such as former names used during enrollment or specific departments..." class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white resize-none"></textarea>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Explicit Privacy Consent Checkbox --}}
                    <div class="relative flex items-start">
                        <div class="flex h-5 items-center">
                            <input id="consent" name="consent" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500/20 cursor-pointer">
                        </div>
                        <div class="ml-3 text-xs leading-5">
                            <label for="consent" class="font-medium text-gray-900 cursor-pointer">Authorize background check and data release</label>
                            <p class="text-gray-400 mt-0.5">I grant the selected institution permission to securely review this document file alongside my provided reference information to verify its authenticity.</p>
                        </div>
                    </div>

                    {{-- Form Footer Actions --}}
                    <div class="pt-2 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                        <button type="button" class="w-full sm:w-auto inline-flex justify-center items-center bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-50 transition-all">
                            Cancel
                        </button>
                        <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-100">
                            Send Request
                        </button>
                    </div>

                </form>
            </div>

        </div>

        {{-- Right: Contextual Document Summary (1 Column) --}}
        <div class="space-y-4 lg:sticky lg:top-8">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-1">Selected Asset</h3>
            
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-500 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-4-9 5 9 4zm0 0v6l9-5V9l-9 5zm0 0l-9-5v6l9 5v-6z"></path></svg>
                    </div>
                    <div class="min-w-0">
                        <h4 class="text-sm font-semibold text-gray-900 truncate">B.Sc. Computer Science</h4>
                        <p class="text-xs text-gray-400 truncate">Uploaded File: degree_final.pdf</p>
                    </div>
                </div>

                <div class="bg-gray-50/50 rounded-xl p-3.5 border border-gray-100 text-xs space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-400">File Type</span>
                        <span class="font-medium text-gray-700">PDF Document</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">File Size</span>
                        <span class="font-medium text-gray-700">2.4 MB</span>
                    </div>
                </div>

                <blockquote class="text-[11px] bg-amber-50/40 border border-amber-100 text-amber-800 p-3 rounded-xl leading-relaxed">
                    <strong>Note:</strong> Standard verifications typically take 2-5 business days depending entirely on the institution's response turnaround.
                </blockquote>
            </div>
        </div>

    </div>
</div>

@endsection