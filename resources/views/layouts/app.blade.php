<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Devstagram</title>
        @stack('styles')
        @vite('resources/css/app.css')
        @vite('resources/js/app.js') 

        @livewireStyles

    </head>
    <body class="antialiased bg-slate-100">
            <header class="p-5 border-b bg-white shadow">
                <div class="container mx-auto flex justify-between items-center">
                    <a href="{{route('home')}}" class="text-3xl font-black">
                        Devstagram
                    </a>

                    @auth
                        <nav class="flex gap-2 items-center">

                            <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer" href="{{route('posts.create')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>                                  
                                Post
                            </a>

                            <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('posts.index', auth()->user()->username)}}">Hi: <span class="font-normal">{{auth()->user()->username}}</span></a>
                            <form method="POST" action="{{route('logout')}}">
                                @csrf
                                <button type="submit" class="font-bold uppercase text-gray-600 text-sm border p-2 rounded gap-2 bg-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                      </svg>                                      
                                </button>
                            </form>
                        </nav>
                    @endauth

                    @guest
                        <nav class="flex gap-2 items-center">
                            <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('login')}}">Login</a>
                            <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('signup')}}">Signup</a>
                        </nav>
                    @endguest

                </div>
            </header>

            <main class="container mx-auto mt-10">
                <h2 class="font-black text-center text-3xl mb-10">
                    @yield('title')
                </h2>
                @yield('content')
            </main>

            <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
                DevCave - All rights Reserved {{now()-> year}}
            </footer>

            @livewireScripts
    </body>
</html>
