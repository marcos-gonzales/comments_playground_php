@include('../layouts/layout')

@section('content')
<div style="max-width: 600px; margin: auto;">
  @auth
  <h1 class="text-center text-warning">Write a post.</h1>
    <form action="/posts" method="POST" class="d-flex flex-column mb-5" enctype="multipart/form-data">
      @csrf
      <label for="title" class="form-label" style="font-size: 120%;">Title</label>
      <input class="form-control mb-2 @error('title') border border-danger border-2 @enderror" type="text" name="title" placeholder="name your post..">

      @error('title')
        <div>
          <p class="text-danger">Title is required.</p>
        </div>
      @enderror

      <label for="body" class="form-label" style="font-size: 120%;">Body</label>
      <input class="form-control mb-2 @error('body') border border-danger border-2 @enderror" type="body" name="body" placeholder="your post body..">

      @error('body')
        <div>
          <p class="text-danger">Body is required.</p>
        </div>
      @enderror

      <label for="file" class="form-label" style="font-size: 120%;">upload image</label>
      <input class="form-control mb-2 @error('file') border border-danger border-2 @enderror" type="file" name="file" placeholder="upload something...">

      @error('file')
        <div>
          <p class="text-danger">File must be JPG or PNG extension.</p>
        </div>
      @enderror

      <button type="submit" class="btn btn-primary" style="font-size: 120%;">Submit</button>
    </form>
    @endauth

    @guest
    <div>
      <p>Login to write a post :)</p>  
    </div>
    @endguest

  <h3 class="text-warning text-center mb-3">Posts people have wrote</h3>
  <div class="card d-flex flex-column p-3">
    @if($posts->count() && $comments->count())
      @foreach ($posts as $post)
      <div class="card p-3 post-cards">
        <p class="text-primary">{{ $post->title }}</p>
        <input type="hidden" name="post_id" value="{{ $post->post_id}}">
        <p>{{ $post->body }}</p>
        <a class="text-warning" href="/posts/{{$post->id}}">view post</a>
        <p>{{$howMany}} comments.</p>
        @guest
      <div>
        <p class="text-end">Login to leave a comment ;)</p>
      </div>
      @endguest
      @auth
      <div class="border-bottom border-primary border-1 p-2 bg-light">
        <form action="/comment" method="POST" class="bg-light">
          @csrf
          <label for="comment">Comment</label>
          <input type="hidden" name="post_id" value="{{ $post->id}}">  
          <input type="text" name="comment" placeholder="write a comment..">
          <button class="btn btn-primary" type="submit">Submit</button>
        </form>
      </div>
      @endauth
      </div>
      

      
    
    @endforeach
    
  </div>
    
  @else
  <p>No posts!!</p>
  @endif
</div>
