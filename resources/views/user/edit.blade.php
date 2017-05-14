@extends('layouts.app')

@section('content')

    <div class="row">
        @include('partials.messages')
        <div class="col-md-6 col-md-offset-3">
            <form enctype="multipart/form-data" action="{{ route('user.update', Auth::user()->id) }}" class="form-horizontal" method="POST" >
                <input type="hidden" name="_method" value="PATCH">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Name</label>
                    <input class="form-control" type="text" value="{{ (isset($user->profile->name)) ? $user->profile->name : ''  }}" id="example-text-input" name="name">
                </div>
                <div class="form-group row">
                    <label for="example-search-input" class="col-2 col-form-label">Last Name</label>
                    <input class="form-control" type="search" value="{{ (isset($user->profile->last_name)) ? $user->profile->last_name : '' }}" id="example-search-input" name="last_name">
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Phone Number</label>
                    <input class="form-control" type="text" value="{{ (isset($user->profile->phone_number) ? $user->profile->phone_number : '') }}" id="example-text-input" name="phone_number">
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">Gender</label>
                    <select class="form-control" name="gender">
                        @if(isset($user->profile->gender))
                            <option value="1" {{ ($user->profile->gender == 1) ? 'selected' : '' }}>Male</option>
                            <option value="2" {{ ($user->profile->gender == 2) ? 'selected' : '' }}>Female</option>
                        @else
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        @endif
                    </select>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">Birth Date</label>
                    <input class="form-control" type="date" value="{{ (isset($user->profile->birth_date) ? $user->profile->birth_date : '') }}" id="example-date-input" name="birth_date">
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection