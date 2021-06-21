<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap justify-center">
        <div class="bg-blue-500 w-full lg:w-2/5 shadow-2xl rounded-lg text-center py-12 mt-4 mx-2 lg:mx-auto">
            <h2 class="text-3xl leading-9 font-bold tracking-tight text-white sm:text-4xl sm:leading-10">
                Pilih Buku
            </h2>
            <div class="mt-8 flex justify-center">
                <div class="inline-flex rounded-md bg-white shadow">
                    <a href="/" class="text-gray-700 font-bold py-2 px-6">
                        Go
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-indigo-500 w-full lg:w-2/5 shadow-2xl rounded-lg text-center py-12 mt-4 mx-2 lg:mx-auto">
            <h2 class="text-3xl leading-9 font-bold tracking-tight text-white sm:text-4xl sm:leading-10">
                Transaksi
            </h2>
            <div class="mt-8 flex justify-center">
                <div class="inline-flex rounded-md bg-white shadow">
                    <a href="transactions" class="text-gray-700 font-bold py-2 px-6">
                        Go
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
