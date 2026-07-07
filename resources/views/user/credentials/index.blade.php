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

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                {{-- cards index --}}
                @if ($credentials->isEmpty())
                    <div
                        class="dash-card flex flex-col items-center justify-center py-16 px-6 border-2 border-dashed border-neutral-700 rounded-xl bg-white/10 text-center transition-colors hover:bg-neutral-800/10">
                        <div class="p-4 bg-neutral-800 rounded-full mb-4 ring-1 ring-neutral-700">
                            <svg class="w-8 h-8 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>

                        <h3 class="text-lg font-semibold text-black">No credentials yet</h3>
                        <p class="mt-1 max-w-sm text-sm text-neutral-800">Get started by uploading your first set of
                            credentials.</p>

                        <a href="{{ route('credentials.create') }}"
                            class="mt-6 inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white transition-colors bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-neutral-900">
                            <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Upload Credentials
                        </a>
                    </div>
                @else
                    @foreach ($credentials as $credential)
                        <div
                            class="bg-white rounded-2xl border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all group flex flex-col">
                            <div class="p-5 flex-1">
                                <div class="flex justify-between items-start mb-4">
                                    <div
                                        class="h-12 w-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 14l9-5-9-4-9 5 9 4zm0 0v6l9-5V9l-9 5zm0 0l-9-5v6l9 5v-6z"></path>
                                        </svg>
                                    </div>
                                    @php
                                        $status = $credential->status;
                                    @endphp

                                    <span
                                        class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md capitalize">
                                        <span
                                            class="h-1.5 w-1.5 rounded-full 
                                            @if ($status === 'pending') bg-yellow-500 
                                            @elseif ($status === 'verified') bg-emerald-500 @endif">
                                        </span>
                                        {{ str_replace('_', ' ', $status) }}
                                    </span>
                                </div>
                                <h3 class="text-base font-semibold text-gray-900 leading-tight">{{ $credential->title }}
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $credential->issuer }}</p>
                                <div class="flex items-center gap-2 mt-4 text-xs font-medium text-gray-400">
                                    <span>{{ $credential->type }}</span>
                                    <span>•</span>
                                    <span>Uploaded {{ $credential->issue_date }}</span>
                                </div>
                            </div>
                            <div
                                class="border-t border-gray-100 p-4 bg-gray-50/50 rounded-b-2xl flex justify-between items-center opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                                <button class="text-sm font-medium text-indigo-600 hover:text-indigo-800">View
                                    Details</button>
                                <div x-data="{ open: false }" class="flex gap-2">
                                    <button
                                        class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                        title="Share">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                                            </path>
                                        </svg>
                                    </button>
                                    <div x-data="{ open: false }">
                                        <button @click="open = true"
                                            class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                                            title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>

                                        <div x-show="open" x-transition.opacity x-cloak @click="open = false"
                                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                                            <div @click.stop x-transition
                                                class="w-full max-w-md rounded-lg bg-neutral-900 p-6 shadow-xl">
                                                <h2 class="text-lg font-semibold text-white">
                                                    Delete Credential
                                                </h2>

                                                <p class="mt-2 text-sm text-neutral-400">
                                                    Are you sure you want to delete this credential? This action cannot be
                                                    undone.
                                                </p>

                                                <div class="mt-6 flex justify-end gap-3">
                                                    <button type="button" @click="open = false"
                                                        class="rounded-md px-4 py-2 text-sm text-neutral-400 hover:bg-neutral-800 transition">
                                                        Cancel
                                                    </button>

                                                    <form action="{{ route('credentials.destroy', $credential) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 transition">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                @if ($credentials->hasPages())
                    <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
                        {{ $credentials->links() }}
                    </div>
                @endif
            </div>
        </div>

        @include('user.credentials.create')
    </div>
@endsection
