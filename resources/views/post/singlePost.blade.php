@include('../layouts/layout')
@section('content')
  <div class="container d-flex flex-column bg-light" style="max-width: 600px; margin: auto;">
    @guest
      <div>
        <p>Login to leave a comment :)</p>
      </div>
    @endguest
    
    <h3 class="text-center text-warning">{{$currentPost->title}}</h3>
    
    <p><span class="text-warning">{{$post_owner->name}}</span> {{$currentPost->body}}</p>

  @foreach ($comments as $comment)
  <div class="card p-2">
    <p><span class="text-primary">{{$comment->name}}</span> {{$comment->comment}}</p>
  </div>
  @endforeach

  @auth
  <form action="/comment" method="post">
    @csrf
    <label for="comment">Leave a comment</label>
    <input type="text" name="comment" placeholder="write a comment..">
    <input type="hidden" name="post_id" value="{{ $comment_id}}">
    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
  </form>
  @endauth
</div>
