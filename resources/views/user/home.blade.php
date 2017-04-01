@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(Auth::user()->blocked)
                <div class="alert alert-danger">
                    <strong>You have been blocked, so you can't add items!</strong>
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Welcome User!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
