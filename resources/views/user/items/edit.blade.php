@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            <h1 class="bg-primary">EDIT {{ $item->title }}</h1>
            {{$item}}
        </div>

    </div>

@endsection