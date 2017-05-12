@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <ul>
            <li><a href="{{ route('admin.users.index') }}">User list</a></li>
            <li><a href="{{ route('admin.items.index') }}">Product list</a></li>
            <li><a href="{{ route('admin.categories.index') }}">Category modification</a></li>
        </ul>
    </div>

@endsection