@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        <h1 class="bg-primary">ITEM SHOW, CIA BUS GALIMA BIDINT</h1>
        <div class="card" style="width: 20rem;">
            <img class="card-img-top" style="max-height: 300px" src="{{$item->picture}}" alt="Picture">
            <div class="card-block">
                <h4 class="card-title">{{$item->title}}</h4>
                <p class="card-text">{{$item->description}}</p>
                <p class="card-text">{{$item->created_at->diffForHumans() }}</p>
                <a href="#" class="btn btn-warning">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
@endsection