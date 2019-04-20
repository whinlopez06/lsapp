<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!--global config helper. if not available set value to 2nd param-->
        <title>{{ config('app.name', 'LSAPP') }}</title>

    </head>
    <body>
        <!--navbar-->
        @include('inc.navbar')
        
        <div class="container">
            <!--error messages-->
            @include('inc.messages')

            <!--content will be here-->
            @yield('content')   

        </div>

    <!--ckeditor-->
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>

    </body>
</html>
