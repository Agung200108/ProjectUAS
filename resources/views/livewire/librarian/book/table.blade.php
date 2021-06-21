<div>
    {{-- delete confirmation --}}
    @if ($deleteId)
        <div class="modal h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50">
            <div class="bg-white rounded shadow-lg w-1/3">
                <div class="border-b px-4 py-2 flex justify-between items-center">
                    <h3 class="font-semibold text-lg">Delete this course?</h3>
                </div>
                <div class="flex justify-end items-center w-100 border-t p-3">
                    <button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mr-1 close-modal">Cancel</button>
                    <button wire:click="delete({{$deleteId}})" class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white">Oke</button>
                </div>
            </div>
        </div>
        
        <script>
            const modal = document.querySelector('.modal');
            const closeModal = document.querySelectorAll('.close-modal');
            closeModal.forEach(close => {
            close.addEventListener('click', function (){
                modal.classList.add('hidden')
            });
            });
        </script>
    @endif

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                {{-- session message if success or failed --}}
                @include('livewire.components.session-message')

                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="navigationForMultipleDelete">
                    {{-- modal button --}}
                    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Add Book</button>
                    
                    {{-- search input --}}
                    <input wire:model="search" class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Search">
                    
                    {{-- confirmation button for multiple delete --}}
                    <button class="bg-yellow-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3 hidden" id="okButton">Ok</button>
                    
                    {{-- delete button for multiple delete --}}
                    <button wire:click="multipleDelete()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-3 hidden" id="multipleDeleteButton">Delete</button>
                    
                    {{-- reload page button after multiple delete --}}
                    <div class="inline-block">
                        <button type="button" class="focus:outline-none text-white text-sm py-3 px-4 rounded-md bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 hover:bg-blue-600 hover:shadow-lg flex items-center hidden" id="buttonReload">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reload
                        </button>
                    </div>

                </div>
                @if($isModal)
                    @include('livewire.librarian.book.create')
                @endif

                <div class="pb-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                <div class="flex flex-1">
                                    <main class="bg-white-300 flex-1 p-3 overflow-hidden">
                                        <table class="min-w-max w-full table-auto">
                                            <thead>
                                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                                    <th class="py-3 px-6 text-left">Book</th>
                                                    <th class="py-3 px-6 text-left">ISBN</th>
                                                    <th class="py-3 px-6 text-center">Author</th>
                                                    <th class="py-3 px-6 text-center">GMD</th>
                                                    <th class="py-3 px-6 text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 text-sm font-light">
                                                @forelse($books as $row)
                                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                                        <td class="py-3 px-5 text-left w-80">
                                                            <div class="flex items-center">
                                                                <div class="mr-2">
                                                                    <img src="{{asset('storage/'.$row->cover_file_name)}}" alt="." width="24">
                                                                </div>
                                                                <span class="font-medium">{{$row->title}}</span>
                                                            </div>
                                                        </td>
                                                        <td class="py-3 px-6 text-left">
                                                            <div class="flex items-center">
                                                                <span>{{$row->isbn}}</span>
                                                            </div>
                                                        </td>
                                                        <td class="py-3 px-6 text-left w-24">
                                                            <div class="flex items-center">
                                                                <span>{{$row->author}}</span>
                                                            </div>
                                                        </td>
                                                        <td class="py-3 px-6 text-center">
                                                            <span class="bg-gradient-to-r from-green-400 to-blue-500 text-white py-1 px-3 rounded-full text-xs">{{$row->gmd}}</span>
                                                        </td>
                                                        <td class="py-3 px-6 text-center">
                                                            <div class="flex item-center justify-center">
                                                                <button wire:click="edit({{ $row->id }})" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                                    </svg>
                                                                </button>
                                                                <button wire:click="confirmDelete({{$row->id}})" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                    </svg>
                                                                </button>
                                                                <input type="checkbox" name="check" class="rounded hover:text-yellow-500 hover:scale-110 checkbox" value="{{$row->id}}">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="border px-4 py-2 text-center" colspan="5">Tidak ada data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="py-5">
                                            {{ $books->links() }}
                                        </div>
                                    </main>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let allCheckBox = document.querySelectorAll('.checkbox')
        let id_course = []
        let deleteButtonFinal = document.getElementById("multipleDeleteButton")
        let accSelectionButton = document.getElementById("okButton")
        let reloadButton = document.getElementById("buttonReload")
        allCheckBox.forEach((checkbox) => { 
            checkbox.addEventListener('change', (event) => {
                if (event.target.checked) {
                    id_course.push(event.target.value)
                }else{
                    id_course = arrayRemove(id_course,event.target.value)
                }
                accSelectionButton.classList.remove("hidden")
            })
        })
        
        accSelectionButton.addEventListener('click', () => {
            deleteButtonFinal.classList.remove("hidden")
            deleteButtonFinal.setAttribute("wire:click",`multipleDelete([`+ id_course +`])`)
            id_course = []
            for (var i = 0; i < allCheckBox.length; i++) { 
                allCheckBox[i].checked = false; 
            }    
        })
        deleteButtonFinal.addEventListener("click",() => {
            setTimeout(function(){
                reloadButton.classList.remove("hidden")
            }, 3000);
        })
        reloadButton.addEventListener("click",() =>{
            location.reload()
        })
            
        function arrayRemove(arr, value) { 
            return arr.filter(function(ele){ 
                return ele != value; 
            });
        }
    </script>

</div>
