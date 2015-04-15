@extends("layout")
@section("content")
    <p>{{ Session::pull('message') }}</p>
    <p>{{ HTML::link('home', 'Volver a la página principal'); }}</p>
@stop