@section('navbar')
    {? $categoriasnav = Category::where('parent_id','=',null)->get(); ?}

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
                <li>{{ HTML::link('user/profile', 'Perfil') }}</li>
                
                @if (Auth::user()->admin)
                <li>{{ HTML::link('admin', 'Administrar') }}</li>
                @endif
                
                <li>{{ HTML::link('user/logout', 'Cerrar sesión') }}</li>
            @else
                <li>{{ HTML::link('user/login', 'Entrar') }}</li>
                <li>{{ HTML::link('account/register', 'Registrar') }}</li>
            @endif                   
            </ul>
            <ul class="nav navbar-nav">
                <li>
                    {{ HTML::link('home', 'Inicio') }}
                </li>
                @foreach($categoriasnav as $categorianav)
                {? $subcategoriasnav = $categorianav->subcategories ?}
                <li class="dropdown">
                    {{ HTML::link('products/' . $categorianav->name, ucfirst($categorianav->name), [
                        'class' => 'dropdown-toggle',
                        'data-toggle' => 'dropdown',
                        'role' => "button",
                        'aria-expanded' => 'false'
                    ]) }}
                    @if(!$subcategoriasnav->isEmpty())
                    <ul class="dropdown-menu" role="menu">
                        @foreach($subcategoriasnav as $subcategorianav)
                        <li>{{ HTML::link('category/' . $subcategorianav->name, ucfirst($subcategorianav->name)) }}</li>
                        @endforeach
                    </ul>
                    @endif              
                </li>                
                @endforeach
            </ul>
            <div class="col-sm-3 col-md-3 pull-left nav navbar-nav">
                <form class="navbar-form" role="search" method="get" action="{{ URL::to('search') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar" name="search">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </nav>
@show