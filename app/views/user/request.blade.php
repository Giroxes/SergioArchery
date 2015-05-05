@extends("layout")
@section("content")
    @if(Session::has('error'))
        {{ Session::pull('error') }}
    @endif
    {{ Form::open(array('url'=>'user/remind', 'method'=>'POST')) }}
    <div class="form-group"> 
        {{ Form::label('email','E-mail') }}
        <input type="email" name="email" id="email" placeholder="ejemplo@asdf.com" required>
    </div>
    <div class="form-group">
        <input type="submit" value="Enviar" class="btn btn-primary">
    </div>
    {{ Form::close() }}
@stop