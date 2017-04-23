@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.messages')

        <h1>{{ Auth::user()->username }} LISTED ITEMS</h1>

        <div class="row">
            @foreach($items as $item)
                <div class="item  col-xs-4 col-lg-4">
                    <div class="thumbnail">
                        <img class="group list-group-image" src="/{{ $item->picture }}" alt="" />
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading">
                                {{ $item->title }}</h4>
                            <p class="group inner list-group-item-text">
                                {{ $item->description }}
                            </p>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <a href="{{ route('items.show', $item->id) }}" class="btn btn-success btn-sm">Show</a>
                                        <a href="{{ route('items.edit', $item) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a class="btn btn-danger btn-sm" onclick="destroyItem({{ json_encode(route('items.destroy', $item)) }})">Delete</a>
                                    </div>
                                </div>
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