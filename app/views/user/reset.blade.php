@extends("layout")
@section("content")
    @if(Session::has('error'))
        {{ Session::pull('error') }}
    @endif
    {{ Form::open(array('url'=>'user/reset', 'method'=>'POST')) }}
        {{ Form::label('email', 'E-mail') }}
        {{ Form::text('email') }}
    <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password') }}
    </div>
    <div class="form-group">
        {{ Form::label('password_confirmation', 'Password Confirmation') }}
        {{ Form::password('password_confirmation') }}
    </div>
        <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">
        <input type="submit" value="Reset Password" class="btn btn-primary">
    </div>
    {{ Form::close() }}
@stop