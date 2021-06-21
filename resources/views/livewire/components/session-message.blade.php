<div>
    @if (session()->has('message'))
        <div class="bg-gradient-to-r from-green-400 to-blue-500 text-white px-4 py-3 shadow-md my-3 rounded mx-2" role="alert">
            <div class="flex">
                <div>
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif
    @if (session()->has('errMessage'))
        <div class="bg-gradient-to-r from-red-400 to-yellow-500 text-white px-4 py-3 shadow-md my-3 rounded mx-2" role="alert">
            <div class="flex">
                <div>
                    <p class="text-sm">{{ session('errMessage') }}</p>
                </div>
            </div>
        </div>
    @endif
</div>