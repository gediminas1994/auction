@extends('layouts.app')

@section('content')

<script type="text/javascript">
    function fillFields(objClickedButton){
        var email = objClickedButton.getAttribute("data-value1");
        var password = objClickedButton.getAttribute("data-value2");
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
    }
</script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <a data-value1="admin@eauction.com" data-value2="admin" class="btn btn-success" onclick="fillFields(this)"><div>admin@eauction.com</div><div>admin</div></a>
                            <a data-value1="user1@eauction.com" data-value2="user1" class="btn btn-success" onclick="fillFields(this)"><div>user1@eauction.com</div><div>user1</div></a>
                            <a data-value1="user2@eauction.com" data-value2="user2" class="btn btn-success" onclick="fillFields(this)"><div>user2@eauction.com</div><div>user2</div></a>
                            <a data-value1="user3@eauction.com" data-value2="user3" class="btn btn-success" onclick="fillFields(this)"><div>user3@eauction.com</div><div>user3</div></a>
                            <a data-value1="user4@eauction.com" data-value2="user4" class="btn btn-success" onclick="fillFields(this)"><div>user4@eauction.com</div><div>user4</div></a>
                            <a data-value1="user5@eauction.com" data-value2="user5" class="btn btn-success" onclick="fillFields(this)"><div>user5@eauction.com</div><div>user5</div></a>
                            <a data-value1="user6@eauction.com" data-value2="user6" class="btn btn-success" onclick="fillFields(this)"><div>user6@eauction.com</div><div>user6</div></a>
                            <a data-value1="user7@eauction.com" data-value2="user7" class="btn btn-success" onclick="fillFields(this)"><div>user7@eauction.com</div><div>user7</div></a>
                            <a data-value1="user8@eauction.com" data-value2="user8" class="btn btn-success" onclick="fillFields(this)"><div>user8@eauction.com</div><div>user8</div></a>
                            <a data-value1="user9@eauction.com" data-value2="user9" class="btn btn-success" onclick="fillFields(this)"><div>user9@eauction.com</div><div>user9</div></a>
                            <a data-value1="user10@eauction.com" data-value2="user10" class="btn btn-success" onclick="fillFields(this)"><div>user10@eauction.com</div><div>user10</div></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
