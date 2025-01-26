<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Layout chính' }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container">
      <a class="navbar-brand" href="{{ route('index') }}">Forum</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#">Home
              <span class="visually-hidden">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
        </ul>
        <div class="d-flex">
        <ul class="navbar-nav">
            @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.dashboard', ['info' => Auth::user()->id]) }}">
                        Hello, {{ Auth::user()->username }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('landing.signin') }}" class="nav-link {{ Route::currentRouteName() == 'landing.signin' ? 'text-white' : '' }}">
                        Login
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('landing.signup') }}" class="nav-link {{ Route::currentRouteName() == 'landing.signup' ? 'text-white' : '' }}">
                        Register
                    </a>
                </li>
            @endif
        </ul>
        </div>
      </div>
    </div>
  </nav>