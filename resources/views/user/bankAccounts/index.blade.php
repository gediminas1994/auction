@extends('layouts.userLayout')

@section('content')
    <div class="container">
        @if($bankAccounts->first())
            @foreach($bankAccounts as $bankAccount)
                <div>{{$bankAccount}}</div>
            @endforeach
        @else
            <div class="alert alert-info">You dont have any bank accounts added</div>

            <form {{--action="{{route('admin.projects.store')}}"--}} id="demo-form2" data-parsley-validate=""
                  class="form-horizontal form-label-left" novalidate="" method="POST">
                {{csrf_field()}}

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client">Bank Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <!-- <input type="text" id="client" name="user_id" required="required"
                               class="form-control col-md-7 col-xs-12"> -->
                        <select id="client" class="form-control col-md-7 col-xs-12" name="user_id">

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project-name">Projekto
                        pavadinimas <span
                                class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="project-name" name="name" required="required"
                               class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                <div class="form-group">
                    <label for="start_date" class="col-sm-3 control-label">Pradžios data</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="fa fa-calendar-o"></span></div>
                            <input type="text" class="form-control" id="start_date" name="start_date"
                                   required="required">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="end_date" class="col-sm-3 control-label">Pabaigos data</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="fa fa-calendar-o"></span></div>
                            <input type="text" class="form-control" id="end_date" name="end_date"
                                   required="required">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Projekto
                        aprašymas
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="description" name="description" required="required" rows="4"
                                              class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a {{--href="{{route('admin.projects.index')}}"--}} class="btn btn-primary">Atgal</a>
                        <button type="submit" class="btn btn-success">Sukurti</button>
                    </div>
                </div>
            </form>

        @endif
    </div>

@endsection