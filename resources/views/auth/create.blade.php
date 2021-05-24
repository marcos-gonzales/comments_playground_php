@include('../layouts/layout')
@section('content')
<div class="container">
    <h1 class="text-center text-warning">Create Account</h1>
    <form action="/create" method="POST" class="d-flex flex-column" style="max-width: 600px; margin: auto;">
      @csrf
      <label for="login" class="form-label text-warning" style="font-size: 120%;">Full name</label>
      <input class="form-control mb-2 @error('name') border border-danger border-2 @enderror" type="text" name="name" placeholder="your name.." value="{{old('name')}}">

      @error('name')
      <div>
        <p class="text-danger">{{$message}}</p>
      </div>
      @enderror

      <label for="email" class="form-label text-warning" style="font-size: 120%;">Email</label>
      <input class="form-control mb-2 @error('email') border border-danger border-2 @enderror" type="email" name="email" placeholder="your email.." value="{{old('email')}}">

      @error('email')
      <div>
        <p class="text-danger">{{$message}}</p>
      </div>
      @enderror

      <label for="password" class="form-label text-warning" style="font-size: 120%;">Password</label>
      <input class="form-control mb-2 @error('password') border border-danger border-2 @enderror" type="password" name="password" placeholder="choose a password">

      @error('password')
      <div>
        <p class="text-danger">{{$message}}</p>
      </div>
      @enderror

      <button class="btn btn-primary" type="submit" style="font-size: 120%;">Submit</button>
    </form>
  </div>
