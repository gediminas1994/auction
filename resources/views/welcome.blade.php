@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="well well-sm" align="middle">
            <strong>Welcome to eAuction!</strong>
        </div>
        <div id="products" class="row list-group">
            @foreach($items as $item)
                <div class="item  col-xs-4 col-lg-4">
                    <div class="thumbnail">
                        <img class="group list-group-image" src="{{--http://placehold.it/400x250/000/fff--}}{{ $item->picture }}" alt="" />
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading">
                                {{ $item->title }}</h4>
                            <p class="group inner list-group-item-text">
                                Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <p class="lead">
                                        {{ $item->startingBid }}€</p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-primary" role="button">Check it out</a>
                                </div>
                            </div>
                        </div>
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