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
                            <th>Username</th>
                            <th>Show</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td><a class="btn btn-primary" href='{{ route('admin.users.show', $user->id)  }}'>Show</a></td>
                                <td><a class="btn btn-info" href="{{ route('admin.users.edit', $user->id)  }}">Edit</a></td>
                                <td><a class="btn btn-danger" onclick="destroyUser({{json_encode(route('admin.users.destroy', $user->id))}})">Delete</a></td>
                                @if($user->blocked)
                                    <td><a class="btn btn-success" onclick="block_unblockUser({{json_encode(route('admin.users.block_unblock', $user))}})">Unblock</a></td>
                                @else
                                    <td><a class="btn btn-danger" onclick="block_unblockUser({{json_encode(route('admin.users.block_unblock', $user))}})">Block</a></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        function destroyUser(url) {
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

        function block_unblockUser(url) {
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
