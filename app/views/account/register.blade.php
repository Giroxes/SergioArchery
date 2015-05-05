@extends('layout')
@section('content')
    {{ Form::open(array(
        'url' => 'account/register',
        'autocomplete' => 'off',
        'method' => 'POST'
    )) }}
    <div class="form-group"> 
        {{ Form::label('username', 'Username') }}
        {{ Form::text('username','',[
            'required' => 'required'
        ]) }}
    </div>
    <div class="form-group"> 
        {{ Form::label('email', 'E-mail') }}
        {{ Form::email('email','',[
            'required' => 'required'
        ]) }}
    </div>
    <div class="form-group"> 
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password','',[
            'required' => 'required'
        ]) }}
    </div>
    <div class="form-group"> 
        {{ Form::label('password_confirmation', 'Password Confirmation') }}
        {{ Form::password('password_confirmation','',[
            'required' => 'required'
        ]) }}
    </div>
    <div class="form-group"> 
        {{ Form::submit("Enviar", ["class" => "btn btn-primary"]) }}
    </div>
    {{ Form::close() }}
    @if ($error = $errors->first('username'))
        <div class="error">
            {{ $error }}
        </div>
    @endif
    @if ($error = $errors->first('email'))
        <div class="error">
            {{ $error }}
        </div>
    @endif
@stop

