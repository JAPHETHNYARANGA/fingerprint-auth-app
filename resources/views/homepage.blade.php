@extends('index')

@section('title', 'Home Page')

@section('content')
   
<nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">Navbar</a>
    <form class="form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
     
    </form>
  </nav>

  <section class="vh-100" style="background-color: #eee;">
    <div class="container-fluid h-100">
        <p class="main-text">Welcome</p>
        <h3 class="fetched-data">{{ $name }}</h3> 
        <p class="main-text">of email</p>
        <p class="fetched-data">{{ $email }}</p>
    </div>
  </section>


@endsection
