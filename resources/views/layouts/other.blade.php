<!DOCTYPE html>
<html>
    <head>
        <title>Online CV</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        {!! HTML::style('dist/css/main.min.css') !!}
        {!! HTML::script('dist/js/main.min.js') !!}
        {!! HTML::script('dist/js/app.min.js') !!}
        @section('head')
            <script> angular.module('cv').constant('$baseUrl', '{{ URL::to('/') }}/'); </script>
            <script> angular.module('cv').constant('$currentUser', 0); </script>
            <script> angular.module('cv').constant('$cvId', null);  </script>
        @show
    </head>
    <body ng-app="@yield('app')" class="@yield('body-classes')">
    <div id="top"></div>
        <div class="wrapper">
        @section('header')
        @show
            <div class="container">
                <div class="content">
                    @section('content')
                    @show
                </div>
            </div>
        @section('footer')
        @show
        </div>
        {!! HTML::script('dist/js/laravel.js') !!}
    </body>
</html>

