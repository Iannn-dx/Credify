{{-- Document Upload Modal Template --}}
<div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    
    {{-- Backdrop Overlay --}}
    <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm transition-opacity"></div>

    {{-- Modal Wrapper --}}
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-100">
            
            {{-- Modal Header --}}
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-semibold text-gray-900" id="modal-title">Upload New Document</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Add a new official record to your digital credentials.</p>
                </div>
                <button type="button" class="rounded-lg p-1.5 text-gray-400 hover:text-gray-500 hover:bg-gray-50 transition-colors focus:outline-none">
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            {{-- Modal Body / Form --}}
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-5 bg-white">
                    
                    {{-- Document Title --}}
                    <div>
                        <label for="doc_title" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">Document Title</label>
                        <input type="text" name="title" id="doc_title" placeholder="e.g., Bachelor of Science Degree" 
                            class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white">
                    </div>

                    {{-- Two Column Fields --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Issuing Organization --}}
                        <div>
                            <label for="doc_issuer" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">Issuing Institution</label>
                            <input type="text" name="issuer" id="doc_issuer" placeholder="e.g., Stanford University" 
                                class="block w-full px-3 py-2.5 border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-gray-50/50 focus:bg-white">
                        </div>

                        {{-- Category Select --}}
                        <div>
                            <label for="doc_category" class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">Category</label>
                            <select name="category" id="doc_category" 
                                class="block w-full pl-3 pr-10 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white text-gray-700 cursor-pointer">
                                <option value="" disabled selected>Select category</option>
                                <option value="education">Education</option>
                                <option value="work">Work Experience</option>
                                <option value="certificate">Certification</option>
                                <option value="id">Identification</option>
                            </select>
                        </div>
                    </div>

                    {{-- Drag and Drop File Zone --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-700 uppercase tracking-wider mb-2">Upload File</label>
                        <div class="mt-1 flex justify-center rounded-xl border-2 border-dashed border-gray-200 px-6 pt-5 pb-6 hover:border-indigo-400 group transition-colors cursor-pointer bg-gray-50/30">
                            <div class="space-y-2 text-center">
                                
                                {{-- Icon wrapper --}}
                                <div class="mx-auto h-10 w-10 text-gray-400 group-hover:text-indigo-500 transition-colors flex items-center justify-center bg-white rounded-lg border border-gray-100 shadow-sm">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                </div>
                                
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500/20">
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

                {{-- Modal Footer Actions --}}
                <div class="bg-gray-50/50 border-t border-gray-100 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                    <button type="button" class="w-full sm:w-auto inline-flex justify-center items-center bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition-all focus:outline-none">
                        Cancel
                    </button>
                    <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-100 focus:outline-none">
                        Upload Document
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>