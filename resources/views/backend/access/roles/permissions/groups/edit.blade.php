@extends('backend.layouts.master')

@section('title', trans('labels.backend.access.permissions.management').' | '. trans('labels.backend.access.permissions.groups.edit'))

@section('page-header')
    <h1>{{ trans('labels.backend.access.permissions.management') }}
        <small>{{ trans('labels.backend.access.permissions.groups.edit') }}</small>
    </h1>
@endsection

@section('content')
    {!! Form::model($group,['route'=>['admin.access.roles.permission-group.update',$group->id],'class'=>'form-horizontal','method'=>'PATCH','role'=>'form']) !!}
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.permissions.groups.edit') }}</h3>
            <div class="box-tools pull-right">
                @include('backend.access.includes.partials.header-buttons')
            </div>
        </div>
        <div class="box-body">
            {!! Form::label('name', trans('validation.attributes.backend.access.permissions.groups.name'),['class'=>'control-label col-lg-2']) !!}
            <div class="col-lg-10">
                {!! Form::text('name', null,['class'=>'form-control','placeholder' => trans('validation.attributes.backend.access.permissions.groups.name')]) !!}
            </div>
        </div>
    </div>

    <div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                <a href="{!! route('admin.access.roles.permissions.index') !!}" class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
            </div>
            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-xs" value="{{ trans('buttons.general.crud.update') }}" />
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection