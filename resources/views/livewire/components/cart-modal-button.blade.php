<div>
    <button wire:click="openModal()" id="navAction"
        class="mx-auto lg:mx-1 opacity-95 text-gray-80 rounded mt-4 lg:mt-0 py-2 bg-white font-black px-6 outline-none shadow flex text-white">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#0984e3" width="25">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </button>
    @if ($modal)
        @include('livewire.components.cart-modal')
    @endif
</div>
