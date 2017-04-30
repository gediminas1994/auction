@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <form action="{{route('items.update', $item)}}" id="item_form" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="POST">
            <input type="hidden" name="_method" value="PATCH">
            {{csrf_field()}}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client">Product Title</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="product_title" name="product_title" required="required" class="form-control col-md-7 col-xs-12" value="{{$item->title}}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_description">Product Description</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea id="product_description" name="product_description" required="required" class="form-control col-md-7 col-xs-12" rows="5">{{$item->description}}</textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>

        @include('partials.errors')
        @include('partials.messages')

    </div>

@endsection