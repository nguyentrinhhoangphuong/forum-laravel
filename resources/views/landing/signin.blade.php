@extends('layouts.index')

@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-warning">
        {{ session('message') }}
    </div>
    @endif

    <form onsubmit="event.preventDefault()" method="post" id="signinForm">
        @csrf
        <h3 class="mt-3">{{$title}}</h3>
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
        <div class="mt-3">
            <div class="mb-2"><a href="{{route('landing.signup')}}">Not yet a Member ?</a></div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/landing.js') }}"></script>
@endsection