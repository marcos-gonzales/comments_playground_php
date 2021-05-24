<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ url('css/app.css')}}">
  <title>Blog Post with User Comments.</title>
</head>
<body>
  <nav>
    <ul class="d-flex flex-row-reverse p-3 bg-primary list-unstyled" style="font-size: 125%;">
      @guest
      <li class="ps-3">
        <a class="text-white text-decoration-none" href="/create">Register</a>
      </li>
      <li class="ps-3">
        <a class="text-white text-decoration-none" href="/login">Login</a>
      </li>
      
      @endguest
      @auth
      <li class="ps-3">
        <form action="/logout" method="POST">
          @csrf
          <button type="submit" style="border: none; background-color: #0d6efd; color: white">Logout</button>
        </form>
      </li>
      <li class="ps-3">
        <a class="text-white text-decoration-none" href="/posts">Posts</a>
      </li>
      <li class="ps-3">
        <a href="/posts" class="text-white text-decoration-none">{{ auth()->user()->name}}</a>
      </li>
      @endauth
    </ul>
  </nav>
  @yield('content')
</body>
</html>