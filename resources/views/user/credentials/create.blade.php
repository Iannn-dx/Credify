<div
    x-show="open"
    x-cloak
    @click.self="open = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

    <div
        x-transition
        class="w-full max-w-lg rounded-xl bg-white p-6">

        <div class="flex justify-between items-start">

            <div>
                <h3 class="text-base font-semibold text-gray-900">
                    Upload New Document
                </h3>
                <p class="text-xs text-gray-500 mt-0.5">
                    Add a new official record to your digital credentials.
                </p>
            </div>

            <!-- Close button -->
            <button
                type="button"
                @click="open = false"
                class="rounded-lg p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-50">
                
                <span class="sr-only">Close</span>

                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>

            </button>

        </div>

    </div>
</div>