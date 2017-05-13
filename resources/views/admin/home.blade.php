@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-lg"><i class="fa fa-users" aria-hidden="true"></i> User list</a>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-1">
                <a href="{{ route('admin.items.index') }}" class="btn btn-info btn-lg"><i class="fa fa-diamond" aria-hidden="true"></i> Product list</a>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-1">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-success btn-lg"><i class="fa fa-cogs" aria-hidden="true"></i> Category modification</a>
            </div>
        </div>
    </div>

@endsection