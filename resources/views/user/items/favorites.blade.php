@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        @if(count($favorites))
            @foreach($favorites as $favorite)
                <div class="item  col-xs-4 col-lg-4">
                    <div class="thumbnail">
                        <img class="group list-group-image" src="/{{ $favorite->picture }}" alt=""/>
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading">
                                {{ $favorite->title }}</h4>
                            <p class="group inner list-group-item-text">
                                {{ $favorite->description }}
                            </p>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6" style="font-size: 23px">
                                        @if($favorite->type == 0)
                                            {{ $favorite->startingBid }}€
                                        @else
                                            {{ $favorite->price }}€
                                        @endif
                                    </div>

                                    <div class="col-md-6 text-right">
                                        <a href="{{ route('items.show', $favorite->id) }}"
                                           class="btn btn-primary btn-sm">Check it out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-md-12" style="font-size: 30px">
                    You don't have any products added to favorites!
                </div>
            </div>
        @endif
    </div>

@endsection