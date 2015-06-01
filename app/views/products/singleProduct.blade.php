@extends("layout")
@section("content")
    <p>{{ ucfirst($producto->category->parent->name) }} >> {{ ucfirst($producto->category->name) }}</p>
    <div class="media thumbnail">
        <div class="media-left">
            {{ HTML::image("images/products/" . $producto->image, '#', [
                'id' => 'productImage'
            ]) }}
        </div>
        <div class="media-body">
            <h2 class="media-heading text-capitalize name">{{ $producto->name}}</h2>
            <p class="trademark  text-capitalize">{{ $producto->trademark }}</p>
        @if(Auth::check())
            <p class="oldPrice"><strike>{{ $producto->price / 100 }}€</strike> -{{ $producto->discount / 100 }}%</p>
            <p class="price">{{ number_format((float)(($producto->price - ($producto->price * ($producto->discount / 10000))) / 100), 2, '.', '') }}€</p>
        @else
            <p class="price">{{ $producto->price /100 }}€</p>
        @endif
            <p class='description'>{{ $producto->description }}</p>
        </div>
    </div>
@stop