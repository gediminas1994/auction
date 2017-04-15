@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partials.messages')

        <div class="row">
            <h1 class="bg-primary">A LIST OF {{ Auth::user()->username }}'s items</h1>

            @foreach($items as $item)
            <div class="col-md-4 bg-success">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" style="max-height: 300px; max-width: 500px" src="{{$item->picture}}" alt="Picture">
                    <div class="card-block img-responsive img-thumbnail">
                        <h4 class="card-title">{{$item->title}}</h4>
                        <p class="card-text">{{$item->description}}</p>
                        <a href="{{ route('user.items.show', ['$user_id' => Auth::user(), '$item_id' => $item->id]) }}" class="btn btn-primary">Show</a>
                        <a href="{{route('user.items.edit', ['$user_id' => Auth::user(), '$item_id' => $item->id])}}" class="btn btn-warning">Edit</a>
                        <td><a class="btn btn-danger" onclick="destroyItem({{json_encode(route('user.items.destroy', ['user' => Auth::user(), 'item' => $item]))}})">Delete</a></td>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


    </div>

    <script>
        function destroyItem(url) {
            $.ajax({
                url: url,
                method: 'DELETE',
                data: {
                    _token: {!! json_encode(csrf_token()) !!}
                }
            }).always(function () {
                location.reload();
            });
        }
    </script>

@endsection