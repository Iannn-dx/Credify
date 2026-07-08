@extends('layouts.app')

@section('title', 'Submit Verification Request')

@section('content')

@php
    $credentialOptions = $credentials->map(fn ($credential) => [
        'id' => $credential->id,
        'title' => $credential->title,
        'type' => $credential->type,
        'issuer' => $credential->issuer,
        'issue_date' => $credential->issue_date
            ? \Carbon\Carbon::parse($credential->issue_date)->format('M j, Y')
            : null,
        'expiry_date' => $credential->expiry_date
            ? \Carbon\Carbon::parse($credential->expiry_date)->format('M j, Y')
            : null,
        'status' => $credential->status,
        'description' => $credential->description,
        'file_path' => $credential->file_path,
    ])->values();
@endphp

<div class="max-w-5xl mx-auto px-4 py-8 sm:px-6 lg:px-8"
    x-data="{
        credentials: @js($credentialOptions),
        selectedId: '{{ old('credential_id', $selectedCredentialId) }}',
        get selected() {
            return this.credentials.find(c => String(c.id) === String(this.selectedId)) ?? null;
        }
    }">

    <nav class="mb-6">
        <a href="{{ route('requests.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Requests
        </a>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h1 class="text-xl font-semibold text-gray-900 tracking-tight">Submit Verification Request</h1>
                    <p class="text-xs text-gray-500 mt-1">
                        Create a record in <span class="font-mono text-gray-600">verification_requests</span> linked to one of your credentials.
                    </p>
                </div>

                @if ($credentials->isEmpty())
                    <div class="p-6">
                        <div class="rounded-xl border border-amber-100 bg-amber-50/60 p-4 text-sm text-amber-900">
                            You need at least one credential before submitting a verification request.
                        </div>
                        <a href="{{ route('credentials.index') }}"
                            class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                            Go to My Credentials →
                        </a>
                    </div>
                @else
                    <form action="{{ route('requests.store') }}" method="POST" class="p-6 space-y-6">
                        @csrf

                        <div>
                            <label for="credential_id" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">
                                Credential <span class="text-rose-500">*</span>
                            </label>
                            <select id="credential_id" name="credential_id" required x-model="selectedId"
                                class="block w-full pl-3 pr-10 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white text-gray-700 cursor-pointer">
                                <option value="" disabled>Select a credential...</option>
                                @foreach ($credentials as $credential)
                                    <option value="{{ $credential->id }}" @selected(old('credential_id', $selectedCredentialId) == $credential->id)>
                                        {{ $credential->title }} — {{ $credential->issuer }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-400 mt-1.5">Maps to <span class="font-mono">credential_id</span>.</p>
                            <x-input-error :messages="$errors->get('credential_id')" class="mt-2" />
                        </div>

                        <div>
                            <label for="message" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">
                                Message <span class="text-gray-400 text-[11px] font-normal normal-case">(optional)</span>
                            </label>
                            <textarea id="message" name="message" rows="4"
                                placeholder="Add any details for the reviewer..."
                                class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white resize-none">{{ old('message') }}</textarea>
                            <p class="text-xs text-gray-400 mt-1.5">Maps to <span class="font-mono">message</span>.</p>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <div class="rounded-xl border border-gray-100 bg-gray-50/60 p-4 text-xs text-gray-500 space-y-1">
                            <p><span class="font-medium text-gray-700">requested_by</span> — set automatically to your user account</p>
                            <p><span class="font-medium text-gray-700">status</span> — defaults to <span class="font-mono">pending</span></p>
                            <p><span class="font-medium text-gray-700">requested_at</span> — set automatically on submit</p>
                            <p><span class="font-medium text-gray-700">responded_at</span> — left empty until reviewed</p>
                        </div>

                        <div class="pt-2 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                            <a href="{{ route('requests.index') }}"
                                class="w-full sm:w-auto inline-flex justify-center items-center bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-50 transition-all">
                                Cancel
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex justify-center items-center bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-100">
                                Submit Request
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <div class="space-y-4 lg:sticky lg:top-8">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-1">Selected Credential</h3>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-4">
                <template x-if="selected">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-500 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-4-9 5 9 4zm0 0v6l9-5V9l-9 5zm0 0l-9-5v6l9 5v-6z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-sm font-semibold text-gray-900 truncate" x-text="selected.title"></h4>
                                <p class="text-xs text-gray-400 truncate" x-text="selected.issuer"></p>
                            </div>
                        </div>

                        <div class="bg-gray-50/50 rounded-xl p-3.5 border border-gray-100 text-xs space-y-2">
                            <div class="flex justify-between gap-4">
                                <span class="text-gray-400">type</span>
                                <span class="font-medium text-gray-700 capitalize" x-text="selected.type"></span>
                            </div>
                            <div class="flex justify-between gap-4">
                                <span class="text-gray-400">status</span>
                                <span class="font-medium text-gray-700 capitalize" x-text="selected.status"></span>
                            </div>
                            <div class="flex justify-between gap-4">
                                <span class="text-gray-400">issue_date</span>
                                <span class="font-medium text-gray-700" x-text="selected.issue_date ?? '—'"></span>
                            </div>
                            <div class="flex justify-between gap-4">
                                <span class="text-gray-400">expiry_date</span>
                                <span class="font-medium text-gray-700" x-text="selected.expiry_date ?? '—'"></span>
                            </div>
                            <div class="flex justify-between gap-4">
                                <span class="text-gray-400">file_path</span>
                                <span class="font-mono text-[10px] text-gray-600 truncate max-w-[10rem]" x-text="selected.file_path"></span>
                            </div>
                        </div>

                        <template x-if="selected.description">
                            <div>
                                <p class="text-xs font-medium text-gray-400 mb-1">description</p>
                                <p class="text-xs text-gray-600 leading-relaxed" x-text="selected.description"></p>
                            </div>
                        </template>
                    </div>
                </template>

                <template x-if="!selected">
                    <p class="text-sm text-gray-400">Select a credential to preview its stored fields.</p>
                </template>
            </div>
        </div>

    </div>
</div>

@endsection
