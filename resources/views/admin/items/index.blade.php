@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <a class="btn btn-info" href="{{ url('/home') }}">Back</a>

                <div class="panel panel-default">

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Item Title</th>
                            <th>Picture</th>
                            <th>Show</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td><img style="max-width: 100px; max-height: 80px" src="/{{ $item->picture }}"></td>
                                <td>Show</td>
                                <td>Edit</td>
                                <td>Delete</td>
                                <td>BLOCKED/UNBLOCKED</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection