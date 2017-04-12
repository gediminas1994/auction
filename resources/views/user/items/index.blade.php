@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($items as $item)
            <div class="card" style="width: 20rem;">
                <img class="card-img-top" style="max-height: 300px" src="{{$item->picture}}" alt="Picture">
                <div class="card-block">
                    <h4 class="card-title">{{$item->title}}</h4>
                    <p class="card-text">{{$item->description}}</p>
                    <a href="{{ route('user.items.show', ['$user_id' => Auth::user(), '$item_id' => $item->id]) }}" class="btn btn-primary">Show</a>
                    <a href="#" class="btn btn-warning">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                </div>
            </div>
        @endforeach
    </div>



@endsection