@extends('layout')
@section('content')
    {{ Form::open(array(
        'url' => 'account/register',
        'autocomplete' => 'off',
        'method' => 'POST'
    )) }}
        {{ Form::label('username', 'Username') }}
        {{ Form::text('username') }}

        {{ Form::label('email', 'E-mail') }}
        {{ Form::text('email') }}

        {{ Form::label('password', 'Password') }}
        {{ Form::password('password') }}

        {{ Form::label('password_confirmation', 'Password Confirmation') }}
        {{ Form::password('password_confirmation') }}

        {{ Form::submit("Send") }}
    {{ Form::close() }}
@stop

