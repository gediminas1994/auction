@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="font-size: 30px">
                @if(isset($keyword))
                    You have searched for <span style="color: blue;">{{ $keyword }}</span>
                @else
                    You have searched for <span style="color: red;">{{ $category_title }}</span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="font-size: 30px">
                {{ count($items) }} products found
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul>
                    @foreach($items as $item)
                        <div class="item col-xs-4 col-lg-4">
                            <div class="thumbnail">
                                <img class="group list-group-image" src="/{{ $item->picture }}" alt="" />
                                <div class="caption">
                                    <h4 class="group inner list-group-item-heading">
                                        {{ $item->title }}</h4>
                                    <p class="group inner list-group-item-text">
                                        {{ $item->description }}
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
                </ul>
            </div>
        </div>
    </div>
@endsection