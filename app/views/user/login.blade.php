@extends("layout")
@section("content")
    <p>{{ HTML::link('user/remind', '¿Has olvidado tu contraseña?') }}</p>
    {{ Form::open(array(
        'url' => 'user/login',
        'autocomplete' => 'off',
        'method' => 'POST'
    )) }}
    <div class="form-group">  
        {{ Form::label("username", "Username") }}
        {{ Form::text("username", Session::get("username"), [
            "placeholder" => "john.smith",
            'required' => 'required'
        ]) }}
    </div>
    <div class="form-group">  
        {{ Form::label("password", "Password") }}
        {{ Form::password("password", [
            "placeholder" => "******",
            'required' => 'required'
        ]) }}
    </div>
    @if ($error = Session::get('errors'))
        <div class="error">
            {{ $error->first('password') }}
        </div>
    @endif
    <div class="form-group"> 
        {{ Form::submit("Entrar", ["class" => "btn btn-primary"]) }}
    </div>
    {{ Form::close() }}
@stop