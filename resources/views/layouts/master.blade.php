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
            @if( Auth::check() && !Auth::user()->admin)
                <script> angular.module('cv').constant('$currentUser', {{ Auth::user()->id }}); </script>
                <script> angular.module('cv').constant('$cvId', {{ $cv->id }}); </script>
            @else
                <script> angular.module('cv').constant('$currentUser', 0); </script>
                <script> angular.module('cv').constant('$cvId', {{isset($cv)? $cv->id : 'null'}}); </script>
            @endif
            <style>
                {!! $cv ? $cv->template->css : null !!}
            </style>
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
                        @if(isset($cv) && $cv)
                            <script type="text/ng-template" id="template.html">
                                {!! $cv->template->template !!}
                            </script>
                        @endif
                    @show
                </div>
            </div>
        @section('footer')
        @show
        </div>
        {!! HTML::script('dist/js/laravel.js') !!}
    </body>
</html>

