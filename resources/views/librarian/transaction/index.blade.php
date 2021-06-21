<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>
    <a href="{{url('dashboard')}}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#636e72" width="30" class="mx-2 my-2">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
    </a>
    @include('livewire.components.session-message')
    @if (Auth::user()->position == "pustakawan")
        @livewire('components.search-transaction')
    @endif
    @if (Auth::user()->position == "member")
        <div class="my-2 mx-2 lg:flex lg:flex-wrap lg:justify-center">
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
            @empty
                
            @endforelse
        </div>
    @endif

</x-app-layout>
