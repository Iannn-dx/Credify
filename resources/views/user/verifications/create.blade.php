@extends('layouts.app')

@section('title', 'Record Verification')

@section('content')

@php
    $requestOptions = $pendingRequests->map(fn ($verificationRequest) => [
        'id' => $verificationRequest->id,
        'credential_id' => $verificationRequest->credential_id,
        'requested_by' => $verificationRequest->requested_by,
        'requester_name' => $verificationRequest->user?->name,
        'message' => $verificationRequest->message,
        'requested_at' => ($verificationRequest->requested_at ?? $verificationRequest->created_at)
            ? \Carbon\Carbon::parse($verificationRequest->requested_at ?? $verificationRequest->created_at)->format('M j, Y g:i A')
            : null,
        'credential' => $verificationRequest->credential ? [
            'title' => $verificationRequest->credential->title,
            'type' => $verificationRequest->credential->type,
            'issuer' => $verificationRequest->credential->issuer,
            'status' => $verificationRequest->credential->status,
            'issue_date' => $verificationRequest->credential->issue_date
                ? \Carbon\Carbon::parse($verificationRequest->credential->issue_date)->format('M j, Y')
                : null,
            'expiry_date' => $verificationRequest->credential->expiry_date
                ? \Carbon\Carbon::parse($verificationRequest->credential->expiry_date)->format('M j, Y')
                : null,
            'description' => $verificationRequest->credential->description,
            'file_path' => $verificationRequest->credential->file_path,
        ] : null,
    ])->values();
@endphp

<div class="max-w-5xl mx-auto px-4 py-8 sm:px-6 lg:px-8"
    x-data="{
        requests: @js($requestOptions),
        selectedId: '{{ old('verification_request_id', $selectedRequestId) }}',
        get selected() {
            return this.requests.find(r => String(r.id) === String(this.selectedId)) ?? null;
        }
    }">

    <nav class="mb-6">
        <a href="{{ route('verification.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Verifications
        </a>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h1 class="text-xl font-semibold text-gray-900 tracking-tight">Record Verification</h1>
                    <p class="text-xs text-gray-500 mt-1">
                        Review a pending request and insert a row into <span class="font-mono text-gray-600">verifications</span>.
                    </p>
                </div>

                @if ($pendingRequests->isEmpty())
                    <div class="p-6">
                        <div class="rounded-xl border border-amber-100 bg-amber-50/60 p-4 text-sm text-amber-900">
                            There are no pending requests in <span class="font-mono">verification_requests</span> to review.
                        </div>
                        <a href="{{ route('verification.index') }}"
                            class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                            Back to Verifications →
                        </a>
                    </div>
                @else
                    <form action="{{ route('verification.store') }}" method="POST" class="p-6 space-y-6">
                        @csrf

                        <div>
                            <label for="verification_request_id" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">
                                Pending Request <span class="text-rose-500">*</span>
                            </label>
                            <select id="verification_request_id" name="verification_request_id" required x-model="selectedId"
                                class="block w-full pl-3 pr-10 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white text-gray-700 cursor-pointer">
                                <option value="" disabled>Select a pending request...</option>
                                @foreach ($pendingRequests as $pendingRequest)
                                    <option value="{{ $pendingRequest->id }}" @selected(old('verification_request_id', $selectedRequestId) == $pendingRequest->id)>
                                        #{{ $pendingRequest->id }} — {{ $pendingRequest->credential?->title ?? 'Unknown credential' }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-400 mt-1.5">Uses <span class="font-mono">verification_requests.id</span> to resolve <span class="font-mono">credential_id</span>.</p>
                            <x-input-error :messages="$errors->get('verification_request_id')" class="mt-2" />
                        </div>

                        <div>
                            <label for="status" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">
                                Status <span class="text-rose-500">*</span>
                            </label>
                            <select id="status" name="status" required
                                class="block w-full pl-3 pr-10 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white text-gray-700 cursor-pointer">
                                <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select outcome...</option>
                                <option value="verified" @selected(old('status') === 'verified')>verified</option>
                                <option value="rejected" @selected(old('status') === 'rejected')>rejected</option>
                            </select>
                            <p class="text-xs text-gray-400 mt-1.5">Maps to <span class="font-mono">verifications.status</span>.</p>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div>
                            <label for="remarks" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">
                                Remarks <span class="text-gray-400 text-[11px] font-normal normal-case">(optional)</span>
                            </label>
                            <textarea id="remarks" name="remarks" rows="4"
                                placeholder="Add reviewer notes..."
                                class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white resize-none">{{ old('remarks') }}</textarea>
                            <p class="text-xs text-gray-400 mt-1.5">Maps to <span class="font-mono">verifications.remarks</span>.</p>
                            <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                        </div>

                        <div class="rounded-xl border border-gray-100 bg-gray-50/60 p-4 text-xs text-gray-500 space-y-1">
                            <p><span class="font-medium text-gray-700">credential_id</span> — copied from the selected request</p>
                            <p><span class="font-medium text-gray-700">verifier_id</span> — set automatically to your user account</p>
                            <p><span class="font-medium text-gray-700">verified_at</span> — set automatically on submit</p>
                            <p><span class="font-medium text-gray-700">verification_requests.status</span> — updated to completed or declined</p>
                            <p><span class="font-medium text-gray-700">verification_requests.responded_at</span> — set automatically on submit</p>
                            <p><span class="font-medium text-gray-700">credentials.status</span> — set to rejected when outcome is rejected</p>
                        </div>

                        <div class="pt-2 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                            <a href="{{ route('verification.index') }}"
                                class="w-full sm:w-auto inline-flex justify-center items-center bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-50 transition-all">
                                Cancel
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex justify-center items-center bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-100">
                                Record Verification
                            </button>
                        </div>
                    </form>
                @endif
            </div>

            <template x-if="selected?.credential?.file_path">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
                        <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Credential File</h2>
                        <span class="text-xs font-mono text-gray-400" x-text="selected.credential.file_path"></span>
                    </div>
                    <div class="p-6 bg-gray-100 flex justify-center items-center min-h-[16rem]">
                        <p class="text-sm text-gray-500">Preview available on the credential detail page.</p>
                    </div>
                </div>
            </template>
        </div>

        <div class="space-y-4 lg:sticky lg:top-8">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-1">Selected Request</h3>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-4">
                <template x-if="selected">
                    <div class="space-y-4 text-xs">
                        <div class="space-y-2">
                            <p class="font-semibold text-gray-400 uppercase tracking-wider">verification_requests</p>
                            <div class="bg-gray-50/50 rounded-xl p-3.5 border border-gray-100 space-y-2">
                                <div class="flex justify-between gap-4">
                                    <span class="text-gray-400">id</span>
                                    <span class="font-mono text-gray-700" x-text="selected.id"></span>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <span class="text-gray-400">credential_id</span>
                                    <span class="font-mono text-gray-700" x-text="selected.credential_id"></span>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <span class="text-gray-400">requested_by</span>
                                    <span class="font-mono text-gray-700" x-text="selected.requested_by"></span>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <span class="text-gray-400">requester</span>
                                    <span class="text-gray-700" x-text="selected.requester_name ?? '—'"></span>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <span class="text-gray-400">requested_at</span>
                                    <span class="text-gray-700" x-text="selected.requested_at ?? '—'"></span>
                                </div>
                                <template x-if="selected.message">
                                    <div>
                                        <span class="text-gray-400">message</span>
                                        <p class="text-gray-600 mt-1 leading-relaxed" x-text="selected.message"></p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <template x-if="selected.credential">
                            <div class="space-y-2">
                                <p class="font-semibold text-gray-400 uppercase tracking-wider">credentials</p>
                                <div class="bg-gray-50/50 rounded-xl p-3.5 border border-gray-100 space-y-2">
                                    <div class="flex justify-between gap-4">
                                        <span class="text-gray-400">title</span>
                                        <span class="text-gray-700 text-right" x-text="selected.credential.title"></span>
                                    </div>
                                    <div class="flex justify-between gap-4">
                                        <span class="text-gray-400">type</span>
                                        <span class="text-gray-700 capitalize" x-text="selected.credential.type"></span>
                                    </div>
                                    <div class="flex justify-between gap-4">
                                        <span class="text-gray-400">issuer</span>
                                        <span class="text-gray-700 text-right" x-text="selected.credential.issuer"></span>
                                    </div>
                                    <div class="flex justify-between gap-4">
                                        <span class="text-gray-400">status</span>
                                        <span class="text-gray-700 capitalize" x-text="selected.credential.status"></span>
                                    </div>
                                    <div class="flex justify-between gap-4">
                                        <span class="text-gray-400">issue_date</span>
                                        <span class="text-gray-700" x-text="selected.credential.issue_date ?? '—'"></span>
                                    </div>
                                    <div class="flex justify-between gap-4">
                                        <span class="text-gray-400">expiry_date</span>
                                        <span class="text-gray-700" x-text="selected.credential.expiry_date ?? '—'"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

                <template x-if="!selected">
                    <p class="text-sm text-gray-400">Select a pending request to preview linked records.</p>
                </template>
            </div>
        </div>

    </div>
</div>

@endsection
