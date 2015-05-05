@extends("layout")
@section("content")

{? $categorias = Category::where('parent_id', '=', null)->get() ?}
<ul id="myTab" class="nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#categories" id="categories-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><h1>Categorías</h1></a></li>
    <li role="presentation" class=""><a href="#products" role="tab" id="products-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><h1>Productos</h1></a></li>
</ul>

<div id="myTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="categories" aria-labelledby="home-tab">
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
    @endforeach
    <a href="{{ URL::to('/admin/category/create') }}" class="btn btn-success navbar-btn" style="margin-left: 3px;"><h3>Añadir categoria</h3></a>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="products" aria-labelledby="profile-tab">
        
    </div>
</div>
@stop