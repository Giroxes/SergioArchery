@extends("layout")
@section("content")

{{ Form::model($producto, [
    'url' => 'admin/product/' . $producto->id,
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
    {{ Form::label('trademark', 'Marca') }}
    {{ Form::text('trademark', null, [
        'class' => 'form-control',
        'required' => 'required'
    ]) }}
</div>
<div class='form-group'>
    {{ Form::label('category_id', 'Categoría') }}<br>
    {{ Form::select('category_id', $types, $producto->category_id) }}
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
        {{ Form::text('price', $producto->price / 100, [
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
        {{ Form::text('discount', $producto->discount / 100, [
            'class' => 'form-control',
            'required' => 'required',
            'aria-describedby' => 'basic-addon1'
        ]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label('home', 'Mostrar en Inicio') }}
    {{ Form::checkbox('home', true, null) }}
</div>
<div class='form-group'>
    {{ Form::submit('Guardar cambios', [
        'class' => 'btn btn-primary'
    ]) }}
</div>
{{ Form::close() }}
@stop