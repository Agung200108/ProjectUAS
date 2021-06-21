<div>
    @if ($isDelete)
        @include('livewire.components.delete-modal')
    @endif
    <a href="{{url('transactions')}}" class="shadow-inner">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#636e72" width="30" class="mx-2 my-2">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
    </a>
    <div class="w-full lg:w-1/2 flex flex-col justify-center mx-auto lg:mt-5 lg:my-5">
        <div class='min-w-full lg bg-white shadow-md rounded-lg overflow-hidden mx-auto'>
            <div class="py-4 px-8 mt-3">
                @include('livewire.components.session-message')
                <div class="bg-gray-100 rounded-lg">
                    <div class="py-4 px-4">
                        <div class="flex flex-col">
                            <h4 class="text-lg font-semibold mb-3">Kode Transaksi :</h4>
                            <div class="flex flex-col text-sm text-gray-500 text-center">
                                <h2 class="text-gray-700 font-semibold text-2xl tracking-wide mb-2">{{$transaction->transaction_code}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($transaction->status == "pending" && Auth::user()->position != "pustakawan")
                <p class="text-xs intalic text-yellow-300">berikan kode ini ke pustakawan untuk meminjam buku</p>
                @endif
                <div class="bg-gray-100 rounded-lg mt-5">
                    <div class="py-4 px-4">
                        <div class="flex flex-col">
                            <h4 class="text-lg font-semibold mb-3">Buku yang di pinjam :</h4>
                            <div class="flex flex-col text-sm text-gray-500">
                                @foreach ($transaction->borrow_books as $key => $book)
                                    <div class="my-2">
                                        <div class="flex items-center">
                                            <img src="{{asset('storage/'.$books[$key]->cover_file_name)}}" alt="" class="mr-1" width="40" height="40">
                                            <span class="mb-1 text-xs">{{$books[$key]->title}}</span>
                                        </div>
                                        <div class="flex">
                                            <span class="mb-1 text-xs">batas waktu : </span>&nbsp;
                                            <span class="mb-1 text-xs">{{$book->return_date}}</span>
                                        </div>
                                        @if ($book->actual_return != null)
                                            <div class="flex">
                                                <span class="mb-1 text-xs">dikembalikan : </span>&nbsp;
                                                <span class="mb-1 text-xs">{{$book->actual_return}}</span>
                                            </div>
                                        @endif
                                        @if ($book->sanction !== null)
                                            <div class="flex">
                                                <span class="mb-1 text-xs">denda : </span>&nbsp;
                                                <span class="mb-1 text-xs">Rp.{{number_format($book->sanction)}}</span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->position == "pustakawan")                    
                    <div class="py-4">
                        @if ($transaction->status == "pending")
                            <button type="button" wire:click="approve()" class="block w-full tracking-widest uppercase text-center shadow bg-indigo-500 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded my-5">Approve</button>
                        @endif
                        @if ($transaction->status == "active")
                            <a href="{{url('/transactions/return-book/'.$transaction->id)}}" class="block w-full tracking-widest uppercase text-center shadow bg-indigo-500 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded my-5">Return Book</a>
                        @endif
                        <button type="button" wire:click="openDeleteModal()" class="block w-full tracking-widest uppercase text-center shadow bg-red-500 hover:bg-red-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded my-5">Remove</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
