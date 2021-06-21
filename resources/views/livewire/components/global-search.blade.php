<div>
    <div class="flex justify-center">
        <input type="text" wire:model="search" placeholder="Cari buku"
            class="py-2 pl-10 pr-5 w-4/5 lg:w-1/2 border border-gray-200 rounded shadow-2xl h-16 lg:h-20 z-20 lg:text-xl text-lg outline-none font-bold text-gray-500"
            style="margin-bottom: -36px;">
    </div>

    @if (count($books) != 0)        
        <section class="bg-white border-b py-8">
            <div class="container mx-auto flex flex-wrap pt-4 pb-12">
                <h2 class="w-full my-2 text-xl font-black leading-tight text-center text-gray-400 mt-10">
                    Cari berdasarkan : ISBN | Author | Title
                </h2>
                <div class="flex flex-wrap justify-center lg:justify-between w-full p-6 bg-gray-100">

                    @forelse ($books as $book)
                        <div class="bg-white rounded overflow-hidden shadow w-40 px-3 mx-4 my-4 lg:my-4 hover:shadow-xl">
                            <a href="{{url('book-details/'.$book->id)}}">
                                <div class="pt-3">
                                    <img src="{{asset('storage/'.$book->cover_file_name)}}" alt="cover" class="mx-auto" width="150">
                                </div>
                                <p class="w-full text-gray-900 text-xs font-light md:text-xs h-10 my-2 overflow-auto">
                                    {{$book->title}}
                                </p>
                            </a>
                        </div>     
                    @empty
                        <h2 class="w-full my-2 text-xl font-black leading-tight text-center text-gray-500">
                            Oops..buku nya lagi kosong
                        </h2>
                    @endforelse
                </div>
                <div class="py-5">
                    {{ $books->links() }}
                </div>
            </div>
        </section>
    @endif

    <!-- fast search -->
    <section class="bg-white border-b py-12 px-4">
        <div class="container mx-auto flex flex-wrap items-center justify-between pb-12">
            <h2 class="w-full my-2 text-xl font-black leading-tight text-center text-gray-800 lg:mt-8">
                Select the topic you are interested in
            </h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <div class="flex flex-1 flex-wrap max-w-4xl mx-auto items-center justify-around mt-10">
                <button type="button" wire:click="fastSearchSubject('literature')"
                    class="flex flex-col items-center justify-center h-24 lg:h-40 w-24 lg:w-40 border-gray-300 bg-gray-100 rounded hover:shadow-xl cursor-pointer my-2 p-4 mx-1">
                    <img src="img/literature.png" alt="literature" width="100">
                    <p class="text-gray-900 font-light text-xs">literature</p>
                </button>
                <button type="button" wire:click="fastSearchSubject('language')"
                    class="flex items-center flex-col justify-center h-24 lg:h-40 w-24 lg:w-40 border-gray-300 bg-gray-100 rounded hover:shadow-xl cursor-pointer my-2 p-4 mx-1">
                    <img src="img/language.png" alt="literature" width="100">
                    <p class="text-gray-900 font-light text-xs">language</p>
                </button>
                <button type="button" wire:click="fastSearchSubject('computer')"
                    class="flex items-center flex-col justify-center h-24 lg:h-40 w-24 lg:w-40 border-gray-300 bg-gray-100 rounded hover:shadow-xl cursor-pointer my-2 p-4 mx-1">
                    <img src="img/computer.png" alt="literature" width="100">
                    <p class="text-gray-900 font-light text-xs">computer science</p>
                </button>
                <button type="button" wire:click="fastSearchSubject('art')"
                    class="flex items-center flex-col justify-center h-24 lg:h-40 w-24 lg:w-40 border-gray-300 bg-gray-100 rounded hover:shadow-xl cursor-pointer my-2 p-4 mx-1">
                    <img src="img/art.png" alt="literature" width="100">
                    <p class="text-gray-900 font-light text-xs">art</p>
                </button>
                <button type="button" wire:click="fastSearchSubject('social')"
                    class="flex items-center flex-col justify-center h-24 lg:h-40 w-24 lg:w-40 border-gray-300 bg-gray-100 rounded hover:shadow-xl cursor-pointer my-2 p-4 mx-1">
                    <img src="img/social-science.png" alt="literature" width="100">
                    <p class="text-gray-900 font-light text-xs">social</p>
                </button>
            </div>
        </div>
    </section>
</div>
