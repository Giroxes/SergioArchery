@extends("layout")
@section("content")
    @if(Session::has('error'))
        {{ Session::pull('error') }}
    @endif
    {{ Form::open(array('url'=>'user/remind', 'method'=>'POST')) }}
        {{ Form::label('email','E-mail') }}
        <input type="email" name="email" id="email" placeholder="ejemplo@asdf.com" required>
        <input type="submit" value="Enviar">
    {{ Form::close() }}
@stop