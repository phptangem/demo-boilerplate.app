@extends('backend.layouts.master')

@section('title', trans('labels.backend.access.roles.management').' | '.trans('labels.backend.access.roles.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.roles.management') }}
        <small>{{ trans('labels.backend.access.roles.create') }}</small>
    </h1>
@endsection

@section('after-styles-end')
    {!! Html::style('css/backend/plugin/jstree/themes/default/style.min.css') !!}
@endsection

@section('content')
    {!! Form::open(['route'=>'admin.access.roles.store', 'class'=>'form-horizontal','method'=>'post', 'id'=>'create-role']) !!}
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.access.roles.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.access.includes.partials.header-buttons')
                </div>
            </div>

            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('name', trans('validation.attributes.backend.access.roles.name'),['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('name', null,['class'=>'form-control', 'placeholder'=>trans('validation.attributes.backend.access.roles.name')]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">{{ trans('validation.attributes.backend.access.roles.associated_permissions') }}</label>
                    <div class="col-lg-10">
                        {!! Form::select('associated-permissions', array('all'=>trans('labels.general.all'), 'custom'=>trans('labels.general.custom')), 'all',['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('sort', trans('validation.attributes.backend.access.roles.sort'),['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('sort', null, ['class'=>'form-control', 'placeholder'=>trans('validation.attributes.backend.access.roles.sort')]) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    <a href="{!! route('admin.access.roles.index') !!}" class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
                </div>
                <div class="pull-right">
                    <input type="submit" class="btn btn-success btn-xs" value="{{ trans('buttons.general.crud.create') }}" />
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        {!! Form::hidden('permissions') !!}
    {!! Form::close() !!}
@endsection