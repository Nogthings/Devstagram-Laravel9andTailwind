@extends('layouts.app')

@section('title')
   Profile: {{$user->username}}
@endsection

@section('content')
   <div class="flex justify-center">
      <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
         <div class="sm:w-8/12 lg:w-6/12 px-5">
            <img src="{{$user->image ? asset('profiles').'/'.$user->image : asset('img/usuario.svg')}}" alt="user_picture" class="rounded-full">
         </div>
         <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">

            <div class="flex items-center gap-2">
               <p class="text-gray-700 text-2xl">{{ $user -> username }}</p>

               @auth
                  @if($user->id === auth()->user()->id)
                     <a href="{{route('profile.index')}}" class="flex items-center gap-1 border p-1 border-gray-600 rounded text-xs font-bold cursor-pointer text-gray-500 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                         </svg>
                         Edit                    
                     </a>
                  @endif
               @endauth
            </div>

            <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
               {{$user->followers->count()}}
               <span class="font-normal">@choice('Follower|Followers', $user->followers->count())</span>
            </p>

            <p class="text-gray-800 text-sm mb-3 font-bold">
               {{$user->following->count()}}
               <span class="font-normal">Following</span>
            </p>

            <p class="text-gray-800 text-sm mb-3 font-bold">
               {{$user->posts->count()}}
               <span class="font-normal">Posts</span>
            </p>

            @auth
            @if($user->id !== auth()->user()->id)

            @if ($user->checkFollow(auth()->user()))
            <form action="{{route('users.unfollow', $user)}}" method="POST">
               @method('DELETE')
               @csrf
               <input type="submit" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-sm font-bold cursor-pointer" value="unfollow">

            </form>

            @else
            <form action="{{route('users.follow', $user)}}" method="POST">
               @csrf
               <input type="submit" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-sm font-bold cursor-pointer" value="follow">

            </form>

            @endif
            @endif

            @endauth
         </div>
      </div>
   </div>

   <section class="container mx-auto mt-10">
      <h2 class="text-4xl text-center font-black my-10">Posts</h2>

      <x-post-list :posts="$posts"/>

   </section>
@endsection