<div>
    @include('livewire.components.session-message')
    <div class="flex justify-center">
        <button wire:click="addToCart()" class="px-4 py-2 bg-gradient-to-r from-indigo-400 to-blue-500 flex rounded my-2 text-white font-black hover:shadow-2xl duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#fff" width="25">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Pinjam Buku
        </button>
    </div>
</div>
