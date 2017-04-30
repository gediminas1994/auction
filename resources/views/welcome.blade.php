@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="well well-sm" align="middle">
                <strong>Welcome to eAuction!</strong>
            </div>
            <div id="products" class="row list-group">
                @foreach($items as $item)
                    <div class="item  col-xs-4 col-lg-4">
                        <div class="thumbnail">
                            <img class="group list-group-image" src="{{ $item->picture }}" alt=""/>
                            <div class="caption">
                                <h4 class="group inner list-group-item-heading">
                                    {{ $item->title }}</h4>
                                <p class="group inner list-group-item-text">
                                    {{ $item->description }}
                                </p>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6" style="font-size: 23px">
                                            @if($item->type == 0)
                                                {{ $item->startingBid }}€
                                            @else
                                                {{ $item->price }}€
                                            @endif
                                        </div>

                                        <div class="col-md-6 text-right">
                                            <a href="{{ route('items.show', $item->id) }}"
                                               class="btn btn-primary btn-sm">Check it out</a>
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
        </div>
    </div>

    <script src="https://js.pusher.com/4.0/pusher.min.js"></script>
    <script>

        Pusher.log = function(msg) {
            console.log(msg);
        };

        let pusher = new Pusher('{{env("PUSHER_APP_KEY")}}', {
            cluster: 'eu',
            encrypted: true
        });

        let channel = pusher.subscribe('test-channel');
        channel.bind('test-event', function(data) {
            alert(data.message);
        });
    </script>

@endsection