<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Perpustakaan</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/x-icon">
    @include('includes.home.style')
    @livewireStyles
</head>

<body class="gradient leading-relaxed tracking-wide flex flex-col">

    <!--Navigation-->
    <nav id="header" class="w-full z-30 top-0 text-white py-1">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-2 lg:py-4">
            <div class="pl-4 flex items-center">
                <a href="{{url('/')}}" class="no-underline hover:no-underline font-bold text-2xl lg:text-2xl flex items-center bg" href="#">
                    <img src="{{asset('logo.png')}}" alt="" width="50" style="margin-top: -10px;">
                    Books
                </a>
            </div>

            <!-- responsive hamburger -->
            <div class="block lg:hidden pr-4">
                <button id="nav-toggle"
                    class="flex items-center bg-white px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-800 hover:border-green-500 appearance-none focus:outline-none">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>


            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 text-black p-4 lg:p-0 z-20"
                id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                </ul>
                @guest                    
                    <a href="{{url('/login')}}" id="navAction"
                        class="mx-auto lg:mx-1 text-gray-80 bg-white text-blue-500 rounded mt-4 lg:mt-0 py-2 px-6 outline-none shadow">
                        Login
                    </a>
                    &nbsp;
                    <a href="{{url('/register')}}" id="navAction"
                        class="mx-auto lg:mx-1 text-gray-80 bg-white text-blue-500 rounded mt-4 lg:mt-0 py-2 px-6 outline-none shadow">
                        Register
                    </a>
                @endguest
                @auth
                    <div class="flex">
                        @livewire('components.cart-modal-button')
                        <a href="{{url('/dashboard')}}" id="navAction"
                            class="mx-auto lg:mx-1 text-gray-80 bg-white text-blue-500 opacity-95 rounded mt-4 lg:mt-0 py-2 px-6 outline-none shadow font-black text-gray-700">
                            Dashboard
                        </a>
                    </div>
                @endauth

            </div>
        </div>
    </nav>

    <!-- header -->
    <div class="container mx-auto h-48 lg:h-96">
        <div class="text-center px-3 lg:px-0 mt-20">
            <h1 class="my-4 text-2xl md:text-3xl lg:text-5xl font-black leading-tight text-gray-100">
                Perpustakaan
            </h1>
        </div>
    </div>

    {{-- main content --}}
        @yield('content')

    <!--Footer-->
    <footer class="bg-white">
        <div class="container mx-auto mt-8 px-8">
            <div class="w-full flex flex-col md:flex-row py-6">
                <div class="flex-1 mb-6">
                    <a class="text-orange-600 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
                        <img src="{{asset('logo.png')}}" width="100" alt="">
                        Books
                    </a>
                </div>

                <div class="flex-1">
                    <p class="uppercase font-extrabold text-gray-500 md:mb-6">Legal</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="{{url('terms-of-service')}}"
                                class="font-light no-underline hover:underline text-gray-800 hover:text-orange-500">Terms</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="{{url('privacy-policy')}}"
                                class="font-light no-underline hover:underline text-gray-800 hover:text-orange-500">Privacy</a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="text-center text-gray-500 my-10">&copy;copyright website perpustakaan books 2021</p>
        </div>
    </footer>

    @include('includes.home.script')
    @livewireScripts
</body>

</html>
