@extends("layout")
@section("content")
    <form action="{{ action('RemindersController@postRemind') }}" method="POST">
        {{ Form::label('email','E-mail') }}
        <input type="email" name="email" placeholder="ejemplo@asdf.com" required>
        <input type="submit" value="Enviar">
    </form>
@stop
@section("footer")
    @parent
    
@stop