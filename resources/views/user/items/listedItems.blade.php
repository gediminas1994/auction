@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.messages')

        <h1> USERIO <span style="color:blue">{{ Auth::user()->username }}</span> ITEMAI</h1>

        <div class="row">
            @foreach($items as $item)
                <div class="box-set col-md-4">
                    <div class="itemBox">
                        <div class="thumbnail">
                            <img src="/{{ $item->picture }}" style="max-height: 50px; max-width: 100px; border-radius: 10px;">
                            <h3 align="center">{{ $item->title }}</h3>
                            <h5 align="center">Starting price only {{ $item->startingBid }} !!!</h5>
                            <h5 align="center">The auction for this item ends at {{ $item->end_date }}</h5>
                            <a href="{{ route('items.show', $item) }}" class="btn btn-success">Show</a>
                            <a href="{{ route('items.edit', $item) }}" class="btn btn-primary">Edit</a>
                            <a class="btn btn-danger" onclick="destroyItem({{ json_encode(route('items.destroy', $item)) }})">Delete</a>
                            <div>
                                @foreach($item->categories as $category)
                                    <div>ASSIGNED CATEGORY: {{ $category->id }} {{ $category->title }}</div>
                                @endforeach
                            </div>
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