<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>
                {{ Form::checkbox('', null, false, [
                    'class' => 'chkHead'
                ])}}
            </th>
            <th>
                {{ HTML::link('', 'Eliminar seleccionados', [
                    'class' => 'btn btn-danger navbar-btn destroySelected',
                    'style' => 'margin-left: 3px;'
                ]) }}
            </th>
            <th><h3>Id</h3></th>
            <th><h3>Nombre</h3></th>
            <th><h3>Marca</h3></th>
            <th><h3>Precio</h3></th>
            <th><h3>Descuento</h3></th>
            <th><h3>Inicio</h3></th>
        </tr>
    </thead>
    <tbody>
    @foreach($productos as $producto)
        <tr>
            <td>{{ Form::checkbox('productoId', $producto->id, false, [
                'class' => 'chkBody'
            ])}}</td>
            <td>
                {{ HTML::link('admin/product/' . $producto->id . '/edit', 'Editar', [
                    'class' => 'btn btn-primary navbar-btn',
                    'style' => 'margin-left: 3px;'
                ]) }}
                {{ Form::open(['url' => 'admin/product/' . $producto->id, 'method' => 'DELETE']) }}
                    {{ Form::submit('Eliminar', ['class' => 'btn btn-danger navbar-btn'])}}
                {{ Form::close() }}
            </td>
            <td>{{ $producto->id }}</td>
            <td>{{ ucfirst($producto->name) }}</td>
            <td>{{ ucfirst($producto->trademark) }}</td>
            <td>{{ $producto->price / 100 }}€</td>
            <td>{{ $producto->discount / 100 }}%</td>
            <td><span class="glyphicon glyphicon-{{ $producto->home ? 'ok' : 'remove' }}" aria-hidden="true"></span></td>
        </tr>
    @endforeach                        
    </tbody>
</table>

{{ $productos->links() }}