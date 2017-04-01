@extends('layouts.app')

@section('content')

       <div class="container">
            <div class="row">
                <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >


                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ $user->username }} <span style="float: right;" class=" text-info">{{ $user->created_at }}</span></h3>

                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src='{{$user->avatar}}' class="img-circle img-responsive"> </div>
                                <div class=" col-md-9 col-lg-9 ">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{ isset($user->profile->name) ? $user->profile->name : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Last Name</td>
                                            <td>{{isset($user->profile->last_name) ? $user->profile->last_name : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Date of Birth</td>
                                            <td>{{ isset($user->profile->birth_date) ? $user->profile->birth_date : ''}}</td>
                                        </tr>

                                        <tr>
                                        <tr>
                                            <td>Gender</td>
                                            @if(isset($user->profile->gender))
                                                @if($user->profile->gender == 0)
                                                    <td>Male</td>
                                                @else
                                                    <td>Female</td>
                                                @endif
                                            @else
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ isset($user->email) ? $user->email : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone Number</td>
                                            <td>{{ isset($user->profile->phone_number) ? $user->profile->phone_number : ''}}</td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ url()->previous() }}" data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-primary">Back</a>
                            <span class="pull-right">
                                <a href="#" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-warning">Edit</a>
                                <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-danger">Delete</a>
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

@endsection

