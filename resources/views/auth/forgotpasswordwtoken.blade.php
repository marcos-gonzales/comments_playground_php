@include('..layouts/layout')

@section('content')

<div class="container" style="max-width: 600px; margin: auto;">
  <h3 class="text-warning text-center">Reset Password</h3>
  <form action="/forgot-password/{{$token}}" method="POST" class="d-flex flex-column" style="font-size: 120%;">
    @csrf
    <label for="email" class="form-label text-warning">Email</label>
    <input type="email" name="email" class="form-control @error('email') border border-2 border-danger @enderror" value="{{ old('email') }}">

    @if(Session::has('success'))
      <div>
        <p class="text-success">{{Session::get('success')}}</p>
      </div>
    @endif

    @if(Session::has('error'))
    <div>
      <p class="text-danger">{{Session::get('error')}}</p>
    </div>
  @endif

    @error('email')
      <div>
        <p class="text-danger">{{$message}}</p>
      </div>
    @enderror

    <label for="password" class="form-label text-warning">Password</label>
    <input type="password" name="password" class="form-control @error('password') border border-2 border-danger @enderror">

    @error('password')
      <div>
        <p class="text-danger">{{$message}}</p>
      </div>
    @enderror

    <label for="password_confirmation" class="form-label text-warning">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control mb-2 @error('password_confirmation') border border-2 border-danger @enderror" required>

    @error('password_confirmation')
      <div>
        <p class="text-danger">{{$message}}</p>
      </div>
    @enderror

    <input type="hidden" name="token" value="{{$token}}">

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>