<div>
    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <form>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="">
                            <div class="mb-4">
                                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul :</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model="title" placeholder="Judul buku">
                                @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="isbn" class="block text-gray-700 text-sm font-bold mb-2">ISBN :</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="isbn" wire:model="isbn" placeholder="">
                                @error('isbn') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="responsible_person" class="block text-gray-700 text-sm font-bold mb-2">Penanggung Jawab :</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="responsible_person" wire:model="responsible_person" placeholder="">
                                @error('responsible_person') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Penulis / Pengarang :</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="author" wire:model="author" placeholder="">
                                @error('author') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="publisher" class="block text-gray-700 text-sm font-bold mb-2">Penerbit :</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="publisher" wire:model="publisher" placeholder="">
                                @error('publisher') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="publication_year" class="block text-gray-700 text-sm font-bold mb-2">Tahun Terbit :</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="publication_year" wire:model="publication_year" placeholder="">
                                @error('publication_year') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="publication_place" class="block text-gray-700 text-sm font-bold mb-2">Tempat Terbit :</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="publication_place" wire:model="publication_place" placeholder="">
                                @error('publication_place') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi :</label>
                                <textarea wire:model="description" type="text" list="description" name="description" class="w-full px-3 py-2 text-gray-700 border-2 border-gray-300 rounded-lg focus:outline-none" rows="4"  placeholder="Deskripsi..."></textarea>
                                <p> @error('description') <span class="text-red-500">{{ $message }}</span>@enderror</p>
                            </div>

                            <div class="mb-4">
                                <label for="edition" class="block text-gray-700 text-sm font-bold mb-2">Edisi :</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="edition" wire:model="edition" placeholder="">
                                @error('edition') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="gmd" class="block text-gray-700 text-sm font-bold mb-2">GMD :</label>
                                <select class="form-control" wire:model="gmd" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option>Pilih</option>
                                    <option value="text">Text</option>
                                    <option value="ebook">Ebook</option>
                                </select>
                                @error('gmd') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            @if ($showUploadPdf)
                                <div class="mb-4">
                                    <label for="pdf_file_name" class="block text-gray-700 text-sm font-bold mb-2">Upload Ebook :</label>
                                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pdf_file_name" wire:model="pdf_file_name">
                                    @error('pdf_file_name') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                            @endif

                            <div class="mb-4">
                                <label for="call_number" class="block text-gray-700 text-sm font-bold mb-2">Nomor Panggil :</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="call_number" wire:model="call_number" placeholder="">
                                @error('call_number') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="language" class="block text-gray-700 text-sm font-bold mb-2">Bahasa :</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="language" wire:model="language" placeholder="">
                                @error('language') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">Tag :</label><sup class="text-gray-800 font-light">contoh : computer,pertanian,...</sup>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="subject" wire:model="subject" placeholder="">
                                @error('subject') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Buku:</label>
                                <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="amount" wire:model="amount" placeholder="">
                                @error('amount') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <hr class="my-5">
                    
                            <div class="mb-4">
                                <label for="cover_file_name" class="block text-gray-700 text-sm font-bold mb-2">Cover Buku :</label>
                                <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cover_file_name" wire:model="cover_file_name">
                                @error('cover_file_name') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            @php
                                $array = explode(".",$cover_file_name);
                            @endphp
                            @if ($array[count($array)-1] == "png" || $array[count($array)-1] == "jpg" || $array[count($array)-1] == "jpeg")
                                <div class="mb-4">
                                    <img src="{{asset('storage/'.$cover_file_name)}}" width="400" class="mx-auto shadow-xl">
                                </div>
                            @endif
                        </div>
                    </div>
        
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Save
                            </button> 
                        </span>
                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                            
                            <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Cancel
                            </button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>