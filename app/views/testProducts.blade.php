@extends("layout")
@section("content")
    @if($productos)
        @foreach ($productos as $producto)
            <p>{{ $producto->name }}</p>
        @endforeach
    @endif
@stop

