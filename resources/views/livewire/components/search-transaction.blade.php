<div>
    <div class="relative text-gray-600 focus-within:text-gray-400 m-5">
      <span class="absolute inset-y-0 left-0 flex items-center pl-2">
        <div type="button" class="p-1 focus:outline-none focus:shadow-outline">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
      </span>
      <input wire:model="search" name="search" type="text" class="py-2 text-sm text-white bg-gray-200 rounded-md pl-10 focus:outline-none focus:bg-white focus:text-gray-900" placeholder="transaction code..." autocomplete="off">
    </div>
    
    <div class="my-2 mx-2 lg:flex lg:flex-wrap">
        @forelse ($transactions as $transaction)
            @php
                $bgcolor = "bg-green-300";
                if($transaction->status == "pending"){
                    $bgcolor = "bg-yellow-300";
                }else if($transaction->status == "inactive"){
                    $bgcolor = "bg-gray-300";
                }
            @endphp
            <article class="sm:grid grid-cols-4 bg-white shadow-sm p-7 relative lg:w-3/12 sm:p-4 rounded-lg lg:col-span-2 mx-2 my-2">
                <div class="pt-5 self-center sm:pt-0 sm:pl-10 col-span-3">
                    <h2 class="text-gray-800 capitalize text-xl font-bold">Peminjaman {{count($transaction->borrow_books)}} buku</h2>
                    <div class="flex">
                        <div class="capitalize mt-2 {{$bgcolor}} px-2 rounded-xl">{{$transaction->status}}</div>&nbsp;
                        <div class="capitalize mt-2 bg-indigo-300 px-2 rounded-xl">{{$transaction->transaction_code}}</div>
                    </div>
                    <div class="flex text-xs">
                        <div class="capitalize mt-2">Tgl. Pinjam</div>&nbsp;
                        <div class="capitalize mt-2 bg-blue-300 px-2 rounded-xl">{{$transaction->borrow_date}}</div>
                    </div>
                    <a href="{{url('transactions/'.$transaction->id)}}" class="capitalize underline block pt-2 outline-none">Details</a>
                </div>
                <div class="justify-self-end">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 absolute top-3 right-3 sm:relative sm:top-0 sm:right-0">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
                </div>
            </article>
            {{ $transactions->links() }}
        @empty
            
        @endforelse
    </div>
</div>
