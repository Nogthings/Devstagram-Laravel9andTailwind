@extends('layouts.app')

@section('title')
   Edit Profile: {{auth()->user()->username}}
@endsection

@section('content')
   <div class="md:flex md:justify-center">
      <div class="md:1/2 bg-white shadow p-6 rounded">
         <form action="{{route('profile.store')}}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
            @csrf
            <div class="mb-5">
               <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                   Username
               </label>
               <input id="username" name="username" type="text" placeholder="Username"
                   class="border p-3 w-full rounded-md 
                   @error('username')
                    border-red-500
                   @enderror"
                   value="{{ auth()->user()->username }}" />
               @error('username')
                   <p class="bg-red-500 text-white my-2 rounded-md text-sm p-2 text-center">{{ $message }}</p>
               @enderror
           </div>

           <div class="mb-5">
            <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">
                Username
            </label>
            <input id="image" name="image" type="file"
                class="border p-3 w-full rounded-md "
                value="" 
                accept=".jpg, .jpeg, .png"/>
        </div>
        <input type="submit" value="Save"
        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-md">
         </form>
      </div>
   </div>
@endsection