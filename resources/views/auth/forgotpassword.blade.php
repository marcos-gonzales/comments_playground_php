@include('../layouts/layout')
@section('content')
<div class="container" style="max-width: 600px; margin: auto;">
  <h3 class="text-center text-warning">Forgot Password? :(</h3>
  <p class="text-center">Fill out the form below, if you have an account with us we'll send you an email.</p>
  <p class="text-start fst-italic">You may have to check your spam :/</p>
  
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

  <form action="/forgot-password" method="POST" class="d-flex flex-column" style="font-size: 120%;">
    @csrf
    <label for="email" class="form-label text-warning">Email</label>
    <input type="email" name="email" placeholder="youremail@email.com" class="form-control mb-2 @error('email') border border-2 border-danger @enderror">

    @error('email')
      <div>
        <p class="text-danger">{{$message}}</p>
      </div>
    @enderror

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
