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
            @else
                <script> angular.module('cv').constant('$currentUser', 0); </script>
            @endif
            <script> angular.module('cv').constant('$cvId', {{ $cv->id }}); </script>
            <style>
                {!! $cv->template->css !!}
            </style>
        @show
    </head>
    <body ng-app="@yield('app')" class="@yield('body-classes')">
        @section('content')
            <script type="text/ng-template" id="template.html">
                {!! $cv->template->pdf_template !!}
            </script>
        @show
    </body>
</html>

