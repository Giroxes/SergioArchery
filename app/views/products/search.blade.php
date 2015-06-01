@extends("layout")
@section("content")
    @if($productos->count())
        <p>Su consulta ha obtenido los siguientes resultados:</p>
        @include('products/productsList')
    @else
        <h1>No se encontraron resultados.</h1>
    @endif
@stop