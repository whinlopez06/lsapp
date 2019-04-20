<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


</head>
<body>
    <div id="app">

        <!--include navbar here-->
        @include('inc.navbar')

        <main class="py-4">
        
            <!--container here-->
            <div class="container">
                <!--include alert messages here-->
                @include('inc.messages')
                @yield('content')
            </div>
        </main>
        
    </div>

    <!--Script. removed the defer in script to fix the ckeditor issue-->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!--Scripts for ckeditor for blog body-->
    <script src="../vendor/unisharp/laravel-ckeditor/ckeditor.js" ></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
    
</body>
</html>
