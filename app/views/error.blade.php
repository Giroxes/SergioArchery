@extends('layout')
@section('content')
<h2 id='error'>La página que buscas no existe.</h2>
{{ HTML::link('home', 'Volver a la página principal.') }}

@stop