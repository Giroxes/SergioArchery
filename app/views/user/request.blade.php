@extends("layout")
@section("content")
    {{ Form::open(array('url'=>'user/remind', 'method'=>'POST')) }}
        {{ Form::label('email','E-mail') }}
        <input type="email" name="email" placeholder="ejemplo@asdf.com" required>
        <input type="submit" value="Enviar">
    {{ Form::close() }}
@stop