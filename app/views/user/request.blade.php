@extends("layout")
@section("content")
    <form action="{{ action('RemindersController@postRemind') }}" method="POST">
        <input type="email" name="email">
        <input type="submit" value="Send Reminder">
    </form>
@stop
@section("footer")
@parent
    <script src="//polyfill.io"></script>
@stop
