@extends('layouts.app')

@section('content')

    @if($item->type == 0)
        {{--AUCTION--}}
        @include('partials.auction')
    @else
        {{--REGULAR ITEM--}}
        @include('partials.regularItem')
    @endif

@endsection