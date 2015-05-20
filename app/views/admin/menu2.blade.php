@extends("layout")
@section("content")

<ul id="myTab" class="nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#products" id="products-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><h1>Productos</h1></a></li>
    <li role="presentation" class=""><a href="#categories" role="tab" id="categories-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><h1>Categorías</h1></a></li>
</ul>

<div id="myTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="products" aria-labelledby="profile-tab">
    {? $subcategorias = Category::whereNotNull('parent_id')->get() ?}
    @foreach($subcategorias as $subcategoria)
        {? $productos = $subcategoria->products ?}
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h2>
                    {{ ucfirst($subcategoria->name) }}
                </h2>
            </div>
            
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><h3>Nombre</h3></th>
                            <th><h3>Marca</h3></th>
                            <th><h3>Potencia</h3></th>
                            <th><h3>Longitud</h3></th>
                            <th><h3>Precio</h3></th>
                            <th><h3>Descuento</h3></th>
                            <th><h3>Inicio</h3></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>{{ ucfirst($producto->name) }}</td>
                            <td>{{ ucfirst($producto->trademark) }}</td>
                            <td>{{ $producto->weight }}#</td>
                            <td>{{ $producto->length }}"</td>
                            <td>{{ $producto->price / 100 }}€</td>
                            <td>{{ $producto->discount / 100 }}%</td>
                            <td><span class="glyphicon glyphicon-{{ $producto->home ? 'ok' : 'remove' }}" aria-hidden="true"></span></td>
                            <td>
                                {{ Form::open(['url' => 'admin/product/' . $producto->id, 'method' => 'DELETE']) }}
                                {{ HTML::link('admin/product/' . $producto->id . '/edit', 'Editar', [
                                    'class' => 'btn btn-primary navbar-btn',
                                    'style' => 'margin-left: 3px;'
                                ]) }}
                                {{ Form::submit('Eliminar', ['class' => 'btn btn-danger navbar-btn'])}}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                        <tr>
                            <td>
                                {{ Form::open(['url' => 'admin/product/create', 'method' => 'GET']) }}
                                {{ Form::hidden('categoryId', $subcategoria->id) }}
                                {{ Form::submit('Añadir producto', ['class' => 'btn btn-success navbar-btn']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
    </div>
    
    <div role="tabpanel" class="tab-pane fade" id="categories" aria-labelledby="home-tab">
    {? $categorias = Category::where('parent_id', '=', null)->get() ?}
    @foreach($categorias as $categoria)
        {? $subcategorias = $categoria->subcategories ?}
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h2>
                    {{ ucfirst($categoria->name) }}
                    {{ Form::open(['url' => 'admin/category/' . $categoria->id, 'method' => 'DELETE']) }}
                    {{ HTML::link('admin/category/' . $categoria->id . '/edit', 'Editar', [
                        'class' => 'btn btn-primary navbar-btn',
                        'style' => 'margin-left: 3px;'
                    ]) }}
                    {{ Form::submit('Eliminar', ['class' => 'btn btn-danger navbar-btn'])}}
                    {{ Form::close() }}
                </h2>
            </div>
            
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody>
                    @foreach($subcategorias as $subcategoria)
                        <tr>
                            <td>
                                <h3>{{ ucfirst($subcategoria->name) }}</h3>
                                {{ Form::open(['url' => 'admin/category/' . $subcategoria->id, 'method' => 'DELETE']) }}
                                {{ HTML::link('admin/category/' . $subcategoria->id . '/edit', 'Editar', [
                                    'class' => 'btn btn-primary navbar-btn',
                                    'style' => 'margin-left: 3px;'
                                ]) }}
                                {{ Form::submit('Eliminar', ['class' => 'btn btn-danger navbar-btn'])}}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                        <tr>
                            <td>
                                {{ Form::open(['url' => 'admin/category/create', 'method' => 'GET']) }}
                                {{ Form::hidden('parentId', $categoria->id) }}
                                {{ Form::submit('Añadir subcategoria', ['class' => 'btn btn-success navbar-btn']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
    <a href="{{ URL::to('/admin/category/create') }}" class="btn btn-success navbar-btn" style="margin-left: 3px;"><h3>Añadir categoria</h3></a>
    </div>
</div>
@stop