@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group row" style="font-size: 20px">
                <span><strong>Name</strong></span> {{ (isset($user->profile->name)) ? $user->profile->name : ''  }}
            </div>
            <div class="form-group row" style="font-size: 20px">
                <span><strong>Last Name</strong></span> {{ (isset($user->profile->last_name)) ? $user->profile->last_name : '' }}
            </div>
            <div class="form-group row" style="font-size: 20px">
                <span><strong>Phone Number</strong></span> {{ (isset($user->profile->phone_number) ? $user->profile->phone_number : '') }}
            </div>
            <div class="form-group row" style="font-size: 20px">
                <span><strong>Gender</strong></span>
                @if(isset($user->profile->gender))
                    {{ ($user->profile->gender == 1) ? 'Male' : 'Female' }}
                @endif
            </div>
            <div class="form-group row" style="font-size: 20px">
                <span><strong>Birth date</strong></span> {{ (isset($user->profile->birth_date) ? $user->profile->birth_date : '') }}
            </div>
        </div>
    </div>

@endsection

