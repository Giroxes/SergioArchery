<!DOCTYPE html>
<html lang=”en”>
    <head>
        <meta charset="UTF-8" />
        {{ HTML::style('css/layout.css'); }}
        <title>Tutorial</title>
    </head>
    <body>
        @include("header")
        <div class="content">
            <div class="container">
                @yield("content")
            </div>
        </div>
        @include("footer")
    </body>
</html>
