@section('productsList')
    <p>
        {{ Form::label('order', 'Ordenar por:') }}
        {{ Form::select('order', [
            '' => 'Seleccione una opción',
            'alf' => 'Alfabéticamente',
            'Precio' => [
                'crec' => 'Menor a Mayor',
                'decr' => 'Mayor a Menor'
            ]
        ], null, [
            'class' => 'form-control',
            'id' => 'order'
        ]) }}
    </p>
    <div class="row">
    @foreach ($productos as $producto)
        <div class="col-sm-4 col-md-4">
            <div class="thumbnail">
                {{ HTML::image("images/products/" . $producto->image) }}
                <div class="caption">
                    <h3 class="text-capitalize"><b>{{ ucfirst($producto->name) }}</b></h3>
                    <h4 class="text-capitalize"><b>{{ ucfirst($producto->trademark) }}</b></h4>
                @if(Auth::check())
                    <p><strike>{{ $producto->price / 100 }}€</strike> -{{ $producto->discount / 100 }}%</p>
                    <p><span class="price">{{ number_format((float)(($producto->price - ($producto->price * ($producto->discount / 10000))) / 100), 2, '.', '') }}</span>€</p>
                @else
                    <p><span class="price">{{ $producto->price /100 }}</span>€</p>
                @endif
                    <p><a href="{{ URL::to('product/' . $producto->id) }}" class="btn btn-primary" role="button">Ver</a></p>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <script>
        $('#order').on('change', function (event) {
            event.preventDefault();
            var row = $('.row');
            var elements = $('.row > div');
            var select = this;
            if (select.value) {
                elements.sort(function(a, b) {
                    var compA = select.value === 'alf' ? $(a).find('h3').text().toUpperCase() : $(a).find('.price').text();
                    var compB = select.value === 'alf' ? $(b).find('h3').text().toUpperCase() : $(b).find('.price').text();
                    if (select.value === 'decr') {
                        return (+compA < +compB) ? 1 : (+compA > +compB) ? -1 : 0;
                    } else if (select.value === 'crec') {
                        return (+compA < +compB) ? -1 : (+compA > +compB) ? 1 : 0;
                    } else if (select.value === 'alf') {
                        return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
                    }
                });
                $.each(elements, function(idx, itm) { row.append(itm); });
            }
        });
    </script>
@show