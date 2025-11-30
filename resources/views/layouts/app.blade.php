<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MahaKarya') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="font-sans antialiased bg-black text-white">
    <div class="flex min-h-screen">

        <div class="hidden md:block w-[72px] xl:w-[245px] border-r border-[#262626] relative flex-shrink-0">
            <div class="fixed top-0 left-0 h-full w-[72px] xl:w-[245px] overflow-y-auto no-scrollbar">
                <x-sidebar />
            </div>
        </div>

        <div class="block md:hidden fixed top-0 w-full z-50 bg-black border-b border-[#262626]">
            @include('layouts.navigation')
        </div>

        <main class="flex-1 flex justify-center w-full bg-black min-h-screen">
            <div class="w-full max-w-[630px] pt-20 md:pt-8 pb-20 px-0 sm:px-4">

                @isset($header)
                <header class="bg-black border-b border-[#262626] md:hidden mb-4">
                    <div class="py-4 px-4 text-white font-bold">
                        {{ $header }}
                    </div>
                </header>
                @endisset

                {{ $slot }}
            </div>
        </main>

        <div class="hidden lg:block w-[380px] pl-10 pt-8 flex-shrink-0">
            <div class="fixed w-[320px]">
                <x-right-sidebar />
            </div>
        </div>

    </div>
</body>

</html>