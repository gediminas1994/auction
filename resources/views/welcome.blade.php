@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Welcome page</h1>

        <div class="row">
            @foreach($items as $item)
                <div class="col-xs-18 col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="{{ $item->picture }}" style="height: 300px; width: 300px; border-radius: 5px">
                        <h3 align="center">{{ $item->title }}</h3>
                        <h5 align="center">Starting price only {{ $item->startingBid }} !!!</h5>
                        <h5 align="center">The auction for this item ends at {{ \Carbon\Carbon::parse($item->expirationDate)->diffForHumans() }}</h5>
                        <p align="center"><a href="{{ route('items.show', $item->id) }}" class="btn btn-primary" role="button">Check it out</a></p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="box-set col-md-4">
                {{ $items->links() }}
            </div>
        </div>
    </div>
@endsection