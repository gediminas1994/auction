@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div>FAVORITES</div>
        @foreach($favorites as $favorite)
            <ul>
                <li><a href="{{ route('items.show', $favorite->id) }}">{{ $favorite->title }}</a></li>
            </ul>
        @endforeach
    </div>

@endsection