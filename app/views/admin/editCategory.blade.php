@extends("layout")
@section("content")

{{ Form::model($categoria, [
    'url' => 'admin/category/' . $categoria->id,
    'method' => 'PATCH',
    'role' => 'form'
]) }}
<div class='form-group'>
    {{ Form::label('name', 'Nombre') }}
    {{ Form::text('name', null, [
        'class' => 'form-control',
        'required' => 'required'
    ]) }}
</div>
<div class='form-group'>
    {{ Form::submit('Guardar cambios', [
        'class' => 'btn btn-primary'
    ]) }}
</div>
{{ Form::close() }}
@stop