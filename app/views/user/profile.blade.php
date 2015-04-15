@extends("layout")
@section("content")
    <h2>Hello {{ strtoupper(Auth::user()->username) }}</h2>
    <p>Welcome to your sparse profile page.</p>
@stop
