<div x-show="open" x-cloak @click.away="open = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

    <div x-transition class="w-full max-w-lg rounded-xl bg-white p-6">

        <div class="flex justify-between items-start">

            <div>
                <h3 class="text-base font-semibold text-gray-900">
                    Upload New Document
                </h3>
                <p class="text-xs text-gray-500 mt-0.5">
                    Add a new official record to your digital credentials.
                </p>
            </div>

            <button type="button" @click="open = false"
                class="rounded-lg p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-50">

                <span class="sr-only">Close</span>

                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>

            </button>

        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-6 space-y-5 bg-white">
                {{-- doc titke --}}
                <div>
                    <x-form-label for="title" />
                    Document Title
                    <x-form-input type="text" name="title" id="doc_title" placeholder="Document Title" required
                        autofocus class="input-text" />
                </div>

                {{-- 2 col --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-form-label for="doc_type" />Category
                        <x-select-form name="category" id="doc_category" required>
                            <option value="" disabled selected>Select category</option>
                            <option value="education">Education</option>
                        </x-select-form>
                    </div>

                    <div>
                        <x-form-label for="doc_issuer" />Issuing Institution
                        <x-form-input id="doc_issuer" name="issuer" placeholder="e.g FreeCodeCamp"
                            class="input-text" />
                    </div>
                </div>

                {{-- 2 col --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Issue Date --}}
                    <div>
                        <x-form-label for="issue_date" />Issue Date
                        <x-form-input type="date" id="issue_date" name="issue_date" class="input-text"
                            value="{{ old('issue_date', now()->toDateString()) }}" />
                    </div>

                    {{-- Expiry Date --}}
                    <div>
                        <x-form-label for="expiry_date" />Expiry Date
                        <x-form-input type="date" id="expiry_date" name="expiry_date" class="input-text" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">Upload File</label>
                    <div
                        class="mt-1 flex justify-center rounded-xl border-2 border-dashed border-gray-200 px-6 pt-5 pb-6 hover:border-indigo-400 group transition-colors cursor-pointer bg-gray-50/30">
                        <div class="space-y-2 text-center">

                            <div
                                class="mx-auto h-10 w-10 text-gray-400 group-hover:text-indigo-500 transition-colors flex items-center justify-center bg-white rounded-lg border border-gray-100 shadow-sm">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                            </div>

                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="file-upload"
                                    class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500/20">
                                    <span>Click to upload</span>
                                    <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                </label>
                                <p class="pl-1 text-gray-400">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-400">PDF, PNG, or JPG up to 10MB</p>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
