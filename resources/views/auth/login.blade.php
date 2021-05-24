@include('../layouts/layout')
@section('content')
<div class="container">
    <h1 class="text-warning text-center">Login</h1>
    <form action="/login" method="POST" class="d-flex flex-column" style="margin: auto; max-width: 600px;">
      @csrf
      <label for="email" class="form-label text-warning" style="font-size: 120%;">Email</label>
      <input type="email" name="email" placeholder="Enter your email.." class="form-control mb-2 @error('email') border border-danger border-2 @enderror" value="{{ old('email')}}">

      @error('email')
      <div>
        <p class="text-danger">{{$message}}</p>
      </div>
      @enderror

      <label for="password" class="text-warning form-label" style="font-size: 120%;">Password</label>
      <input type="password" name="password" placeholder="Enter your password.." class="form-control mb-2 @error('password') border border-danger border-2 @enderror">

      @error('password')
      <div>
        <p class="text-danger">{{$message}}</p>
      </div>
      @enderror

      <a class="text-end mb-2 text-decoration-none" href="/forgot-password">Forgot password?</a>

      <button type="submit" class="btn btn-primary" style="font-size: 120%;">Submit</button>
    </form>
  </div>

  