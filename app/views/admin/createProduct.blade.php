@extends("layout")
@section("content")

{{ Form::open([
    'url' => 'admin/product',
    'method' => 'POST',
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
    {{ Form::label('trademark', 'Marca') }}
    {{ Form::text('trademark', null, [
        'class' => 'form-control',
        'required' => 'required'
    ]) }}
</div>
<div class='form-group'>
    {{ Form::label('category_id', 'Categoría') }}<br>
    {{ Form::select('category_id', $types, $categoryId) }}
</div>
<div class='form-group'>
    {{ Form::label('weight', 'Potencia') }}
    <div class='input-group'>
        <span class="input-group-addon" id="basic-addon1">#</span>
        {{ Form::number('weight', null, [
            'class' => 'form-control',
            'required' => 'required',
            'aria-describedby' => 'basic-addon1'
        ]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label('length', 'Longitud') }}
    <div class='input-group'>
        <span class="input-group-addon" id="basic-addon2">"</span>
        {{ Form::number('length', null, [
            'class' => 'form-control',
            'required' => 'required',
            'aria-describedby' => 'basic-addon1'
        ]) }}
    </div>
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
    {{ Form::label('home', 'Mostrar en Inicio') }}
    {{ Form::checkbox('home', true, false) }}
</div>
<div class='form-group'>
    {{ Form::submit('Crear', [
        'class' => 'btn btn-primary'
    ]) }}
</div>
{{ Form::close() }}
@stop