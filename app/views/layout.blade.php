<!DOCTYPE html>
<html lang=”en”>
    <head>
        <meta charset="UTF-8" />
        {{ HTML::style('css/layout.css'); }}
        {{ HTML::style('assets/css/bootstrap.min.css', array('media' => 'screen')) }}
        <script src="//code.jquery.com/jquery.js"></script>
        @yield("head")
        <title>Sergio's Archery</title>
    </head>
    <body style="padding-top: 100px">
        @include("navbar")
        <div class="content">
            <div class="container">
                @yield("content")
            </div>
        </div>
        <!-- @include("footer") -->
        {{ HTML::script('assets/js/bootstrap.min.js') }}
    </body>
</html>
