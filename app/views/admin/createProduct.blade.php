@extends("layout")
@section("content")
<p>{{ $errors->first() }}</p>
{{ Form::open([
    'url' => 'admin/product',
    'method' => 'POST',
    'role' => 'form',
    'files' => true
]) }}
<div class='form-group'>
    {{ Form::label('name', 'Nombre') }}
    {{ Form::text('name', null, [
        'class' => 'form-control',
        'required' => 'required'
    ]) }}
</div>
<div class='form-group'>
    {{ Form::label('trademark', 'Marca') }}
    {{ Form::text('trademark', null, [
        'class' => 'form-control',
        'required' => 'required'
    ]) }}
</div>
<div class='form-group'>
    {{ Form::label('category_id', 'Categoría') }}<br>
    {{ Form::select('category_id', $types, $categoryId, [
        'class' => 'form-control',
        'required' => 'required'
    ]) }}
</div>
<div class='form-group'>
    {{ Form::label('price', 'Precio') }}
    <div class='input-group'>
        <span class="input-group-addon" id="basic-addon3">€</span>
        {{ Form::text('price', null, [
            'class' => 'form-control',
            'required' => 'required',
            'aria-describedby' => 'basic-addon1'
        ]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label('discount', 'Descuento') }}
    <div class='input-group'>
        <span class="input-group-addon" id="basic-addon4">%</span>
        {{ Form::number('discount', null, [
            'class' => 'form-control',
            'required' => 'required',
            'aria-describedby' => 'basic-addon1'
        ]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label('image', 'Imagen') }}
    {{ Form::file('image', [
            'class' => 'form-control',
            'required' => 'required'
        ]) }}
</div>
<div class='form-group'>
    {{ Form::label('home', 'Mostrar en Inicio') }}
    {{ Form::checkbox('home', true, false) }}
</div>
<div class='form-group'>
    {{ Form::label('description', 'Descripción') }}
    <div class='input-group'>
        {{ Form::textarea('description', null, [
            'class' => 'form-control'
        ]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::submit('Crear', [
        'class' => 'btn btn-primary'
    ]) }}
</div>
{{ Form::close() }}
@stop