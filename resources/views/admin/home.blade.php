@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <ul>
            <li><a href="{{ route('admin.users.index') }}">Visu vartotoju sarasas</a></li>
            <li><a href="{{ route('admin.items.index') }}">Visu produktu sarasas</a></li>
        </ul>
    </div>

@endsection