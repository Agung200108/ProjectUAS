<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Managements') }}
        </h2>
    </x-slot>

    @livewire('librarian.book.table')

</x-app-layout>
