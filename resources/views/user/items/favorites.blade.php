@extends('layouts.app')

@section('content')

    <div class="container">
        <div>FAVORITES</div>
        @foreach($favorites as $favorite)
            <ul>
                <li>{{ $favorite->title }}</li>
            </ul>
        @endforeach
    </div>

@endsection