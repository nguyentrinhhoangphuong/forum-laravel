@extends('layouts.index')

@section('content')
<div class="container">
    <form onsubmit="event.preventDefault()" method="post" id="signupForm">
        @csrf
        <h3 class="mt-3">{{ $title }}</h3>
        <div>
            <label class="form-label mt-4">User name</label>
            <input type="text" class="form-control" name="username" placeholder="Enter username">
            <small class="text-danger" id="usernameError"></small>
        </div>
        <div>
            <label class="form-label mt-4">Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email">
            <small class="text-danger" id="emailError"></small>
        </div>
        <div>
            <label class="form-label mt-4">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
            <small class="text-danger" id="passwordError"></small>
        </div>
        <div>
            <label class="form-label mt-4">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" autocomplete="off">
            <small class="text-danger" id="confirmPasswordError"></small>
        </div>
        <div class="mt-3">
            <div class="mb-2"><a href="{{ route('landing.signin') }}">Already a Member ?</a></div>
            <button type="submit" class="btn btn-primary" id="signupButton">Submit</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/landing.js') }}"></script>
@endsection