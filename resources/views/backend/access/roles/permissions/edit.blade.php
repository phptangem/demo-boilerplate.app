@extends('backend.layouts.master')

@section('title', trans('labels.backend.access.permissions.management').' | '.trans('labels.backend.access.permissions.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.permissions.management') }}
        <small>{{ trans('labels.backend.access.permissions.edit') }}</small>
    </h1>
@endsection

@section('content')
    {!! Form::model($permission, ['route'=>[ 'admin.access.roles.permissions.update',$permission->id],'class'=>'form-horizontal','role'=>'form','method'=>'PATCH']) !!}
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">{{ trans('labels.backend.access.permissions.edit') }}</h3>
            <div class="box-tools with-border">
                @include('backend.access.includes.partials.header-buttons')
            </div>
        </div>
        <div class="box-body">
            <div>
                {{--Nav tabs--}}
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active" role="presentation">
                        <a href="#general" aria-controls="general" role="tab" data-toggle="tab">
                            {{ trans('labels.backend.access.permissions.tabs.general') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#dependencies" aria-control="dependencies" role="tab" data-toggle="tab">
                            {{ trans('labels.backend.access.permissions.tabs.dependencies') }}
                        </a>
                    </li>
                </ul>
                {{--tab panes--}}
                <div class="tab-content">
                    <div class="tab-pane active" id="general" role="tabpanel" style="padding-top: 20px">
                        <div class="form-group">
                            {!! Form::label('name', trans('validation.attributes.backend.access.permissions.name'),['class'=>'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>trans('validation.attributes.backend.access.permissions.name')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('display_name',trans('validation.attributes.backend.access.permissions.display_name'),['class'=>'control-label col-lg-2']) !!}
                            <div class="col-lg-10">
                                {!! Form::text('display_name',null,['class'=>'form-control','placeholder'=>trans('validation.attributes.backend.access.permissions.display_name')]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('group',trans('validation.attributes.backend.access.permissions.group'),['class'=>'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                <select name="group" id="" class="form-control">
                                    <option value="">{{ trans('labels.general.none') }}</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}" {!! $group->id == $permission->group_id ? 'selected':'' !!}>{!! $group->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('sort',trans('validation.attributes.backend.access.permissions.group_sort'),['class'=>'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::text('sort', null,['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">{{ trans('validation.attributes.backend.access.permissions.associated_roles') }}</label>
                            <div class="col-lg-10">
                                @if(count($roles))
                                    @foreach($roles as $role)
                                        <input type="checkbox" {{ $role->id == 1 ? 'disabled' :"" }} {{ in_array($role->id,$permission_roles)|| ($role->id == 1)? 'checked':'' }} value="{{ $role->id }}"><label
                                                for="role-{{$role->id}}">{!! $role->name !!}</label><br/>
                                        <div class="clearfix"></div>
                                    @endforeach
                                @else
                                    {{ trans('labels.backend.access.permissions.no_roles') }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">{{ trans('validation.attributes.backend.access.permissions.system') }}</label>
                            <div class="col-lg-10">
                                <input type="checkbox" name="system" {{ $permission->system==1 ? 'checked':'' }}>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="dependencies" style="padding-top: 20px">
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i>
                            {!! getLanguageBlock('backend.lang.access.roles.permissions.dependencies-explanation') !!}
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">{{ trans('validation.attributes.backend.access.permissions.dependencies') }}</label>
                            <div class="col-lg-10">
                                @if(count($permissions))
                                    @foreach(array_chunk($permissions->toArray(), 10) as $perm)
                                        <div class="col-lg-3">
                                            <ul style="margin: 0px;padding: 0px;list-style: none">
                                                @foreach($perm as $p)
                                                    <?php
                                                        $dependencies = [];
                                                        $dependency_list = [];
                                                        if(count($p['dependencies'])){
                                                            foreach($p['dependencies'] as $dependency){
                                                                array_push($dependencies, $dependency['dependency_id']);
                                                                array_push($dependency_list,$dependency['permission']['display_name']);
                                                            }
                                                        }
                                                        $dependencies = json_encode($dependencies);
                                                        $dependency_list = implode(', ',$dependency_list);
                                                    ?>
                                                    @if($p['id'] != $permission->id)
                                                        <li>
                                                            <input type="checkbox" value="{{ $p['id'] }}" name="dependencies[]" data-dependencies="{{ $dependencies }}" id="permission-{{$p['id']}}" {!! in_array($p['id'],$permission_dependencies) ? 'checked':'' !!}>
                                                            <label for="permission-{{$p['id']}}" >
                                                                @if($p['dependencies'])
                                                                    <a style="color:black;text-decoration:none;" data-toggle="tooltip" data-html="true" title="<strong>{{ trans('labels.backend.access.permissions.dependencies') }}:</strong> {!! $dependency_list !!}">{!! $p['display_name'] !!} <small><strong>(D)</strong></small></a>
                                                                @else
                                                                    {!! $p['display_name'] !!}
                                                                @endif
                                                            </label>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                @else
                                    {{ trans('labels.backend.access.permissions.no_permissions') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
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
            <div class="clearfix"></div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('after-scripts-end')
    {!! Html::script('js/backend/access/permissions/dependencies/script.js') !!}
@stop
