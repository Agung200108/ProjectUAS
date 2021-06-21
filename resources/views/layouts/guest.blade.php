<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <style>
            .body-bg {
                background-color: #9921e8;
                background-image: linear-gradient(315deg, #9921e8 0%, #5f72be 74%);
            }
        </style>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="body-bg min-h-screen pt-5 md:pt-0 pb-6 px-2 md:px-0">
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
