@extends("layout")
@section("style")
<style>
    form {
        margin:0;
        padding:0;
        display: inline
    }
    .loading {
        width: 100%;
        height: 50px;
        display: block;
        margin-left: auto;
        margin-right: auto
    }
    .pagination {
        margin-left: 5px
    }
    #xml .btn {
        margin-bottom: 15px;
        margin-top: 5px;
    }
</style>
@stop

@section("content")
{{ Form::open([
    'url' => 'admin/xml',
    'files' => true,
    'id' => 'xml',
    'role' => 'form'
]) }}
    {{ Form::label('file', 'Cargar archivo XML') }}
    {{ Form::file('file') }}
    {{ Form::submit('Enviar', [
        'class' => 'btn btn-primary'
    ]) }}
{{ Form::close() }}

{? $categorias = Category::where('parent_id', '=', null)->get() ?}
@foreach($categorias as $categoria)
    {? $subcategorias = $categoria->subcategories ?}
    <div class="panel panel-default" style="background-color: lightgray" id="{{ $categoria->id }}">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <h2>
                {{ ucfirst($categoria->name) }}
                {{ HTML::link('admin/category/' . $categoria->id . '/edit', 'Editar', [
                    'class' => 'btn btn-primary navbar-btn',
                    'style' => 'margin-left: 3px;'
                ]) }}
                
                {{ Form::open([
                    'url' => 'admin/category/' . $categoria->id,
                    'method' => 'DELETE'
                ]) }}
                    {{ Form::submit('Eliminar', ['class' => 'btn btn-danger navbar-btn'])}}
                {{ Form::close() }}
                
                {{ Form::open([
                    'url' => 'admin/category/create',
                    'method' => 'GET'
                ]) }}
                    {{ Form::hidden('parentId', $categoria->id) }}
                    {{ Form::submit('Añadir subcategoria', [
                        'class' => 'btn btn-success navbar-btn',
                        'style' => 'margin-left: 10px'
                    ]) }}
                {{ Form::close() }}
                @if ($subcategorias->count())
                {{ Form::open(['url' => 'admin/product/create', 'method' => 'GET']) }}
                    {{ Form::hidden('categoryId', $categoria->id) }}
                    {{ Form::submit('Añadir producto', ['class' => 'btn btn-success navbar-btn']) }}
                {{ Form::close() }}
                @endif
                <button class="btn btn-warning btn-categoria">Mostrar/ocultar</button>
            </h2>
        </div>
        @foreach($subcategorias as $subcategoria)
        {? $productos = $subcategoria->products ?}
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading" style="background-color: gray" id="{{ $subcategoria->id }}">
                <h2>
                    {{ ucfirst($subcategoria->name) }}
                    {{ HTML::link('admin/category/' . $subcategoria->id . '/edit', 'Editar', [
                        'class' => 'btn btn-primary navbar-btn',
                        'style' => 'margin-left: 3px;'
                    ]) }}
                    
                    {{ Form::open([
                        'url' => 'admin/category/' . $subcategoria->id,
                        'method' => 'DELETE'
                    ]) }}
                        {{ Form::submit('Eliminar', ['class' => 'btn btn-danger navbar-btn'])}}
                    {{ Form::close() }}
                    
                    {{ Form::open(['url' => 'admin/product/create', 'method' => 'GET']) }}
                        {{ Form::hidden('categoryId', $subcategoria->id) }}
                        {{ Form::hidden('parentId', $categoria->id) }}
                        {{ Form::submit('Añadir producto', ['class' => 'btn btn-success navbar-btn']) }}
                    {{ Form::close() }}
                    <button class="btn btn-warning btn-subcategoria">Mostrar/ocultar</button>
                </h2>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                
            </div>
        </div>
        @endforeach
    </div>
@endforeach
<a href="{{ URL::to('/admin/category/create') }}" class="btn btn-success navbar-btn" style="margin-left: 3px;"><h3>Añadir categoria</h3></a>
<script>
    $('.panel-default .panel-default').hide();
    $('.table-responsive').hide();
    
    var botonesCat = $('.btn-categoria');
    botonesCat.on('click', function (event) {
        var panel = $(this).parents('.panel-default').children('.panel-default');
        panel.toggle();
    });
    
    
    var botonesSub = $('.btn-subcategoria');
    botonesSub.on('click', function (event) {
        var panel = $(this).parents('.panel-default');
        var catId = panel.children('.panel-heading').attr('id');
        var tabla = panel.children('.table-responsive');
        tabla.toggle();
        tabla.html('<img src="http://localhost/proyectoPHP/public/images/loading.gif" class="loading">');
        var url = 'http://localhost/proyectoPHP/public/ajax/' + catId;
        showTabla(tabla, url);
    });
    
    function paginationAjax(pagLinks) {
        pagLinks.on('click', function (event) {
            event.preventDefault();
            var tabla = $(this).parents('.table-responsive');
            var url = $(this).attr('href');
            showTabla(tabla, url);
        });
    }
    
    function checkBoxes(chkHead, chkBody) {
        chkHead.on('change', function (event) {
            chkBody.prop('checked', chkHead[0].checked);
        });
    }
    
    function showTabla(tabla, url) {
        $.ajax({
            dataType: "html",
            url: url,
            success: function (d) {
                tabla.html(d);
                var pagLinks = tabla.find('.pagination a');
                var chkHead = tabla.find('.chkHead');
                var chkBody = tabla.find('.chkBody');
                var desSel = tabla.find('.destroySelected');
                checkBoxes (chkHead, chkBody);
                paginationAjax(pagLinks);
                destroySelected(desSel);
            }
        });
    }
    
    function destroySelected(button) {
        button.on('click', function (event) {
            event.preventDefault();
            var tabla = $(this).parents('.table-responsive');
            var panel = $(this).parents('.panel-default');
            var catId = panel.children('.panel-heading').attr('id');
            var chks = tabla.find('.chkBody:checked:enabled');
            chks.each(function (index, element){
                var urlDel = "<?php echo URL::to('/admin/product'); ?>" + '/' + element.value ;
                $.ajax({
                    dataType: "html",
                    url: urlDel,
                    method: 'DELETE',
                    success: function (d) {}
                });
            });
            var url = 'http://localhost/proyectoPHP/public/ajax/' + catId;
            showTabla(tabla, url);
        });
    }
    <?php 
    if (Session::get('message')) { 
    ?>
        $.msgBox({
            title:"Atención",
            content: '<?php echo Session::get('message') ?>',
            type: '<?php echo Session::get('type') ?>'
        });
    <?php
    } 
    ?>
</script>
@stop