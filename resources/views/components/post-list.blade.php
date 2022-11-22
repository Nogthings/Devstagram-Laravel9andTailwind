<div>
    @if ($posts->count())
   <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      @foreach ($posts as $post )
         <div>
            <a href="{{route('post.show', ['post' => $post, 'user' => $post->user])}}">
               <img src="{{asset('uploads') . '/' . $post->image}}" alt="img-post{{$post->title}}">
            </a>
         </div>
      @endforeach
   </div>

   <div class="my-10">
      {{$posts->links()}}
   </div>
   @else
      <p class="text-center">No posts yet, follow users.</p>
   @endif
</div>