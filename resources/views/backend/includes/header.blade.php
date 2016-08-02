<header class="main-header">

    {{--Logo--}}
    <a href="{!! route('frontend.index') !!}" class="logo">{!! app_name() !!}</a>

    {{--Header Navbar--}}
    <nav class="navbar navbar-static-top">
        {{--Sidebar toggle button--}}
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
        </a>
        {{--Navbar Right Menu--}}
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                @if(config('locale.status') && count(config('locale.languages')) > 1)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ trans('menus.language-picker.language') }} <span class="caret"></span></a>
                        @include('includes.partials.lang')
                    </li>
                @endif

                {{--Messages:style can be found in dropdown.less--}}
                <li class="dropdown messages-menu">
                    {{--Menu toggle button--}}
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">6</span>
                    </a>
                    <ul class="dropdown-menu">

                        <li class="header">{{trans_choice('strings.backend.general.you_have.messages',4,['number'=>4])}}</li>
                        <li>
                            {{--inner menu: contains the messages--}}
                            <ul class="menu">
                                <li>
                                    {{--Start the message--}}
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{!! access()->user()->picture !!}" alt="User Image" class="img-circle" />
                                        </div>
                                        <h4>
                                            Support Team
                                            <small><i class="fa fa-clock-o">5 mins</i></small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">{{trans('strings.backend.general.see_all.messages')}}</a></li>
                    </ul>
                </li>

                {{--Notifications Menu--}}
                <li class="dropdown notification-menu">
                    {{--Menu toggle button--}}
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">{{trans_choice('strings.backend.general.you_have.notifications',0)}}</li>
                        <li>
                            {{--Inner Menu:contains the notifications--}}
                            <ul class="menu">
                                <li>
                                    {{--start notification--}}
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i>5 new members joined today
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">{{trans('strings.backend.general.see_all.notifications')}}}</a></li>
                    </ul>
                </li>

                {{--Tasks Menu--}}
                <li class="dropdown tasks-menu">
                    {{--Menu Toggle Button--}}
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">1</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">{{trans_choice('strings.backend.general.you_have.tasks',1,['number'=>1])}}</li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width:20%" role="progressbar" aria-valuenow="20" aria-valuemax="100" aria-valuemin="0">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">{{trans('strings.backend.general.see_all.tasks')}}</a>
                        </li>
                    </ul>
                </li>

                {{--User Account Menu--}}
                <li class="dropdown user user-menu">
                    {{--Menu Toggle Button--}}
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{!! access()->user()->picture !!}" alt="User Image" class="user-image">
                        <span class="hidden-xs">{{access()->user()->name}}</span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{!! access()->user()->picture !!}" alt="User Image" class="img-circle" />
                            <p>
                                {!! access()->user()->name !!}-{{trans('roles.web_developer')}}
                                <small>{{trans('strings.backend.general.member_since')}} XX/XX/XXXX</small>
                            </p>
                        </li>
                        {{--Menu Body--}}
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Link</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#" class="">Link</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#" class="">Link</a>
                            </div>
                        </li>

                        {{--Menu Footer--}}
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">{{ trans('navs.backend.button') }}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{!! route('auth.logout') !!}" class="btn btn-default btn-flat">{{trans('navs.general.logout')}}</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>