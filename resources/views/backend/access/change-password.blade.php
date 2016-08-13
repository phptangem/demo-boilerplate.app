@extends('backend.layouts.master')

@section('title', trans('labels.backend.access.users.management').' | '. trans('labels.backend.access.users.change_password'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.change_password') }}</small>
    </h1>
@endsection

@section('content')
    {!! Form::open(['route'=>['admin.access.user.change-password',$user->id], 'class'=>'form-horizontal', 'role'=>'form', 'method'=>'post']) !!}
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">{{ trans('labels.backend.access.users.change_password_for', ['user'=>$user->name]) }}</h3>
            <div class="box-tools with-border">
                @include('backend.access.includes.partials.header-buttons')
            </div>
        </div>

        <div class="box-body">
            <div class="form-group">
                {!! Form::label('password', trans('validation.attributes.backend.access.users.password'), ['class'=>'col-lg-2 control-label' ]) !!}
                <div class="col-lg-10">
                    {{ Form::text('password', null,['class'=>'form-control']) }}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', trans('validation.attributes.backend.access.users.password_confirmation'), ['class'=>'col-lg-2 control-label' ]) !!}
                <div class="col-lg-10">
                    {{ Form::text('password_confirmation', null,['class'=>'form-control']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{route('admin.access.users.index')}}" class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>

            </div>
            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-xs" value="{{ trans('buttons.general.crud.update') }}" />
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
