@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <a class="btn btn-info" href="{{ url('/home') }}">Back</a>
                <hr>

                <div class="panel panel-default">

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Item Title</th>
                            <th>Picture</th>
                            <th>Show</th>
                            <th>Delete</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td><img style="max-width: 100px; max-height: 80px" src="/{{ $item->picture }}"></td>
                                <td><a href="{{ route('items.show', $item->id) }}" class="btn btn-primary">Show</a></td>
                                <td><a class="btn btn-danger" onclick="destroyItem({{ json_encode(route('items.destroy', $item)) }})">Delete</a></td>
                                @if($item->blocked)
                                    <td><a class="btn btn-success" onclick="block_unblockItem({{json_encode(route('admin.items.block_unblock', $item))}})">Unblock</a></td>
                                @else
                                    <td><a class="btn btn-danger" onclick="block_unblockItem({{json_encode(route('admin.items.block_unblock', $item))}})">Block</a></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{ $items->links() }}
            </div>
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

        function block_unblockItem(url) {
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