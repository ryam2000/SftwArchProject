<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Hummingbird') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="overflow-y-hidden">

    <div class="grid grid-cols-3 font-assistant">
        <div class="relative h-screen md:flex">
            <!-- Sidebar -->
            <div class="bg-gray-900 border border-0 border-r border-gray-600 text-white w-full absolute inset-y-0 left-0 md:relative transform -translate-x-full md:translate-x-0 overflow-y-auto transition ease-in-out duration-200" >
                <div class="grid grid-cols-5">
                    <div class="col-span-3"></div>
                    <div class="col-span-2">
                        <!-- Logo -->
                        <div class="flex justify-center items-center py-16 ">
                            <img class="block h-16 w-auto fill-current" src="/img/humminglogo_white.png" alt="Hummingbird">
                        </div>
                        <!-- Nav Links -->
                        <nav>
                            <x-sidebarmain_nav href="/home" class="text-lg text-white">
                                <span class="inline-flex items-baseline px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="self-center" width="16" height="16" fill="currentColor" viewBox="0 -1 16 16"> <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/> </svg>
                                </span>
                                Home
                            </x-sidebarmain_nav>

                            <x-sidebarmain_nav href="/contacts" :active="request()->routeIs('contacts')" class="text-lg text-white">
                                <span class="inline-flex items-baseline px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="self-center" width="16" height="16" fill="currentColor" viewBox="0 -2 16 16"> <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/> <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/> </svg>
                                </span>
                                Contacts
                            </x-sidebarmain_nav>

                            <x-sidebarmain_nav href="/about" :active="request()->routeIs('about')" class="text-lg text-white">
                                <span class="inline-flex items-baseline px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="self-center" width="16" height="16" fill="currentColor" viewBox="0 -2 16 16"> <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/> <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/> </svg>
                                </span>
                                About us
                            </x-sidebarmain_nav>

                            @if(Auth::check())
                                <div class="pt-2 pr-4">
                                    <x-button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="h-12 w-full" type="button">
                                        Make a post
                                    </x-button>
                                </div>
                            @endif

                            @if(Auth::check())
                                <div class="absolute bottom-7 w-[40%]">
                                    <!-- Settings Dropdown -->
                                    <div class="ml-3 relative w-auto">
                                        <x-dropdown>
                                            <x-slot name="content">
                                                <!-- Account Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Manage Account') }}
                                                </div>

                                                <x-dropdown-link href="{{ route('profile.show') }}">
                                                    {{ __('Profile') }}
                                                </x-dropdown-link>

                                                @if(Auth::user()->id == 1)
                                                    <x-dropdown-link href="/admin" :active="request()->routeIs('admin')">
                                                        {{ __('Admin Panel') }}
                                                    </x-dropdown-link>
                                                @endif

                                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                                        {{ __('API Tokens') }}
                                                    </x-dropdown-link>
                                                @endif

                                                <!-- Authentication -->
                                                <form method="POST" action="{{ route('logout') }}" x-data>
                                                    @csrf

                                                    <x-dropdown-link href="{{ route('logout') }}"
                                                                     @click.prevent="$root.submit();">
                                                        {{ __('Log Out') }}
                                                    </x-dropdown-link>
                                                </form>
                                            </x-slot>

                                            <x-slot name="trigger">
                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                    <div class="pr-4">
                                                        <x-loginbutton class="w-full block focus:bg-gray-800 transition">
                                                            <div class="flex items-center justify-between">
                                                                <div class="flex items-center justify-between">
                                                                    <img class="h-8 w-8 object-cover rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->displayname }}" />
                                                                    <div>
                                                                        <span class="items-baseline text-base px-3">{{ Auth::user()->displayname }}</span>
                                                                        <div class="px-3">
                                                                            <span class="items-baseline text-gray-500 text-xs">@</span>
                                                                            <span class="items-baseline text-gray-500 text-xs">{{ Auth::user()->name }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <span class="inline-flex items-baseline px-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="self-center" width="16" height="16" fill="currentColor" viewBox="0 -4 16 16">
                                                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/> </svg> </svg>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </x-loginbutton>
                                                    </div>
                                                @else
                                                    <span class="inline-flex">
                                                        <button type="button" class="inline-flex items-center px-2 py-2 border border-white text-sm leading-4 font-medium text-white bg-gray-900 hover:text-gray-700 hover:bg-white focus:outline-none focus:bg-gray-50 transition ease-in-out duration-150">
                                                            {{ Auth::user()->name }}

                                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                            </svg>
                                                        </button>
                                                    </span>
                                                @endif
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                </div>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <main class="col-span-2 bg-gray-900 w-full">
            <div class="grid grid-cols-9 w-full h-screen overflow-y-hidden overflow-y-scroll scrollbar-hidden-y ">
                <div class="col-span-4">
                    {{ $slot }}
                </div>
                <div class="col-span-2 w-full h-screen overflow-y-hidden fixed-top sticky-top">
                    <div class="py-2 px-2">
                        <x-input type="text" name="title" placeholder="Search" class="border-gray-900 rounded-full bg-gray-700 w-full text-sm text-white active:border-emerald-500"></x-input>
                    </div>
                    <div class="px-4 py-2 w-full h-full">
                        <div class="bg-gray-700">
                    </div>
                </div>
            </div>
        </main>
    </div>
    @auth
    @else
        <div class="absolute w-full bottom-0 bg-emerald-500 text-assistant">
            <div class="flex justify-center">
                <div class="p-3 inline-flex items-center justify-center">
                    <div class="text-white overflow-hidden">
                        <p class="text-center text-sm">If you wish to get the best of Hummingbird, please log in.</p>
                    </div>
                    <div class="pl-3">
                        <x-sidebarmain_btn href="{{route('login')}}">
                            Log in
                        </x-sidebarmain_btn>
                    </div>
                    <div class="pl-3">
                        <x-sidebarmain_btn href="{{route('register')}}">
                            Register
                        </x-sidebarmain_btn>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    </body>
</html>
