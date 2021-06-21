<div>
    <div class="w-full lg:w-3/4 flex flex-col justify-center mx-auto lg:mt-5 lg:my-5">
        <div class='min-w-full lg bg-white shadow-md rounded-lg overflow-hidden mx-auto'>
            <div class="py-4 px-8 mt-3">
                <div class="rounded-lg mt-5">
                    <div class="py-4 px-4">
                        <div class="flex flex-col">
                            <h4 class="text-lg font-semibold mb-3">Buku yang di pinjam :</h4>
                            @include('livewire.components.session-message')
                            <div class="flex flex-col text-sm text-gray-500">
                                @foreach ($transaction->borrow_books as $key => $book)
                                    <div class="my-5">
                                        <div class="flex">
                                            <div>
                                                <div class="p-4 rounded bg-gray-100 mr-2 shadow">
                                                    <img src="{{asset('storage/'.$books[$key]->cover_file_name)}}" alt="" class="mr-1" width="100" height="100">
                                                </div>
                                            </div>
                                            <div>
                                                <span class="mb-1 text-xl">{{$books[$key]->title}}</span>
                                                <div class="flex mt-2">
                                                    <span class="mb-1 text-sm">peminjam : </span>&nbsp;
                                                    <span class="mb-1 text-sm">{{$user->name}}</span>
                                                </div>
                                                <div class="flex">
                                                    <span class="mb-1 text-sm">tgl. pinjam : </span>&nbsp;
                                                    <span class="mb-1 text-sm">{{$transaction->borrow_date}}</span>
                                                </div>
                                                <div class="flex">
                                                    @if ($book->renewal_date != null)
                                                        <span class="mb-1 text-sm">batas perpanjangan : </span>&nbsp;
                                                        <span class="mb-1 text-sm">{{Date::parse($book->renewal_date)->timespan()}}</span>
                                                    @else
                                                        <span class="mb-1 text-sm">batas waktu : </span>&nbsp;
                                                        <span class="mb-1 text-sm">{{Date::parse($book->return_date)->timespan()}}</span>
                                                    @endif
                                                </div>
                                                <div class="flex">
                                                    @if ($book->actual_return != null)
                                                        <span class="mb-1 text-sm">tanggal pengembalian</sup> : </span>&nbsp;
                                                        <span class="mb-1 text-sm">{{$book->actual_return}}</span>
                                                    @else
                                                        <span class="mb-1 text-sm">tanggal <sup>sekarang</sup> : </span>&nbsp;
                                                        <span class="mb-1 text-sm">{{$now}}</span>
                                                    @endif
                                                </div>
                                                <div class="flex my-2">
                                                    <span class="mb-1 text-xl">Denda : </span>&nbsp;
                                                    <span class="mb-1 text-xl px-4 rounded bg-red-200">Rp.{{number_format($sanction[$key])}}</span>
                                                </div>
                                                <div class="flex">
                                                    @if ($book->actual_return == null && $book->sanction == null)
                                                        <button type="button" wire:click="returnBook({{$book->id}},{{$sanction[$key]}},{{$book->book_id}})" class="uppercase text-center shadow bg-indigo-500 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded mt-1">kembalikan</button>&nbsp;&nbsp;
                                                        {{-- fitur konfirmasi untuk mencegah salah klik sempat dibuat tetapi masih ada bug saat pengembalian buku, tidak error --}}
                                                        {{-- @if ($return_modal)
                                                            @include('livewire.components.return-book-modal')
                                                        @endif --}}
                                                    @endif
                                                    @if ($sanction[$key] == 0 && $book->actual_return == null && $book->renewal_date === null)
                                                        <button type="button" wire:click="openRenewalModal()" class="uppercase text-center shadow bg-blue-500 hover:bg-blue-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded mt-1">perpanjang</button>
                                                        @if ($renewal_modal)
                                                            <form wire:submit.prevent="renewalBook(Object.fromEntries(new FormData($event.target)))">
                                                                <div class="flex ml-4">
                                                                    <div class="mx-2">
                                                                        <input type="hidden" name="borrowed_book_id" value="{{$book->id}}">
                                                                        <input type="date" name="renewal_date" class="z-50 border-4 border-gray-500 rounded-xl cursor-pointer" >
                                                                        @error('renewal_date') <span class="text-red-500">{{ $message }}</span>@enderror
                                                                    </div>
                                                                    <button stype="button" class="px-4 bg-blue-500 p-3 rounded-lg text-white hover:bg-gray-100 hover:text-indigo-400 mr-2">Save</button>&nbsp;&nbsp;
                                                                    
                                                                    <button wire:click="closeRenewalModal()" type="button" class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
                                                                </div>
                                                            </form>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
