@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                You have searched for {{ $keyword }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{ count($items) }} products found
            </div>
            <div class="col-md-12">
                <ul>
                    @foreach($items as $item)
                        <li>{{ $item->title }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection