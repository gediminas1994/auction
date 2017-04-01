@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partials.messages')

        @if($bankAccounts->first())
            <table class="table table-hover">
                <tr>
                    <th>Bank Name</th>
                    <th>Bank Account Number</th>
                    <th>Edit Record</th>
                    <th>Delete Record</th>
                </tr>
                @foreach($bankAccounts as $bankAccount)
                    <tr>
                        <td>{{$bankAccount->bank_name}}</td>
                        <td>{{$bankAccount->bank_account}}</td>
                        <td><a href="{{route('user.bankAccounts.edit', ['user' => Auth::user(), 'bankRecord' => $bankAccount])}}" class="btn btn-info btn-sm">Edit</a></td>
                        <td><a class="btn btn-danger btn-sm" onclick="destroyBankAccount({{json_encode(route('user.bankAccounts.destroy', ['user' => Auth::user(), 'bankRecord' => $bankAccount]))}})">Delete</a></td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="alert alert-info">You dont have any bank accounts added</div>
        @endif

            <form action="{{route('user.bankAccounts.store', Auth::user())}}" id="bank_form" data-parsley-validate=""
                  class="form-horizontal form-label-left" novalidate="" method="POST">
                {{csrf_field()}}

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client">Bank Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="bank_name" class="form-control col-md-7 col-xs-12" name="bank_name">
                            <option>Seb</option>
                            <option>Swedbank</option>
                            <option>Paysera</option>
                            <option>Paypal</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project-name">Bank Account</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="bank_account" name="bank_account" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{{url('/')}}" class="btn btn-primary">Back</a>
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </div>
            </form>

        @include('partials.errors')

    </div>

<script>
    function destroyBankAccount(url) {
        $.ajax({
            url: url,
            method: 'DELETE',
            data: {
                _token: {!! json_encode(csrf_token()) !!}
            }
        }).always(function () {
            location.reload();
        });
    }
</script>

@endsection