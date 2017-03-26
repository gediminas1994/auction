@extends('layouts.adminLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <a class="btn btn-info" href="{{url()->previous()}}">Back</a>

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
                                <td><a class="btn btn-info" href="admin/users/{{ $user->id }}/edit">Edit</a></td>
                                <td><a class="btn btn-danger" href="admin/users/{{ $user->id }}">Delete</a></td>
                                <!-- jeigu 1, useris uzblokuotas -->
                                @if($user->status == 1)
                                    <td><a class="btn btn-success" href="">Unblock</a></td>
                                @else
                                    <td><a class="btn btn-danger" href="">Block</a></td>
                                @endif

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
