{{--Left side column.contains the logo and sidebar--}}
<aside class="main-sidebar">
    {{--sidebar:style can be found in style sidebar.less--}}
    <seciton class="sidebar">
        {{--Sidebar user panel--}}
            <div class="user-panel">
                <div class="pull-left image">
                    {{--<img src="{!! access()->user()->picture !!}" alt="User Image" class="img-circle">--}}
                    <img src="{{url('/img/avatar.jpg')}}" alt="User Image" class="img-circle">
                </div>
                <div class="pull-left info">
                    <p>{!! access()->user()->name !!}</p>
                    {{--Status--}}
                    <a href="#"><i class="fa fa-circle text-success"></i>{{trans('strings.backend.general.status.online')}}</a>
                </div>
            </div>

            {{--search form--}}
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="{!! trans('strings.backend.general.search_placeholder') !!}">
                    <span class="input-group-btn">
                        <button class="btn btn-flat" type="submit" name="search" id="search-btn"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>

            {{--Sidebar menu--}}
            <ul class="sidebar-menu">
                <li class="header">{{trans('menus.backend.sidebar.general')}}</li>

                {{--Optionally,you can add icons to the links--}}
                <li class="{{ Active::getClassIf(if_uri_pattern('admin/dashboard')) }}">
                    <a href="{!! route('admin.dashboard') !!}"><span>{{trans('menus.backend.sidebar.dashboard')}}</span></a>
                </li>

                @permission('view-access-permission')
                    <li class="{{Active::getClassIf(if_uri_pattern('admin/access/*'))}}">
                        <a href="{!!url('admin/access/users')!!}"><span>{{ trans('menus.backend.access.title') }}</span></a>
                    </li>
                @endauth

                <li class="{{Active::getClassIf(if_uri_pattern('admin/log-viewer*'))}} treeview">
                    <a href="#">
                        <span>{{trans('menus.backend.log-viewer.main')}}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu {{Active::getClassIf(if_uri_pattern(['admin/log-viewer*', 'menu-open']))}}" style="display: none; {{ Active::getClassIf(if_uri_pattern(['admin/log-viewer*', 'display: block;'])) }}">
                        <li class="{{ Active::getClassIf(if_uri_pattern('admin/log-viewer')) }}">
                            <a href="{!! url('admin/log-viewer') !!}">{{ trans('menus.backend.log-viewer.dashboard') }}</a>
                        </li>
                        <li class="{{ Active::getClassIf(if_uri_pattern('admin/log-viewer/logs')) }}">
                            <a href="{!! url('admin/log-viewer/logs') !!}">{{ trans('menus.backend.log-viewer.logs') }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
    </seciton>
</aside>