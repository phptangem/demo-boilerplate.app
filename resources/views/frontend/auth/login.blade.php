@extends('frontend.layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('labels.frontend.auth.login_box_title')}}
                </div>

                <div class="panel-body">
                    {!! Form::open(['url'=>'login', 'class'=>'form-horizontal']) !!}

                        <div class="form-group">

                            {!! Form::label('email', trans('validation.attributes.frontend.email') , ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('email', 'email', null, ['class'=>'form-control', 'placeholder'=>trans('validation.attributes.frontend.email')]) !!}
                            </div>
                        </div>

                        <div class="form-group">

                            {!! Form::label('password', trans('validation.attributes.frontend.password'), ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('password', 'password', null, ['class'=>'form-control', 'placeholder'=>trans('validation.attributes.frontend.password')]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label for="">
                                        {!! Form::checkbox('remember') !!}{{trans('labels.frontend.auth.remember_me')}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit(trans('labels.frontend.auth.login_button'),['class'=>'btn btn-primary','style'=>'margin-right:15px']) !!}

                                {!! link_to('password/reset', trans('labels.frontend.passwords.forgot_password')) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div><!-- panel body -->
            </div>
        </div>
    </div>
@stop