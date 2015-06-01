@extends("layout")
@section("content")
    @if($productos)
        <p>{{ ucfirst($productos->first()->category->parent->name) }} >> {{ ucfirst($productos->first()->category->name) }}</p>
        @include('products/productsList')
    @else
        <h1>No se encontraron resultados.</h1>
    @endif
@stop