<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Angular Boilerplate</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        {!! HTML::style('dist/css/main.min.css') !!}
        {!! HTML::script('dist/js/main.min.js') !!}
        {!! HTML::script('dist/js/app.min.js') !!}
    </head>
    <body ng-app="welcomeApp">
        <div class="container">
            <div class="content">
                <ui-view></ui-view>
            </div>
        </div>
    </body>
</html>
