@extends('backend.layouts.master')

@section('title',trans('labels.backend.access.users.management').' | '.trans('labels.backend.access.users.deleted'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.deleted') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.deleted') }}</h3>
            <div class="box-tools pull-right">
                @include('backend.access.includes.partials.header-buttons')
            </div>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.access.users.table.id') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.name') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.e-mail') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.confirmed') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.roles') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.other-permissions') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.created') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if($users->count())
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{!!  $user->confirmed_label !!} </td>
                                    <td>
                                        @if($user->roles()->count())
                                            @foreach($user->roles as $role)
                                                {{ $role->name }}<br />
                                            @endforeach
                                        @else
                                            {{ trans('labels.general.none')}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->permissions()->count())
                                            @foreach($user->permissions as $perm)
                                                {{ $perm->display_name }}<br />
                                            @endforeach
                                        @else
                                            {{ trans('labels.general.none') }}
                                        @endif
                                    </td>
                                    <td class="visible-lg">{!! $user->created_at->diffForHumans() !!}</td>
                                    <td class="visible-lg">{!! $user->updated_at->diffForHumans() !!}</td>
                                    <td>
                                        @permission('undelete-users')
                                        <a href="{{ route('admin.access.user.restore', $user->id) }}" class="btn btn-xs btn-success" name="restore_user"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="{{ trans('buttons.backend.access.users.restore_user') }}"></i></a>
                                        @endauth
                                        @permission('permanently-delete-users')
                                        <a href="{{route('admin.access.user.delete-permanently', $user->id)}}" class="btn btn-xs btn-danger" name="delete_user_perm"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="{{ trans('buttons.backend.access.users.delete_permanently') }}"></i></a>
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="9">{{ trans('labels.backend.access.users.table.no_deleted') }}</td>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="pull-left">
                {!! $users->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $users->total()) }}
            </div>

            <div class="pull-right">
                {!! $users->render() !!}
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
@endsection