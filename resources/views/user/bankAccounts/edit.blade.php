@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('user.bankAccounts.update', ['user' => Auth::user(), 'bankRecord' => $bankRecord])}}" id="bank_form" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="POST">
            <input type="hidden" name="_method" value="PATCH">
            {{csrf_field()}}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client">Bank Name</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="bank_name" name="bank_name" required="required" class="form-control col-md-7 col-xs-12" value="{{$bankRecord->bank_name}}" disabled>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project-name">Bank Account</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="bank_account" name="bank_account" required="required" class="form-control col-md-7 col-xs-12" value="{{$bankRecord->bank_account}}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a href="{{ route('user.bankAccounts', Auth::user()) }}" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>

        @include('partials.errors')
        @include('partials.messages')

    </div>

@endsection