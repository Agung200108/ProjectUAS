<div>
    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
        <div class="flex items-start justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-top sm:h-screen"></span>​
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-full lg:max-w-2xl sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <form wire:submit.prevent="store(Object.fromEntries(new FormData($event.target)))">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        @forelse ($cartBooks as $key => $book)
                            <div class="flex my-10 lg:my-4">
                                <div class="w-4/12 lg:w-1/5">
                                    <div class="p-2 shadow-inset lg:p-5 rounded lg:rounded-xl bg-gray-100">
                                        <img src="{{asset('storage/'.$book->cover_file_name)}}" alt="cover">
                                    </div>
                                </div>
                                <div class=" mx-2 w-full">
                                    <h1 class="text-gray-500 font-black mb-2">{{$book->title}}</h1>
                                    <div class="flex justify-between w-full lg:w-full my-2">
                                        <span class="text-sm text-gray-600 font-light">Tanggal Pinjam</span>
                                        <span class="text-sm  bg-gray-100 text-gray-500 rounded px-2 font-light">{{$borrow_date}}</span>
                                    </div>
                                    <div class="flex justify-between w-full lg:w-full my-2 items-center">
                                        <span class="text-sm text-gray-600 font-light">Tanggal Kembali</span>
                                        <input type="date" class="border border-blue-300 rounded-xl h-10" name="return_date{{$key}}" required>
                                    </div>
                                    <div class="flex justify-between w-full lg:w-full my-2 items-center">
                                        <span class="text-sm text-gray-600 font-light"></span>
                                        <button wire:click="removeBook({{$key}})" type="button" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff7675" width="25">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                              </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            
                        @endforelse
                    </div>
                    @include('livewire/components/session-message')
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button class="inline-flex justify-center w-full bg-gradient-to-r from-indigo-400 to-blue-500 rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Pinjam
                            </button> 
                        </span>
                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                            <button type="button" wire:click="closeModal()" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5 cursor-pointer">
                                Cancel
                            </button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
