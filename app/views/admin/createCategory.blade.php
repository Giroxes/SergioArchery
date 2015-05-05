@extends("layout")
@section("content")

{{ Form::open([
    'url' => 'admin/category',
    'method' => 'POST',
    'role' => 'form'
]) }}
<div class='form-group'>
    {{ Form::label('name', 'Nombre') }}
    {{ Form::text('name', '', [
        'class' => 'form-control',
        'required' => 'required'
    ]) }}
</div>
<div class='form-group'>
    {{ Form::submit('Crear', [
        'class' => 'btn btn-primary'
    ]) }}
</div>
{{ Form::hidden('parentId', $parentId) }}
{{ Form::close() }}
@stop