@extends('layouts.adminLayout')

@section('content')

    <div class="container">
        <ul>
            <li><a href="{{ route('admin.users.index') }}">Visu vartotoju sarasas</a></li>
        </ul>
    </div>

@endsection