<?php
$productosInicio = Product::where('home', true)->get();
$active = true;
?>
@extends('layout')
@section('content')
    @if($productosInicio->count())
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <h2>Articulos destacados:</h2>
      <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        @for ($i=1; $i < $productosInicio->count(); $i++)
            <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
        @endfor
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($productosInicio as $producto)
            <div class="{{ $active ? "item active" : "item" }}">
                <a href="{{ URL::to('product/' . $producto->id)}}">
                {{ HTML::image("images/products/" . $producto->image, '#', ['class' => 'productCarousel']) }}
                <div class="carousel-caption">
                    <h3 class="text-capitalize">{{ $producto->name }}</h3>
                @if(Auth::check())
                    <p><strike>{{ $producto->price / 100 }}€</strike> -{{ $producto->discount / 100 }}%</p>
                    <p>{{ number_format((float)(($producto->price - ($producto->price * ($producto->discount / 10000))) / 100), 2, '.', '') }}€</p>
                @else
                    <p>{{ $producto->price /100 }}€</p>
                @endif
                </div>
                </a>
            </div>
                @if($active)
                    <?php $active = false ?>
                @endif
            @endforeach
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>
    @endif
@stop