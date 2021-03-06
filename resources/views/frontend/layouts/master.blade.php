<html>
    <head>
        <meta name="_token" content="{{ csrf_token()}}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />
        <title>@yield('title',app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'default description')">
        <meta name="author" content="@yield('meta_author', 'Tangem')">
        @yield('meta')

        <!-- Styles -->
        @yield('before_styles_end')
        {!! Html::style(elixir('css/frontend.css')) !!}
        @yield('after_styles_end')

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    </head>
    <body id="app-layout">

        @include('frontend.includes.nav')

        <div class="container">
            @include('includes.partials.messages')
            @yield('content')
        </div>

        <!-- Javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery/jquery-2.1.4.min.js')}}"><\/script>')</script>
        {!! Html::script('js/vendor/bootstrap/bootstrap.min.js') !!}

        @yield('before-scripts-end')
        {!! Html::script(elixir('js/frontend.js')) !!}
        @yield('after-scripts-end')

        @include('includes.partials.ga')
    </body>
</html>