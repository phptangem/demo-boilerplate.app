<html>
    <head>
        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('meta_author', 'Tangem')" >
        @yield('meta')

        <!-- Styles -->
        @yield('before-style-end')
        {!! Html::style(elixir('css/backend.css')) !!}
        @yield('after-style-end')

        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

    </head>
    <body class="skin-{!! config('backend.theme') !!}">
        <div class="wrapper">
            @include('backend.includes.header')
            @include('backend.includes.sidebar')

            <div class="content-wrapper">
                <section class="content-header">

                    @yield('page-header')


                    {!! Breadcrumbs::renderIfExists() !!}
                </section>

                <section class="content">
                    @include('includes.partials.messages')
                    @yield('content')
                </section>


            </div>
                @include('backend.includes.footer')
        </div>

        {{--JavaScripts--}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery/jquery-2.1.4.min.js')}}"><\/script>')</script>
        {!! Html::script('js/vendor/bootstrap/bootstrap.min.js') !!}

        @yield('before-scripts-end')
        {!! HTML::script(elixir('js/backend.js')) !!}
        @yield('after-scripts-end')
    </body>
</html>