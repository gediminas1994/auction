@extends('layouts.app')

@section('content')

    <div class="container">
        @foreach($favorites as $favorite)
            <ul>
                <li>{{ $favorite->title }}</li>
            </ul>
        @endforeach
    </div>

@endsection