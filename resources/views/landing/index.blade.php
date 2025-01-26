@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <div class="card border-primary mb-3">
        <h3 class="card-header text-center">🌜Forum🌛</h3>
        @if (count($forums) < 1)
            <p class="text-success-emphasis text-center m-3">No Forum</p>
        @else
            @foreach ($forums as $forum)
                <div class="card-body">
                    <h4 class="card-title">{{$forum->title}}</h4>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection