@extends('layouts.app')

@section('content')
    <div class="container bg-info">

        <div class="row">
            <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
            <a onclick="addToFavorites({{ json_encode(route('items.addToFavorites', $item->id)) }})" class="btn-success col-lg-1 pull-right">
                <i class="fa fa-star" aria-hidden="true"></i>Favorite
            </a>
        </div>

        <div class="row">

            <div class="col-lg-6 bg-primary">
                <h1>{{ $item->title }}</h1>
                <img src="{{ $item->picture }}" style="max-height: 500px; max-width: 400px; border-radius: 3px">
            </div>

            <div class="col-lg-6 bg-success">
                <h3>Description</h3>
                <div>{{ $item->description }}</div>

                <h3>The auction ends in</h3>
                <div>
                    {{ \Carbon\Carbon::parse($item->expirationDate)->diffForHumans() }}
                </div>

                <h3>Items left</h3>
                <div>{{ $item->quantity }}</div>

                <h3>Starting Bid</h3>
                <div>{{ $item->startingBid }}</div>

                <h3>Your Bid:</h3>
                <div>
                    <input class="form-control" type="number" step="0.01" placeholder="0.00">
                </div>
                <div>
                    <button class="btn btn-primary col-lg-12">Place a bid</button>
                </div>
            </div>

            <div class="col-lg-12 bg-danger">
                <h1>Time left</h1>
                <h1>15 hours 23 minutes 11 seconds</h1>
            </div>

            <div class="col-lg-12 bg-warning">
                <h1>Komentarai</h1>
                <div>Nekazka</div>
                <div><small>Posted by Pink Floyd at 2017-04-17 9:42:11</small></div>
                <br>
                <div>Uz Lietuva vyrai</div>
                <div><small>Posted by NoScoper420 at 2017-04-17 9:42:11</small></div>
                <br>
                <div>Paimu uz 0.01</div>
                <div><small>Posted by League Of Autism at 2017-04-17 9:42:11</small></div>
                <br>
                <button>1</button>
                <button>2</button>
                <button>3</button>
                <button>4</button>
                <button>5</button>
                <button>6</button>

                <h3>Rasykite komentara:</h3>
                <input class="form-control" type="text">
                <button class="btn btn-success">Komentuoti</button>
            </div>
        </div>

    </div>


    <script>
        function addToFavorites(url) {
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: {!! json_encode(csrf_token()) !!}
                }
            }).always(function () {
                location.reload();
            });
        }
    </script>
@endsection