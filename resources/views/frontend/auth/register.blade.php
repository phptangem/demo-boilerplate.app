@extends('frontend.layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('navs.frontend.register')}}
                </div>
                <div class="panel-body">
                   {!! Form::open(['url' => 'register', 'class'=>'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('name', trans('validation.attributes.frontend.name'), ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('name', 'name', null,['class'=>'form-control', 'placeholder'=>trans('validation.attributes.frontend.name')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', trans('validation.attributes.frontend.email'), ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('email', 'email', null,['class'=>'form-control', 'placeholder'=>trans('validation.attributes.frontend.email')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', trans('validation.attributes.frontend.password'), ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('password', 'password', null,['class'=>'form-control', 'placeholder'=>trans('validation.attributes.frontend.password')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirmation', trans('validation.attributes.frontend.password_confirmation'), ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('password', 'password_confirmation', null,['class'=>'form-control', 'placeholder'=>trans('validation.attributes.frontend.password_confirmation')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit(trans('labels.frontend.auth.register_button'),['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                   {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop