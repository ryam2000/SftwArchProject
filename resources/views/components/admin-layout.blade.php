<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Hummingbird') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=akshar:300,400,500,600,700" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="overflow-y-hidden font-sans antialiased font-assistant">
        <!-- Custom header -->
        <div class="font-semibold bg-black py-2 text-base text-white leading-tight">
            <div class="flex justify-between px-2">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <img class="block h-10 w-auto fill-current" src="/img/humminglogo_white.png" alt="Hummingbird">
                    <span class="px-2 font-bold text-lg">
                            Administration
                        </span>
                </div>
                <span>
                @if (Auth::check())
                        <div class="py-3">
                        <p class="text-xs font-normal text-center">Logged in as {{ Auth::user()->name }}</p>
                    </div>
                    @endif
            </span>
            </div>
        </div>

        <div class="grid grid-cols-6">
            <div class="relative h-screen md:flex">
                <!-- Sidebar -->
                <div class="bg-gradient-to-t from-gray-900 to-black text-white w-full px-2 absolute inset-y-0 left-0 md:relative transform -translate-x-full md:translate-x-0 overflow-y-auto transition ease-in-out duration-200 shadow-lg" >
                    <!-- Nav Links -->
                    <nav>
                        <x-nav-link-admin href="/home" :active="request()->routeIs('home')">
                        <span class="inline-flex items-baseline px-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="self-center" width="14" height="14" fill="currentColor" viewBox="0 -2 16 16"> <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/> <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/> </svg>
                        </span>
                            Return to the homepage
                        </x-nav-link-admin>
                        <x-nav-link-admin href="/admin" :active="request()->routeIs('admin')">
                        <span class="inline-flex items-baseline px-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="self-center" width="16" height="16" fill="currentColor" viewBox="0 -2 16 16"> <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/> <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/> </svg>
                        </span>
                            Dashboard
                        </x-nav-link-admin>
                        <x-nav-link-admin href="/admin/users" :active="request()->routeIs('users')">
                        <span class="inline-flex items-baseline px-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="self-center" width="16" height="16" fill="currentColor" viewBox="0 -2 16 16"> <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/> </svg>
                        </span>
                            Users
                        </x-nav-link-admin>
                        <x-nav-link-admin href="/admin/roles" :active="request()->routeIs('roles')">
                        <span class="inline-flex items-baseline px-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="self-center" width="14" height="14" fill="currentColor" viewBox="0 -0.5 16 16"> <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z"/> </svg>
                        </span>
                            Roles
                        </x-nav-link-admin>
                        <x-nav-link-admin href="/admin/posts" :active="request()->routeIs('posts')">
                        <span class="inline-flex items-baseline px-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="self-center" width="14" height="14" fill="currentColor" viewBox="0 -1 16 16"> <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/> </svg>
                        </span>
                            Posts
                        </x-nav-link-admin>
                        <x-nav-link-admin href="/admin/comments" :active="request()->routeIs('comments')">
                        <span class="inline-flex items-baseline px-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="self-center" width="14" height="14" fill="currentColor" viewBox="0 -2 16 16"> <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/> <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg>
                        </span>
                            Comments
                        </x-nav-link-admin>
                    </nav>
                </div>
            </div>

            <!-- Main content -->
            <main class="col-span-5">
                <div class="w-full h-[calc(100vh-3.5rem)] overflow-y-hidden overflow-y-scroll">
                    {{ $slot }}
                </div>
            </main>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    </body>
</html>
