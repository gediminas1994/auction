@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if(is_null($items->first()))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger" style="text-align: center">There are no products in the system</div>
                </div>
            </div>
        @else
            <div class="well well-sm" align="middle">
                @if($items->first()->type == 0)
                    <strong>Auctions</strong>
                @else
                    <strong>Regular Products</strong>
                @endif
            </div>
            <div id="products" class="row list-group">
                @foreach($items as $item)
                    <div class="item  col-xs-4 col-lg-4">
                        <div class="thumbnail">
                            <img class="group list-group-image" src="{{ $item->picture }}" alt="" />
                            <div class="caption">
                                <h4 class="group inner list-group-item-heading">
                                    {{ $item->title }}</h4>
                                <p class="group inner list-group-item-text">
                                    {{ $item->description }}
                                </p>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6" style="font-size: 21px">
                                            @if($item->type == 0)
                                                {{ $item->startingBid }}€
                                            @else
                                                {{ $item->price }}€
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <a href="{{ route('items.show', $item->id) }}" class="btn btn-primary btn-sm">Check it out</a>
                                        </div>
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
        @endif
    </div>
@endsection