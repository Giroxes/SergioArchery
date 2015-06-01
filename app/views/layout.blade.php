<!DOCTYPE html>
<html lang=”en”>
    <head>
        <meta charset="UTF-8" />
        {{ HTML::style('assets/css/bootstrap.min.css', array('media' => 'screen')) }}
        {{ HTML::style('assets/css/msgBoxLight.css', array('media' => 'screen')) }}
        {{ HTML::style('css/main.css', array('media' => 'screen')) }}
        <script src="//code.jquery.com/jquery.js"></script>
        {{ HTML::script('assets/js/jquery.msgBox.js') }}
        <title>Sergio's Archery</title>
        @yield("style")
    </head>
    <body style="padding-top: 25px">
        @include("navbar")
        <div class="content">
            <div class="container">
                @include("header")
                @yield("content")
            </div>
        </div>
        @include("footer")
        {{ HTML::script('assets/js/bootstrap.min.js') }}
    </body>
</html>
